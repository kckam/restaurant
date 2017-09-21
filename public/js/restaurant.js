restaurant = {
	init: function() {

		if (navigator.geolocation) {
          	navigator.geolocation.getCurrentPosition(function(position) {
	            restaurant.current_position = {
	              lat: position.coords.latitude,
	              lng: position.coords.longitude
	            };
	            restaurant.loadAllRestaurant();
	            restaurant.placeMarker();
            });
          }

		
		restaurant.loadHandler();
	},

	loadHandler: function() {
		$(".filter").change(function(){
			restaurant.filterData($(this).val());
		});

		$( "main" ).on( "click", ".map_label", function() {
			restaurant.showDetails($(this).attr("data-id"));
		});

		$( "main" ).on( "click", ".overlay_content", function() {
			restaurant.showDetails($(this).closest(".restaurant").attr("data-id"));
		});

		$(".close_page").click(function(){
			restaurant.closeFullPage();
		});
	},

	filterData: function(selected){
		var res = {};
		$.extend(res, restaurant.rawData);
		if(selected !== "")
		{
			for(i in res) 
			{
				if(res[i].category != selected)
				{
					delete res[i];
				}
			}
		}
		
		restaurant.updateTemplate(res);
		restaurant.updateMarker(res);
	},

	placeMarker: function() {
		$.ajax({
	  		url: "./get_all_restaurant",
		}).done(function(data) {
			restaurant.rawData = data;
			restaurant.updateTemplate(data);
	  		restaurant.updateMarker(data);
		});
	},

	updateTemplate: function(data) {
		data = data || null;
		var source   = $("#list-template").html();
		var template = Handlebars.compile(source);

		$(".restaurant_wrapper").html(template(data));
	},

	updateMarker: function(data) {
		for(i in data) {
  			var position = {
  				lat: parseFloat(data[i].lat),
  				lng: parseFloat(data[i].long),
  			}

		 	var map = new google.maps.Map(document.getElementById('map'+data[i].id), {
		        center: position,
		        zoom: 15,
		        disableDefaultUI: true
	        });

			
			// var marker = new google.maps.Marker({
			// 	position: position,
			// 	map: map,
			// 	// label: data[i].name,
			// 	title: data[i].name
		 //  	});

		  	var contentString = '<div class="map_label" data-id='+data[i].id+'><h1>'+data[i].name+'</h1></div>';

	        var infowindow = new google.maps.InfoWindow({
	          content: contentString
	        });

			var directionsDisplay;
            var request = {
				origin: restaurant.current_position,
			  	destination: position,
				provideRouteAlternatives: false,
				travelMode: 'DRIVING',
				unitSystem: google.maps.UnitSystem.IMPERIAL
	        };

	        directionsDisplay = new google.maps.DirectionsRenderer({
	         	map: map
	        });

	       	restaurant.calculateRoute(map,request, directionsDisplay, i);
	 		
		  	// restaurant.listenMarker(marker,infowindow,map);
  		}
	},

	listenMarker: function(marker,infowindow,map){
 		google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
	},

	calculateRoute: function(map, request, directionsDisplay, index) {
		

 		// Pass the directions request to the directions service.
        var directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function(response, status) {
          if (status == 'OK') {
            // Display the route on the map.
            directionsDisplay.setDirections(response);
            if(index)
            {
        	 	restaurant.rawData[index].map_details = directionsDisplay.getDirections();
            }
          }
        });
	},

	loadAllRestaurant: function(){
	 	var map = new google.maps.Map(document.getElementById('all_restaurant'), {
	        center: restaurant.current_position,
	        zoom: 11
	    });

		new google.maps.Marker({
			position: restaurant.current_position,
			map: map,
			icon: {
		      url: "https://d30y9cdsu7xlg0.cloudfront.net/png/8203-200.png",
		      scaledSize: new google.maps.Size(50, 50),
		    },
	  	});

	 	var currentRequest = null;   

	 	currentRequest = $.ajax({
	  		url: "./get_all_restaurant",
	  		beforeSend : function()    {           
		        if(currentRequest != null) {
		            currentRequest.abort();
		        }
		    },
		}).done(function(data) {
			for(i in data) {
	  			var position = {
	  				lat: parseFloat(data[i].lat),
	  				lng: parseFloat(data[i].long),
	  			}
				var marker = new google.maps.Marker({
					position: position,
					map: map,
					// label: data[i].name,
					title: data[i].name
			  	});

			  	var contentString = '<div class="map_label" data-id='+data[i].id+'><h1>'+data[i].name+'</h1></div>';

		        var infowindow = new google.maps.InfoWindow({
		          content: contentString
		        });

			  	restaurant.listenMarker(marker,infowindow,map);
	  		}
		});
	},

	showDetails: function(id) {
		var source   = $("#details-template").html();
		var template = Handlebars.compile(source);

		$(".full_page .content").html(template(restaurant.rawData[id]));


		var position = {
				lat: parseFloat(restaurant.rawData[id].lat),
				lng: parseFloat(restaurant.rawData[id].long),
			}

	 	var map = new google.maps.Map(document.getElementById('details_map'), {
	        center: position,
	        zoom: 15
        });

		var directionsDisplay;
        

        var request = {
			origin: restaurant.current_position,
		  	destination: position,
			provideRouteAlternatives: false,
			travelMode: 'DRIVING',
			unitSystem: google.maps.UnitSystem.IMPERIAL
        };

        directionsDisplay = new google.maps.DirectionsRenderer({
         	map: map
        });

       	restaurant.calculateRoute(map,request, directionsDisplay, null);

		$(".full_page").addClass("active");
	},

	closeFullPage: function(){
		$(".full_page").removeClass("active");
	},
}

$( document ).ready(function() {
    restaurant.init();
});

$(window).load(function() {
	$("html").removeClass("preload");
});
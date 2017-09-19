restaurant = {
	init: function() {
		restaurant.placeMarker();
		restaurant.loadHandler();
	},

	loadHandler: function() {
		$(".filter").change(function(){
			restaurant.filterData($(this).val());
		});

		$( "main" ).on( "click", ".map_label", function() {
			console.log($(this).attr("data-id"));
		});
	},

	filterData: function(selected){
		var data = restaurant.rawData.slice();
		console.log(data);
		for(i in data) {
			if(data[i].category == selected)
			{
				data.splice(i, 1);
			}
		}
		restaurant.updateTemplate(data);
		restaurant.updateMarker(data);
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

  			console.log(position);

			 	var map = new google.maps.Map(document.getElementById('map'+data[i].id), {
	          center: position,
	          zoom: 15
	        });

			
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
	},

	listenMarker: function(marker,infowindow,map){
 		google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
	}
}

$( document ).ready(function() {
    restaurant.init();
});
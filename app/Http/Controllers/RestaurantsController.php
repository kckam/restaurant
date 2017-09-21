<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;

class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants =  Restaurant::orderBy('created_at', 'desc')->get();

        $data = array(
                    "title" => "List",
                    "restaurants" => $restaurants
                );

        return view('restaurants.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_data = Category::all()->pluck("name", "id");

        $data = array(
                "title" => "Restaurant",
                "category_data" => $category_data
            );

        return view('restaurants.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $restaurant = new Restaurant;
        $restaurant->name = $request->input('name');
        $restaurant->category = $request->input('category');
        $restaurant->lat = $request->input('latitude');
        $restaurant->long = $request->input('longitude');
        $restaurant->save();

        return redirect('./restaurant');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       

        // $restaurant = Restaurant::leftJoin('categories', function($join) {
        //     $join->on('restaurant.category', '=', 'categories.id');
        // })
        // ->where('restaurants.id', '=', $id);

        $restaurant = Restaurant::leftJoin('categories', 'restaurants.category', '=', 'categories.id')
                    ->where('restaurants.id', '=', $id)
                    ->select('restaurants.*', 'categories.name as category_name')
                    ->first();

        $data = array(
            "title" => "Edit",
            "restaurant" => $restaurant
        );

        return view('restaurants.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::leftJoin('categories', 'restaurants.category', '=', 'categories.id')
                    ->where('restaurants.id', '=', $id)
                    ->select('restaurants.*', 'categories.name as category_name')
                    ->first();
        $category_data = Category::all()->pluck("name", "id");

        $data = array(
            "title" => "Edit",
            "restaurant" => $restaurant,
            "category_data" => $category_data
        );

        return view('restaurants.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $restaurant = Restaurant::find($id);
        $restaurant->name = $request->input('name');
        $restaurant->category = $request->input('category');
        $restaurant->lat = $request->input('latitude');
        $restaurant->long = $request->input('longitude');
        $restaurant->save();

        return redirect('./restaurant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->delete();
        return redirect('./restaurant');
    }
}

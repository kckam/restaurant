<?php
use App\Restaurant;
use App\Category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "PagesController@index");

Route::get('get_all_restaurant', function() {
	$res = DB::table('restaurants')
            ->leftJoin('categories', 'restaurants.category', '=', 'categories.id')
            ->select('restaurants.*', 'categories.name as category_name')
            ->get()->keyBy('id');
    return $res;
});

Route::resource('restaurant', 'RestaurantsController');
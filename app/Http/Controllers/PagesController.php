<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;

class PagesController extends Controller
{
    public function index() {
    	$category_data = Category::all()->pluck("name", "id");

    	$data = array(
    				"title" => "Restaurant",
    				"category_data" => $category_data
    			);
    	return view("pages.index")->with($data);
    }
}

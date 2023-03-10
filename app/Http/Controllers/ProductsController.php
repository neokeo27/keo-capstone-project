<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderby('name', 'ASC')->paginate(20);
        $items = Item::orderby('id', 'ASC')->paginate(20);
        return view('products')->with('categories', $categories)->with('items', $items);
    }

    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        if ($category) {
            $items = $category->items()->get();
            return view('products', compact('items', 'category'));
        } else {
            return redirect()->back();
        }
    }
}

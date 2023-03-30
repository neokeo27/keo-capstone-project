<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;

class ProductsController extends Controller
{
    //show list of products
    public function index()
    {
        $categories = Category::orderby('name', 'ASC')->paginate(20);
        $items = Item::orderby('id', 'ASC')->paginate(20);
        return view('products')->with('categories', $categories)->with('items', $items);
    }

    //show products by category selected
    public function show($id)
    {
        if (Category::where('id', $id)->exists()) {
            $category = Category::where('id', $id)->first();
            $categories = Category::orderby('name', 'ASC')->paginate(20);
            $items = Item::where('category_id', $category->id)->get();
            return view('products', compact('category', 'items', 'categories'));
        } else {
            return redirect("/");
        }
    }

    //show selected product info page
    public function showItem($category_id, $id)
    {
        $item = Item::where('id', $id)->first();
        return view('productView')->with('item', $item);
    }
}

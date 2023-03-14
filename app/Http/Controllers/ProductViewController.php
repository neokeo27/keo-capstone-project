<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductViewController extends Controller
{

    public function show($category_id, $id)
    {
        $item = Item::where('id', $id)->first();
        return view('productView')->with('item', $item);
    }
}

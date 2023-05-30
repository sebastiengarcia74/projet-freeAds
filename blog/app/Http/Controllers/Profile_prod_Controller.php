<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;

class Profile_prod_Controller extends Controller
{


    public function create()
    {
        $categories = Categories::all()->where('is_sub', '=', '0');
        $sub_categories = Categories::all()->where('is_sub', '=', '1')->where('parent_id', '!=', '0');

        return view('profile_prod.create', compact('categories', 'sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'required',

        ]);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('img_source'), $imageName);

        $request['created_by'] = session('user')->id; // will contain current user id (in this case: admin)
        $request['image_path'] = '/img_source/' . $imageName;
        Product::create($request->post());

        return redirect()->route('profile.index')->with('success', 'Product has been created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('profile_prod.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ]);

        $product->fill($request->post())->save();

        return redirect()->route('profile.index')->with('success', 'Product Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('profile.index')->with('success', 'Product has been deleted successfully');
    }
}

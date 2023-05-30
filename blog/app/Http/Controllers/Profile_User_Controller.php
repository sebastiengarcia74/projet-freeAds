<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Support\Facades\Session;



class Profile_User_Controller extends Controller
{
    public function index()
    {
        session();
        $iduser = session('user')->id;
        // dump($iduser);
        // $products = Product::all()->where('$product->category_id', '=', '$category->id');
        // ->where('$product->created_by', '=', '$iduser');
        $products = Product::all();
        // dump($products);
        $user = User::where("id", "$iduser")->first();
        $categories = Categories::all()->where('$product->category_id', '=', '$category->id');
        $categorynames = Product::join('categories', 'products.category_id', '=', 'categories.id')->distinct('categories.id')
            ->get(['products.category_id', 'categories.id', 'categories.name']);
        // dump($categories);
        return view('profile.index', compact('products', 'categories', 'categorynames', 'user'));
    }


    public function edit(User $userinfo)
    {

        $iduser = session('user')->id;
        dump($iduser);
        $user = User::where("id", "$iduser")->first();


        return view('profile.edit', compact('user'));
    }


    public function update(Request $request)
    {


        $iduser = session('user')->id;
        $user = User::where("id", "$iduser")->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $request['password'] = session('user')->password;
        $request['admin'] = session('user')->admin;


        $user->fill($request->post())->save();
        return redirect()->route('profile.index')->with('success', 'Your profile has been updated successfully');
    }




    // public function showprod(Product $product)
    // {
    //     $categories = Categories::all();
    //     $sub_categories = Categories::all()->where('is_sub', '=', '1')->where('parent_id', '!=', '0');
    //     return view('products.selected', compact('product', 'categories'));
    //     return view('profile.index', compact('product', 'categories'));
    // }


    public function createprod()
    {
        $categories = Categories::all()->where('is_sub', '=', '0');
        $sub_categories = Categories::all()->where('is_sub', '=', '1')->where('parent_id', '!=', '0');

        return view('profile.createprod', compact('categories', 'sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function storeprod(Request $request)
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
    public function editprod(Product $product)
    {
        $categories = Categories::all()->where('is_sub', '=', '0');
        $sub_categories = Categories::all()->where('is_sub', '=', '1')->where('parent_id', '!=', '0');
        return view('profile.editprod', compact('product', 'categories', 'sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateprod(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            // 'category_id' => 'required',
            // 'sub_category_id' => 'required',
        ]);

        $product->fill($request->post())->save();

        return redirect()->route('profile.index')->with('success', 'Product Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyprod(Product $product)
    {

        $product->delete();
        return redirect()->route('profile.index')->with('success', 'Product has been deleted successfully');
    }
}

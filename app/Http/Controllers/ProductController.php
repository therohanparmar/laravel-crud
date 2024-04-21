<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatorRules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if ($request->image != '') {
            $validatorRules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != '') {
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $product->image = $imageName;
            $image->move(public_path('uploads/products'), $imageName);
            $product->save();
        }


        return redirect()->route('products.index')->with('success', 'Product addedd successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $validatorRules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if ($request->image != '') {
            $validatorRules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != '') {
            File::delete(public_path('uploads/products/'.$product->image));
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $product->image = $imageName;
            $image->move(public_path('uploads/products'), $imageName);
            $product->save();
        }


        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image != '') {
            File::delete(public_path('uploads/products/'.$product->image));
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');

    }
}

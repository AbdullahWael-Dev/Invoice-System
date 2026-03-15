<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('Product.products', compact('products','sections'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'section_id' => 'required|exists:sections,id',
            'description' => 'nullable',
        ]);
        Product::create([
            'name' => $request->name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'section_id' => 'required',
            'description' => 'nullable',
        ]);
        $section_id = Section::where('name',$request->section_id)->first()->id;
        $product = Product::findorfail($request->pro_id);
        $product->update([
            'name' => $request->name,
            'section_id' => $section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        Product::findorfail($request->pro_id)->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}

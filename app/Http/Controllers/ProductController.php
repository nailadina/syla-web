<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin(){
        $product = Product::all();

        return view('product.adminProduct', compact('product'));
    }

    public function index()
    {
        $product = Product::all();

        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'picture' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ],
        [
            'name.required' => 'Harap Masukkan Nama Produk',
            'stock.required' => 'Harap Masukkan Jumlah Stock Product',
            'description.required' => 'Harap Masukkan Description Produk',
            'picture.required' => 'Harap Masukkan Foto Produk',
            'price.required' => 'Harap Masukkan Harga Produk',
            'category_id.required' => 'Harap Masukkan Kategori Produk',
        ]
    );

        $fileName = time().'.'.$request->picture->extension();
        $category = new Product;

        $category->name = $request->name;
        $category->stock = $request->stock;
        $category->description = $request->description;
        $category->picture = $fileName;
        $category->price = $request->price;
        $category->category_id = $request->category_id;

        $category->save();
        $request->picture->move(public_path('images'), $fileName);

        return redirect('product')->with('success', 'Data anda berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $id)
    {
        $category = Category::all();
        $product = Product::findorfail($id);

        return view('product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'picture' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ],
        [
            'name.required' => 'Harap Masukkan Nama Produk',
            'stock.required' => 'Harap Masukkan Jumlah Stock Product',
            'description.required' => 'Harap Masukkan Description Produk',
            'picture.required' => 'Harap Masukkan Foto Produk',
            'price.required' => 'Harap Masukkan Harga Produk',
            'category_id.required' => 'Harap Masukkan Kategori Produk',
        ]
    );

    $product = Product::findOrFail($id);

    if($request->has('picture'))
        {

            $path = "images/";
            File::delete($path . $product->picture);

            $fileName = time().'.'.$request->picture->extension();
            $request->picture->move(public_path('images'), $fileName);

            $product_data = 
            [
                'name' =>$request->name,
                'stock' =>$request->stock,
                'description' =>$request->description,
                'picture' =>$fileName,
                'price' =>$request->price,
                'category_id' =>$request->category_id
            ];

        }else
            {
                $product_data = 
                [
                    'name' =>$request->name,
                    'stock' =>$request->stock,
                    'description' =>$request->description,
                    'picture' =>$request->picture,
                    'price' =>$request->price,
                    'category_id' =>$request->category_id
                ];
            }
        $product->update($product_data);

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        $product = Product::find($id)->delete();

        return view('product.adminProduct', compact('product'));
    }
}

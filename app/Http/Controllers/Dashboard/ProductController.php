<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\StoreProductPost;
use App\Http\Requests\UpdateProduct;
use App\Measurement;
use Illuminate\Support\Str;
use App\ImgProduct;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::where(['pp_is_ban' => false, 'pp_is_delete' => false, 'pp_status' => true])->orderBy('pp_update_at', 'DESC')->get();
        $data['title_page'] = 'Daftar Produk';
        $data['code_page'] = 'dashboard_product';
        return view('backup-dashboard.daftar-produk')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::all();
        $data['categories'] = Category::where('pc_status', false)->get();
        $data['measurements'] = Measurement::where('pm_delete_at', NULL)->get();
        $data['title_page'] = 'Tambah Produk';
        $data['code_page'] = 'addproduct';
        return view('backup-dashboard.form-product')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPost $request)
    {
        $data = new Product;
        $data = $request->all();
        $data['pp_id_shop'] = 1;
        $data['pp_slug'] = Str::slug($request->pp_title, '-');
        $data['pp_token'] = rand(999999999, 9999999999);
        $data['pp_token_backup'] = rand(999999999, 9999999999);
        Product::create($data);
        return redirect()->route('product.product.index');
        // return response()->json(['message' => 'Succes Add!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data['title_page'] = 'Edit Produk';
        $data['product'] = $product;
        $data['categories'] = Category::where('pc_status', false)->get();
        $data['measurements'] = Measurement::where('pm_delete_at', NULL)->get();
        $data['img'] = $this->getProductImage($data['product']['pp_token'], $data['product']['pp_token_backup']);
        $data['code_page'] = 'editProduct';
        return view('backup-dashboard.update-product')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request, Product $product)
    {
        $data = $request->only('pp_title', 'pp_basic_price', 'pp_selling_price', 'pp_qty', 'pp_weight', 'pp_description', 'pp_status', 'pp_email', 'pp_phone');
        $product->update($data);
        return redirect()->route('product.product.index')->with(['message' => 'Success Edit Product']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->update([
            'pp_is_delete' => true
        ]);
        $product->delete();
        return redirect()->route('product.product.index');
    }
    public function showBannedProduct()
    {
        $data['title_page'] = 'Daftar Produk Banned';
        $data['code_page'] = 'dashboard_product';
        $data['products'] = Product::where(['pp_is_ban' => true, 'pp_is_delete' => false])->orderBy('pp_update_at', 'DESC')->get();
        return view('backup-dashboard.daftar-produk')->with($data);
    }
    public function showDraftProduct()
    {
        $data['title_page'] = 'Daftar Produk Draft';
        $data['code_page'] = 'dashboard_product';
        $data['products'] = Product::where(['pp_status' => false, 'pp_is_delete' => false])->orderBy('pp_update_at', 'DESC')->get();
        return view('backup-dashboard.daftar-produk')->with($data);
    }
    public function bannedProduct(Product $product)
    {
        $product->update(['pp_is_ban' => true, 'pp_status' => false]);
        return redirect()->route('product.product.index');
        // return response()->json(['message' => 'Success']);
    }
    public function unBannedProduct(Product $product)
    {
        $product->update(['pp_is_ban' => false]);
        return redirect()->route('product.banned');
        // return response()->json(['message' => 'Success']);
    }
    public function publishProduct(Product $product)
    {
        $product->update(['pp_status' => true]);
        return redirect()->route('product.draft');
        // return response()->json(['message' => 'Success']);
    }
    public function getProductImage($token, $token_backup)
    {
        $data = ImgProduct::where('pip_token', $token)
            ->where('pip_token_backup', $token_backup)
            ->orderBy('pip_id', 'ASC')
            ->get();
        return $data;
    }
    public function deleteImg(ImgProduct $img)
    {
        $img->delete();
        return redirect()->back()->with(['message' => 'Succes Delete Image']);
    }
}

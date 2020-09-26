<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Category;
use App\Http\Requests\StoreCategoryPost;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $data['categories'] = Category::join('product.product', 'product.product.pp_id_category', '=', 'category.pc_id')
        //     ->select('*', Product::count('pp_id_category')->where('pp_id_category', 'category.pc_id'))

        //     ->get();
        $data['title_page'] = 'Daftar Kategori';
        $data['code_page']  = "list_category";
        $data['category'] = DB::table(DB::raw("product.category c"))
            ->select(DB::raw("c.*, (SELECT COUNT(p.pp_id_category) FROM product.product p WHERE c.pc_id = p.pp_id_category ) AS product"))
            ->whereRaw("c.pc_status = false")
            ->get();
        return view('backup-dashboard.daftar-kategori')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryPost $request)
    {
        if (isset($request->pc_img_path)) {
            $category = Str::slug($request->pc_title, '-');
            $file = $request->file('pc_img_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $path = 'customAuth/img/category/' . $category . '/';
            if (!is_dir('customAuth/img/category/' . $category)) {
                mkdir('./customAuth/img/category/' . $category, 0777, TRUE);
            }
            $file->move($path, $nama_file);
            Category::create([
                'pc_img_path' => 'img/category/' . $category . '/' . $nama_file,
                'pc_title' => $request->pc_title,
                'pc_slug' => Str::slug($request->pc_title, '-'),
            ]);
        } else {
            Category::create([
                'pc_title' => $request->pc_title,
                'pc_slug' => Str::slug($request->pc_title, '-'),
            ]);
        }
        return redirect()->back();
    }
    public function getCategoryBySlug($slug_category)
    {
        $data = Category::where('pc_slug', $slug_category)
            ->orderBy('pc_created_at', 'DESC')
            ->limit(1)->get();
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (isset($request->pc_img_path)) {
            $slug = Str::slug($request->pc_title, '-');
            $file = $request->file('pc_img_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $path = 'customAuth/img/category/' . $slug . '/';
            if (!is_dir('customAuth/img/category/' . $slug)) {
                mkdir('./customAuth/img/category/' . $slug, 0777, TRUE);
            }
            $file->move($path, $nama_file);
            $category->update([
                'pc_title' => $request->pc_title,
                'pc_slug' => Str::slug($request->pc_title, '-'),
                'pc_img_path' => 'img/category/' . $slug . '/' . $nama_file
            ]);
        } else {
            $category->update([
                'pc_title' => $request->pc_title,
                'pc_slug' => Str::slug($request->pc_title, '-')
            ]);
        }
        return redirect()->route('kategori.all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->update([['pc_status' => true]]);
        $category->delete();
        return redirect()->route('kategori.all')->with('message', 'Succes Delete Category');
    }
}

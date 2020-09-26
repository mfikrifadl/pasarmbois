<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\City;
use App\Province;
use App\Site;
use App\Subdistrict;
use Illuminate\Http\Request;

class SettingController extends Controller
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
        $data['general'] = Site::orderBy('ps_created_at', 'DESC')->first();
        $data['title_page'] = 'General Setting';
        $data['code_page']  = "setting";
        return view('backup-dashboard.setting-general')->with($data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        if (isset($request->ps_favicon)) {
            $favicon = $request->file('ps_favicon');
            $favicon->move('customAuth/img/site/', 'favicon.ico');
            $site->update(['ps_favicon' => '/img/site/favicon.ico']);
        }
        if (isset($request->ps_logo)) {
            $logo = $request->file('ps_logo');
            $logo->move('customAuth/img/site/', 'logo_login.png');
            $site->update(['ps_logo' => '/img/site/logo_login.png']);
        }
        if (isset($request->ps_logo_dashboard)) {
            $logo_dashboard = $request->file('ps_logo_dashboard');
            $logo_dashboard->move('customAuth/img/site/', 'logo-light-text.png');
            $site->update(['ps_logo_dashboard' => '/img/site/logo-light-text.png']);
        }
        $site->update([
            'ps_title' => $request->ps_title,
            'ps_description' => $request->ps_description,
            'ps_tags' => $request->ps_tags,
        ]);
        return redirect()->back()->with(['message' => 'Update Berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        //
    }
    public function getAddress()
    {
        $data['address'] =  Site::orderBy('ps_created_at', 'DESC')->first();
        $data['province'] =  Province::all();
        $data['city'] =  City::all();
        $data['subdistrict'] =  Subdistrict::all();
        $data['title_page'] = 'Setting Alamat';
        $data['code_page'] = 'set-address';
        return view('backup-dashboard.setting-alamat')->with($data);
    }
    public function getMaps()
    {
        $data['maps'] =  Site::orderBy('ps_created_at', 'DESC')->first();
        $data['title_page'] = 'Setting Maps';
        $data['code_page']  = 'setting';
        return view('backup-dashboard.setting-maps')->with($data);
    }
    public function editMaps(Request $request, Site $site)
    {
        $site->update([
            'ps_maps' => $request->ps_maps
        ]);
        return redirect()->back()->with(['message' => 'Success Edit Map']);
    }
    public function getOther()
    {
        $data['title_page'] = 'Pengaturan Halaman Informasi';
        $data['general'] =  Site::orderBy('ps_created_at', 'DESC')->first();
        $data['code_page'] = 'setting';
        return view('backup-dashboard.setting-site')->with($data);
    }
    public function editOther(Request $request, Site $site)
    {
        if (isset($request->ps_img_product_default)) {
            $product_default = $request->file('ps_img_product_default');
            $product_default->move('customAuth/img/site/', 'pasar-mbois-default-product.jpg');
            $site->update(['ps_img_product_default' => '/img/site/pasar-mbois-default-product.jpg']);
        }
        if (isset($request->ps_img_category_default)) {
            $category_default = $request->file('ps_img_category_default');
            $category_default->move('customAuth/img/site/', 'pasar-mbois-default-category.jpg');
            $site->update(['ps_img_category_default' => '/img/site/pasar-mbois-default-category.jpg']);
        }
        if (isset($request->ps_img_user_default)) {
            $logo_user = $request->file('ps_img_user_default');
            $logo_user->move('customAuth/img/site/', 'user.png');
            $site->update(['ps_img_user_default' => '/img/site/user.png']);
        }
        $site->update([
            'ps_page_category' => $request->ps_page_category,
            'ps_page_search' => $request->ps_page_search,
        ]);
        return redirect()->back()->with(['message' => 'Update Berhasil']);
    }
    public function updateAddress(Request $request, $id)
    {
        $address = Site::find($id);
        $address->update([
            'ps_id_province' => $request->ps_id_province,
            'ps_id_city' => $request->ps_id_city,
            'ps_id_subdistrict' => $request->ps_id_subdistrict,
            'ps_zip_code' => $request->ps_zip_code,
            'ps_phone' => $request->ps_phone,
            'ps_complete_address' => $request->ps_complete_address
        ]);
        // dd($request);
        return redirect()->back()->with(['message' => 'Succes Edit Alamat']);
    }
}

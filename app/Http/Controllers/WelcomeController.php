<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Category;
use App\Product;
use App\Review;
use App\Slider;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guest = new Guest;
        $agent = new Agent;
        $guest['pg_unique_text'] = Str::random(25);
        $guest['pg_browser'] = $agent->browser();
        $guest['pg_ip'] = $request->getClientIp();
        $guest->save();
        $data['code_page'] = 'home';
        $data['category'] = Category::where('pc_status', false)->get();
        $data['slider'] = $this->getAllSlider();
        $data['productNew'] = $this->getProductNew();
        $data['populer'] = $this->productPopuler();
        // dd($data);
        return view('main.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllSlider()
    {
        $data = Slider::orderBy('pss_created_at', 'desc')->get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProductNew()
    {
        $data = Product::where('pp_is_ban', false)
            ->where('pp_status', true)->orderBy('pp_created_at', 'desc')->limit(4)->get();
        foreach ($data as $dat) {
            $dat['rating'] = 0;
            if (count($dat->reviews) > 0) {
                $rate = 0;
                foreach ($dat->reviews as $review) {
                    $rate += $review['pr_rating'];
                }
                // dd($rate);
                $dat['rating'] = $rate / count($dat->reviews);
            }
        }
        // dd($data);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function productPopuler()
    {
        $data = DB::table(DB::raw("product.product P, product.category C "))
            ->select(DB::raw("P.pp_id, P.pp_title, P.pp_slug, P.pp_selling_price, P.pp_qty, P.pp_status, P.pp_is_delete, P.pp_is_ban,
            ( SELECT pip_img_path FROM product.img_product i WHERE P.pp_token = i.pip_token AND P.pp_token_backup = i.pip_token_backup LIMIT 1 ) AS img_path,
            ( SELECT count(v.pvp_id_product) FROM product.viewed_product v WHERE P.pp_id = v.pvp_id_product ) AS views,
            COALESCE ( ( SELECT sum(pr_rating) / count(pr_id) FROM product.review r WHERE P.pp_id = r.pr_id_product ), 0 ) AS rating"))
            ->whereRaw("C.pc_id = P.pp_id_category AND P.pp_status = true AND P.pp_is_ban = false AND P.pp_is_delete = false")
            ->orderBy('views', 'desc')
            ->limit(10)
            ->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        //
    }
}

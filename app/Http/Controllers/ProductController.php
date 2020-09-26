<?php

namespace App\Http\Controllers;

use App\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use App\Category;
use App\Comment;
use App\ImgProduct;
use App\Review;
use App\ViewedProduct;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $product)
    {
        $data['category'] = Category::where('pc_status', false)->get();
        $data['product'] = Product::where('pp_slug', $product)->first();
        $data['rating'] = $this->getRating($data['product']['pp_id']);
        $this->getViewed($request, $data['product']['pp_id']);
        $data['code_page'] = 'detail_produk';
        $data['img_path']   = $this->getAllImageByProduct($data['product']['pp_token'], $data['product']['pp_token_backup']);
        // $data['similar']    = $this->getSimilarProduct($data['product']['pp_id_category'])->result_array();
        $data['ct']         = $this->getCategoryById($data['product']['pp_id_category']);
        // dd($data);
        $data['review']     = $this->getReviewByProduct($data['product']['pp_id']);
        $data['cr']         = $this->countReviewByProduct($data['product']['pp_id']);
        $data['comment']    = $this->getCommentByProduct($data['product']['pp_id']);
        $data['reply']      = $this->getReplayComment();
        $data['cc']         = $this->countCommentByProduct($data['product']['pp_id']);
        // dd($data);
        return view('main.product-detail')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getAllImageByProduct($token, $token_backup)
    {
        $data = ImgProduct::where('pip_token', $token)
            ->where('pip_token_backup', $token_backup)
            ->orderBy('pip_id', 'ASC')
            ->get();
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getSimilarProduct($id_category)
    {
        if (isset(Auth::user()->pu_id)) {
            $query = "SELECT p.id_product,p.title_product,p.slug_product,p.id_category, p.selling_price,p.qty,p.status, p.is_delete, p.is_ban, (select img_path from ecs_img_product i where p.token=i.token and p.token_backup=i.token_backup limit 1) as img_path,
           (select count(v.id_product) from ecs_viewed_product v where p.id_product=v.id_product) as views, 
           COALESCE((select sum(rating)/count(id_review) from ecs_review r where p.id_product=r.id_product),0) as rating,
           (select id_wishlist from ecs_wishlist w where w.id_product = p.id_product and w.id_user=" . $_SESSION['id_user'] . ") as id_wishlist,
           (select id_cart from ecs_cart c where c.id_product = p.id_product and c.id_user=" . $_SESSION['id_user'] . ") as id_cart    
           FROM ecs_product p, ecs_category c where c.id_category=p.id_category AND  p.status=1 AND p.is_delete=0 AND p.is_ban=0 AND p.id_category=$id_category ORDER BY RAND() limit 10";
        } else {
            $query = "SELECT p.id_product,p.title_product,p.slug_product, p.id_category, p.selling_price,p.qty,p.status, p.is_delete, p.is_ban, (select img_path from ecs_img_product i where p.token=i.token and p.token_backup=i.token_backup limit 1) as img_path,
            (select count(v.id_product) from ecs_viewed_product v where p.id_product=v.id_product) as views, 
            COALESCE((select sum(rating)/count(id_review) from ecs_review r where p.id_product=r.id_product),0) as rating,
                      (select id_cart_guest from ecs_cart_guest c where c.id_product = p.id_product and c.id_guest=" . $_COOKIE['id_guest'] . ") as id_cart    
            FROM ecs_product p, ecs_category c where c.id_category=p.id_category AND  p.status=1 AND p.is_delete=0 AND p.is_ban=0 AND p.id_category=$id_category ORDER BY RAND() limit 10";
        }
        return $this->db->query($query);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getViewed(Request $request, $product)
    {
        $guest = new ViewedProduct;
        $agent = new Agent;
        $guest['pvp_browser'] = $agent->browser();
        $guest['pvp_platform'] = $agent->platform();
        $guest['pvp_ip_address'] = $request->getClientIp();
        $guest['pvp_id_product'] = $product;
        $guest->save();
    }
    public function getCategoryById($id)
    {
        $data = Category::where('pc_id', $id)->first();
        return $data;
    }
    public function getReviewByProduct($id_product)
    {
        $data = Review::where('pr_id_product', $id_product)
            ->orderBy('pr_created_at', 'DESC')->get();
        return $data;
    }
    public function countReviewByProduct($id_product)
    {

        $data = Review::where('pr_id_product', $id_product)->count();
        return $data;
    }
    public function getCommentByProduct($id_product)
    {
        $data = Comment::where('pc_id_product', $id_product)
            ->where('pc_parent', 0)
            ->orderBy('pc_created_at', 'desc')->get();
        return $data;
    }
    public function getReplayComment()
    {
        $data = Comment::where('pc_is_delete', false)
            ->where('pc_parent', '!=', 0)
            ->orderBy('pc_created_at', 'ASC')->get();
        return $data;
    }
    public function countCommentByProduct($id_product)
    {
        $data = Comment::where('pc_id_product', $id_product)->count();
        return $data;
    }
    public function replyComment(Request $request)
    {
        $comment = new Comment;
        $comment = $request->all();
        $comment['pc_id_user'] = Auth::user()->pu_id;
        $comment['pc_id_shop'] = 1;
        Comment::create($comment);
        return redirect()->back();
    }
    public function getRating($product)
    {
        $review = Review::where('pr_id_product', $product)->get();
        $rate = 0;
        if (count($review) > 0) {
            foreach ($review as  $rev) {
                $rate += $rev['pr_rating'];
            }
            $data = $rate / count($review);
        } else $data = 0;
        return $data;
    }
}

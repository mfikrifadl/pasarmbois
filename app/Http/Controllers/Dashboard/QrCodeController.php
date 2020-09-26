<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Product;
use App\Province;
use Illuminate\Http\Request;
use App\City;
use App\QrCodeM;
use App\Subdistrict;
use QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class QrCodeController extends Controller
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
        $data['qrcode'] = QrCodeM::where('pq_status', 0)->get();
        // dd($data);
        $data['title_page'] = 'Daftar QR Code';
        $data['code_page'] = "dashboard_qrcode";
        // dd($data['qrcode']);
        return view('backup-dashboard.daftar-qrcode')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page'] = 'Tambah QR Code';
        $data['code_page'] = "add_qrcode";
        $data['product'] = Product::where('pp_status', true)
            ->where('pp_is_ban', false)
            ->where('pp_is_delete', false)
            ->orderBy('pp_created_at', 'DESC')->get();
        $data['province'] = Province::all();
        $data['city'] =  City::all();
        $data['subdistrict'] =  Subdistrict::all();
        // dd($data['province']);
        return view('backup-dashboard.form-qrcode')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = mt_rand();
        $check_tokenqr = $this->check_token($token);
        while ($check_tokenqr != 0) {
            $token = mt_rand();
            $check_tokenqr = $this->check_token($token);
        }
        Qrcode::size(250)
            ->format('png')
            ->generate(URL::to('pmqr') . '/' . $token, public_path('customAuth/img/qr/' . $token . '.png'));
        $data = new QrCodeM;
        $data = $request->all();
        $data['pq_qrcode_path'] = 'img/qr/' . $token . '.png';
        $data['pq_status'] = 0;
        $data['pq_token_qr'] = $token;
        $data['pq_id_user'] = Auth::user()->pu_id;
        $data['pq_string'] = URL::to('pmqr') . '/' . $token;
        QrCodeM::create($data);
        return redirect()->back()->with(['message' => 'Succes Add QrCode']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(QrCodeM $qr)
    {
        $qr->update(['pq_is_delete' => true]);
        $qr->delete();
        return redirect()->back()->with(['message' => 'Succes Delete QR Code']);
    }
    public function check_token($string)
    {
        $data = QrCodeM::where('pq_token_qr', $string)->count();
        return $data;
    }
    public function getBanned()
    {
        $data['qrcode'] = QrCodeM::where('pq_status', 1)->get();
        $data['title_page'] = 'Daftar QR Code Banned';
        $data['code_page'] = "dashboard_qrcode";
        // dd($data['qrcode']);
        return view('backup-dashboard.daftar-qrcode')->with($data);
    }
    public function banned(QrCodeM $qr)
    {
        $qr->update([
            'pq_status' => 1
        ]);
        return redirect()->back()->with(['message' => 'Success Non Active QR Code']);
    }
    public function active(QrCodeM $qr)
    {
        $qr->update([
            'pq_status' => 0
        ]);
        return redirect()->back()->with(['message' => 'Success Active QR Code']);
    }
}

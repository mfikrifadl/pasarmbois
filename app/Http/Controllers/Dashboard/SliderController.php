<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
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
        $data['slider'] = Slider::all();
        $data['code_page']  = "slider";
        $data['title_page'] = 'Daftar Slider';
        return view('backup-dashboard.daftar-slider')->with($data);
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
        $desc = Str::slug($request->pss_title, '-');
        $file = $request->file('pss_img_path');
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $path = 'customAuth/img/slider/' . $desc . '/';
        if (!is_dir('customAuth/img/slider/' . $desc)) {
            mkdir('./customAuth/img/slider/' . $desc, 0777, TRUE);
        }
        $file->move($path, $nama_file);
        Slider::create([
            'pss_img_path' => 'img/slider/' . $desc . '/' . $nama_file,
            'pss_title' => $request->pss_title,
            'pss_desc' => $desc,
            'pss_link' => $request->pss_link,
            'pss_status' => false,
            'pss_id_user' => Auth::user()->pu_id,
        ]);
        return redirect()->back()->with(['message' => 'Success Add Slider']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $desc = Str::slug($request->pss_title, '-');
        if (isset($request->pss_img_path)) {
            $file = $request->file('pss_img_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $path = 'customAuth/img/slider/' . $desc . '/';
            if (!is_dir('customAuth/img/slider/' . $desc)) {
                mkdir('./customAuth/img/slider/' . $desc, 0777, TRUE);
            }
            $file->move($path, $nama_file);
            $slider->update([
                'pss_img_path' => 'img/slider/' . $desc . '/' . $nama_file,
                'pss_title' => $request->pss_title,
                'pss_desc' => $desc,
                'pss_link' => $request->pss_link,
                'pss_status' => false,
                'pss_id_user' => Auth::user()->pu_id,
            ]);
        } else {
            $slider->update([
                'pss_title' => $request->pss_title,
                'pss_desc' => $desc,
                'pss_link' => $request->pss_link,
                'pss_status' => false,
            ]);
        }
        return redirect()->back()->with(['message' => 'Success Edit Slider']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->back()->with(['message' => 'Success Delete Slider']);
    }
}

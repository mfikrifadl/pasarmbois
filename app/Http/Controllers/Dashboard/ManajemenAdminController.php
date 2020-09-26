<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ManajemenAdminController extends Controller
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
        $data['admin'] = User::join('public.user_detail', 'public.user_detail.pud_id_user', '=', 'user.pu_id')
            ->join('public.role_user', 'public.role_user.pru_id', '=', 'user.pu_id_role')
            ->where(function ($query) {
                $query->where('pu_id_role', 1)
                    ->orWhere('pu_id_role', 2);
            })->get();
        $data['title_page'] = 'Daftar Admin';
        $data['code_page']  = "useradmin";
        return view('backup-dashboard.daftar-admin')->with($data);
    }
    public function bannedAdmin(User $user)
    {
        $user->update(['pu_is_ban' => true]);
        return redirect()->back()->with(['message' => 'Succes Ban Admin']);
    }
    public function unbannedAdmin(User $user)
    {
        $user->update(['pu_is_ban' => false]);
        return redirect()->back()->with(['message' => 'Succes unBan Admin']);
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
        $user = User::create([
            'pu_username' => $request->pu_username,
            'pu_id_role' => $request->pu_id_role,
            'pu_password' => Hash::make($request->pu_password)
        ]);
        $detail = UserDetail::create([
            'pud_id_user' => $user['pu_id'],
            'pud_firstname' => $request->pud_firstname,
            'pud_lastname' => $request->pud_lastname,
            'pud_email' => $request->pud_email
        ]);
        return redirect()->back()->with(['message' => 'Succes Add Admin']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['profile'] = User::join('public.user_detail', 'public.user_detail.pud_id_user', '=', 'user.pu_id')
            ->join('public.role_user', 'public.role_user.pru_id', '=', 'user.pu_id_role')->find($id);
        $data['title_page'] = 'Detail Admin';
        $data['code_page']  = "detail_profile";
        return view('backup-dashboard.detail-admin')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::join('public.user_detail', 'public.user_detail.pud_id_user', '=', 'user.pu_id')->find($id);
        $detail = UserDetail::where('pud_id_user', $user['pu_id'])->first();
        $cek = Hash::check($request->pu_password, $user['pu_password']);
        if ($cek == true) {
            if (isset($request->pud_img_path)) {
                $file = $request->file('pud_img_path');
                $nama_file = time() . "_" . Auth::user()->pu_id;

                // isi dengan nama folder tempat kemana file diupload
                $path = 'customAuth/img/member/';
                $file->move($path, $nama_file);
                $detail->update([
                    'pud_firstname' => $request->pud_firstname,
                    'pud_lastname' => $request->pud_lastname,
                    'pud_img_path' => 'img/member/' . $nama_file,
                    'pud_email' => $request->pud_email,
                    'pud_phone' => $request->pud_phone,
                    'pud_line' => $request->pud_line,
                    'pud_whatsapp' => $request->pud_whatsapp,
                    'pud_telegram' => $request->pud_telegram,
                    'pud_gender' => $request->pud_gender
                ]);
            } else {
                $detail->update([
                    'pud_firstname' => $request->pud_firstname,
                    'pud_lastname' => $request->pud_lastname,
                    'pud_email' => $request->pud_email,
                    'pud_phone' => $request->pud_phone,
                    'pud_line' => $request->pud_line,
                    'pud_whatsapp' => $request->pud_whatsapp,
                    'pud_telegram' => $request->pud_telegram,
                    'pud_gender' => $request->pud_gender
                ]);
            }
            return redirect()->back()->with(['message' => 'Update Berhasil']);
        } else {
            return redirect()->back()->with(['message' => 'Password Anda Salah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $cek = Hash::check($request->pu_password, $user['pu_password']);
        if ($cek == true) {
            $user->update([
                'pu_password' => Hash::make($request->newpassword)
            ]);
            return redirect()->back()->with(['message' => 'Update Password Berhasil']);
        } else {
            return redirect()->back()->with(['message' => 'Password Anda Salah']);
        }
    }
}

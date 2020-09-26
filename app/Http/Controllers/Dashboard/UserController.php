<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Guest;
use App\Http\Requests\StoreUserPost;
use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $data['users'] = User::where('pu_id_role', 3)->where('pu_is_ban', false)->get();
        $data['title_page'] = 'Daftar Member';
        $data['code_page'] = "dashboard_member";
        return view('backup-dashboard.daftar-member')->with($data);
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
    public function store(StoreUserPost $request)
    {
        $data = $request->only('pu_id_role', 'pu_username');
        $data['pu_password'] = Hash::make($request->pu_password);
        User::create($data);
        return response()->json([
            'message' => 'Success Add Member',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = UserDetail::find($id);
        $data['title_page'] = 'Detail Member';
        $data['code_page'] = "detail_profile";
        return view('backup-dashboard.member-detail')->with($data);
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
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function dashboard()
    {
        $data['user'] = Auth::user();
        $data['title_page'] = 'Dashboard';
        return view('dashboard.index')->with($data);
    }
    public function showBannedMember()
    {
        $data['title_page'] = 'Daftar Member Banned';
        $data['code_page'] = 'banned_member';
        $data['users'] = User::where(['user.pu_id_role' => 3, 'user.pu_is_ban' => true])->get();
        return view('backup-dashboard.daftar-member')->with($data);
    }
    public function bannedMember(User $user)
    {
        $user->update(['pu_is_ban' => true]);
        return redirect()->route('member.member.index');
    }
    public function unBannedMember(User $user)
    {
        $user->update(['pu_is_ban' => false]);
        return redirect()->route('member.banned');
    }
}

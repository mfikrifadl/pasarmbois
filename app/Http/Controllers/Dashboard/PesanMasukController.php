<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Contact;
use App\Http\Requests\StorePesanMasukPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanMasukController extends Controller
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
        $data['pesan'] = Contact::where('pc_parent', 0)
            ->orderBY('pc_created_at', 'DESC')->get();
        $data['code_page'] = "dashboard_product";
        $data['title_page'] = 'Kotak Masuk';
        return view('backup-dashboard.daftar-pesan')->with($data);
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
    public function store(StorePesanMasukPost $request)
    {
        // dd($request);
        $data = new Contact;
        $data = $request->only(['pc_content', 'pc_parent', 'pc_email']);
        $data['pc_created_at'] = date("Y-m-d h:i:s");
        $data['pc_id_user'] = Auth::user()->pu_id;
        Contact::create($data);
        $details = [
            'title' => 'Hai ' . $request->pc_name . ' ini balasan pesanmu',
            'body' => $request->pc_content
        ];
        \Mail::to($request->pc_email)->send(new \App\Mail\EmailContact($details));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $data['pesan'] = $contact;
        $data['reply'] = $this->getReply($contact['pc_id']);
        $data['pesan']->update(['pc_status' => 1]);
        $data['code_page'] = "dashboard_product";
        $data['title_page'] = 'Kotak Masuk';
        return view('backup-dashboard.detail-pesanmasuk')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->update(['pc_is_delete' => true]);
        $contact->delete();
        return redirect()->route('pesanmasuk.all');
    }
    public function getReply($parent)
    {
        $data = Contact::join('public.user_detail', 'public.user_detail.pud_id_user', '=', 'contact.pc_id_user')
            ->select('contact.*', 'public.user_detail.pud_id_user', 'public.user_detail.pud_firstname', 'public.user_detail.pud_lastname')
            ->where('contact.pc_parent', $parent)
            ->get();
        return $data;
    }
}

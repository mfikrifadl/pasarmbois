<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\TemplateEmail;
use Illuminate\Http\Request;

class TemplateEmailController extends Controller
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
        $data['email'] = TemplateEmail::all();
        $data['code_page'] = 'dashboard_contact';
        // dd($data);
        $data['title_page'] = 'Daftar Template Email';
        return view('backup-dashboard.daftar-templateemail')->with($data);
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
     * @param  \App\TemplateEmail  $templateEmail
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateEmail $templateEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemplateEmail  $templateEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplateEmail $template)
    {
        $data['edit'] = $template;
        $data['title_page'] = 'Edit Template Email';
        $data['code_page'] = "addpage";
        return view('backup-dashboard.detail-templateemail')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemplateEmail  $templateEmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemplateEmail $template)
    {
        $template->update([
            'pte_title' => $request->pte_title,
            'pte_subject' => $request->pte_subject,
            'pte_opening' => $request->pte_opening,
            'pte_content' => $request->pte_content,
            'pte_closing' => $request->pte_closing
        ]);
        return redirect()->route('templateemail.all')->with(['message' => 'Success Edit Template']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TemplateEmail  $templateEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemplateEmail $templateEmail)
    {
        //
    }
}

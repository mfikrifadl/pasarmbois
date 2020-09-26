<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\BankStatements;
use Illuminate\Http\Request;

class BankController extends Controller
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
        $data['title_page'] = 'Daftar Bank';
        $data['code_page'] = 'dashboard_contact';
        $data['rekening'] = BankStatements::orderBy('tbs_transaction_date', 'ASC')->get();
        return view('backup-dashboard.daftar-logbank')->with($data);
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
     * @param  \App\BankStatements  $bankStatements
     * @return \Illuminate\Http\Response
     */
    public function show(BankStatements $bankStatements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankStatements  $bankStatements
     * @return \Illuminate\Http\Response
     */
    public function edit(BankStatements $bankStatements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankStatements  $bankStatements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankStatements $bankStatements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankStatements  $bankStatements
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankStatements $bankStatements)
    {
        //
    }
}

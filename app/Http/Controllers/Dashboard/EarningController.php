<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\InvoiceDetail;
use Illuminate\Http\Request;

class EarningController extends Controller
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
        $data['title_page']     = 'Pendapatan Pasarmbois';
        $data['code_page']      = "dashboard_earning";
        $data['earning']        = $this->getEarningByMonth();
        $data['totProduct']     = $this->getTotProduct();
        $data['totSell']        = $this->getTotSell();
        $bp = 0;
        $sp = 0;
        foreach ($data['earning'] as $e) {
            $bp += $e['tid_qty'] * $e['pp_basic_price'];
            $sp += $e['tid_qty'] * $e['pp_selling_price'];
        }
        $data['totProfit'] = $sp - $bp;
        $data['allearning'] = $this->getAllEarning();
        $abp = 0;
        $asp = 0;
        foreach ($data['allearning'] as $ae) {
            $abp += $ae['tid_qty'] * $ae['pp_basic_price'];
            $asp += $ae['tid_qty'] * $ae['pp_selling_price'];
        }
        $data['totAllProfit'] = $asp - $abp;
        return view('backup-dashboard.daftar-pendapatan')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEarningByMonth()
    {
        $earn = InvoiceDetail::join('product.product', 'product.product.pp_id', '=', 'invoice_detail.tid_id_product')
            ->join('transaction.invoice', 'transaction.invoice.ti_id', '=', 'invoice_detail.tid_id_invoice')
            ->select('product.product.*', 'invoice_detail.*', 'transaction.invoice.ti_id', 'transaction.invoice.ti_created_at')
            ->where('transaction.invoice.ti_id_status', 3)
            ->whereMonth('transaction.invoice.ti_created_at', date('n'))
            ->whereYear('transaction.invoice.ti_created_at', date('Y'))
            ->get();
        return $earn;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTotProduct()
    {
        $earn = InvoiceDetail::join('transaction.invoice', 'transaction.invoice.ti_id', '=', 'invoice_detail.tid_id_invoice')
            ->where('transaction.invoice.ti_id_status', 3)
            ->whereMonth('transaction.invoice.ti_created_at', date('n'))
            ->whereYear('transaction.invoice.ti_created_at', date('Y'))
            ->sum('invoice_detail.tid_qty');
        return $earn;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTotSell()
    {
        $earn = InvoiceDetail::join('transaction.invoice', 'transaction.invoice.ti_id', '=', 'invoice_detail.tid_id_invoice')
            ->where('transaction.invoice.ti_id_status', 3)
            ->whereMonth('transaction.invoice.ti_created_at', date('n'))
            ->whereYear('transaction.invoice.ti_created_at', date('Y'))
            ->sum('invoice_detail.tid_total_price');
        // dd($earn);
        return $earn;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllEarning()
    {
        $earn = InvoiceDetail::join('product.product', 'product.product.pp_id', '=', 'invoice_detail.tid_id_product')
            ->join('transaction.invoice', 'transaction.invoice.ti_id', '=', 'invoice_detail.tid_id_invoice')
            ->select('product.product.*', 'invoice_detail.*', 'transaction.invoice.ti_id', 'transaction.invoice.ti_created_at')
            ->where('transaction.invoice.ti_id_status', 3)
            ->get();
        return $earn;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

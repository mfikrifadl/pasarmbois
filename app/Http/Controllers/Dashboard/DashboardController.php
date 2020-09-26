<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Comment;
use App\Guest;
use App\Invoice;
use App\InvoiceDetail;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\InvoiceGuest;

class DashboardController extends Controller
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
        $data['title_page'] = 'Dashboard';
        $data['code_page'] = "dashboard_index";
        $data['countTrx'] = $this->countTrans();
        $data['countSellProduct'] = $this->sellProduct();
        $bp = 0;
        $sp = 0;
        foreach ($data['countSellProduct'] as $e) {
            $bp += $e['tid_qty'] * $e->product->pp_basic_price;
            $sp += $e['tid_qty'] * $e->product->pp_selling_price;
        }
        $data['totProfit']      = $sp - $bp;
        $data['qty_sell']       = $this->countQtySell();
        $data['countMember']    = $this->countMember();
        $data['comment']        = $this->getAllComment();
        $data['reply']          = $this->getReplayComment();
        $data['product']        = $this->listProductDash();
        $data['chartTrx']       = $this->getChartTransactionAdmin();
        // // dd($data['chartTrx']);
        $data['chartGuest']     = $this->getChartVisitor();
        $data['chartStatus']    = $this->getChartStatus();
        $data['chart']    = $this->combineTrxGuest();
        // dd($data['chart']);
        // dd($data['chartStatus']);
        $data['transaction']    = $this->getAlltransactionDashboard();
        return view('backup-dashboard.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function countTrans()
    {
        $data = InvoiceDetail::join('transaction.invoice', 'transaction.invoice.ti_id', '=', 'invoice_detail.tid_id_invoice')
            ->where('transaction.invoice.ti_id_status', 3)->sum('invoice_detail.tid_total_price');
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sellProduct()
    {
        $data = InvoiceDetail::join('transaction.invoice', 'transaction.invoice.ti_id', '=', 'invoice_detail.tid_id_invoice')
            ->where('transaction.invoice.ti_id_status', 3)->get();
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function countQtySell()
    {
        $data = InvoiceDetail::join('transaction.invoice', 'transaction.invoice.ti_id', '=', 'invoice_detail.tid_id_invoice')
            ->where('transaction.invoice.ti_id_status', 3)->sum('invoice_detail.tid_qty');
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function countMember()
    {
        $data = User::where('pu_is_delete', false)
            ->where('pu_is_ban', false)
            ->where('pu_id_role', 3)
            ->count();
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function getAllComment()
    {
        $data = Comment::where('pc_is_delete', false)
            ->where('pc_parent', 0)
            ->orderBy('pc_created_at', 'DESC')->get();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function getReplayComment()
    {
        $data = Comment::where('pc_is_delete', false)
            ->where('pc_parent', '!=', 0)
            ->orderBy('pc_created_at', 'ASC')->get();
        return $data;
    }
    public function listProductDash()
    {
        $data = DB::table(DB::raw("product.product p, product.category c"))
            ->select(DB::raw("p.pp_id,p.pp_title,p.pp_slug, p.pp_qty,p.pp_status, p.pp_is_delete, p.pp_is_ban, COALESCE((select sum(id.tid_qty) from transaction.invoice_detail id JOIN transaction.invoice i ON id.tid_id_invoice=i.ti_id where p.pp_id=id.tid_id_product AND ti_id_status=3),0) as sell"))
            ->whereRaw("c.pc_id=p.pp_id_category AND p.pp_status=true AND p.pp_is_delete=false AND p.pp_is_ban=false")
            ->orderBy('pp_qty', 'ASC')->get();
        return $data;
    }
    public function getChartTransactionAdmin()
    {
        $data = DB::table(DB::raw("(SELECT ti_id, ti_created_at from transaction.invoice WHERE ti_created_at > now() - INTERVAL '6 MONTH' AND ti_id_status = 3) i"))
            ->select(DB::raw("bulan (i.ti_created_at) as month, date_part ('month', i.ti_created_at) as monthnum, date_part('year', i.ti_created_at) as year, COUNT(i.ti_id) as count, COUNT(i.ti_id) +
            (
                SELECT COUNT(t.ti_id)
                FROM transaction.invoice t
                WHERE t.ti_created_at < i.ti_created_at AND ti_id_status = 3
            ) AS accumulate"))
            ->groupBy('month', 'monthnum', 'year', 'i.ti_created_at')
            ->orderBy('monthnum', 'DESC')
            ->orderBy('year', 'DESC')->get();
        return $data;
    }
    public function getChartVisitor()
    {
        $interval = Guest::select(DB::raw("date_part ('month', pg_created_at) as monthnum, count(pg_id)"))
            ->whereRaw("pg_created_at > now() - INTERVAL '6 MONTH'")
            ->groupBy(DB::raw("monthnum"))->orderBy('monthnum', 'asc')
            ->get();
        foreach ($interval as $int) {
            $int['month'] = $this->bulan($int['monthnum']);
        }
        return $interval;
    }
    public function getChartStatus()
    {
        $guest = InvoiceGuest::select(DB::raw("COUNT(CASE WHEN tig_id_status = 3 or (tig_payment_method=0 and tig_id_status=1) then 1 ELSE NULL END) as success,
        COUNT(CASE WHEN (tig_id_status = 0 or tig_id_status=2 or (tig_payment_method=1 and tig_id_status=1)) then 1 ELSE NULL END) as pending,
        COUNT(CASE WHEN (tig_id_status = -1 or tig_id_status=-2) then 1 ELSE NULL END) as failed"))->first();
        // dd($guest);
        $all = Invoice::select(DB::raw("COUNT(CASE WHEN ti_id_status = 3 or (ti_payment_method=0 and ti_id_status=1) then 1 ELSE NULL END) as success,
        COUNT(CASE WHEN (ti_id_status = 0 or ti_id_status=2 or (ti_payment_method=1 and ti_id_status=1)) then 1 ELSE NULL END) as pending,
        COUNT(CASE WHEN (ti_id_status = -1 or ti_id_status=-2) then 1 ELSE NULL END) as failed"))
            ->first();
        // dd($guest);
        $data['success'] = $guest['success'] + $all['success'];
        $data['pending'] = $guest['pending'] + $all['pending'];
        $data['failed'] = $guest['failed'] + $all['failed'];
        return $data;
    }
    public function getAlltransactionDashboard()
    {
        $guest = InvoiceGuest::select('tig_id_status', 'tig_firstname', 'tig_lastname', 'tig_code_order', 'tig_id', 'tig_created_at', DB::raw("'guest' AS type_user"))
            ->where('tig_id_status', 0);
        // dd($guest);
        $all = Invoice::select('ti_id_status', 'ti_firstname', 'ti_lastname', 'ti_code_order', 'ti_id', 'ti_created_at as created_at', DB::raw(" 'user' AS type_user"))
            ->where('ti_id_status', 0)->unionAll($guest)->orderBy('created_at', 'DESC')->get();
        return $all;
    }
    public function bulan($monthnum)
    {
        switch ($monthnum) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            default:
                return 'Desember';
        }
    }
    public function combineTrxGuest()
    {
        $transaction = $this->getChartTransactionAdmin();
        $guest = $this->getChartVisitor();
        foreach ($guest as $guestItem) {
            foreach ($transaction as $trx) {
                if ($guestItem->monthnum == $trx->monthnum) {
                    $guestItem->trans += $trx->count;
                } elseif ($guestItem->trans <= 0) $guestItem->trans = 0;
            }
        }
        return $guest;
    }
}

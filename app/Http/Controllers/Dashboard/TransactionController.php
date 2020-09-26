<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Invoice;
use App\InvoiceDetail;
use App\InvoiceDetailGuest;
use Illuminate\Http\Request;
use App\InvoiceGuest;
use App\Site;
use PDF;

class TransactionController extends Controller
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
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $transaction)
    {
        $data['title_page'] = 'Detail Transaksi';
        $data['sites'] = Site::where('site.ps_id', 1)->first();
        $data['transactions'] = Invoice::find($transaction['ti_id']);
        $data['code_page']  = "order";
        // dd($transaction);
        $data['invoice_details'] = InvoiceDetail::where('tid_id_invoice', $transaction['ti_id'])->get();
        // dd($invoice_detail);
        return view('backup-dashboard.transaction-detail')->with($data);
    }
    public function showGuestTrans(InvoiceGuest $transaction)
    {
        $data['title_page'] = 'Detail Transaksi Tamu';
        $data['sites'] = Site::where('site.ps_id', 1)->first();
        $data['guest'] = 10;
        $data['code_page']  = "order";
        $data['transactions'] = InvoiceGuest::find($transaction['tig_id']);
        // dd($transaction);
        $data['invoice_details'] = InvoiceDetailGuest::where('tidg_id_invoice', $transaction['tig_id'])->get();
        // dd($invoice_detail);
        return view('backup-dashboard.transaction-detail-guest')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $transaction)
    {
        // dd($transaction);
        $transaction->update(['ti_is_delete' => true]);
        $transaction->delete();
        return redirect()->back()->with('message', 'Success Delete Transaksi!');
    }
    public function destroyGuestTrans(InvoiceGuest $transaction)
    {
        // dd($transaction);
        $transaction->update(['tig_is_delete' => true]);
        // $transaction->delete();
        return redirect()->back()->with('message', 'Success Delete Transaksi!');
    }
    public function getUserTransaction()
    {
        $data['title_page'] = 'Transaksi User';
        $data['code_page']  = "dashboard_transaction";
        $data['transactions'] = Invoice::where('ti_is_delete', false)->orderBy('ti_created_at', 'DESC')->get();
        return view('backup-dashboard.user-transaction')->with($data);
    }
    public function getGuestTransaction()
    {
        $data['title_page'] = 'Transaksi Tamu';
        $data['code_page']  = "dashboard_transaction";
        $data['transaction_guest'] = InvoiceGuest::where('tig_is_delete', false)->orderBy('tig_created_at', 'DESC')->get();
        return view('backup-dashboard.user-transaction')->with($data);
    }
    public function updateReceipt(Request $request, Invoice $transaction)
    {
        // dd($request);
        // $transaction = Invoice::where('ti_code_order', $ti_code_order)->get();
        $transaction->update([
            'ti_receipt' => $request->input('ti_receipt'),
            'ti_id_status' => 2,
            'ti_expired_date' => date('Y-m-d H:i:s', strtotime('+168 hour', strtotime(date("Y-m-d H:i:s"))))
        ]);
        // return "OK";
        return redirect()->route('transaksi.user')->with('message', 'Success Update Resi!');
    }
    public function updateReceiptGuest(Request $request, InvoiceGuest $transaction)
    {
        // dd($request);
        // $transaction = Invoice::where('ti_code_order', $ti_code_order)->get();
        $transaction->update([
            'tig_receipt' => $request->input('tig_receipt'),
            'tig_id_status' => 2,
            'tig_expired_date' => date('Y-m-d H:i:s', strtotime('+168 hour', strtotime(date("Y-m-d H:i:s"))))
        ]);
        // return "OK";
        return redirect()->route('transaksi.guest')->with('message', 'Success Update Resi!');
    }
    public function approveTransaction(Invoice $transaction)
    {
        $transaction->update([
            'ti_id_status' => 1
        ]);
        return redirect()->back()->with('message', 'Success Approve Transaksi!');
    }
    public function approveTransactionGuest(InvoiceGuest $transaction)
    {
        $transaction->update([
            'tig_id_status' => 1
        ]);
        return redirect()->back()->with('message', 'Success Approve Transaksi!');
    }
    public function unApproveTransaction(Invoice $transaction)
    {
        $transaction->update([
            'ti_id_status' => 0
        ]);
        return redirect()->route('transaksi.user')->with('message', 'Success UnApprove Transaksi!');
    }
    public function unApproveTransactionGuest(InvoiceGuest $transaction)
    {
        $transaction->update([
            'tig_id_status' => 0
        ]);
        return redirect()->route('transaksi.guest')->with('message', 'Success UnApprove Transaksi!');
    }
    public function printInvoice(Invoice $transaction)
    {
        $site = Site::where('site.ps_id', 1)->get();
        $transaction = Invoice::find($transaction['ti_id']);
        // dd($transaction);
        $invoice_detail = InvoiceDetail::where('tid_id_invoice', $transaction['ti_id'])->get();
        // dd($invoice_detail);
        view()->share(['transaction' => $transaction, 'site' => $site, 'invoice_detail' => $invoice_detail]);
        $pdf = PDF::loadView('dashboard.print-invoice', $transaction);
        return $pdf->download('pdf_file.pdf');
        // return view('dashboard.transaction-detail')->with(['transactions' => $transaction, 'sites' => $site, 'invoice_details' => $invoice_detail]);
    }
    public function printInvoiceGuest(InvoiceGuest $transaction)
    {
        $site = Site::where('site.ps_id', 1)->get();
        $transaction = InvoiceGuest::find($transaction['tig_id']);
        // dd($transaction);
        $invoice_detail = InvoiceDetailGuest::where('tidg_id_invoice', $transaction['tig_id'])->get();
        // dd($invoice_detail);
        view()->share(['transaction' => $transaction, 'site' => $site, 'invoice_detail' => $invoice_detail]);
        $pdf = PDF::loadView('dashboard.print-invoice', $transaction);
        return $pdf->download('pdf_file.pdf');
        // return view('dashboard.transaction-detail')->with(['transactions' => $transaction, 'sites' => $site, 'invoice_details' => $invoice_detail]);
    }
}

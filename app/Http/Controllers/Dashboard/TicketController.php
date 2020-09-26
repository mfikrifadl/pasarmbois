<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreCategoryTicketPost;
use App\Http\Requests\StoreReplyPost;
use App\TicketType;
use Illuminate\Http\Request;
use App\Ticket;
use App\TicketReply;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['tickets'] = $this->getAllTicket();
        $data['open'] = $this->getCountTicketOpen();
        $data['pending'] = $this->getCountTicketPending();
        $data['resolve'] = $this->getCountTicketResolve();
        $data['all'] = $this->getCountTicketAll();
        $data['title_page'] = 'Daftar Tiket';
        $data['code_page']  = "dashboard_ticket";
        return view('backup-dashboard.daftar-tiket')->with($data);
    }
    public function getAllTicket()
    {
        $data = Ticket::join('public.ticket_type', 'public.ticket_type.ptt_id', '=', 'ticket.pt_id_ticket_type')
            ->join('public.user_detail', 'public.user_detail.pud_id_user', '=', 'ticket.pt_id_user')
            ->select('ticket.*', 'public.ticket_type.ptt_id', 'public.ticket_type.ptt_title', 'public.user_detail.pud_id_user', 'public.user_detail.pud_firstname', 'public.user_detail.pud_lastname')
            ->where('ticket.pt_is_delete', false)
            ->orderBy('ticket.pt_created_at', 'DESC')
            ->get();
        return $data;
    }
    public function getCountTicketOpen()
    {
        $data = Ticket::where('pt_status', 1)
            ->count();
        return $data;
    }
    public function getCountTicketPending()
    {
        $data = Ticket::where('pt_status', 2)
            ->count();
        return $data;
    }
    public function getCountTicketResolve()
    {
        $data = Ticket::where('pt_status', 3)
            ->count();
        return $data;
    }
    public function getCountTicketAll()
    {
        $data = Ticket::count();
        return $data;
    }
    public function getAllCategory()
    {
        $data['categories'] = TicketType::all();
        $data['title_page'] = 'Kategori Tiket';
        $data['code_page']  = "dashboard_ticket";
        return view('backup-dashboard.kategori-tiket')->with($data);
    }
    public function storeCategory(StoreCategoryTicketPost $request)
    {
        $data =  new TicketType;
        $data = $request->all();
        TicketType::create($data);
        return redirect()->route('tiket.kategori')->with('message', 'Succes Add Category Ticket');
    }
    public function destroyCategory(TicketType $categorie)
    {
        $categorie->update(['ptt_is_delete' => true]);
        $categorie->delete();
        return redirect()->route('tiket.kategori')->with('message', 'Succes Delete Category Ticket');
    }
    public function destroy(Ticket $ticket)
    {
        $ticket->update(['pt_is_delete' => true]);
        $ticket->delete();
        return redirect()->route('tiket.tiket')->with('message', 'Succes Delete Ticket');
    }
    public function detailTicket($no_ticket)
    {
        $data['ticket'] = Ticket::join('public.ticket_type', 'public.ticket_type.ptt_id', '=', 'ticket.pt_id_ticket_type')
            ->join('public.user_detail', 'public.user_detail.pud_id_user', '=', 'ticket.pt_id_user')
            ->select('ticket.*', 'public.ticket_type.ptt_id', 'public.ticket_type.ptt_title', 'public.user_detail.pud_id_user', 'public.user_detail.pud_firstname', 'public.user_detail.pud_lastname', 'public.user_detail.pud_email', 'public.user_detail.pud_img_path')
            ->where('ticket.pt_no_ticket', $no_ticket)
            ->get();
        $data['ticketTotal']    = $this->getCountTicket($data['ticket'][0]['pt_id_user']);
        $data['ticketOpen']     = $this->countOpenTicket($data['ticket'][0]['pt_id_user']);
        $data['ticketClose']    = $this->countCloseTicket($data['ticket'][0]['pt_id_user']);
        if ($data['ticket'][0]['pt_status'] == 0) {
            $this->ticketUpdate($data['ticket'][0]['pt_id']);
        }
        $data['reply']         = $this->getReply($data['ticket'][0]['pt_id']);
        $data['title_page']    = 'Detail Tiket';
        $data['code_page']  = "dashboard_ticket";
        return view('backup-dashboard.detail-tiket', $data);
    }
    public function getCountTicket($pt_id_user)
    {
        $data = Ticket::where('pt_id_user', $pt_id_user)
            ->count();
        return $data;
    }
    public function countOpenTicket($pt_id_user)
    {
        $data = Ticket::where('pt_id_user', $pt_id_user)
            ->where('pt_status', 1)
            ->count();
        return $data;
    }
    public function countCloseTicket($pt_id_user)
    {
        $data = Ticket::where('pt_id_user', $pt_id_user)
            ->where('pt_status', 3)
            ->count();
        return $data;
    }
    public function ticketUpdate($pt_id)
    {
        $data = Ticket::where('pt_id', $pt_id);
        return $data->update(['pt_status' => 1]);
    }
    public function getReply($ptr_id_ticket)
    {
        $data = TicketReply::join('public.user_detail', 'public.user_detail.pud_id_user', '=', 'ticket_reply.ptr_id_user')
            ->select('ticket_reply.*', 'public.user_detail.pud_id', 'public.user_detail.pud_firstname', 'public.user_detail.pud_lastname', 'public.user_detail.pud_img_path')
            ->where('ticket_reply.ptr_id_ticket', $ptr_id_ticket)
            ->orderBy('ticket_reply.ptr_created_at', 'ASC')
            ->get();
        return $data;
    }
    public function storeReply(StoreReplyPost $request, TicketReply $ticketReply)
    {
        $ticketReply = $request->only('ptr_id_ticket', 'ptr_content');
        $ticketReply['ptr_id_user'] = Auth::user()->pu_id;
        TicketReply::create($ticketReply);
        return $this->detailTicket($request['pt_no_ticket']);
    }
    public function updatePending(Ticket $ticket)
    {
        $ticket->update(['pt_status' => 2]);
        return redirect()->route('tiket.tiket.detail', $ticket['pt_no_ticket']);
    }
    public function updateOpen(Ticket $ticket)
    {
        $ticket->update(['pt_status' => 1]);
        return redirect()->route('tiket.tiket.detail', $ticket['pt_no_ticket']);
    }
    public function updateClose(Ticket $ticket)
    {
        $ticket->update(['pt_status' => 3]);
        return redirect()->route('tiket.tiket.detail', $ticket['pt_no_ticket']);
    }
}

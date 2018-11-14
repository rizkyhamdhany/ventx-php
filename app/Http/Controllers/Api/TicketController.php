<?php

namespace App\Http\Controllers\Api;

use App\CC;
use App\Models\OrderRepository;
use App\Models\TicketRepository;
use App\Models\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;

class TicketController extends Controller
{
    protected $ticketRepo;
    protected $userRepo;
    protected $orderRepo;

    /**
     * TicketController constructor.
     * @param $ticketRepo
     * @param $userRepo
     * @param $orderRepo
     */
    public function __construct(TicketRepository $ticketRepo, UserRepository $userRepo, OrderRepository $orderRepo)
    {
        $this->ticketRepo = $ticketRepo;
        $this->userRepo = $userRepo;
        $this->orderRepo = $orderRepo;
    }

    public function index(Request $request){
        $order = new \stdClass();
        $order->name = $request->input('ticket_name');
        $order->email = $request->input('email');
        $order->tickets = array();

        $codes = $request->input('ticket_code');
        $code = explode(",", $codes);
        foreach ($code as $ticket_code) {
            $ticket = new \stdClass();

            $ticket->ticket_code = $ticket_code;
            $ticket->ticket_name = $request->input('ticket_name');
            $ticket->name = $request->input('name');
            $ticket->phone = $request->input('phone');
            $ticket->email = $request->input('email');

            $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
            $output = $pdf->output();
            $ticket->ticket_url = 'ventex/ticket/ticket_'.$ticket->ticket_code.'.pdf';
            array_push($order->tickets, $ticket);
            $s3 = \Storage::disk('s3');
            $s3->put($ticket->ticket_url , $output, 'public');
        }


        Mail::to($order->email)->send(new TicketMail($order));
        return response()->json(['status' => 'success', 'message' => 'check success']);
    }

    public function sendTicketSMS(Request $request){
        $params = array(
            'credentials' => array(
                'key' => 'AKIAI4A7VVYOJBALWJUA',
                'secret' => 'qOxjWzL5PQC8qKYz10dbgRh6E78tcuN3tGKN8AvR',
            ),
            'region' => 'eu-west-1', // < your aws from SNS Topic region
            'version' => 'latest'
        );
        $sns = new \Aws\Sns\SnsClient($params);

        $args = array(
            "SenderID" => "VENTX",
            "SMSType" => "Transactional",
            "Message" => "Your DBL VENTX e-Ticket http://the-assets-dev.jobagency.id/api/ticket/41144e55d2",
            "PhoneNumber" => "+6281910381028"
        );

        $result = $sns->publish($args);
        print_r($result);
        return response()->json(['status' => 'success', 'message' => 'check success', 'data' => $result]);
    }

    public function viewTicket($url){
        print_r($url);
        return redirect('https://s3-ap-southeast-1.amazonaws.com/ventx-prod/ventex/ticket/ticket_'.$url.'.pdf');
    }
}

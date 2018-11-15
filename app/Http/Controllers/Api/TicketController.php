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
use Twilio\Rest\Client;

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
        $sms = false;
        if ($request->input('sms') == "yes"){
            $sms = true;
        }
//        return response()->json(['status' => 'success', 'message' => $request->input('sms')]);
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

            if ($sms){
                $this->sendTicketSMS($ticket->ticket_code, $ticket->phone);

            }
        }


        Mail::to($order->email)->send(new TicketMail($order));
        return response()->json(['status' => 'success', 'message' => 'check success']);
    }

    public function sendTicketSMS($ticketCode, $phone){

        if (substr($phone, 0, 1) === '0') {
            $phone = '+62' . substr($phone, 1);
        }

        $params = array(
            'credentials' => array(
                'key' => env('SES_KEY'),
                'secret' => env('SES_SECRET'),
            ),
            'region' => 'ap-southeast-1', // < your aws from SNS Topic region
            'version' => 'latest'
        );
        $sns = new \Aws\Sns\SnsClient($params);

        $args = array(
            "SenderID" => "VENTX",
            "SMSType" => "Transactional",
            "Message" => "Your DBL VENTX e-Ticket http://the-assets-dev.jobagency.id/ticket/".$ticketCode,
            "PhoneNumber" => $phone
        );
        $result = $sns->publish($args);
        return $result;
//        return response()->json(['status' => 'success', 'message' => 'check success', 'data' => $result]);
    }

    public function viewTicket($url){
        return redirect('https://s3-ap-southeast-1.amazonaws.com/ventx-prod/ventex/ticket/ticket_'.$url.'.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\EventRepository;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketClass;
use App\Models\Seat;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use View;
use Illuminate\Support\Facades\Redis;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{

    /**
     * LandingController constructor.
     * @param $eventRepo
     */
    public function __construct(){
    }


    public function index($id){
        $endpoint = "http://ventx-api.jobagency.id/v1/ticket/".$id;
        $client = new \GuzzleHttp\Client();

        $client = new \GuzzleHttp\Client;
        try {
            $res = json_decode($client->get($endpoint)->getBody());
            return view('dashboard.tickets.ticket')->with('res', $res);
        }
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $res_data = json_decode($responseBodyAsString);
            print_r($res_data->msg);
        }



// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;


    }
//    public function event(){
//        return redirect()->route('event.home', ['smilemotion']);
//    }
//    public function contact(){
//        View::share( 'page_state', 'Contact Us' );
//        return view('contact');
//    }
//    public function contactPost(ContactRequest $request){
//        Mail::to('salam@nalar.id')->send(new ContactMail($request->input()));
//        $request->session()->flash('alert-success', 'Thank you for contacting us, we will reply your message asap !');
//        return redirect()->route('contact');
//    }
//    public function tnc(){
//        View::share( 'page_state', 'Terms and Conditions' );
//        return view('tnc');
//    }
}

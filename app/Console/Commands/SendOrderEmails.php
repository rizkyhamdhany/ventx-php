<?php

namespace App\Console\Commands;

use App\Mail\OrderMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendOrderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Order Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Mail::to('rizky@nalar.id')->send(new OrderMail());
    }
}

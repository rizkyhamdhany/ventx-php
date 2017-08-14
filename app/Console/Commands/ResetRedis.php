<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use CC;
use App\Models\RedisModel;

class ResetRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Redis Memory';

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
        //
        Redis::command(CC::$REDIS_FLUSHALL);
        RedisModel::cachingBookedSeat();
    }
}

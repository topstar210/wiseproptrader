<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order; 

class ProfitAlart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:profitalart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        //  $Orders = Order::where('user_id', auth()->user()->id)->where('type', 'buy')->get();
        //  $LossSum = $Orders->sum('loss');
        //  $TradeSum = $Orders->sum('trade_amount');
         
         return 0;
    }
}

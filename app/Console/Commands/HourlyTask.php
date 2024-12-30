<?php

namespace App\Console\Commands;

use App\Models\pesanan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HourlyTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hourly-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Update Gagal Bayar';

    /**
     * Execute the console command.
     */
    public function handle()
    {

// Ambil waktu sekarang dikurangi 24 jam
        $thresholdTime = Carbon::now()->subHours(24);
        // Query untuk mendapatkan pesanan yang updated_at lebih dari 24 jam lalu
        $orders = pesanan::where('updated_at', '<', $thresholdTime)
        ->where('status', 'tunggubayar')
        ->whereNotNull('snap_token')
        ;
        $orders->update([
            'status'=>'batal'
        ]);

    }
}

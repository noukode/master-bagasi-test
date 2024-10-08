<?php

namespace App\Console\Commands;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ActivateVoucher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:activate-voucher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for activate voucher';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Voucher::whereDate('tgl_mulai_berlaku', '<=', Carbon::now())->where('is_active', 0)->update([
            'is_active' => 1,
        ]);
    }
}

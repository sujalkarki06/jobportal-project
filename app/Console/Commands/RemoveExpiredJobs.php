<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use Carbon\Carbon;

class RemoveExpiredJobs extends Command
{
    protected $signature = 'jobs:remove-expired';
    protected $description = 'Remove expired jobs from the database';

    public function handle()
    {
        $expiredJobs = Job::where('deadline', '<', Carbon::now())->get();

        foreach ($expiredJobs as $job) {
            $job->delete();
            // Alternatively, you can mark the job as expired instead of deleting it:
            // $job->update(['expired' => true]);
        }

        $this->info('Expired jobs have been removed.');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Issue;

class ArchiveIssues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive:issues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archives issues whose number of downvotes is at least double than the number of upvotes.';

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
        $issues = Issue::where(['status' => 2])->get();
        $count = 0;
        foreach($issues as $issue)
        {
            if(count($issue->downvotes()) >= 2*count($issue->upvotes()) && count($issue->upvotes()) >= 1) 
            {
                $issue->status = 1;
                $issue->save();
                $count++;
            }
        }

        $this->info('Archived '.$count.' issues out of '.count($issues).' active issues total.');
    }
}

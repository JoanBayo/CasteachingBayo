<?php

namespace App\Console\Commands;

use App\Notifications\VideoCreated;
use Illuminate\Console\Command;

class TestSendVideoCreatedEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:videocretednotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bla bla bla';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Notification::route('mail', 'jbayo@iesebre.com')->notify(new VideoCreated(create_sample_video()));
    }
}

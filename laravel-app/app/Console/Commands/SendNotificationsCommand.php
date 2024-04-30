<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendNotificationsJob;
use App\Models\Notification;
class SendNotificationsCommand extends Command
{     
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'dipatch SendNotificationsJobs';

    /**
     * Execute the console command.
     */
    public function handle()
    { 
        $notifications = Notification::where('status', 'new')->get();
         
        if ($notifications->isEmpty()) {
         $this->info('No new notifications found.');
        } 
        else {
         foreach ($notifications as $notification) {

            dispatch(new SendNotificationsJob($notification));
          
          }
        $this->info('Notifications dispatched successfully.');
        }
    }
}

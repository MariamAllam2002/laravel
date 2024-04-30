<?php

namespace App\Jobs;
// require_once __DIR__ . '/../vendor/autoload.php';
// require_once __DIR__.'/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;
use Illuminate\Queue\Connectors\RabbitMQConnector;

class SendNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notification;

    /**
     * Create a new job instance.
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     */
    
    public function handle(): void
    { 
      $this->publishToRabbitMQ($this->notification);
      $this->notification->status = 'sent';
      $this->notification->save();
        
    }

 private function publishToRabbitMQ(Notification $notification){
        print("inn");
    try{
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
     
        $channel = $connection->channel();
       
        $channel->exchange_declare('notifications_topic', 'topic', false, false, false);
        print("exchange created succefully");
    }
    catch (Exception $e) {
        // Handle the exception
        logger()->error('Error in SendNotificationsJob: ' . $e->getMessage());
    }
        // Construct the message payload
        $message = json_encode([
            'id' => $this->notification->id,
            'message' => $this->notification->content,
            'recipient'=> $this->notification->recipient_ID
        ]);
          // Create and publish the message with the specified routing key

    $msg = new AMQPMessage($message);
    $channel->basic_publish($msg, 'notifications_topic', 'routing_key');
    print("notification published succefully");
    // Close the channel and the connection
    $channel->close();
    $connection->close();
    }
}

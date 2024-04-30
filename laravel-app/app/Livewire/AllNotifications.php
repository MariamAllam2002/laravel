<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;


class AllNotifications extends Component
{  
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    public function render()
    {   
        $notifications = Notification::latest()->paginate(8);
    
        return view('livewire.all-notifications', [
            'notifications' => $notifications
        ]);
    }
    public function deleteN($notificationId)
    {
       $notification =Notification::findOrFail($notificationId);
      $notification->delete();
       
    }
}

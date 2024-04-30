<?php

namespace App\Imports;

use App\Models\Notification;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NotificationsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Notification::create([
                'type' => $row[0],
                'sender' => $row[1],
                'recipient_ID' => $row[2],
                'content' => $row[3],
                'status' => $row[4]
               
            ]);
        }
    }
}

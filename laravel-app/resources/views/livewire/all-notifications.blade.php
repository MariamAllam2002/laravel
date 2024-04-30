<div>

    <table class="table-auto w-full mb-6">
        <thead>
            <tr>
                <th class="px-4 py-2">User Name</th>
                <th class="px-4 py-2">Message</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Type</th>
             
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <td class="border px-4 py-2">{{ $notification->sender }}</td>
                    <td class="border px-4 py-2">{{ $notification->content }}</td>
                    <td class="border px-4 py-2
                        @if($notification->status == 'new') bg-yellow-500
                        @elseif($notification->status == 'sent') bg-green-500
                        @endif">
                        {{ $notification->status }}
                    </td>
                    <td class="border px-4 py-2">{{ $notification->type }}</td>
                    <td class="px-4 py-2 border">
                        <button wire:click="deleteN({{ $notification->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                     </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!!  $notifications->links() !!}

</div>

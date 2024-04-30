<div class="flex justify-center items-center h-full">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-md p-6">
            <h2 class="text-lg font-semibold mb-4 text-center">Upload File</h2>

            <!-- File upload input and submit button -->
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Choose File:</label>
                <input id="file" type="file" wire:model="file" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('file') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <button wire:click="import" class="w-full px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Upload
                </button>
            </div>

            <!-- Display errors and success message -->
            @if ($errors->any())
                <div class="text-red-500 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="text-green-500 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display uploaded files -->
            @if ($files->isNotEmpty())
                <div>
                    <h2 class="text-lg font-semibold mb-2">Uploaded Files</h2>
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th> 
                                <th class="px-4 py-2 text-left">File Name</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $file->id }}</td>
                                    <td class="px-4 py-2 border">{{ $file->filename }}</td>
                                    <td class="px-4 py-2 border">
                                        <button wire:click="deleteFile({{ $file->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

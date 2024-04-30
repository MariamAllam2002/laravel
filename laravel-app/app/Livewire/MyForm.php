<?php

namespace App\Livewire;

use App\Imports\NotificationsImport;
use App\Models\File;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class MyForm extends Component
{
    use WithFileUploads;

    public $file;

    public function deleteFile($fileId)
    {
        $file = File::findOrFail($fileId);
        $file->delete();

        // Refresh the file list after deletion
        $this->files = $this->files->except($fileId);
    }

    public function render()
    {
        return view('livewire.my-form', [
            'files' => File::all(),
        ]);
    }

    public function import()
    {
        $validatedData = Validator::make(
            ['file' => $this->file],
            ['file' => 'required|mimes:xlsx,xls,csv|max:2048']
        )->validate();

        // Store file in storage/app/public directory
        $path = $this->file->store('public');

        // Save file information to the database
        $file = new File();
        $file->filename = $this->file->getClientOriginalName();
        $file->path = $path;
        $file->save();

        try {
            Excel::import(new NotificationsImport, $this->file->getRealPath());

            session()->flash('success', 'File imported successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred during file import: ' . $e->getMessage());
        }
    }
}

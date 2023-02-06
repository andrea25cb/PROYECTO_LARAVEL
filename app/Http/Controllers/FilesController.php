<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{

    private $disk = "public";
    public function loadView()
    {
        $files = [];

        foreach (Storage::disk($this->disk)->files() as $file) {
            $name = str_replace("$this->disk/", "", $file);

            // $picture = "";

            // $type = Storage::disk($this->disk)->mimeType($name);


        }

        $downloadLink = route('download', $name);

        $files[] = [
            'name' => $name,
            'link' => $downloadLink,
            // 'size' => Storage::disk($this->disk)->size($name)
        ];

        return view('files', ['files' => $files]);
    }

    public function storeFile(Request $request)
    {
        if ($request->isMethod('POST')) {
            $file = $request->file('file');
            // $name = $request->input
            $file->storeAs('', $file->extension(), 'public');
        }

        return $this->loadView();
    }

    public function downloadFile($name)
    {
        if (Storage::disk($this->disk)->exists($name)) {
            return Storage::disk($this->$disk)->download($name);
        }

        return response('',404);
    }

}

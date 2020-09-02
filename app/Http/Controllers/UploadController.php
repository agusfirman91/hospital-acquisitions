<?php

namespace App\Http\Controllers;

use App\Imports\DrugsImport;
use Illuminate\Http\Request;
use Excel;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        //JIKA FILE ADA
        if ($request->hasFile('file')) {
            //GET FILE NYA
            $file = $request->file('file');
            //MEMBUAT FILENAME DENGAN MENGAMBIL EKSTENSI DARI FILE YANG DI-UPLOAD
            $filename = time() . '.' . $file->getClientOriginalExtension();

            //FILE TERSEBUT DISIMPAN KEDALAM FOLDER
            // STORAGE > APP > PUBLIC > IMPORT
            //DENGAN MENGGUNAKAN METHOD storeAs()
            $file->storeAs(
                'public/import',
                $filename
            );

            //MEMBUAT INSTRUKSI JOB QUEUE
            // ImportJob::dispatch($filename);
            Excel::import(new DrugsImport, $file);
            return redirect()->back()->with(['success' => 'Upload success']);
            //JIKA TIDAK ADA FILE, REDIRECT ERROR
            return redirect()->back()->with(['error' => 'Failed to upload file']);
        }
    }

    public function export()
    {
        $pathToFile = public_path('storage/format-drug.csv');
        return response()->download($pathToFile);
    }
}

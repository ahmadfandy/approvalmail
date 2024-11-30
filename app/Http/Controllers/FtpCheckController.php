<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FtpCheckController extends Controller
{
    /**
     * Cek file di FTP.
     */
    public function checkFile(Request $request)
    {
        // // Validasi input
        // $request->validate([
        //     'folder' => 'required|string',
        //     'filename' => 'required|string',
        // ]);

        // // Ambil parameter dari request
        // $folder = $request->input('folder');
        // $filename = $request->input('filename');


        $dataFtp = array(
            'folder'     => $request->folder,
            'filename'    => $request->filename
        );

        // Gabungkan path folder dan filename
        // $path = $folder . '/' . $filename;
           $path = $request->folder . '/' . $request->filename;
        // Cek apakah file ada di FTP
        if (Storage::disk('ftp')->exists($path)) {
            // return response()->json(['message' => 'Ada file', 'file_path' => $path], 200);
            return  'File Exists';
        } else {
            // return response()->json(['message' => 'File tidak ditemukan', 'file_path' => $path], 404);
            return  'File Not Exists';
        }
    }
}

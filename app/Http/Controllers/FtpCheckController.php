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
        // // Cek apakah file ada di FTP
        // if (Storage::disk('ftp')->exists($path)) {
        //     // return response()->json(['message' => 'Ada file', 'file_path' => $path], 200);
        //     return  'File Exists';
        // } else {
        //     // return response()->json(['message' => 'File tidak ditemukan', 'file_path' => $path], 404);
        //     return  'File Not Exists';
        // }

        // Ambil konfigurasi FTP dari .env
        $ftpHost = config('filesystems.disks.ftp.host');
        $ftpUser = config('filesystems.disks.ftp.username');
        $ftpPassword = config('filesystems.disks.ftp.password');
        $ftpPort = config('filesystems.disks.ftp.port', 21);

        try {
            // Tes koneksi FTP menggunakan PHP ftp_connect
            $ftpConn = ftp_connect($ftpHost, $ftpPort, 10); // 10 detik timeout
            if (!$ftpConn) {
                return response()->json(['message' => 'Gagal terhubung ke server FTP'], 500);
            }

            // Coba login ke FTP
            $loginResult = ftp_login($ftpConn, $ftpUser, $ftpPassword);
            if (!$loginResult) {
                ftp_close($ftpConn);
                return response()->json(['message' => 'Login FTP gagal. Periksa kredensial.'], 500);
            }

            // Jika koneksi berhasil, gunakan Laravel Storage untuk cek file
            if (Storage::disk('ftp')->exists($path)) {
                ftp_close($ftpConn);
                return 'File Exists';
            } else {
                ftp_close($ftpConn);
                return 'File Not Exists';
            }
        } catch (\Exception $e) {
            // Tangani error
            return response()->json([
                'message' => 'Error saat mengakses FTP',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

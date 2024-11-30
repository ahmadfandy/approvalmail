<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FtpCheckController extends Controller
{
    public function checkFile(Request $request)
    {
        $dataFtp = array(
            'folder'     => $request->folder,
            'filename'    => $request->filename
        );

        $ftpHost = config('filesystems.disks.ftp.host');
        $ftpUser = config('filesystems.disks.ftp.username');
        $ftpPass = config('filesystems.disks.ftp.password');
        $ftpPort = config('filesystems.disks.ftp.port', 21);
        $folder = trim($request->folder);
        $filename = trim($request->filename);
        $path = $folder . '' . $filename;

        try {
            // Koneksi ke FTP
            $ftpConn = ftp_connect($ftpHost, $ftpPort, 30);
            if (!$ftpConn) {
                throw new \Exception('Tidak dapat terhubung ke server FTP.');
            }

            // Login FTP
            if (!ftp_login($ftpConn, $ftpUser, $ftpPass)) {
                ftp_close($ftpConn);
                throw new \Exception('Login ke server FTP gagal.');
            }

            // Aktifkan mode pasif (opsional, tergantung server)
            ftp_pasv($ftpConn, true);

            // Ambil daftar file di folder
            $fileList = ftp_nlist($ftpConn, $folder);
            
            if ($fileList === false) {
                ftp_close($ftpConn);
                throw new \Exception('Gagal mendapatkan daftar file dari server FTP.');
            }

            // Cek apakah file ada di daftar
            if (in_array($path, $fileList)) {
                // Cek ukuran file
                $fileSize = ftp_size($ftpConn, $path);
                ftp_close($ftpConn);

                if ($fileSize > 0) {
                    return 'File Exists';
                } else {
                    return 'File Not Exists';
                }
            } else {
                ftp_close($ftpConn);
                return 'File Not Exists';
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi error saat mengakses FTP.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
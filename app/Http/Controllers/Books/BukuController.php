<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function getDataBuku(Request $request)
    {
        $nama_buku   = $request->get('nama_buku');
        $kode_buku  = $request->get('kode_buku');

        $arrBuku = [
            'nama_buku'  => $nama_buku,
            'kode_buku' => $kode_buku
        ];

        return json_encode($arrBuku);
    }

    public function createDataBuku(Request $request)
    {
        $post   = $request->post();
        $arr    = [];
        $arr['judul_buku']  = $request->post('judul_buku');
        $arr['kode_buku']   = $request->post('kode_buku');
        $arr['penerbit']    = $request->post('penerbit');

        $isValid = self::cekBuku($arr['judul_buku']);
        if ($isValid) {
            $res['status'] = true;
            $res['message'] = 'Judul Buku Valid!';
            $code = 200;
        } else {
            $res['status'] = false;
            $res['message'] = 'Judul Buku Tidak Valid!';
            $code = 401;
        }

        //Contoh response json
        return response()->json($res, $code);
    }

    private static function cekBuku($judul_buku)
    {
        if ($judul_buku == 'Laravel 8') {
            return true;
        } else {
            return false;
        }
    }

    public function updateDataBuku(Request $request)
    {
        $post = $request->post();
        $arr = [];
        $arr['judul_buku']  = $request->post('judul_buku');
        $arr['kode_buku']   = $request->post('kode_buku');
        $arr['penerbit']    = $request->post('penerbit');

        //Buat response seperti ketika insert, silahkan improve sendiri

        return response()->json($arr, 200);
    }

    public function deleteDataBuku(Request $request)
    {
        $arr = [];
        $arr['judul_buku'] = $request->get('judul_buku');

        $isValid = self::cekBuku($arr['judul_buku']);
        if ($isValid) {
            $res['status'] = true;
            $res['message'] = 'Data berhasil dihapus!';
            $code = 200;
        } else {
            $res['status'] = false;
            $res['message'] = 'Data tidak ditemukan / judul_buku tidak valid!';
            $code = 401;
        }

        return response()->json($res, $code);
    }
}

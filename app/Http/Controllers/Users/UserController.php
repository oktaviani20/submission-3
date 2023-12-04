<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            [
                'id'        => '1',
                'nama'      => 'Putri Oktaviani',
                'email'     => 'oktavianip34@gmail.com',
                'telp'      => '083192330019',
                'alamat'    => [
                    'street'    => 'Jl. Binong Jati II',
                    'postcode'  => '40275'
                ]
            ],
            [
                'id'        => '2',
                'nama'      => 'Doni Gunawan',
                'email'     => 'doni@gmail.com',
                'telp'      => '089823230048',
                'alamat'    => [
                    'street'    => 'Jl. Kopo',
                    'postcode'  => '230394'
                ]
            ],
            [
                'id'        => '3',
                'nama' => 'Ahmad Budi',
                'email' => 'ahmad@gmail.com',
                'telp' => '082184912203',
                'alamat' => [
                    'street'    => 'Jl. Buah Batu',
                    'postcode'  => '491380'
                ]
            ]
        ];

        $data2 = [
            [
                'id'        => '4',
                'nama'      => 'Ali Muhammad',
                'email'     => 'ali@gmail.com',
                'telp'      => '08538190942',
                'alamat'    => [
                    'street'    => 'Jl. Lembang',
                    'postcode'  => '458290'
                ]
            ]
        ];

        // debug string
        // echo('sdsdsd');

        //debug string / array
        // var_dump($data);
        // dd($data);

        $data = array_merge($data, $data2);
        return view('users/user', compact('data'));
    }

    public function tambah()
    {
        return view('Users.tambahuser');
    }

    // Controller for API (api.php)
    public function getDataUser(Request $request)
    {
        $nama   = $request->get('nama');
        $email  = $request->get('email');

        $arrNama = [
            'nama'  => $nama,
            'email' => $email
        ];

        return json_encode($arrNama);
    }

    public function createDataUser(Request $request)
    {
        $post   = $request->post();
        $arr    = [];
        $arr['username']    = $request->post('username');
        $arr['email']       = $request->post('email');
        $arr['no_telp']     = $request->post('no_telp');

        $isValid = self::cekUser($arr['username']);
        if ($isValid) {
            $res['status'] = true;
            $res['message'] = 'Username Valid!';
            $code = 200;
        } else {
            $res['status'] = false;
            $res['message'] = 'Username Tidak Valid!';
            $code = 401;
        }

        //Contoh response json
        return response()->json($res, $code);
    }

    private static function cekUser($username)
    {
        if ($username == 'putri') {
            return true;
        } else {
            return false;
        }
    }

    public function updateDataUser(Request $request)
    {
        $post = $request->post();
        $arr = [];
        $arr['username'] = $request->post('username');
        $arr['email'] = $request->post('email');
        $arr['no_telp'] = $request->post('no_telp');

        //Buat response seperti ketika insert, silahkan improve sendiri

        return response()->json($arr, 200);
    }

    public function deleteDataUser(Request $request)
    {
        $arr = [];
        $arr['username'] = $request->get('username');

        $isValid = self::cekUser($arr['username']);
        if ($isValid) {
            $res['status'] = true;
            $res['message'] = 'Data berhasil dihapus!';
            $code = 200;
        } else {
            $res['status'] = false;
            $res['message'] = 'Data tidak ditemukan / username tidak valid!';
            $code = 401;
        }

        return response()->json($res, $code);
    }
}

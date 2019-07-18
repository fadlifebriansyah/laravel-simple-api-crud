<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;

class SiswaController extends Controller
{
    //read
    public function index() {
        $data = \App\Siswa::all();

        if(count($data) > 0) {
            $res['success'] = true;
            $res['message'] = "Data ditemukan!";
            $res['data'] = $data;
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = "Data tidak ditemukan!";
            $res['data'] = [];
            return response($res);
        }
    }

    //create
    public function create(request $request) {
        $siswa = new Siswa;

        if($request->nama === NULL) {
            $res['success'] = false;
            $res['message'] = "Nama harus di isi!";
            return response($res);
        } else {
            $siswa->nama = $request->nama;
        }
        
        if($request->alamat === NULL) {
            $res['success'] = false;
            $res['message'] = "Alamat harus di isi!";
            return response($res);
        } else {
            $siswa->alamat = $request->alamat;
        }

        if($siswa->save()) {
            $res['success'] = true;
            $res['message'] = "Sukses menyimpan!";
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = "Gagal menyimpan!";
            return response($res);
        }
    }

    //update
    public function update(request $request, $id) {
        $nama = $request->nama;
        $alamat = $request->alamat;

        $siswa = Siswa::find($id);
        
        if($siswa === NULL) {
            $res['success'] = false;
            $res['message'] = "Data siswa tidak ditemukan!";
            return response($res);
        } else {
            if($nama === NULL) {
                $res['success'] = false;
                $res['message'] = "Nama harus di isi!";
                return response($res);
            } else {
                $siswa->nama = $nama;
            }

            if($alamat === NULL) {
                $res['success'] = false;
                $res['message'] = "Alamat harus di isi!";
                return response($res);
            } else {
                $siswa->alamat = $alamat;
            }

            if($siswa->save()) {
                $res['success'] = true;
                $res['message'] = "Sukses mengupdate!";
                return response($res);
            } else {
                $res['success'] = false;
                $res['message'] = "Gagal mengupdate!";
                return response($res);
            }
        }
    }

    //delete
    public function delete($id) {
        $siswa = Siswa::find($id);

        if($siswa === NULL) {
            $res['success'] = false;
            $res['message'] = "Data siswa tidak ditemukan!";
            return response($res);
        } else {
            if($siswa->delete()) {
                $res['success'] = true;
                $res['message'] = "Sukses menghapus!";
                return response($res);
            } else {
                $res['success'] = false;
                $res['message'] = "Gagal menghapus!";
                return response($res);
            }
        }
    }
}
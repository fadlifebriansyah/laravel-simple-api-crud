<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;

class SiswaController extends Controller
{
    //read
    public function index() {
        //$data = Siswa::all();
        $data = Siswa::paginate(5);

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

        if($request->umur === NULL) {
            $res['success'] = false;
            $res['message'] = "Umur harus di isi!";
            return response($res);
        } else {
            $siswa->umur = $request->umur;
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
        $umur = $request->umur;

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

            if($umur === NULL) {
                $res['success'] = false;
                $res['message'] = "Umur harus di isi!";
                return response($res);
            } else {
                $siswa->umur = $umur;
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

    //search
    public function search(request $request) {
        $keyword = $request->nama;

        $siswa = Siswa::where('nama', 'like', "%{$keyword}%")->get();

        if($siswa->isEmpty()) {
            $res['success'] = false;
            $res['message'] = "Data siswa tidak ditemukan!";
            $res['data'] = $siswa;
            return response($res);
        } else {
            $res['success'] = true;
            $res['message'] = "Data ditemukan!";
            $res['data'] = $siswa;
            return response($res);
        }
    }

    //sort
    public function sort(request $request) {
        $siswa = Siswa::all();
        $sortby = $request->sortby;
        $order = $request->order;

        if($sortby === NULL) {
            $res['success'] = false;
            $res['message'] = "Sort By harus di isi!";
            return response($res);
        }

        if($order === NULL) {
            $res['success'] = false;
            $res['message'] = "Order harus di isi!";
            return response($res);
        }

        if($sortby == "nama") {
            $siswa = Siswa::orderBy('nama', $order)->get();
        }

        if($sortby == "date") {
            $siswa = Siswa::orderBy('created_at', $order)->get();
        }

        if($sortby == "modified") {
            $siswa = Siswa::orderBy('updated_at', $order)->get();
        }

        if($siswa->isEmpty()) {
            $res['success'] = false;
            $res['message'] = "Data siswa tidak ditemukan!";
            $res['data'] = $siswa;
            return response($res);
        } else {
            $res['success'] = true;
            $res['message'] = "Data ditemukan!";
            $res['data'] = $siswa;
            return response($res);
        }
    }

    //filter
    public function filter(request $request) {
        $siswa = Siswa::all();
        $flag = $request->flag;
        $min = $request->min;
        $max = $request->max;

        if($flag === NULL) {
            $res['success'] = false;
            $res['message'] = "Flag harus di isi!";
            return response($res);
        }

        if($min === NULL) {
            $res['success'] = false;
            $res['message'] = "Range min harus di isi!";
            return response($res);
        }

        if($max === NULL) {
            $res['success'] = false;
            $res['message'] = "Range max harus di isi!";
            return response($res);
        }

        if($flag == "umur") {
            $siswa = Siswa::where('umur', '>=', $min)
                          ->Where('umur', '<=', $max)->get();
        }

        if($siswa->isEmpty()) {
            $res['success'] = false;
            $res['message'] = "Data siswa tidak ditemukan!";
            $res['data'] = $siswa;
            return response($res);
        } else {
            $res['success'] = true;
            $res['message'] = "Data ditemukan!";
            $res['data'] = $siswa;
            return response($res);
        }
    }
}
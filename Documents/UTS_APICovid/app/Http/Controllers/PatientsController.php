<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;


class PatientsController extends Controller
{
    # method index untuk menampilkan semua data
    public function index()
    {
        # mengambil model Patients untuk select 
        $pasien = Patients::all();

        if ($pasien) {
            $data = [
                'message' => 'Get All Resource',
                'data' => $pasien
            ];
            return response($data, 200);
        } else {
            $data = ['message' => 'Data is empty'];

            # mengubah data array ke JSON dan mengatur status code
            return response($data, 200);
        }
    }
    # method store untuk menambahkan data
    public function store(Request $request)
    {
        # menangkap inputan dari user
        $input = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at,
        ];
        # membuat validasi
        $rules = [
            'name' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required',
            'out_date_at' => 'required',
        ];
        # membuat pesan eror
        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];
        #menjalankan validasi
        $this->validate($request, $rules, $messages);
        # menambahkan data ke database 
        $pasien = Patients::create($input);
        #mengembalikan respon
        $response = [
            'message' => 'Resource is added sucessfully',
            'data' => $pasien
        ];
        # mengembalikan data (json) status code 201
        return response($response, 201);
    }
    # method show untuk mendapatkan detail data berdasarkan id
    public function show($id)
    {
        # cari data Patients berdasarkan id
        $pasien = Patients::find($id);

        if ($pasien) {
            $data = [
                'message' => "Get Detail Resource",
                'data' => $pasien
            ];
            #status code 200  mengembalikan data json
            return response($data, 200);
        } else {
            $data = [
                'message' => "Resource not found"
            ];
            #status code 404  mengembalikan data json
            return response($data, 404);
        }
    }
    # method update untuk mengupdate data berdasarkan id kemudian di ubah berdasarkan inputan
    public function update(Request $request,  $id)
    {
        # cari data Patients berdasarkan id 
        $pasien = Patients::find($id);

        if ($pasien) {
            # mendapatkan data request
            $input = [
                'name' => $request->name ?? $pasien->name,
                'phone' => $request->phone ?? $pasien->phone,
                'address' => $request->address ?? $pasien->address,
                'status' => $request->status ?? $pasien->status,
                'in_date_at' => $request->in_date_at ?? $pasien->in_date_at,
                'out_date_at' => $request->out_date_at ?? $pasien->out_date_at,
            ];
            # mengupdate data
            $pasien->update($input);

            $data = [
                'message' => 'Resource is update successfully',
                'data' => $pasien
            ];
            #status code 200  mengembalikan data json
            return response($data, 200);
        } else {
            $data = [
                'message' => "Resource not found"
            ];
            #status code 404  mengembalikan data json
            return response($data, 404);
        }
    }
    # method destroy untuk menghapus data berdasarkan id
    public function destroy($id)
    {
        # cari data Patients berdasarkan id 
        $pasien = Patients::find($id);

        if ($pasien) {
            # hapus data
            $pasien->delete();

            $data = [
                'message' => 'Resource delete is successfully'
            ];
            #status code 200  mengembalikan data json
            return response($data, 200);
        } else {
            $data = [
                'message' => "Resource not found"
            ];
            #status code 404  mengembalikan data json
            return response($data, 404);
        }
        return $pasien;
    }
    # method search untuk mencari data berdasarkan nama
    public function search($name)
    {
        # cari data Patients berdasarkan name
        $pasien = Patients::where('name', 'like', '%' . $name . '%')->get();

        if ($pasien) {
            $data = [
                'message' => 'Get searched resource',
                'data' => $pasien
            ];
            #status code 200  mengembalikan data json
            return response($data, 200);
        } else {
            $data = [
                'message' => "Resource not found"
            ];
            #status code 404  mengembalikan data json
            return response($data, 404);
        }
    }
    # method positive untuk mencari data berdasarkan status positive
    public function positive()
    {
        # mengambil data yang posive ddi Patients berdasarkan status
        $pasien = Patients::where('status', '=', 'positive')->get();
        #total data
        $total = Patients::where('status', '=', 'positive')->get()->count();

        if ($pasien) {
            $data = [
                'message' => 'Get positive resource',
                'total' => $total,
                'data' => $pasien
            ];
            #status code 200  mengembalikan data json
            return response($data, 200);
        } else {
            $data = [
                'message' => "Resource not found"
            ];
            #status code 404  mengembalikan data json
            return response($data, 404);
        }
    }
    # method recovered untuk mencari data berdasarkan status recovered
    public function recovered()
    {
        # mengambil data yang recovered di Patients berdasarkan status
        $pasien = Patients::where('status', '=', 'recovered')->get();
        $total = Patients::where('status', '=', 'recovered')->get()->count();

        if ($pasien) {
            $data = [
                'message' => 'Get recovered resource',
                'total' => $total,
                'data' => $pasien
            ];
            #status code 200  mengembalikan data json
            return response($data, 200);
        } else {
            $data = [
                'message' => "Resource not found"
            ];
            #status code 404  mengembalikan data json
            return response($data, 404);
        }
    }
    # method dead untuk mencari data berdasarkan status dead
    public function dead()
    {
        # mengambil data yang dead di Patients berdasarkan status
        $pasien = Patients::where('status', '=', 'dead')->get();
        $total = Patients::where('status', '=', 'dead')->get()->count();

        if ($total != null) {
            $data = [
                'message' => 'Get dead resource',
                'total' => $total,
                'data' => $pasien
            ];
            #status code 200  mengembalikan data json
            return response($data, 200);
        } else {
            $data = [
                'message' => "Resource not found"
            ];
            #status code 404  mengembalikan data json
            return response($data, 404);
        }
    }
}
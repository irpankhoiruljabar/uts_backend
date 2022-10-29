<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public $animals = ['Kambing', 'Kucing', 'Sapi'];

    function index()
    {
        foreach ($this->animals as $animal) {
            echo "$animal, ";
        }
        echo '<br>';
        echo "Menampilkan data hewan";
    }

    function store(Request $request)
    {

        array_push($this->animals, $request->nama);
        echo "<br>";
        echo "Menambahkan data hewan baru";
        echo "<br>";
        foreach ($this->animals as $animal) {
            echo "$animal, ";
        }
    }
    function update(Request $request, $id)
    {
        $this->animals[$id] = $request->nama;
        echo "Mengubah data hewan id $id";
        echo "<br>";
        foreach ($this->animals as $animal) {
            echo "$animal, ";
        }
    }
    function destroy($id)
    {
        unset($this->animals[$id]);
        echo "Menghapus data hewan id $id";
        echo "<br>";

        foreach ($this->animals as $animal) {
            echo "$animal, ";
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetStoreController extends Controller
{
    public function index()
    {
//         // $response = Http::get("https://petstore.swagger.io/pet/1");
//         $response = Http::post("$this->baseUrl", [
//                 "name" => "Benek",
                
//             ]);

// // dd($response);
//         if ($response->successful()) {
//             $data = $response->json();
//             dd($data);
//             return $data;
//         } else {
//             return response()->json(
//                 ["error" => "Nie udało się pobrać danych"],
//                 $response->status()
//             );
//         }
        return view("pet-store.index", []);
    }

    public function store()
    {
        return view("pet-store.index", []);
    }

    public function create()
    {
        return view("pet-store.index", []);
    }

    public function show()
    {
        return view("pet-store.index", []);
    }

    public function update()
    {
        return view("pet-store.index", []);
    }

    public function edit()
    {
        return view("pet-store.index", []);
    }
}

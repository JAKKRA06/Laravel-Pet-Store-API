<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetStoreController extends Controller
{
    protected string $baseUrl = "https://petstore.swagger.io/v2/pet";

    /**
     * Display a front for pet-store.
     */
    public function index()
    {
        return view("pet-store.index");
    }

    /**
     * Show the form for creating a new pet resource.
     */
    public function create()
    {
        return view("pet-store.create");
    }

    /**
     * Show the form for editing the specified pet resource.
     */
    public function edit(string $id)
    {
        try {
            $response = $this->getPetById($id);
            if ($response->successful()) {
                return view("pet-store.edit", ["pet" => $response->json()]);
            }
            // @todo add logger
            return redirect()
                ->route("pet.show.all")
                ->with("error", "Something went wrong. Try again! HTTP code:" . $response->status());
        } catch (Exception $e) {
            // @todo add logger
            return redirect()
                ->route("pet.show.all")
                ->with("error", $e->getMessage());
        }
    }

    /**
     * Store a newly created pet resource.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => ["required", "string", "max:255"],
            "photoUrls" => ["required", "string", "max:255"],
            "tags" => ["string", "nullable"],
            "status" => ["string", "nullable"],
            "category.name" => ["string", "nullable"]
        ]);

        $body = [
            "name" => $validatedData["name"],
            "photoUrls" => explode(",", $validatedData["photoUrls"]),
            "status" => $validatedData["status"],
            "category" => [
                "name" => $validatedData["category"]["name"]
            ]
        ];

        $bodyTags = [];
        $requestTags = explode(",", $validatedData["tags"]);
        foreach ($requestTags as $tag) {
            $bodyTags["name"] = $tag;
            $body["tags"][] = $bodyTags;
        }

        $response = Http::post($this->baseUrl, $body);
        if ($response->successful()) {
            return redirect()
                ->route("pet.index")
                ->with(
                    "success",
                    "New pet has been saved! Pet ID: " . $response->json()["id"]
                );
        }
        // @todo add logger

        return redirect()
            ->route("pet.create")
            ->with("error", "Something went wrong. Try again! HTTP code:" . $response->status());
    }

    /**
     * Update the specified pet resource.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            "name" => ["required", "string", "max:255"],
            "photoUrls" => ["required", "string"],
            "tags" => ["string", "nullable"],
            "status" => ["string", "nullable", "in:sold,pending,available"],
            "category.name" => ["string", "nullable"]
        ]);

        $body = [
            "id" => $id,
            "name" => $validatedData["name"],
            "photoUrls" => explode(",", $validatedData["photoUrls"]),
            "status" => $validatedData["status"],
            "category" => [
                "name" => $validatedData["category"]["name"]
            ]
        ];

        $bodyTags = [];
        $requestTags = explode(",", $validatedData["tags"]);
        foreach ($requestTags as $tag) {
            $bodyTags["name"] = $tag;
            $body["tags"][] = $bodyTags;
        }

        $response = Http::put($this->baseUrl, $body);
        if ($response->successful()) {
            return redirect()
                ->route("pet.index")
                ->with(
                    "success",
                    "Pet has been edited! Pet ID: " . $response->json()["id"]
                );
        }
        // @todo add logger

        return redirect()
            ->route("pet.edit")
            ->with("error", "Something went wrong. Try again! HTTP code:" . $response->status());
    }

    /**
     * Remove the specified pet resource.
     */
    public function destroy(string $id)
    {
        try {
            $response = Http::delete($this->baseUrl . "/{$id}");

            if ($response->successful()) {
                return redirect()
                    ->route("pet.index")
                    ->with("success", "Pet resource deleted! ID: " . $id);
            }
            // @todo add logger
            return redirect()
                ->route("pet.show.all")
                ->with("error", "Something went wrong. Try again! HTTP code:" . $response->status());
        } catch (Exception $e) {
            // @todo add logger
            return redirect()
                ->route("pet.show.all")
                ->with("error", $e->getMessage());
        }
    }

    // Helper methods

    /**
     * Display a listing.
     */
    public function getAllByStatus()
    {
        try {
            $url = $this->baseUrl . "/findByStatus?status=";
            $availAblePets = Http::get($url . "available");
            $pendingPets = Http::get($url . "pending");
            $soldPets = Http::get($url . "sold");

            if (
                $availAblePets->successful() &&
                $pendingPets->successful() &&
                $soldPets->successful()
            ) {
                return view("pet-store.showAll", [
                    "sold" => !empty($soldPets)
                        ? $this->chunkNames($soldPets->json())
                        : [],
                    "pending" => !empty($pendingPets)
                        ? $this->chunkNames($pendingPets->json())
                        : [],
                    "available" => !empty($availAblePets)
                        ? $this->chunkNames($availAblePets->json())
                        : [],
                ]);
            }
            // @todo add logger
            return redirect()
                ->route("pet.index")
                ->with("error", "Error! Try again! HTTP code:" . $response->status());
        } catch (Exception $e) {
            // @todo add logger
            return redirect()
                ->route("pet.show.all")
                ->with("error", $e->getMessage());
        }
    }

    /**
     * Retrieve pet helper.
     */
    protected function getPetById(string $id)
    {
        return Http::get($this->baseUrl . "/{$id}");
    }

    /**
     * Trim long names to 30 chars.
     */
    protected function chunkNames(array $items)
    {
        return array_map(function ($item) {
            if (isset($item["name"]) && strlen($item["name"]) > 30) {
                $item["name"] = substr($item["name"], 0, 30) . "...";
            }
            if (
                isset($item["category"]["name"]) &&
                strlen($item["category"]["name"]) > 30
            ) {
                $item["category"]["name"] =
                    substr($item["category"]["name"], 0, 30) . "...";
            }
            return $item;
        }, $items);
    }
}

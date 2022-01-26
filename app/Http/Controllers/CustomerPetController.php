<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Services\CustomerPetService;
use App\Services\Providers\HttpStatus;

class CustomerPetController extends Controller
{
    private $service;

    public function __construct(CustomerPetService $service)
    {
        $this->service = $service;
    }

    public function index($customer_id)
    {
        return $this->service->index($customer_id);
    }

    public function show($customer_id, $pet_id)
    {
        $pet = $this->service->show($customer_id, $pet_id);
        return response()->json($pet, HttpStatus::HTTP_CREATED);
    }

    public function store(StorePetRequest $request, $customer_id)
    {
        $pet = $this->service->store($request->validated(), $customer_id);
        return response()->json($pet, HttpStatus::HTTP_CREATED);
    }

    public function update(StorePetRequest $request, $customer_id, $pet_id)
    {
        return $this->service->update($request->validated(), $customer_id, $pet_id);
    }

    public function destroy($customer_id, $pet_id)
    {
        $this->service->destroy($customer_id, $pet_id);
        return response()->json([], HttpStatus::HTTP_NO_CONTENT); 
    }
}

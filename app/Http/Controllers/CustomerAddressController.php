<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerAddressRequest;
use App\Services\CustomerAddressService;
use App\Services\Providers\HttpStatus;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    private $service;

    public function __construct(CustomerAddressService $service)
    {
        $this->service = $service;
    }

    public function index($customer_id)
    {
        return $this->service->index($customer_id);
    }

    public function show($customer_id, $address_id)
    {
        $addresses = $this->service->show($customer_id, $address_id);
        return response()->json($addresses, HttpStatus::HTTP_CREATED);
    }

    public function store(StoreCustomerAddressRequest $request, $customer_id)
    {
        $addresses = $this->service->store($request->validated(), $customer_id);
        return response()->json($addresses, HttpStatus::HTTP_CREATED);
    }

    public function destroy($customer_id, $address_id)
    {
        $this->service->destroy($customer_id, $address_id);
        return response()->json([], HttpStatus::HTTP_NO_CONTENT); 
    }
}

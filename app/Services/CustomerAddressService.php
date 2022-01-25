<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Services\Providers\HttpStatus;

class CustomerAddressService
{
    public function index($customer_id)
    {
        return Customer::findOrFail($customer_id)->addresses;
    }

    public function show($customer_id, $address_id)
    {
        return Customer::findOrFail($customer_id)
            ->addresses()
            ->findOrFail($address_id);
    }

    public function store(array $params, $customer_id)
    {
        return Customer::findOrFail($customer_id)
            ->addresses()
            ->createMany($params['addresses']);
    }

    public function destroy($customer_id, $address_id)
    {
        $address = Customer::findOrFail($customer_id)
            ->addresses()
            ->findOrFail($address_id);

        $address->delete(); 
    }
}
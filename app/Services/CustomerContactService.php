<?php

namespace App\Services;

use App\Models\Customer;

class CustomerContactService
{
    public function index($customer_id)
    {
        return Customer::findOrFail($customer_id)->contacts;
    }

    public function show($customer_id, $contact_id)
    {
        return Customer::findOrFail($customer_id)
            ->contacts()
            ->findOrFail($contact_id);
    }

    public function store(array $params, $customer_id)
    {
        return Customer::findOrFail($customer_id)
            ->contacts()
            ->createMany($params['contacts']);
    }

    public function destroy($customer_id, $contact_id)
    {
        $address = Customer::findOrFail($customer_id)
            ->contacts()
            ->findOrFail($contact_id);

        $address->delete(); 
    }
}
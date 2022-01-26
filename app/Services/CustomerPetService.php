<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomerPetService
{
    public function index($customer_id)
    {
        return Customer::findOrFail($customer_id)->pets;
    }

    public function show($customer_id, $pet_id)
    {
        return Customer::findOrFail($customer_id)
            ->pets()
            ->findOrFail($pet_id);
    }

    public function store(array $params, $customer_id)
    {
        if(!empty($params['image'])) {
            $imagePath = Storage::disk(storageDisk())->put('pets', $params['image']);
            $params['image'] = $imagePath;
        }

        $pet = Customer::findOrFail($customer_id)
            ->pets()
            ->create($params);

        return $pet;
    }

    public function update(array $params, $customer_id, $pet_id)
    {
        $pet = Customer::findOrFail($customer_id)
            ->pets()
            ->findOrFail($pet_id);

        if(!empty($params['image'])) {
            $imagePath = Storage::disk(storageDisk())->put('pets', $params['image']);
            $params['image'] = $imagePath;

            if($pet->image) {
                Storage::disk(storageDisk())->delete($params['image']);
            }
        }

        $pet->fill($params);
        $pet->save();

        return $pet;
    }

    public function destroy($customer_id, $pet_id)
    {
        $pet = Customer::findOrFail($customer_id)
            ->pets()
            ->findOrFail($pet_id);

        $pet->delete(); 
    }
}
<?php

namespace App\Services;

use App\Exceptions\HttpException;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\Providers\HttpStatus;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    private $customerAddressService;
    private $customerContactService;

    public function __construct(
        CustomerAddressService $customerAddressService,
        CustomerContactService $customerContactService
    )
    {
        $this->customerAddressService = $customerAddressService;
        $this->customerContactService = $customerContactService;
    }

    public function index()
    {
        return CustomerResource::collection(Customer::paginate());
    }

    public function store(array $params)
    {
        try {
            DB::beginTransaction();
            $customerDataParams = $params;
            unset($customerDataParams['address']);
            unset($customerDataParams['contacts']);

            $customer = Customer::create($customerDataParams);

            if(!empty($params['contacts']))
                $customer->contacts()->createMany($params['contacts']);

            if(!empty($params['address'])) {
                $params['address']['default'] = true;
                $customer->addresses()->create($params['address']);
            }

            DB::commit();
            return response()->json(new CustomerResource($customer), HttpStatus::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollback();
            return makeException($e);
        }
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return new CustomerResource($customer);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json([], HttpStatus::HTTP_NO_CONTENT);
    }

    public function update(array $params, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->fill($params);
        $customer->save();

        return response()->json(new CustomerResource($customer));
    }
}

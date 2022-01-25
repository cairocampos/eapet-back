<?php

namespace App\Services;

use App\Models\Pelage;
use App\Services\Providers\HttpStatus;

class PelageService
{
    public function index()
    {
        return Pelage::paginate();
    }

    public function show($id)
    {
        return Pelage::findOrFail($id);
    }

    public function store(array $params)
    {
        $pelage = Pelage::create($params);
        return response()->json(['data' => $pelage], HttpStatus::HTTP_CREATED);
    }

    public function update(array $params, $id)
    {
        $pelage = Pelage::findOrFail($id);
        $pelage->fill($params);
        $pelage->save();

        return [
            'data' => $pelage
        ];
    }

    public function destroy($id)
    {
        $pelage = Pelage::findOrFail($id);
        $pelage->delete();

        return response()->json([], HttpStatus::HTTP_NO_CONTENT);
    }
}

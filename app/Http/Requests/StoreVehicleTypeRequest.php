<?php

namespace App\Http\Requests;

use App\VehicleType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVehicleTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vehicle_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'type' => [
                'required',
                'unique:vehicle_types'],
        ];

    }
}

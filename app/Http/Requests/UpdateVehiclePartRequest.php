<?php

namespace App\Http\Requests;

use App\VehiclePart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateVehiclePartRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vehicle_part_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name' => [
                'required'],
        ];

    }
}

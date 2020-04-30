<?php

namespace App\Http\Requests;

use App\VehicleAllocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateVehicleAllocationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vehicle_allocation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'organogram_id'            => [
                'required',
                'integer'],
            'division_id'              => [
                'required',
                'integer'],
            'vehicle_serial_numbers.*' => [
                'integer'],
            'vehicle_serial_numbers'   => [
                'required',
                'array'],
        ];

    }
}

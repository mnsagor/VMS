<?php

namespace App\Http\Requests;

use App\DriverAllocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreDriverAllocationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('driver_allocation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'driver_id'              => [
                'required',
                'integer'],
            'ragistration_number_id' => [
                'required',
                'integer'],
        ];

    }
}

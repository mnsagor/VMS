<?php

namespace App\Http\Requests;

use App\Fuel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateFuelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fuel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'amount' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'date'   => [
                'required',
                'date_format:' . config('panel.date_format')],
        ];

    }
}

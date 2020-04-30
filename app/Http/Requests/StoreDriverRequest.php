<?php

namespace App\Http\Requests;

use App\Driver;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreDriverRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('driver_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'                          => [
                'required'],
            'phone_number'                  => [
                'required',
                'unique:drivers'],
            'drivng_licence_validity'       => [
                'required'],
            'driving_licence_certificate.*' => [
                'required'],
        ];

    }
}

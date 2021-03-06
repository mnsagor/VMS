<?php

namespace App\Http\Requests;

use App\Driver;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDriverRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('driver_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'                    => [
                'required'],
            'phone_number'            => [
                'required',
                'unique:drivers,phone_number,' . request()->route('driver')->id],
            'drivng_licence_validity' => [
                'required'],
        ];

    }
}

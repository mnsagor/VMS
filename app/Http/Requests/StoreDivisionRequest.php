<?php

namespace App\Http\Requests;

use App\Division;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreDivisionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('division_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:divisions'],
        ];

    }
}

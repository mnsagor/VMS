<?php

namespace App\Http\Requests;

use App\Organogram;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreOrganogramRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('organogram_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'post_name' => [
                'required'],
        ];

    }
}

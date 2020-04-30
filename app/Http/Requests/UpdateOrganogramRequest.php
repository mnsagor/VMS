<?php

namespace App\Http\Requests;

use App\Organogram;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrganogramRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('organogram_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

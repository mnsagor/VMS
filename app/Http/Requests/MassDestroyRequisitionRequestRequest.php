<?php

namespace App\Http\Requests;

use App\RequisitionRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequisitionRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('requisition_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:requisition_requests,id',
        ];

    }
}

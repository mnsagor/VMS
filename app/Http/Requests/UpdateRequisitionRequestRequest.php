<?php

namespace App\Http\Requests;

use App\RequisitionRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequisitionRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('requisition_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'            => [
                'required'],
            'designation'     => [
                'required'],
            'phone_number'    => [
                'required'],
            'vehicle_type_id' => [
                'required',
                'integer'],
            'start_time'      => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format')],
            'end_time'        => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format')],
        ];

    }
}

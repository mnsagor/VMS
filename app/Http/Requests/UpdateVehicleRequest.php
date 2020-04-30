<?php

namespace App\Http\Requests;

use App\Vehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vehicle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'vehicle_serial'      => [
                'required',
                'unique:vehicles,vehicle_serial,' . request()->route('vehicle')->id],
            'ragistration_number' => [
                'required',
                'unique:vehicles,ragistration_number,' . request()->route('vehicle')->id],
            'vehicle_type_id'     => [
                'required',
                'integer'],
            'model_name'          => [
                'required'],
            'ragistration_date'   => [
                'required',
                'date_format:' . config('panel.date_format')],
            'engine_capacity'     => [
                'required'],
            'fitness_vality'      => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'tax_token_validity'  => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
        ];

    }
}

<?php

namespace App\Http\Requests;

use App\ExpenseType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreExpenseTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('expense_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'catagory_type' => [
                'required',
                'unique:expense_types'],
        ];

    }
}

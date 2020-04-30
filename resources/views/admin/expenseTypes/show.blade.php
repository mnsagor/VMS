@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.expenseType.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.expense-types.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseType.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $expenseType->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseType.fields.catagory_type') }}
                                    </th>
                                    <td>
                                        {{ $expenseType->catagory_type }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.expense-types.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#expence_catogory_expenses" aria-controls="expence_catogory_expenses" role="tab" data-toggle="tab">
                            {{ trans('cruds.expense.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="expence_catogory_expenses">
                        @includeIf('admin.expenseTypes.relationships.expenceCatogoryExpenses', ['expenses' => $expenseType->expenceCatogoryExpenses])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
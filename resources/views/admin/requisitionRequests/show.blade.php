@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.requisitionRequest.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.requisition-requests.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.requisitionRequest.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $requisitionRequest->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.requisitionRequest.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $requisitionRequest->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.requisitionRequest.fields.designation') }}
                                    </th>
                                    <td>
                                        {{ $requisitionRequest->designation }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.requisitionRequest.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $requisitionRequest->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.requisitionRequest.fields.vehicle_type') }}
                                    </th>
                                    <td>
                                        {{ $requisitionRequest->vehicle_type->type ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.requisitionRequest.fields.start_time') }}
                                    </th>
                                    <td>
                                        {{ $requisitionRequest->start_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.requisitionRequest.fields.end_time') }}
                                    </th>
                                    <td>
                                        {{ $requisitionRequest->end_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.requisitionRequest.fields.purpose') }}
                                    </th>
                                    <td>
                                        {!! $requisitionRequest->purpose !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.requisition-requests.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
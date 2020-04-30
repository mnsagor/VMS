@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.vehicleType.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.vehicle-types.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleType.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $vehicleType->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleType.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $vehicleType->type }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.vehicle-types.index') }}">
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
                        <a href="#vehicle_type_vehicles" aria-controls="vehicle_type_vehicles" role="tab" data-toggle="tab">
                            {{ trans('cruds.vehicle.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#vehicle_type_requisition_requests" aria-controls="vehicle_type_requisition_requests" role="tab" data-toggle="tab">
                            {{ trans('cruds.requisitionRequest.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="vehicle_type_vehicles">
                        @includeIf('admin.vehicleTypes.relationships.vehicleTypeVehicles', ['vehicles' => $vehicleType->vehicleTypeVehicles])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="vehicle_type_requisition_requests">
                        @includeIf('admin.vehicleTypes.relationships.vehicleTypeRequisitionRequests', ['requisitionRequests' => $vehicleType->vehicleTypeRequisitionRequests])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
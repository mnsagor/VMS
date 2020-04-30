@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.vehicle.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.vehicles.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.vehicle_serial') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->vehicle_serial }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.ragistration_number') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->ragistration_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.vehicle_type') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->vehicle_type->type ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.model_name') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->model_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.model_year') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->model_year }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.ragistration_date') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->ragistration_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.engine_capacity') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->engine_capacity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.fitness_vality') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->fitness_vality }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.fitness_certificate') }}
                                    </th>
                                    <td>
                                        @foreach($vehicle->fitness_certificate as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.tax_token_validity') }}
                                    </th>
                                    <td>
                                        {{ $vehicle->tax_token_validity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.tex_token_certificate') }}
                                    </th>
                                    <td>
                                        @foreach($vehicle->tex_token_certificate as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.other_documents') }}
                                    </th>
                                    <td>
                                        @foreach($vehicle->other_documents as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.vehicles.index') }}">
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
                        <a href="#vehicle_expenses" aria-controls="vehicle_expenses" role="tab" data-toggle="tab">
                            {{ trans('cruds.expense.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#ragistration_number_driver_allocations" aria-controls="ragistration_number_driver_allocations" role="tab" data-toggle="tab">
                            {{ trans('cruds.driverAllocation.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#vehicle_serial_number_vehicle_allocations" aria-controls="vehicle_serial_number_vehicle_allocations" role="tab" data-toggle="tab">
                            {{ trans('cruds.vehicleAllocation.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="vehicle_expenses">
                        @includeIf('admin.vehicles.relationships.vehicleExpenses', ['expenses' => $vehicle->vehicleExpenses])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="ragistration_number_driver_allocations">
                        @includeIf('admin.vehicles.relationships.ragistrationNumberDriverAllocations', ['driverAllocations' => $vehicle->ragistrationNumberDriverAllocations])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="vehicle_serial_number_vehicle_allocations">
                        @includeIf('admin.vehicles.relationships.vehicleSerialNumberVehicleAllocations', ['vehicleAllocations' => $vehicle->vehicleSerialNumberVehicleAllocations])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
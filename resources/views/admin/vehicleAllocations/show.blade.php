@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.vehicleAllocation.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.vehicle-allocations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleAllocation.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $vehicleAllocation->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleAllocation.fields.organogram') }}
                                    </th>
                                    <td>
                                        {{ $vehicleAllocation->organogram->post_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleAllocation.fields.division') }}
                                    </th>
                                    <td>
                                        {{ $vehicleAllocation->division->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleAllocation.fields.vehicle_serial_number') }}
                                    </th>
                                    <td>
                                        @foreach($vehicleAllocation->vehicle_serial_numbers as $key => $vehicle_serial_number)
                                            <span class="label label-info">{{ $vehicle_serial_number->vehicle_serial }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.vehicle-allocations.index') }}">
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
@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.driver.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.drivers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $driver->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $driver->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $driver->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Driver::TYPE_SELECT[$driver->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.drivng_licence_validity') }}
                                    </th>
                                    <td>
                                        {{ $driver->drivng_licence_validity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driver.fields.driving_licence_certificate') }}
                                    </th>
                                    <td>
                                        @foreach($driver->driving_licence_certificate as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.drivers.index') }}">
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
                        <a href="#driver_driver_allocations" aria-controls="driver_driver_allocations" role="tab" data-toggle="tab">
                            {{ trans('cruds.driverAllocation.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="driver_driver_allocations">
                        @includeIf('admin.drivers.relationships.driverDriverAllocations', ['driverAllocations' => $driver->driverDriverAllocations])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
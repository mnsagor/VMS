@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.vehicleAllocation.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.vehicle-allocations.update", [$vehicleAllocation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('organogram') ? 'has-error' : '' }}">
                            <label class="required" for="organogram_id">{{ trans('cruds.vehicleAllocation.fields.organogram') }}</label>
                            <select class="form-control select2" name="organogram_id" id="organogram_id" required>
                                @foreach($organograms as $id => $organogram)
                                    <option value="{{ $id }}" {{ ($vehicleAllocation->organogram ? $vehicleAllocation->organogram->id : old('organogram_id')) == $id ? 'selected' : '' }}>{{ $organogram }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('organogram'))
                                <span class="help-block" role="alert">{{ $errors->first('organogram') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleAllocation.fields.organogram_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('division') ? 'has-error' : '' }}">
                            <label class="required" for="division_id">{{ trans('cruds.vehicleAllocation.fields.division') }}</label>
                            <select class="form-control select2" name="division_id" id="division_id" required>
                                @foreach($divisions as $id => $division)
                                    <option value="{{ $id }}" {{ ($vehicleAllocation->division ? $vehicleAllocation->division->id : old('division_id')) == $id ? 'selected' : '' }}>{{ $division }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('division'))
                                <span class="help-block" role="alert">{{ $errors->first('division') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleAllocation.fields.division_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('vehicle_serial_numbers') ? 'has-error' : '' }}">
                            <label class="required" for="vehicle_serial_numbers">{{ trans('cruds.vehicleAllocation.fields.vehicle_serial_number') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="vehicle_serial_numbers[]" id="vehicle_serial_numbers" multiple required>
                                @foreach($vehicle_serial_numbers as $id => $vehicle_serial_number)
                                    <option value="{{ $id }}" {{ (in_array($id, old('vehicle_serial_numbers', [])) || $vehicleAllocation->vehicle_serial_numbers->contains($id)) ? 'selected' : '' }}>{{ $vehicle_serial_number }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('vehicle_serial_numbers'))
                                <span class="help-block" role="alert">{{ $errors->first('vehicle_serial_numbers') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleAllocation.fields.vehicle_serial_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
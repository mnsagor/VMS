@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.driverAllocation.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.driver-allocations.update", [$driverAllocation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('driver') ? 'has-error' : '' }}">
                            <label class="required" for="driver_id">{{ trans('cruds.driverAllocation.fields.driver') }}</label>
                            <select class="form-control select2" name="driver_id" id="driver_id" required>
                                @foreach($drivers as $id => $driver)
                                    <option value="{{ $id }}" {{ ($driverAllocation->driver ? $driverAllocation->driver->id : old('driver_id')) == $id ? 'selected' : '' }}>{{ $driver }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('driver'))
                                <span class="help-block" role="alert">{{ $errors->first('driver') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.driverAllocation.fields.driver_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ragistration_number') ? 'has-error' : '' }}">
                            <label class="required" for="ragistration_number_id">{{ trans('cruds.driverAllocation.fields.ragistration_number') }}</label>
                            <select class="form-control select2" name="ragistration_number_id" id="ragistration_number_id" required>
                                @foreach($ragistration_numbers as $id => $ragistration_number)
                                    <option value="{{ $id }}" {{ ($driverAllocation->ragistration_number ? $driverAllocation->ragistration_number->id : old('ragistration_number_id')) == $id ? 'selected' : '' }}>{{ $ragistration_number }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ragistration_number'))
                                <span class="help-block" role="alert">{{ $errors->first('ragistration_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.driverAllocation.fields.ragistration_number_helper') }}</span>
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
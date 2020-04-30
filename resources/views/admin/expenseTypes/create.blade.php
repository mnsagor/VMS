@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.expenseType.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.expense-types.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('catagory_type') ? 'has-error' : '' }}">
                            <label class="required" for="catagory_type">{{ trans('cruds.expenseType.fields.catagory_type') }}</label>
                            <input class="form-control" type="text" name="catagory_type" id="catagory_type" value="{{ old('catagory_type', '') }}" required>
                            @if($errors->has('catagory_type'))
                                <span class="help-block" role="alert">{{ $errors->first('catagory_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.expenseType.fields.catagory_type_helper') }}</span>
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
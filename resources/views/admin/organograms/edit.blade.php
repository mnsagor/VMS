@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.organogram.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.organograms.update", [$organogram->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('post_name') ? 'has-error' : '' }}">
                            <label class="required" for="post_name">{{ trans('cruds.organogram.fields.post_name') }}</label>
                            <input class="form-control" type="text" name="post_name" id="post_name" value="{{ old('post_name', $organogram->post_name) }}" required>
                            @if($errors->has('post_name'))
                                <span class="help-block" role="alert">{{ $errors->first('post_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.organogram.fields.post_name_helper') }}</span>
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
@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.driver.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.drivers.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.driver.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.driver.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            <label class="required" for="phone_number">{{ trans('cruds.driver.fields.phone_number') }}</label>
                            <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '01912929987') }}" required>
                            @if($errors->has('phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.driver.fields.phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.driver.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Driver::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <span class="help-block" role="alert">{{ $errors->first('type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.driver.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('drivng_licence_validity') ? 'has-error' : '' }}">
                            <label class="required" for="drivng_licence_validity">{{ trans('cruds.driver.fields.drivng_licence_validity') }}</label>
                            <input class="form-control" type="text" name="drivng_licence_validity" id="drivng_licence_validity" value="{{ old('drivng_licence_validity', '2025') }}" required>
                            @if($errors->has('drivng_licence_validity'))
                                <span class="help-block" role="alert">{{ $errors->first('drivng_licence_validity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.driver.fields.drivng_licence_validity_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('driving_licence_certificate') ? 'has-error' : '' }}">
                            <label class="required" for="driving_licence_certificate">{{ trans('cruds.driver.fields.driving_licence_certificate') }}</label>
                            <div class="needsclick dropzone" id="driving_licence_certificate-dropzone">
                            </div>
                            @if($errors->has('driving_licence_certificate'))
                                <span class="help-block" role="alert">{{ $errors->first('driving_licence_certificate') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.driver.fields.driving_licence_certificate_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedDrivingLicenceCertificateMap = {}
Dropzone.options.drivingLicenceCertificateDropzone = {
    url: '{{ route('admin.drivers.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="driving_licence_certificate[]" value="' + response.name + '">')
      uploadedDrivingLicenceCertificateMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDrivingLicenceCertificateMap[file.name]
      }
      $('form').find('input[name="driving_licence_certificate[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($driver) && $driver->driving_licence_certificate)
          var files =
            {!! json_encode($driver->driving_licence_certificate) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="driving_licence_certificate[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
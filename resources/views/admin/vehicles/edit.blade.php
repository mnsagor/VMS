@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.vehicle.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.vehicles.update", [$vehicle->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('vehicle_serial') ? 'has-error' : '' }}">
                            <label class="required" for="vehicle_serial">{{ trans('cruds.vehicle.fields.vehicle_serial') }}</label>
                            <input class="form-control" type="text" name="vehicle_serial" id="vehicle_serial" value="{{ old('vehicle_serial', $vehicle->vehicle_serial) }}" required>
                            @if($errors->has('vehicle_serial'))
                                <span class="help-block" role="alert">{{ $errors->first('vehicle_serial') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.vehicle_serial_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ragistration_number') ? 'has-error' : '' }}">
                            <label class="required" for="ragistration_number">{{ trans('cruds.vehicle.fields.ragistration_number') }}</label>
                            <input class="form-control" type="text" name="ragistration_number" id="ragistration_number" value="{{ old('ragistration_number', $vehicle->ragistration_number) }}" required>
                            @if($errors->has('ragistration_number'))
                                <span class="help-block" role="alert">{{ $errors->first('ragistration_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.ragistration_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('vehicle_type') ? 'has-error' : '' }}">
                            <label class="required" for="vehicle_type_id">{{ trans('cruds.vehicle.fields.vehicle_type') }}</label>
                            <select class="form-control select2" name="vehicle_type_id" id="vehicle_type_id" required>
                                @foreach($vehicle_types as $id => $vehicle_type)
                                    <option value="{{ $id }}" {{ ($vehicle->vehicle_type ? $vehicle->vehicle_type->id : old('vehicle_type_id')) == $id ? 'selected' : '' }}>{{ $vehicle_type }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('vehicle_type'))
                                <span class="help-block" role="alert">{{ $errors->first('vehicle_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.vehicle_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('model_name') ? 'has-error' : '' }}">
                            <label class="required" for="model_name">{{ trans('cruds.vehicle.fields.model_name') }}</label>
                            <input class="form-control" type="text" name="model_name" id="model_name" value="{{ old('model_name', $vehicle->model_name) }}" required>
                            @if($errors->has('model_name'))
                                <span class="help-block" role="alert">{{ $errors->first('model_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.model_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('model_year') ? 'has-error' : '' }}">
                            <label for="model_year">{{ trans('cruds.vehicle.fields.model_year') }}</label>
                            <input class="form-control" type="text" name="model_year" id="model_year" value="{{ old('model_year', $vehicle->model_year) }}">
                            @if($errors->has('model_year'))
                                <span class="help-block" role="alert">{{ $errors->first('model_year') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.model_year_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ragistration_date') ? 'has-error' : '' }}">
                            <label class="required" for="ragistration_date">{{ trans('cruds.vehicle.fields.ragistration_date') }}</label>
                            <input class="form-control date" type="text" name="ragistration_date" id="ragistration_date" value="{{ old('ragistration_date', $vehicle->ragistration_date) }}" required>
                            @if($errors->has('ragistration_date'))
                                <span class="help-block" role="alert">{{ $errors->first('ragistration_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.ragistration_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('engine_capacity') ? 'has-error' : '' }}">
                            <label class="required" for="engine_capacity">{{ trans('cruds.vehicle.fields.engine_capacity') }}</label>
                            <input class="form-control" type="text" name="engine_capacity" id="engine_capacity" value="{{ old('engine_capacity', $vehicle->engine_capacity) }}" required>
                            @if($errors->has('engine_capacity'))
                                <span class="help-block" role="alert">{{ $errors->first('engine_capacity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.engine_capacity_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('fitness_vality') ? 'has-error' : '' }}">
                            <label for="fitness_vality">{{ trans('cruds.vehicle.fields.fitness_vality') }}</label>
                            <input class="form-control date" type="text" name="fitness_vality" id="fitness_vality" value="{{ old('fitness_vality', $vehicle->fitness_vality) }}">
                            @if($errors->has('fitness_vality'))
                                <span class="help-block" role="alert">{{ $errors->first('fitness_vality') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.fitness_vality_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('fitness_certificate') ? 'has-error' : '' }}">
                            <label for="fitness_certificate">{{ trans('cruds.vehicle.fields.fitness_certificate') }}</label>
                            <div class="needsclick dropzone" id="fitness_certificate-dropzone">
                            </div>
                            @if($errors->has('fitness_certificate'))
                                <span class="help-block" role="alert">{{ $errors->first('fitness_certificate') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.fitness_certificate_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tax_token_validity') ? 'has-error' : '' }}">
                            <label for="tax_token_validity">{{ trans('cruds.vehicle.fields.tax_token_validity') }}</label>
                            <input class="form-control date" type="text" name="tax_token_validity" id="tax_token_validity" value="{{ old('tax_token_validity', $vehicle->tax_token_validity) }}">
                            @if($errors->has('tax_token_validity'))
                                <span class="help-block" role="alert">{{ $errors->first('tax_token_validity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.tax_token_validity_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tex_token_certificate') ? 'has-error' : '' }}">
                            <label for="tex_token_certificate">{{ trans('cruds.vehicle.fields.tex_token_certificate') }}</label>
                            <div class="needsclick dropzone" id="tex_token_certificate-dropzone">
                            </div>
                            @if($errors->has('tex_token_certificate'))
                                <span class="help-block" role="alert">{{ $errors->first('tex_token_certificate') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.tex_token_certificate_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('other_documents') ? 'has-error' : '' }}">
                            <label for="other_documents">{{ trans('cruds.vehicle.fields.other_documents') }}</label>
                            <div class="needsclick dropzone" id="other_documents-dropzone">
                            </div>
                            @if($errors->has('other_documents'))
                                <span class="help-block" role="alert">{{ $errors->first('other_documents') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicle.fields.other_documents_helper') }}</span>
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
    var uploadedFitnessCertificateMap = {}
Dropzone.options.fitnessCertificateDropzone = {
    url: '{{ route('admin.vehicles.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="fitness_certificate[]" value="' + response.name + '">')
      uploadedFitnessCertificateMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFitnessCertificateMap[file.name]
      }
      $('form').find('input[name="fitness_certificate[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($vehicle) && $vehicle->fitness_certificate)
          var files =
            {!! json_encode($vehicle->fitness_certificate) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="fitness_certificate[]" value="' + file.file_name + '">')
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
<script>
    var uploadedTexTokenCertificateMap = {}
Dropzone.options.texTokenCertificateDropzone = {
    url: '{{ route('admin.vehicles.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="tex_token_certificate[]" value="' + response.name + '">')
      uploadedTexTokenCertificateMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedTexTokenCertificateMap[file.name]
      }
      $('form').find('input[name="tex_token_certificate[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($vehicle) && $vehicle->tex_token_certificate)
          var files =
            {!! json_encode($vehicle->tex_token_certificate) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="tex_token_certificate[]" value="' + file.file_name + '">')
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
<script>
    var uploadedOtherDocumentsMap = {}
Dropzone.options.otherDocumentsDropzone = {
    url: '{{ route('admin.vehicles.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="other_documents[]" value="' + response.name + '">')
      uploadedOtherDocumentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedOtherDocumentsMap[file.name]
      }
      $('form').find('input[name="other_documents[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($vehicle) && $vehicle->other_documents)
          var files =
            {!! json_encode($vehicle->other_documents) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="other_documents[]" value="' + file.file_name + '">')
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
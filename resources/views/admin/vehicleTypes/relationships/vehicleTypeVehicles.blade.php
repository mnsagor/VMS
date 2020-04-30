<div class="content">
    @can('vehicle_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.vehicles.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.vehicle.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.vehicle.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-vehicleTypeVehicles">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.vehicle_serial') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.ragistration_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.vehicle_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.model_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.model_year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.ragistration_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.engine_capacity') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.fitness_vality') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.fitness_certificate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.tax_token_validity') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.tex_token_certificate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicle.fields.other_documents') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $key => $vehicle)
                                    <tr data-entry-id="{{ $vehicle->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $vehicle->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicle->vehicle_serial ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicle->ragistration_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicle->vehicle_type->type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicle->model_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicle->model_year ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicle->ragistration_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicle->engine_capacity ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicle->fitness_vality ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($vehicle->fitness_certificate as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $vehicle->tax_token_validity ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($vehicle->tex_token_certificate as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($vehicle->other_documents as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('vehicle_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.vehicles.show', $vehicle->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.vehicles.edit', $vehicle->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_delete')
                                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('vehicle_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vehicles.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-vehicleTypeVehicles:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
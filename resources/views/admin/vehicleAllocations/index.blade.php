@extends('layouts.admin')
@section('content')
<div class="content">
    @can('vehicle_allocation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.vehicle-allocations.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.vehicleAllocation.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.vehicleAllocation.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-VehicleAllocation">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleAllocation.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleAllocation.fields.organogram') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleAllocation.fields.division') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleAllocation.fields.vehicle_serial_number') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicleAllocations as $key => $vehicleAllocation)
                                    <tr data-entry-id="{{ $vehicleAllocation->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $vehicleAllocation->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleAllocation->organogram->post_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleAllocation->division->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($vehicleAllocation->vehicle_serial_numbers as $key => $item)
                                                <span class="label label-info label-many">{{ $item->vehicle_serial }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('vehicle_allocation_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.vehicle-allocations.show', $vehicleAllocation->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_allocation_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.vehicle-allocations.edit', $vehicleAllocation->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_allocation_delete')
                                                <form action="{{ route('admin.vehicle-allocations.destroy', $vehicleAllocation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('vehicle_allocation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vehicle-allocations.massDestroy') }}",
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
  $('.datatable-VehicleAllocation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
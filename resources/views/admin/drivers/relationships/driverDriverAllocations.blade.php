<div class="content">
    @can('driver_allocation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.driver-allocations.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.driverAllocation.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.driverAllocation.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-driverDriverAllocations">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.driverAllocation.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.driverAllocation.fields.driver') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.driverAllocation.fields.ragistration_number') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($driverAllocations as $key => $driverAllocation)
                                    <tr data-entry-id="{{ $driverAllocation->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $driverAllocation->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $driverAllocation->driver->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $driverAllocation->ragistration_number->ragistration_number ?? '' }}
                                        </td>
                                        <td>
                                            @can('driver_allocation_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.driver-allocations.show', $driverAllocation->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('driver_allocation_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.driver-allocations.edit', $driverAllocation->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('driver_allocation_delete')
                                                <form action="{{ route('admin.driver-allocations.destroy', $driverAllocation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('driver_allocation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.driver-allocations.massDestroy') }}",
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
  $('.datatable-driverDriverAllocations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
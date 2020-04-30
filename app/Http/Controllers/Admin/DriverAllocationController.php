<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\DriverAllocation;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDriverAllocationRequest;
use App\Http\Requests\StoreDriverAllocationRequest;
use App\Http\Requests\UpdateDriverAllocationRequest;
use App\Vehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverAllocationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('driver_allocation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driverAllocations = DriverAllocation::all();

        return view('admin.driverAllocations.index', compact('driverAllocations'));
    }

    public function create()
    {
        abort_if(Gate::denies('driver_allocation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ragistration_numbers = Vehicle::all()->pluck('ragistration_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.driverAllocations.create', compact('drivers', 'ragistration_numbers'));
    }

    public function store(StoreDriverAllocationRequest $request)
    {
        $driverAllocation = DriverAllocation::create($request->all());

        return redirect()->route('admin.driver-allocations.index');

    }

    public function edit(DriverAllocation $driverAllocation)
    {
        abort_if(Gate::denies('driver_allocation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ragistration_numbers = Vehicle::all()->pluck('ragistration_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $driverAllocation->load('driver', 'ragistration_number');

        return view('admin.driverAllocations.edit', compact('drivers', 'ragistration_numbers', 'driverAllocation'));
    }

    public function update(UpdateDriverAllocationRequest $request, DriverAllocation $driverAllocation)
    {
        $driverAllocation->update($request->all());

        return redirect()->route('admin.driver-allocations.index');

    }

    public function show(DriverAllocation $driverAllocation)
    {
        abort_if(Gate::denies('driver_allocation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driverAllocation->load('driver', 'ragistration_number');

        return view('admin.driverAllocations.show', compact('driverAllocation'));
    }

    public function destroy(DriverAllocation $driverAllocation)
    {
        abort_if(Gate::denies('driver_allocation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driverAllocation->delete();

        return back();

    }

    public function massDestroy(MassDestroyDriverAllocationRequest $request)
    {
        DriverAllocation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Division;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVehicleAllocationRequest;
use App\Http\Requests\StoreVehicleAllocationRequest;
use App\Http\Requests\UpdateVehicleAllocationRequest;
use App\Organogram;
use App\Vehicle;
use App\VehicleAllocation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleAllocationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_allocation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleAllocations = VehicleAllocation::all();

        return view('admin.vehicleAllocations.index', compact('vehicleAllocations'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_allocation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organograms = Organogram::all()->pluck('post_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicle_serial_numbers = Vehicle::all()->pluck('vehicle_serial', 'id');

        return view('admin.vehicleAllocations.create', compact('organograms', 'divisions', 'vehicle_serial_numbers'));
    }

    public function store(StoreVehicleAllocationRequest $request)
    {
        $vehicleAllocation = VehicleAllocation::create($request->all());
        $vehicleAllocation->vehicle_serial_numbers()->sync($request->input('vehicle_serial_numbers', []));

        return redirect()->route('admin.vehicle-allocations.index');

    }

    public function edit(VehicleAllocation $vehicleAllocation)
    {
        abort_if(Gate::denies('vehicle_allocation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organograms = Organogram::all()->pluck('post_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicle_serial_numbers = Vehicle::all()->pluck('vehicle_serial', 'id');

        $vehicleAllocation->load('organogram', 'division', 'vehicle_serial_numbers');

        return view('admin.vehicleAllocations.edit', compact('organograms', 'divisions', 'vehicle_serial_numbers', 'vehicleAllocation'));
    }

    public function update(UpdateVehicleAllocationRequest $request, VehicleAllocation $vehicleAllocation)
    {
        $vehicleAllocation->update($request->all());
        $vehicleAllocation->vehicle_serial_numbers()->sync($request->input('vehicle_serial_numbers', []));

        return redirect()->route('admin.vehicle-allocations.index');

    }

    public function show(VehicleAllocation $vehicleAllocation)
    {
        abort_if(Gate::denies('vehicle_allocation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleAllocation->load('organogram', 'division', 'vehicle_serial_numbers');

        return view('admin.vehicleAllocations.show', compact('vehicleAllocation'));
    }

    public function destroy(VehicleAllocation $vehicleAllocation)
    {
        abort_if(Gate::denies('vehicle_allocation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleAllocation->delete();

        return back();

    }

    public function massDestroy(MassDestroyVehicleAllocationRequest $request)
    {
        VehicleAllocation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

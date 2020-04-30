<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleAllocationRequest;
use App\Http\Requests\UpdateVehicleAllocationRequest;
use App\Http\Resources\Admin\VehicleAllocationResource;
use App\VehicleAllocation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleAllocationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_allocation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehicleAllocationResource(VehicleAllocation::with(['organogram', 'division', 'vehicle_serial_numbers'])->get());

    }

    public function store(StoreVehicleAllocationRequest $request)
    {
        $vehicleAllocation = VehicleAllocation::create($request->all());
        $vehicleAllocation->vehicle_serial_numbers()->sync($request->input('vehicle_serial_numbers', []));

        return (new VehicleAllocationResource($vehicleAllocation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(VehicleAllocation $vehicleAllocation)
    {
        abort_if(Gate::denies('vehicle_allocation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehicleAllocationResource($vehicleAllocation->load(['organogram', 'division', 'vehicle_serial_numbers']));

    }

    public function update(UpdateVehicleAllocationRequest $request, VehicleAllocation $vehicleAllocation)
    {
        $vehicleAllocation->update($request->all());
        $vehicleAllocation->vehicle_serial_numbers()->sync($request->input('vehicle_serial_numbers', []));

        return (new VehicleAllocationResource($vehicleAllocation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(VehicleAllocation $vehicleAllocation)
    {
        abort_if(Gate::denies('vehicle_allocation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleAllocation->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

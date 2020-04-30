<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVehicleTypeRequest;
use App\Http\Requests\StoreVehicleTypeRequest;
use App\Http\Requests\UpdateVehicleTypeRequest;
use App\VehicleType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleTypes = VehicleType::all();

        return view('admin.vehicleTypes.index', compact('vehicleTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleTypes.create');
    }

    public function store(StoreVehicleTypeRequest $request)
    {
        $vehicleType = VehicleType::create($request->all());

        return redirect()->route('admin.vehicle-types.index');

    }

    public function edit(VehicleType $vehicleType)
    {
        abort_if(Gate::denies('vehicle_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleTypes.edit', compact('vehicleType'));
    }

    public function update(UpdateVehicleTypeRequest $request, VehicleType $vehicleType)
    {
        $vehicleType->update($request->all());

        return redirect()->route('admin.vehicle-types.index');

    }

    public function show(VehicleType $vehicleType)
    {
        abort_if(Gate::denies('vehicle_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleType->load('vehicleTypeVehicles', 'vehicleTypeRequisitionRequests');

        return view('admin.vehicleTypes.show', compact('vehicleType'));
    }

    public function destroy(VehicleType $vehicleType)
    {
        abort_if(Gate::denies('vehicle_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleType->delete();

        return back();

    }

    public function massDestroy(MassDestroyVehicleTypeRequest $request)
    {
        VehicleType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVehiclePartRequest;
use App\Http\Requests\StoreVehiclePartRequest;
use App\Http\Requests\UpdateVehiclePartRequest;
use App\VehiclePart;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehiclePartsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_part_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleParts = VehiclePart::all();

        return view('admin.vehicleParts.index', compact('vehicleParts'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_part_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleParts.create');
    }

    public function store(StoreVehiclePartRequest $request)
    {
        $vehiclePart = VehiclePart::create($request->all());

        return redirect()->route('admin.vehicle-parts.index');

    }

    public function edit(VehiclePart $vehiclePart)
    {
        abort_if(Gate::denies('vehicle_part_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleParts.edit', compact('vehiclePart'));
    }

    public function update(UpdateVehiclePartRequest $request, VehiclePart $vehiclePart)
    {
        $vehiclePart->update($request->all());

        return redirect()->route('admin.vehicle-parts.index');

    }

    public function show(VehiclePart $vehiclePart)
    {
        abort_if(Gate::denies('vehicle_part_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vehicleParts.show', compact('vehiclePart'));
    }

    public function destroy(VehiclePart $vehiclePart)
    {
        abort_if(Gate::denies('vehicle_part_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehiclePart->delete();

        return back();

    }

    public function massDestroy(MassDestroyVehiclePartRequest $request)
    {
        VehiclePart::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

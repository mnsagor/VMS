<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiclePartRequest;
use App\Http\Requests\UpdateVehiclePartRequest;
use App\Http\Resources\Admin\VehiclePartResource;
use App\VehiclePart;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehiclePartsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_part_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehiclePartResource(VehiclePart::all());

    }

    public function store(StoreVehiclePartRequest $request)
    {
        $vehiclePart = VehiclePart::create($request->all());

        return (new VehiclePartResource($vehiclePart))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(VehiclePart $vehiclePart)
    {
        abort_if(Gate::denies('vehicle_part_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehiclePartResource($vehiclePart);

    }

    public function update(UpdateVehiclePartRequest $request, VehiclePart $vehiclePart)
    {
        $vehiclePart->update($request->all());

        return (new VehiclePartResource($vehiclePart))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(VehiclePart $vehiclePart)
    {
        abort_if(Gate::denies('vehicle_part_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehiclePart->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

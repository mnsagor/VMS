<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Fuel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFuelRequest;
use App\Http\Requests\UpdateFuelRequest;
use App\Http\Resources\Admin\FuelResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FuelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FuelResource(Fuel::all());

    }

    public function store(StoreFuelRequest $request)
    {
        $fuel = Fuel::create($request->all());

        return (new FuelResource($fuel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Fuel $fuel)
    {
        abort_if(Gate::denies('fuel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FuelResource($fuel);

    }

    public function update(UpdateFuelRequest $request, Fuel $fuel)
    {
        $fuel->update($request->all());

        return (new FuelResource($fuel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Fuel $fuel)
    {
        abort_if(Gate::denies('fuel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fuel->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\Admin\VehicleResource;
use App\Vehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehicleResource(Vehicle::with(['vehicle_type'])->get());

    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->all());

        if ($request->input('fitness_certificate', false)) {
            $vehicle->addMedia(storage_path('tmp/uploads/' . $request->input('fitness_certificate')))->toMediaCollection('fitness_certificate');
        }

        if ($request->input('tex_token_certificate', false)) {
            $vehicle->addMedia(storage_path('tmp/uploads/' . $request->input('tex_token_certificate')))->toMediaCollection('tex_token_certificate');
        }

        if ($request->input('other_documents', false)) {
            $vehicle->addMedia(storage_path('tmp/uploads/' . $request->input('other_documents')))->toMediaCollection('other_documents');
        }

        return (new VehicleResource($vehicle))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Vehicle $vehicle)
    {
        abort_if(Gate::denies('vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehicleResource($vehicle->load(['vehicle_type']));

    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->all());

        if ($request->input('fitness_certificate', false)) {
            if (!$vehicle->fitness_certificate || $request->input('fitness_certificate') !== $vehicle->fitness_certificate->file_name) {
                $vehicle->addMedia(storage_path('tmp/uploads/' . $request->input('fitness_certificate')))->toMediaCollection('fitness_certificate');
            }

        } elseif ($vehicle->fitness_certificate) {
            $vehicle->fitness_certificate->delete();
        }

        if ($request->input('tex_token_certificate', false)) {
            if (!$vehicle->tex_token_certificate || $request->input('tex_token_certificate') !== $vehicle->tex_token_certificate->file_name) {
                $vehicle->addMedia(storage_path('tmp/uploads/' . $request->input('tex_token_certificate')))->toMediaCollection('tex_token_certificate');
            }

        } elseif ($vehicle->tex_token_certificate) {
            $vehicle->tex_token_certificate->delete();
        }

        if ($request->input('other_documents', false)) {
            if (!$vehicle->other_documents || $request->input('other_documents') !== $vehicle->other_documents->file_name) {
                $vehicle->addMedia(storage_path('tmp/uploads/' . $request->input('other_documents')))->toMediaCollection('other_documents');
            }

        } elseif ($vehicle->other_documents) {
            $vehicle->other_documents->delete();
        }

        return (new VehicleResource($vehicle))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Vehicle $vehicle)
    {
        abort_if(Gate::denies('vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}

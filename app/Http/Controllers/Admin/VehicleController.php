<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVehicleRequest;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Vehicle;
use App\VehicleType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VehicleController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicles = Vehicle::all();

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle_types = VehicleType::all()->pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vehicles.create', compact('vehicle_types'));
    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->all());

        foreach ($request->input('fitness_certificate', []) as $file) {
            $vehicle->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('fitness_certificate');
        }

        foreach ($request->input('tex_token_certificate', []) as $file) {
            $vehicle->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('tex_token_certificate');
        }

        foreach ($request->input('other_documents', []) as $file) {
            $vehicle->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('other_documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $vehicle->id]);
        }

        return redirect()->route('admin.vehicles.index');

    }

    public function edit(Vehicle $vehicle)
    {
        abort_if(Gate::denies('vehicle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle_types = VehicleType::all()->pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicle->load('vehicle_type');

        return view('admin.vehicles.edit', compact('vehicle_types', 'vehicle'));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->all());

        if (count($vehicle->fitness_certificate) > 0) {
            foreach ($vehicle->fitness_certificate as $media) {
                if (!in_array($media->file_name, $request->input('fitness_certificate', []))) {
                    $media->delete();
                }

            }

        }

        $media = $vehicle->fitness_certificate->pluck('file_name')->toArray();

        foreach ($request->input('fitness_certificate', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $vehicle->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('fitness_certificate');
            }

        }

        if (count($vehicle->tex_token_certificate) > 0) {
            foreach ($vehicle->tex_token_certificate as $media) {
                if (!in_array($media->file_name, $request->input('tex_token_certificate', []))) {
                    $media->delete();
                }

            }

        }

        $media = $vehicle->tex_token_certificate->pluck('file_name')->toArray();

        foreach ($request->input('tex_token_certificate', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $vehicle->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('tex_token_certificate');
            }

        }

        if (count($vehicle->other_documents) > 0) {
            foreach ($vehicle->other_documents as $media) {
                if (!in_array($media->file_name, $request->input('other_documents', []))) {
                    $media->delete();
                }

            }

        }

        $media = $vehicle->other_documents->pluck('file_name')->toArray();

        foreach ($request->input('other_documents', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $vehicle->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('other_documents');
            }

        }

        return redirect()->route('admin.vehicles.index');

    }

    public function show(Vehicle $vehicle)
    {
        abort_if(Gate::denies('vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle->load('vehicle_type', 'vehicleExpenses', 'ragistrationNumberDriverAllocations', 'vehicleSerialNumberVehicleAllocations');

        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function destroy(Vehicle $vehicle)
    {
        abort_if(Gate::denies('vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle->delete();

        return back();

    }

    public function massDestroy(MassDestroyVehicleRequest $request)
    {
        Vehicle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('vehicle_create') && Gate::denies('vehicle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Vehicle();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}

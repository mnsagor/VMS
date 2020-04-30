<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDriverRequest;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DriversController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('driver_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all();

        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        abort_if(Gate::denies('driver_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.drivers.create');
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->all());

        foreach ($request->input('driving_licence_certificate', []) as $file) {
            $driver->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('driving_licence_certificate');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $driver->id]);
        }

        return redirect()->route('admin.drivers.index');

    }

    public function edit(Driver $driver)
    {
        abort_if(Gate::denies('driver_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->all());

        if (count($driver->driving_licence_certificate) > 0) {
            foreach ($driver->driving_licence_certificate as $media) {
                if (!in_array($media->file_name, $request->input('driving_licence_certificate', []))) {
                    $media->delete();
                }

            }

        }

        $media = $driver->driving_licence_certificate->pluck('file_name')->toArray();

        foreach ($request->input('driving_licence_certificate', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $driver->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('driving_licence_certificate');
            }

        }

        return redirect()->route('admin.drivers.index');

    }

    public function show(Driver $driver)
    {
        abort_if(Gate::denies('driver_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver->load('driverDriverAllocations');

        return view('admin.drivers.show', compact('driver'));
    }

    public function destroy(Driver $driver)
    {
        abort_if(Gate::denies('driver_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver->delete();

        return back();

    }

    public function massDestroy(MassDestroyDriverRequest $request)
    {
        Driver::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('driver_create') && Gate::denies('driver_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Driver();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}

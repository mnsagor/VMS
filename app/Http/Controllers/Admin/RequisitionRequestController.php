<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRequisitionRequestRequest;
use App\Http\Requests\StoreRequisitionRequestRequest;
use App\Http\Requests\UpdateRequisitionRequestRequest;
use App\RequisitionRequest;
use App\VehicleType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RequisitionRequestController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('requisition_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitionRequests = RequisitionRequest::all();

        return view('admin.requisitionRequests.index', compact('requisitionRequests'));
    }

    public function create()
    {
        abort_if(Gate::denies('requisition_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle_types = VehicleType::all()->pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.requisitionRequests.create', compact('vehicle_types'));
    }

    public function store(StoreRequisitionRequestRequest $request)
    {
        $requisitionRequest = RequisitionRequest::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $requisitionRequest->id]);
        }

        return redirect()->route('admin.requisition-requests.index');

    }

    public function edit(RequisitionRequest $requisitionRequest)
    {
        abort_if(Gate::denies('requisition_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle_types = VehicleType::all()->pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $requisitionRequest->load('vehicle_type');

        return view('admin.requisitionRequests.edit', compact('vehicle_types', 'requisitionRequest'));
    }

    public function update(UpdateRequisitionRequestRequest $request, RequisitionRequest $requisitionRequest)
    {
        $requisitionRequest->update($request->all());

        return redirect()->route('admin.requisition-requests.index');

    }

    public function show(RequisitionRequest $requisitionRequest)
    {
        abort_if(Gate::denies('requisition_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitionRequest->load('vehicle_type');

        return view('admin.requisitionRequests.show', compact('requisitionRequest'));
    }

    public function destroy(RequisitionRequest $requisitionRequest)
    {
        abort_if(Gate::denies('requisition_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitionRequest->delete();

        return back();

    }

    public function massDestroy(MassDestroyRequisitionRequestRequest $request)
    {
        RequisitionRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('requisition_request_create') && Gate::denies('requisition_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RequisitionRequest();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}

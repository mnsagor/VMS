<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRequisitionRequestRequest;
use App\Http\Requests\UpdateRequisitionRequestRequest;
use App\Http\Resources\Admin\RequisitionRequestResource;
use App\RequisitionRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequisitionRequestApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('requisition_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequisitionRequestResource(RequisitionRequest::with(['vehicle_type'])->get());

    }

    public function store(StoreRequisitionRequestRequest $request)
    {
        $requisitionRequest = RequisitionRequest::create($request->all());

        return (new RequisitionRequestResource($requisitionRequest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(RequisitionRequest $requisitionRequest)
    {
        abort_if(Gate::denies('requisition_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequisitionRequestResource($requisitionRequest->load(['vehicle_type']));

    }

    public function update(UpdateRequisitionRequestRequest $request, RequisitionRequest $requisitionRequest)
    {
        $requisitionRequest->update($request->all());

        return (new RequisitionRequestResource($requisitionRequest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(RequisitionRequest $requisitionRequest)
    {
        abort_if(Gate::denies('requisition_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitionRequest->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

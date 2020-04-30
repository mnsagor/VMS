<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganogramRequest;
use App\Http\Requests\UpdateOrganogramRequest;
use App\Http\Resources\Admin\OrganogramResource;
use App\Organogram;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganogramApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('organogram_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrganogramResource(Organogram::all());

    }

    public function store(StoreOrganogramRequest $request)
    {
        $organogram = Organogram::create($request->all());

        return (new OrganogramResource($organogram))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Organogram $organogram)
    {
        abort_if(Gate::denies('organogram_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrganogramResource($organogram);

    }

    public function update(UpdateOrganogramRequest $request, Organogram $organogram)
    {
        $organogram->update($request->all());

        return (new OrganogramResource($organogram))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Organogram $organogram)
    {
        abort_if(Gate::denies('organogram_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organogram->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

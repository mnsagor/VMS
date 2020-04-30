<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrganogramRequest;
use App\Http\Requests\StoreOrganogramRequest;
use App\Http\Requests\UpdateOrganogramRequest;
use App\Organogram;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganogramController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('organogram_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organograms = Organogram::all();

        return view('admin.organograms.index', compact('organograms'));
    }

    public function create()
    {
        abort_if(Gate::denies('organogram_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organograms.create');
    }

    public function store(StoreOrganogramRequest $request)
    {
        $organogram = Organogram::create($request->all());

        return redirect()->route('admin.organograms.index');

    }

    public function edit(Organogram $organogram)
    {
        abort_if(Gate::denies('organogram_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organograms.edit', compact('organogram'));
    }

    public function update(UpdateOrganogramRequest $request, Organogram $organogram)
    {
        $organogram->update($request->all());

        return redirect()->route('admin.organograms.index');

    }

    public function show(Organogram $organogram)
    {
        abort_if(Gate::denies('organogram_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organogram->load('organogramVehicleAllocations');

        return view('admin.organograms.show', compact('organogram'));
    }

    public function destroy(Organogram $organogram)
    {
        abort_if(Gate::denies('organogram_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organogram->delete();

        return back();

    }

    public function massDestroy(MassDestroyOrganogramRequest $request)
    {
        Organogram::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

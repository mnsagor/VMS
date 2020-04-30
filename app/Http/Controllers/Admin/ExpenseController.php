<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use App\ExpenseType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Vehicle;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ExpenseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenses = Expense::all();

        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        abort_if(Gate::denies('expense_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expence_catogories = ExpenseType::all()->pluck('catagory_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicles = Vehicle::all()->pluck('vehicle_serial', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.expenses.create', compact('expence_catogories', 'vehicles'));
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $expense->id]);
        }

        return redirect()->route('admin.expenses.index');

    }

    public function edit(Expense $expense)
    {
        abort_if(Gate::denies('expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expence_catogories = ExpenseType::all()->pluck('catagory_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicles = Vehicle::all()->pluck('vehicle_serial', 'id')->prepend(trans('global.pleaseSelect'), '');

        $expense->load('expence_catogory', 'vehicle');

        return view('admin.expenses.edit', compact('expence_catogories', 'vehicles', 'expense'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());

        return redirect()->route('admin.expenses.index');

    }

    public function show(Expense $expense)
    {
        abort_if(Gate::denies('expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->load('expence_catogory', 'vehicle');

        return view('admin.expenses.show', compact('expense'));
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->delete();

        return back();

    }

    public function massDestroy(MassDestroyExpenseRequest $request)
    {
        Expense::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('expense_create') && Gate::denies('expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Expense();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}

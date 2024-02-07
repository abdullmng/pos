<?php

namespace Modules\Branch\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Branch\DataTables\BranchDataTable;
use Modules\Branch\Entities\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(BranchDataTable $dataTable)
    {
        abort_if(Gate::denies('access_branches'), 403);
        return $dataTable->render('branch::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(Gate::denies('create_branches'), 403);
        return view('branch::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('create_branches'), 403);
        $request->validate(
            [
                'name'=> 'required|unique:branches',
                'location' => 'required'
            ]
        );

        Branch::create($request->except('_token'));
        toast('Branch Created!', 'success');
        return redirect()->route('branches.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        abort_if(Gate::denies('show_branches'), 403);
        $branch = Branch::findOrFail($id);
        return view('branch::show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        abort_if(Gate::denies('edit_branches'), 403);
        $branch = Branch::findOrFail($id);
        return view('branch::edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('update_branches'), 403);
        $request->validate(
            [
                'name'=> 'required',
                'location' => 'required'
            ]
        );

        Branch::where('id', $id)->update($request->except('_token', '_method'));
        toast('Branch Updated','success');
        return redirect()->route('branches.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Branch::destroy($id);
        toast('Branch Deleted', 'success');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('Section.sections', compact('sections'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
            $input = $request->all();
            $validatedData = $request->validate([
               'name' => 'required|unique:sections|max:255',
               'description' => 'nullable',
            ]);
            Section::create([
                'name' => $input['name'],
                'description' => $input['description'],
                'created_by' => Auth::user()->name,
            ]);
            session()->flash('add', 'Section created successfully');
            return redirect()->back();
    }

    public function show(Section $section)
    {
        //
    }

    public function edit(Section $section)
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $request->validate([
           'name' => 'required|unique:sections,name,'.$id,
            'description' => 'nullable',
        ]);
        $section = Section::findorfail($id);
        $section->update([
           'name' => $request->get('name'),
           'description' => $request->get('description'),
        ]);
        session()->flash('edit', 'Section updated successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Section::destroy($id);
        session()->flash('delete', 'Section deleted successfully');
        return redirect()->back();
    }
}

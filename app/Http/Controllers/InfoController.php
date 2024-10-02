<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    // User side
    public function userIndex()
    {
        $infos = Info::all();
        return view('info', [
            'infos' => $infos,
        ]);
    }

    // Admin side
    public function index()
    {
        $infos = Info::all();
        return view('admin.infos.index', [
            'infos' => $infos,
            'title' => 'Info',
        ]);
    }

    public function create()
    {
        return view('admin.infos.create', [
            'title' => 'Info',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Info::create($request->all());
        return redirect()->route('admin.infos.index')->with('success', 'Info created successfully.');
    }

    public function edit($id)
    {
        $info = Info::findOrFail($id);
        return view('admin.infos.edit', [
            'info' => $info,
            'title' => 'Info',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $info = Info::findOrFail($id);
        $info->update($request->all());
        return redirect()->route('admin.infos.index')->with('success', 'Info updated successfully.');
    }

    public function destroy($id)
    {
        $info = Info::findOrFail($id);
        $info->delete();
        return redirect()->route('admin.infos.index')->with('success', 'Info deleted successfully.');
    }
}

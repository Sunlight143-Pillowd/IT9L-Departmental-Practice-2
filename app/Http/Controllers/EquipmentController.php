<?php

namespace App\Http\Controllers;

use App\Models\equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = equipment::where('user_id', Auth::id())->latest()->get();
        return view('equipments.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
        'equipment_name'=> 'required|string|max:255',
        'category'=> 'required|string|max:255',
        'unit_price'=> 'required|numeric|min:0',
        'description'=> 'nullable|string',
        'availability_status'=> 'required|in:Available,Unavailable,Maintenance',
      ]);
      
      equipment::create([
        ...$request->validated(),
        'user_id' => Auth::id(),
      ]);
      return redirect()->route('equipments.index')->with('success','Equipment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(equipment $equipment)
    {
        abort_unless($equipment->user_id === Auth::id(), 403);
        return view('equipments.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(equipment $equipment)
    {
        abort_unless($equipment->user_id === Auth::id(), 403);
        return view('equipments.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, equipment $equipment)
    {
        $request->validate([
        'equipment_name'=> 'required|string|max:255',
        'category'=> 'required|string|max:255',
        'unit_price'=> 'required|numeric|min:0',
        'description'=> 'nullable|string',
        'availability_status'=> 'required|in:Available,Unavailable,Maintenance',
      ]);
      
      abort_unless($equipment->user_id === Auth::id(), 403);
      $equipment -> update($request->all());
      return redirect()->route('equipments.index')->with('success','Equipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(equipment $equipment)
    {
        abort_unless($equipment->user_id === Auth::id(), 403);
        $equipment->delete();
        return redirect()->route('equipments.index')->with('success','Equipment deleted successfully.');
    }
}

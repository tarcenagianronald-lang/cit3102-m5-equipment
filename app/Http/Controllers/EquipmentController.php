<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $allowed = ['name', 'category', 'location', 'quantity'];

        $query = Equipment::query();

        foreach ($allowed as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->query($field));
            }
        }

        return response()->json($query->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        $equipment = Equipment::create($data);

        return response()->json($equipment, 201);
    }

    public function show(Equipment $equipment)
    {
        return response()->json($equipment, 200);
    }

    public function update(Request $request, Equipment $equipment)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer|min:0',
        ]);

        $equipment->update($data);

        return response()->json($equipment, 200);
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return response()->noContent();
    }
}
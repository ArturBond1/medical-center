<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Test controller!',
            'status' => 'success'
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'message' => 'From ID: ' . $id,
            'status' => 'success'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        return response()->json([
            'message' => 'Data received successfully',
            'data' => $validated,
            'status' => 'success'
        ], 201);
    }
}

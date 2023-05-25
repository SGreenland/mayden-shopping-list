<?php

namespace App\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use App\Models\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('shoppingList/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if(!auth()->user()) abort(403);

        Log::debug($request->list);


        $request->validate(['list' => 'array']);
        try {
            ShoppingList::create([
                'user_id' => auth()->user()->id,
                'items' => $request->list,
            ]);
            return response()->json('Success', 200);
        }
        catch (Throwable $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingList $shoppingList)
    {
        //
    }
}

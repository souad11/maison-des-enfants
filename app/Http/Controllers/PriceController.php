<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PriceController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Price::class);
        
        $prices = Price::all();
        return view('prices.index', compact('prices'));
    }

    public function create()
    {
        Gate::authorize('create', Price::class);
        
        return view('prices.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Price::class);
        
        $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        Price::create($request->all());

        return redirect()->route('prices.index')->with('success', 'Prix ajouté avec succès.');
    }

    public function show(Price $price)
    {
        Gate::authorize('view', $price);
        
        return view('prices.show', compact('price'));
    }

    public function edit(Price $price)
    {
        Gate::authorize('update', $price);
        
        return view('prices.edit', compact('price'));
    }

    public function update(Request $request, Price $price)
    {
        Gate::authorize('update', $price);
        
        $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        $price->update($request->all());

        return redirect()->route('prices.index')->with('success', 'Prix mis à jour avec succès.');
    }

    public function destroy(Price $price)
    {
        Gate::authorize('delete', $price);
        
        $price->delete();
        return redirect()->route('prices.index')->with('success', 'Prix supprimé avec succès.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::all();
        return view('prices.index', compact('prices'));
    }

    public function create()
    {
        return view('prices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        Price::create($request->all());

        return redirect()->route('prices.index')->with('success', 'Prix ajouté avec succès.');
    }

    public function show(Price $price)
    {
        return view('prices.show', compact('price'));
    }

    public function edit(Price $price)
    {
        return view('prices.edit', compact('price'));
    }

    public function update(Request $request, Price $price)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        $price->update($request->all());

        return redirect()->route('prices.index')->with('success', 'Prix mis à jour avec succès.');
    }

    public function destroy(Price $price)
    {
        $price->delete();
        return redirect()->route('prices.index')->with('success', 'Prix supprimé avec succès.');
    }
}

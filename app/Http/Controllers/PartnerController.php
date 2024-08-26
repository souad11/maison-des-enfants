<?php 

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('partners.index', compact('partners'));
    }

        /**
     * Afficher la liste des partenaires dans la template (partie statique).
     */
    public function template()
    {
        $partners = Partner::all();

        return view('partners.template', [
            'partners' => $partners,
        ]);
    }

    public function showTemplate($id)
    {
        $partner = Partner::findOrFail($id);

        return view('partners.showTemplate', compact('partner'));
    }

    public function create()
    {
        return view('partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'website' => 'nullable|string|max:255',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('partners', 'public');
        }

        Partner::create($validated);

        return redirect()->route('partners.index')->with('success', 'Partenaire créé avec succès.');
    }

    public function show(Partner $partner)
    {
        return view('partners.show', compact('partner'));
    }

    public function edit(Partner $partner)
    {
        return view('partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'website' => 'nullable|string|max:255',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('partners', 'public');
        }

        $partner->update($validated);

        return redirect()->route('partners.index')->with('success', 'Partenaire mis à jour avec succès.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->picture) {
            Storage::disk('public')->delete($partner->picture);
        }

        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partenaire supprimé avec succès.');
    }
}

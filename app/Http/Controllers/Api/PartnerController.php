<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return PartnerResource::collection(Partner::all());
        
    }

    public function show(Partner $partner)
    {
        return new PartnerResource($partner);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'picture' => 'nullable|url'
        ]);

        $partner = Partner::create($validated);
        return new PartnerResource($partner);
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'picture' => 'nullable|url'
        ]);

        $partner->update($validated);
        return new PartnerResource($partner);
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return response()->json(null, 204);
    }
}

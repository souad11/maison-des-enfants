<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityGroup;
use App\Models\Child;
use App\Models\Group;
use App\Models\Payment;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class RegistrationController extends Controller
{
    public function register($activityGroupId)
    {
        $activityGroup = ActivityGroup::with(['activity', 'group'])
            ->findOrFail($activityGroupId);

        // Retrieve children of the logged-in tutor
        $children = Child::where('tutor_id', auth()->user()->tutor->id)->get();

        // Ensure the activity is still valid for registration
        if (Carbon::parse($activityGroup->activity->end_date)->isPast()) {
            return redirect()->back()->with('error', 'Cette activité est déjà terminée.');
        }

        return view('activity_groups.register', compact('activityGroup', 'children'));
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////            INTEGRATION DE STRIPE PAS TOTALEMENT FINIT       //////////////////////////////
    
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'activity_group_id' => 'required|exists:activity_groups,id',
            'child_id' => 'required|exists:children,id',
        ]);

        // Récupérer le groupe d'activité, l'activité et l'enfant
        $activityGroup = ActivityGroup::with('activity', 'group')->findOrFail($validated['activity_group_id']);
        $activity = $activityGroup->activity;
        $group = $activityGroup->group;
        $child = Child::findOrFail($validated['child_id']);

        // Vérifier la disponibilité des places
        if ($activityGroup->available_space <= 0) {
            return redirect()->back()->with('error', 'Aucune place disponible pour cette activité.');
        }

        // Calculer l'âge de l'enfant à partir de sa date de naissance
        $childAge = Carbon::parse($child->birthday)->age;

        // Vérifier si l'âge de l'enfant est approprié pour le groupe
        if ($childAge < $group->min_age || $childAge > $group->max_age) {
            return back()->withErrors(['child_id' => 'L\'âge de l\'enfant ne correspond pas à la tranche d\'âge du groupe sélectionné.']);
        }

        // Créer une inscription
        $registration = Registration::create([
            'activity_group_id' => $validated['activity_group_id'],
            'child_id' => $validated['child_id'],
        ]);

        // Mettre à jour le nombre de places disponibles
        $activityGroup->decrement('available_space');

        // Configurer Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Créer une session de paiement Stripe
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $activity->title,
                    ],
                    'unit_amount' => $activity->price->price * 100, // Le prix en centimes
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['registration_id' => $registration->id]),
            'cancel_url' => route('payment.cancel'),
        ]);

        // Enregistrer le paiement avec un statut 'pending'
        Payment::create([
            'registration_id' => $registration->id,
            'amount' => $activity->price->price,
            'currency' => 'eur',
            'status' => 'pending',
            'stripe_payment_id' => $session->id, // Utiliser l'ID de session Stripe
        ]);

        //dd( $session->id);

        // Rediriger vers Stripe
        return redirect()->away($session->url);
    }

    public function paymentSuccess(Request $request, $registration_id)
    {
        // Récupérer l'inscription
        $registration = Registration::findOrFail($registration_id);

        // Mettre à jour l'inscription pour marquer comme payée
        $registration->update(['status' => 'paid']);

        // Mettre à jour l'enregistrement de paiement
        $payment = Payment::where('registration_id', $registration_id)->first();
        dd($payment);
        if ($payment) {
            $payment->update([
                'status' => 'paid',
                'stripe_payment_id' => $request->get('session_id'), 
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Paiement réussi et inscription confirmée.');
    }

    public function paymentCancel()
    {
        return redirect()->route('dashboard')->with('error', 'Le paiement a été annulé.');
    }
}

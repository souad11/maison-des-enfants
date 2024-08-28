<?php

use App\Http\Controllers\API\ActivityController;
use App\Http\Controllers\Api\PartnerController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;


// Route pour récupérer les informations de l'utilisateur authentifié
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/**
 * Api Partenaires protégée avec sanctum 
 */

Route::middleware('auth:sanctum')->group(function() {
    // GET request pour récupérer tous les partenaires
    Route::get('partners', [PartnerController::class, 'index']);

    // GET request pour récupérer un partenaire spécifique
    Route::get('partners/{partner}', [PartnerController::class, 'show']);

    // POST request pour créer un nouveau partenaire
    Route::post('partners', [PartnerController::class, 'store']);

    // PUT request pour mettre à jour un partenaire existant
    Route::put('partners/{partner}', [PartnerController::class, 'update']);

    // DELETE request pour supprimer un partenaire
    Route::delete('partners/{partner}', [PartnerController::class, 'destroy']);
});




/**
 * Api Activity
 */

// GET request pour récupérer toutes les activités
Route::get('activity', [ActivityController::class, 'index']);

// GET request pour récupérer une activité spécifique
Route::get('activity/{activity}', [ActivityController::class, 'show']);

// POST request pour créer une nouvelle activité
Route::post('activity', [ActivityController::class, 'store']);

// PUT request pour mettre à jour une activité existante
Route::put('activity/{activity}', [ActivityController::class, 'update']);

// DELETE request pour supprimer une activité
Route::delete('activity/{activity}', [ActivityController::class, 'destroy']);



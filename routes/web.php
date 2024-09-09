<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityGroupController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducatorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/dashboard', [EventController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.password.form');
    Route::post('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password.change');

});

Route::resource('activity_groups', ActivityGroupController::class);

Route::get('/activity-group/{id}/participants', [ActivityGroupController::class, 'showParticipants'])->name('activity-groups.participants');

Route::get('/activities/filter', [ActivityController::class, 'filterActivities'])->name('activities.filter');

Route::middleware(['auth'])->group(function () {
    Route::resource('activities', ActivityController::class);
    Route::resource('prices', PriceController::class);
    Route::resource('educators', EducatorController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('feedbacks', FeedbackController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('events', EventController::class);
    Route::resource('opinions', OpinionController::class);



    Route::get('/feedbacks/children/{activity_group_id}', [FeedbackController::class, 'children'])->name('feedbacks.children');



});

Route::get('/partnersTemplate', [PartnerController::class, 'template'])->name('partners.template');
Route::get('/partners/{id}/template', [PartnerController::class, 'showTemplate'])->name('partners.showTemplate');




Route::middleware(['auth'])->group(function () {
    Route::get('/tutors/children/create', [TutorController::class, 'showAddChildForm'])->name('tutors.create_child');
    Route::post('/tutors/children', [TutorController::class, 'storeChild'])->name('tutors.store_child');
    Route::get('/tutors/enfant', [TutorController::class, 'showChildren'])->name('tutor.children');
    Route::delete('/children/{child}', [TutorController::class, 'destroy'])->name('children.destroy');
    //Route::get('/tutor/feedbacks', [TutorController::class, 'showChildrenFeedbacks'])->name('tutor.children_feedbacks');
    
    Route::get('/tutor/feedbacks', [TutorController::class, 'showChildrenFeedbacks'])
    ->name('tutors.children_feedbacks');
    
    Route::get('/tutor/schedules', [TutorController::class, 'showChildrenSchedules'])->name('tutor.children_schedules');
    Route::get('/tutor/registrations', [TutorController::class, 'showChildrenRegistrations'])->name('tutor.children_registrations');

    

});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    // Route pour afficher les avis pour l'admin
    Route::get('/admin/opinions', [OpinionController::class, 'indexAdmin'])->name('opinions.indexAdmin');

   // Route pour approuver une opinion
Route::post('admin/opinions/{opinion}/approve', [OpinionController::class, 'approve'])->name('admin.opinions.approve');

// Route pour rejeter une opinion
Route::post('admin/opinions/{opinion}/reject', [OpinionController::class, 'reject'])->name('admin.opinions.reject');
});


// Route pour afficher le formulaire d'inscription
//Route::get('activities/{id}/register', [RegistrationController::class, 'register'])->name('activities.register');
//Route::post('registrations', [RegistrationController::class, 'store'])->name('registrations.store');


Route::get('activities/{id}/register', [RegistrationController::class, 'register'])->name('activity_group.register');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/payment/success/{registration_id}', [RegistrationController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [RegistrationController::class, 'paymentCancel'])->name('payment.cancel');

Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');



Route::get('/activitiesTemplate', [ActivityGroupController::class, 'templateIndex'])->name('activities.template');
// Route::get('/activity', [ActivityController::class, 'index'])->name('activities.index');

Route::get('/equipe', [EducatorController::class, 'templateIndex'])->name('educators.template');
Route::get('/showEducator', [ActivityGroupController::class, 'showEducator'])->name('activityGroups.showEducator');

// Route::get('/home', function () {
//     return view('home');
// })->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Route pour afficher le formulaire de contact
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

// Route pour soumettre le formulaire de contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/about', function () {
    return view('about');
})->name('about');


// Test Récupéation donné api protégé avec sanctum
Route::get('/partner', function () {
    return view('partner');
});


// Auth routes (en général pour l'enregistrement, la réinitialisation du mot de passe, etc.)
require __DIR__.'/auth.php';

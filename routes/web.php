<?php

use App\Http\Controllers\{
    ActivityController, ActivityGroupController, Auth\AuthenticatedSessionController, ContactController, 
    EducatorController, EventController, FeedbackController, GroupController, HomeController, 
    MessageController, OpinionController, PartnerController, PaymentController, PriceController, 
    ProfileController, RegistrationController, ScheduleController, TutorController
};
use Illuminate\Support\Facades\Route;

// Page d'accueil
// Route::get('/', function () {
//     return view('home');
// });

// Pages statiques (contact, à propos)
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/about', function () {
    return view('about');
})->name('about');

// Routes pour les modèles (template) de partenaires et d'activités
Route::get('/partnersTemplate', [PartnerController::class, 'template'])->name('partners.template');
Route::get('/partners/{id}/template', [PartnerController::class, 'showTemplate'])->name('partners.showTemplate');
Route::get('/activitiesTemplate', [ActivityGroupController::class, 'templateIndex'])->name('activity_groups.template');

// Routes pour les éducateurs (vue équipe) statiques 
Route::get('/equipe', [EducatorController::class, 'templateIndex'])->name('educators.template');

// Dashboard (authentifié)
Route::get('/dashboard', [EventController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Routes pour le profil utilisateur (authentifié)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.password.form');
    Route::post('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password.change');
});


Route::get('/activity_groups/filter', [ActivityGroupController::class, 'filter'])->name('activity_groups.filter');
Route::get('/activities/filter', [ActivityController::class, 'filterActivities'])->name('activities.filter');

// Routes liées aux activités, éducateurs, partenaires, etc.
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
    Route::resource('activity_groups', ActivityGroupController::class);
    Route::get('/feedbacks/children/{activity_group_id}', [FeedbackController::class, 'children'])->name('feedbacks.children');
    Route::get('/showEducator', [ActivityGroupController::class, 'showEducator'])->name('activityGroups.showEducator');
    Route::get('/activity-group/{id}/participants', [ActivityGroupController::class, 'showParticipants'])->name('activity-groups.participants');


});

// Routes liées aux tuteurs et enfants
Route::middleware(['auth'])->group(function () {
    Route::get('/tutors/children/create', [TutorController::class, 'showAddChildForm'])->name('tutors.create_child');
    Route::post('/tutors/children', [TutorController::class, 'storeChild'])->name('tutors.store_child');
    Route::get('/tutors/enfant', [TutorController::class, 'showChildren'])->name('tutor.children');
    Route::delete('/children/{child}', [TutorController::class, 'destroy'])->name('children.destroy');
    Route::get('/tutor/feedbacks', [TutorController::class, 'showChildrenFeedbacks'])->name('tutors.children_feedbacks');
    Route::get('/tutor/schedules', [TutorController::class, 'showChildrenSchedules'])->name('tutor.children_schedules');
    Route::get('/tutor/registrations', [TutorController::class, 'showChildrenRegistrations'])->name('tutor.children_registrations');
    Route::get('/tutors/{id}/edit', [TutorController::class, 'edit'])->name('tutors.edit');
    Route::put('/tutors/{id}', [TutorController::class, 'update'])->name('tutors.update');
    Route::delete('/tutors/{id}', [TutorController::class, 'destroyTutor'])->name('tutors.destroyTutor');
    Route::get('/tutors/admin', [TutorController::class, 'showTutorsWithChildren'])->name('tutors.admin');
});

// Routes pour les avis (opinions) administratifs, les messages et les notifications 
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/opinions', [OpinionController::class, 'indexAdmin'])->name('opinions.indexAdmin');
    Route::post('admin/opinions/{opinion}/approve', [OpinionController::class, 'approve'])->name('admin.opinions.approve');
    Route::post('admin/opinions/{opinion}/reject', [OpinionController::class, 'reject'])->name('admin.opinions.reject');
    Route::get('messages/create', [MessageController::class, 'create'])->name('message.create');
    Route::post('messages/{user}', [MessageController::class, 'store'])->name('message.store');
    Route::get('messages/{user}', [MessageController::class, 'index'])->name('message.index');
    Route::get('messages/conversation/create', [MessageController::class, 'createConversation'])->name('messages.createConversation');
    Route::post('notifications/{id}/mark-as-read', [MessageController::class, 'markAsRead'])->name('notifications.markAsRead');
});

// Routes pour l'inscription et le paiement des activités
Route::middleware(['auth'])->group(function () {
    Route::get('activities/{id}/register', [RegistrationController::class, 'register'])->name('activity_group.register');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
    Route::get('/payment/success/{registration_id}', [RegistrationController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [RegistrationController::class, 'paymentCancel'])->name('payment.cancel');
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
});



// Routes Auth
require __DIR__ . '/auth.php';


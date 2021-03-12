<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('register/failed', 'FailedTransactionController@storeLog')->name('failed.transaction');

//Route::get('thankyou', 'HomeController@showThankyou')->name('thankyou');
//Route::get('failed', 'HomeController@showFailed')->name('failed');

Route::group(['middleware' => 'auth'], function(){
    Route::get('myaccount', 'UserController@showMyAccount')->name('myaccount');
    Route::post('myaccount', 'UserController@updateMyAccount')->name('myaccount.action');
    Route::post('myaccount/change-password', 'UserController@updatePassword')->name('change-password');
    Route::post('myaccount/consent-document', 'Admin\ConsentDocumentController@uploadConsentForm')->name('consent-document.upload');
    Route::post('myaccount/cpr-certificate', 'Admin\CprCertificateController@uploadCprCertificate')->name('cpr-certificate.upload');
    Route::get('dashboard', 'UserController@showDashboard')->name('user.dashboard');

    Route::get('refer', 'ReferralReportController@showRefer')->name('refer');
    Route::post('refer/send', 'ReferralReportController@sendInvite')->name('send.invite');

    Route::get('subscribe/{id}', 'SubscriptionController@showSubscribe')->name('subscribe');
    Route::post('subscribe', 'SubscriptionController@subscribe')->name('subscribe.action');
    Route::get('subscribe', function () {
        return abort(404);
    });

    Route::get('myresources', 'Admin\ResourceController@showResources')->name('user.resources');

    // Only for Security Training Service users
    Route::group(['middleware' => 'check.training:1'], function(){
        Route::get('security-training-chapters', 'TrainingController@showTrainingChapters')->name('training_chapters');
        Route::get('study/{chapter_id}', 'TrainingController@showSlides')->name('show_slides');
        Route::post('study', 'TrainingController@loadSlides')->name('load_slides');
        Route::post('study/update', 'StudyLogController@updateTimer')->name('update_timer');
        Route::post('study/finish', 'StudyLogController@finishStudy')->name('finish_study');

        Route::get('quiz/{id}', 'QuizReportController@index')->name('quiz');
        Route::post('quiz/start', 'QuizReportController@startQuiz')->name('start.quiz');
        Route::post('quiz/load', 'QuizReportController@loadQuestion')->name('load.question');
        Route::post('quiz/finish', 'QuizReportController@finishQuiz')->name('finish.quiz');
        Route::post('quiz/timer', 'QuizReportController@updateQuizTimer')->name('quiz.timer');
        Route::post('quiz/initialize', 'QuizReportController@checkQuizAvaibility')->name('quiz.initialize');
    });

    /**
     * Two same route list for first Aid CPR services
     * 
     * Note: Make sure to make any changes on below both the routes
     */

    // ID 2: Emergency First Aid with CPR Level C and AED Training (1 Day Course)
    //Route::group(['middleware' => 'check.training:2'], function(){
        Route::get('schedule/{id}', 'UserScheduleController@showScheduleForm')->name('schedule');
        Route::post('schedule', 'UserScheduleController@addSchedule')->name('schedule.action');
        Route::post('schedule/contact', 'UserScheduleController@contactAdmin')->name('contact_admin');
    //});

    // ID 3: Recertification- Standard First Aid with CPR Level C and AED (6.5 Hours)
   /*  Route::group(['middleware' => 'check.training:3'], function(){
        Route::get('schedule/{id}', 'UserScheduleController@showScheduleForm')->name('schedule');
        Route::post('schedule', 'UserScheduleController@addSchedule')->name('schedule.action');
        Route::post('schedule/contact', 'UserScheduleController@contactAdmin')->name('contact_admin');
    }); */
    // Throw 404 for unsupported /schedule route
    Route::get('schedule', function () {
        return abort(404);
    });

});


Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('login.action');
    Route::get('password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\AdminResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');
    //Route::get('register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    //Route::post('register', 'Auth\AdminRegisterController@createUser');

    Route::group(['middleware' => 'admin'], function(){
        Route::get('/dashboard', 'AdminController@index')->name('dashboard');
        Route::get('profile', 'AdminController@show')->name('profile');
        Route::get('profile/edit', 'AdminController@edit')->name('profile.edit');
        Route::post('profile/edit', 'AdminController@update')->name('profile.update');

        // Datatable routes
        Route::get('users/load', 'UserController@loadUsers')->name('load.users');
        Route::get('testimonials/load', 'TestimonialController@loadTestimonials')->name('load.testimonials');
        Route::get('clients/load', 'ClientController@loadClients')->name('load.clients');
        Route::get('chapters/{id}/questions/load', 'QuestionController@loadQuestions')->name('load.questions');
        Route::get('referrals/load', 'ReferralController@loadReferrals')->name('load.referrals');
        Route::get('referrals/load/{id}', 'ReferralController@loadReferralUsers')->name('load.referral_users');
        Route::get('consent-documents/load', 'ConsentDocumentController@loadDocuments')->name('load.documents');
        Route::get('cpr-certificates/load', 'CprCertificateController@loadCprCertificates')->name('load.cpr_certificates');
        Route::get('slots/load/{id}', 'ScheduleSlotController@loadSlots')->name('load.slots');
        Route::get('resources/load', 'ResourceController@loadResources')->name('load.resources');
        Route::get('transactions/load_successful', 'TransactionController@loadSuccessfulTransactions')->name('load.successful-transactions');
        Route::get('transactions/load_failed', 'TransactionController@loadFailedTransactions')->name('load.failed-transactions');

        Route::get('slot-services/slots', 'ScheduleSlotController@firstAidServicesList')->name('services.slots'); //list of first aid services
        Route::get('slot-services/{id}/slots', 'ScheduleSlotController@index')->name('slots.index'); // list
        Route::get('slot-services/{id}/slots/create', 'ScheduleSlotController@create')->name('slots.create'); // add form
        Route::POST('slot-services/{id}/slots', 'ScheduleSlotController@store')->name('slots.store'); // Store 
        Route::get('slots/{id}/edit', 'ScheduleSlotController@edit')->name('slots.edit'); // edit form
        Route::PUT('slots/{id}/update', 'ScheduleSlotController@update')->name('slots.update'); //Update 
        Route::get('slots/{id}', 'ScheduleSlotController@show')->name('slots.show'); //Show details
        Route::DELETE('slots/{id}', 'ScheduleSlotController@destroy')->name('slots.destroy'); // Delete slot
        // Delete user's appointment and add user to schedule slot
        Route::DELETE('slots/delete/{id}', 'ScheduleSlotController@deleteAppointment')->name('delete.appointment'); 
        Route::POST('slots/add-user', 'ScheduleSlotController@addUser')->name('schedule.addUser');

        Route::get('chapters/{id}/questions', 'QuestionController@index')->name('questions');
        Route::get('chapters/{id}/questions/create', 'QuestionController@create')->name('questions.create');
        Route::POST('chapters/{id}/questions', 'QuestionController@store')->name('questions.store');
        Route::get('questions/{id}/edit', 'QuestionController@edit')->name('questions.edit');
        Route::PUT('questions/{id}', 'QuestionController@update')->name('questions.update');
        Route::DELETE('questions/{id}', 'QuestionController@destroy')->name('questions.delete');
        Route::PUT('questions/{id}/options', 'QuestionOptionController@store')->name('options.update');

        // Routes for slides
        Route::get('chapters/{id}/slides', 'TutorialSlideController@index')->name('slides.index');
        Route::get('chapters/{id}/slides/create', 'TutorialSlideController@create')->name('slides.create');
        Route::POST('chapters/{id}/slides', 'TutorialSlideController@store')->name('slides.store');
        Route::get('slides/{id}/edit', 'TutorialSlideController@edit')->name('slides.edit');
        Route::PUT('slides/{id}', 'TutorialSlideController@update')->name('slides.update');
        Route::DELETE('slides/{id}', 'TutorialSlideController@destroy')->name('slides.delete');

        // Resource routes
        Route::resource('users', 'UserController');
        Route::resource('services', 'ServiceController');
        Route::resource('chapters', 'TrainingChapterController');
        Route::resource('testimonials', 'TestimonialController');
        Route::resource('home-slides', 'HomeSliderController');
        Route::resource('clients', 'ClientController');
        Route::resource('pages', 'PageController');
        //Route::resource('slots', 'ScheduleSlotController');
        Route::resource('resources', 'ResourceController');


        // Schedule routes
        //Route::get('schedules', 'ScheduleController@index')->name('schedules.index');
        //Route::get('schedules/{id}', 'ScheduleController@show')->name('schedules.show');
        //Route::POST('schedules/approve', 'ScheduleController@approve')->name('schedules.approve');
        //Route::POST('schedules/reschedule', 'ScheduleController@reschedule')->name('schedules.reschedule');

        

        // Referral
        Route::get('referrals', 'ReferralController@index')->name('referrals');
        Route::get('referrals/{id}', 'ReferralController@details')->name('referrals.details');

        //Consent forms
        Route::get('consent-documents', 'ConsentDocumentController@index')->name('consent-documents.index');
        Route::get('consent-documents/{id}', 'ConsentDocumentController@show')->name('consent-documents.show');
        Route::post('consent-documents', 'ConsentDocumentController@updateStatus')->name('consent-documents.update');

        // CPR Certificate
        Route::get('cpr-certificates', 'CprCertificateController@index')->name('cpr-certificates.index');
        Route::get('cpr-certificates/{id}', 'CprCertificateController@show')->name('cpr-certificates.show');

        // Transactions Routes
        Route::get('transactions/successful', 'TransactionController@listSuccessful')->name('successful.transactions');
        Route::get('transactions/successful/{id}', 'TransactionController@showSuccessful')->name('show.successful-transaction');
        Route::get('transactions/failed', 'TransactionController@listFailed')->name('failed.transactions');
        Route::get('transactions/failed/{id}', 'TransactionController@showFailed')->name('show.failed-transaction');

        // Order changing routes
        Route::post('slides/order', 'TutorialSlideController@updateSlideOrder')->name('slides.order');
        Route::post('chapters/order', 'TrainingChapterController@updateChapterOrder')->name('chapters.order');
        Route::post('home-slides/order', 'HomeSliderController@updateSlideOrder')->name('home-slides.order');

        Route::post('editor/images', 'TutorialSlideController@editorImageUpload')->name('image.upload');
        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');

        // General settings
        Route::get('settings', 'AdminController@showSettingForm')->name('settings');
        Route::POST('settings', 'AdminController@saveSettings')->name('settings.update');
    });
});

// Routes for both the login users
Route::group(['middleware' => ['check.login']], function() {
    Route::get('consent-document/download/{filename}', 'Admin\ConsentDocumentController@getDocument')->name('get.document');
    Route::get('cpr-certificate/download/{filename}', 'Admin\CprCertificateController@getDocument')->name('get.cpr_certificate');
    Route::get('resources/files/{filename}', 'Admin\ResourceController@getResource')->name('get.resource');
});

Route::get('{slug}', 'Admin\PageController@loadContent')->name('page');

// Route::get('/post/{slug}', function(){
//     $post = AppPost::where('slug', $slug)->firstOrFail(); 
// });

// File retrival routes
//Route::get('documents/{filename}', 'FileController@getDocument')->where('filename', '^(.+)\/([^\/]+)$');
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/register', function(){
    return redirect()->route('login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'superAdmin','middleware'=>['superAdmin','auth']], function(){
        Route::get('/', 'HomeController@superAdmin')->name('superAdmin');

        Route::resource('/user','UserController');
        Route::get('/user-destroy/{id}','UserController@destroy')->name('deleteUser');
        Route::get('/profile','UserController@adminProfile')->name('admin-profile');
        Route::put('/profile/{id}','UserController@UpdateAdmin')->name('admin-update');

        Route::resource('/users_info','UsersInfoController');
        Route::get('/user_info_delete/{id}','UsersInfoController@destroy')->name('user_info_delete');
        
        
        Route::resource('/visitors_log','VisitorsLogController');
        Route::get('/view-all-log/{id}','VisitorsLogController@viewAllLog')->name('viewAllLog');

        Route::get('/visitors_log_delete/{id}','VisitorsLogController@destroy')->name('visitors_logDelete');

        Route::resource('/visitors_note','VisitorsNoteController');
        Route::get('/add_notes/{id}','VisitorsNoteController@addNotes')->name('addNotes');
        Route::post('/save_notes/{id}','VisitorsNoteController@saveNotes')->name('saveNotes');

        Route::get('/visitors_note_delete/{id}','VisitorsNoteController@destroy')->name('visitors_noteDelete');
});

Route::group(['prefix'=>'admin','middleware'=>['admin','auth']], function(){
    Route::get('/', 'HomeController@admin')->name('admin');

    Route::get('/user_index','UserController@user_index')->name('user_index');
    Route::get('/user_create','UserController@user_create')->name('user_create');
    Route::post('/user_store','UserController@user_store')->name('user_store');
    Route::get('/user_edit/{id}','UserController@user_edit')->name('user_edit');
    Route::put('/user_update/{id}','UserController@user_update')->name('user_update');

    Route::get('/profile_admin','UserController@adminProfileEdit')->name('adminProfileEdit');
    Route::put('/profile_admin/{id}','UserController@UpdateAdminUpdate')->name('UpdateAdminUpdate');



    Route::get('/users_info','UsersInfoController@userInfoIndex')->name('userInfoIndex');
    Route::get('/users_info_create','UsersInfoController@usersInfoCreate')->name('usersInfoCreate');
    Route::post('/users_info_store','UsersInfoController@usersInfoStore')->name('usersInfoStore');
    Route::get('/users_info_edit/{id}','UsersInfoController@usersInfoEdit')->name('usersInfoEdit');
    Route::put('/users_info_update/{id}','UsersInfoController@usersInfoUpdate')->name('usersInfoUpdate');



    Route::get('/admin_visitors_log','VisitorsLogController@visitorsLogIndex')->name('visitorsLogIndex');
    Route::get('/visitors_log_create','VisitorsLogController@visitorsLogCreate')->name('visitorsLogCreate');
    Route::post('/visitors_log_store','VisitorsLogController@visitorsLogStore')->name('visitorsLogStore');
    Route::get('/visitors_log_edit/{id}','VisitorsLogController@visitorsLogEdit')->name('visitorsLogEdit');
    Route::put('/visitors_log_update/{id}','VisitorsLogController@visitorsLogUpdate')->name('visitorsLogUpdate');

    Route::get('/view-all-log_admin/{id}','VisitorsLogController@viewAllLogAdmin')->name('viewAllLogAdmin');


    
    Route::get('/add_notes_admin/{id}','VisitorsNoteController@addNotesAdmin')->name('addNotesAdmin');
    Route::post('/save_notes_admin/{id}','VisitorsNoteController@saveNotesAdmin')->name('saveNotesAdmin');


    Route::get('/admin_visitors_notes','VisitorsNoteController@visitorsNotesIndex')->name('visitorsNotesIndex');
    Route::get('/visitors_notes_create','VisitorsNoteController@visitorsNotesCreate')->name('visitorsNotesCreate');
    Route::post('/visitors_notes_store','VisitorsNoteController@visitorsNotesStore')->name('visitorsNotesStore');
    Route::get('/visitors_notes_edit/{id}','VisitorsNoteController@visitorsNotesEdit')->name('visitorsNotesEdit');
    Route::put('/visitors_notes_update/{id}','VisitorsNoteController@visitorsNotesUpdate')->name('visitorsNotesUpdate');

    
    
});


Route::group(['prefix'=>'student','middleware'=>['student','auth']], function(){
    Route::get('/', 'HomeController@student')->name('student');
});


Route::group(['prefix'=>'visitor','middleware'=>['visitor','auth']], function(){
    Route::get('/', 'HomeController@visitor')->name('visitor');
});

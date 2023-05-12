<?php

Route::middleware(['auth'])->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {

            //home
            Route::get('/home', 'HomeController@index')->name('home');

      
            //admin routes
            Route::get('/admins/data', 'AdminController@data')->name('admins.data');
            Route::delete('/admins/bulk_delete', 'AdminController@bulkDelete')->name('admins.bulk_delete');
            Route::resource('admins', 'AdminController');

            //client routes
            Route::get('/clients/data', 'ClientController@data')->name('clients.data');
            Route::delete('/clients/bulk_delete', 'ClientController@bulkDelete')->name('clients.bulk_delete');
            Route::resource('clients', 'ClientController');

            //project routes
            Route::get('/projects/data', 'ProjectController@data')->name('projects.data');
            Route::delete('/projects/bulk_delete', 'ProjectController@bulkDelete')->name('projects.bulk_delete');
            Route::resource('projects', 'ProjectController');

            //task routes
            Route::get('/tasks/data', 'TaskController@data')->name('tasks.data');
            Route::delete('/tasks/bulk_delete', 'TaskController@bulkDelete')->name('tasks.bulk_delete');
            Route::resource('tasks', 'TaskController');



        });

    });

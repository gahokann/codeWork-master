<?php

use App\Http\Controllers\Task\Message\StoreController;
use Illuminate\Support\Facades\Route;

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
    if (auth()->check()) {
        return redirect()->route('course.index');
    } else
        return view('welcome');
});

Auth::routes();
// Courses

Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'App\Http\Controllers\Course'], function () {
        Route::get('/courses', 'IndexController')->name('course.index');
        Route::get('/courses/create', 'CreateController')->name('course.create');
        Route::get('/course/{unique}', 'JoinController')->name('course.join');
        Route::post('/courses', 'StoreController')->name('course.store');

        //Для участника курса
        Route::group(['middleware' => 'participant'], function () {
            Route::get('/courses/{course}', 'ShowController')->name('course.show');
            Route::delete('/courses/{course}/leave', 'LeaveController')->name('course.leave');

            Route::group(['namespace' => 'User'], function () {
                Route::get('/courses/{course}/users', 'IndexController')->name('course.user.index');
            });
        });

        //Для создателя курса
        Route::group(['middleware' => 'leaderCourse'], function () {
            Route::group(['namespace' => 'Grade'], function () {
                Route::get('/courses/{course}/grades', 'IndexController')->name('course.grade.index');
            });

            Route::group(['namespace' => 'Setting'], function () {
                Route::get('/courses/{course}/settings', 'IndexController')->name('course.setting.index');

                Route::group(['namespace' => 'Connection'], function () {
                    Route::get('settings/{course}/connection', 'IndexController')->name('course.setting.connection.index');
                    Route::patch('settings/{course}/connection', 'UpdateController')->name('course.setting.connection.update');
                    Route::post('settings/{course}/connection', 'StoreController')->name('course.setting.connection.store');
                    Route::delete('settings/{course}/connection/user/{user}', 'DestroyController')->name('course.setting.connection.destroy');
                });

                Route::group(['namespace' => 'Task'], function () {
                    Route::get('/courses/{course}/settings/tasks', 'IndexController')->name('course.setting.task.index');
                    Route::get('/courses/{course}/settings/tasks/{task}', 'ShowController')->name('course.setting.task.show');
                });
            });

            Route::patch('courses/{course}', 'UpdateController')->name('course.update');
            Route::delete('courses/{course}', 'DestroyController')->name('course.destroy');
        });
    });

    // Tasks
    Route::group(['namespace' => 'App\Http\Controllers\Task'], function () {
        // Для участника курса
        Route::group(['middleware' => 'participant'], function () {
            Route::get('/courses/{course}/tasks/{task}', 'ShowController')->name('task.show');
            Route::post('/courses/{course}/tasks', 'StoreController')->name('task.store');

            Route::group(['namespace' => 'File'], function () {
                Route::group(['middleware' => 'option'], function () {
                    Route::get('/courses/{course}/tasks/{task}/files/{file}', 'ShowController')->name('task.file.show');
                    Route::delete('/courses/{course}/tasks/{task}/files/{file}', 'DestroyController')->name('task.file.destroy');
                    Route::get('/courses/{course}/tasks/{task}/files/{file}/download', 'DownloadController')->name('task.file.download');
                });

                Route::group(['namespace' => 'Message'], function () {
                    Route::post('/courses/{course}/tasks/{task}/files/{file}', 'StoreController')->name('task.file.message.store');
                });

                Route::group(['namespace' => 'Review'], function () {
                    Route::post('/courses/{course}/tasks/{task}/files/{file}/reviews', 'StoreController')->name('task.file.review.store');
                    Route::patch('/courses/{course}/tasks/{task}/files/{file}/reviews/{review}', 'UpdateController')->name('task.file.review.update');
                });

                Route::post('/courses/{course}/tasks/{task}', 'StoreController')->name('task.file.store');
            });

            Route::group(['namespace' => 'Completed'], function () {
                Route::patch('/courses/{course}/tasks/{task}/completed/{completed}', 'UpdateController')->name('task.completed.update');
            });
        });

        //Просмотр для создателя курса и определенного участника
        Route::group(['middleware' => 'isUser'], function () {
            Route::group(['namespace' => 'User'], function () {
                Route::get('/courses/{course}/user/{user}', 'IndexController')->name('task.user.index');
                Route::get('/courses/{course}/tasks/{task}/user/{user}', 'ShowController')->name('task.user.show');
            });
        });

        //Для создателя курса
        Route::group(['middleware' => 'leaderCourse'], function () {
            Route::patch('/courses/{course}/tasks', 'UpdateController')->name('task.updateSimplified');
            Route::patch('/courses/{course}/tasks/{task}', 'UpdateController')->name('task.update');
            Route::patch('/courses/{course}/tasks/{task}/user/{user}/return', 'ReturnController')->name('task.return');

            Route::delete('/courses/{course}/tasks', 'DestroyController')->name('task.destroySimplified');
            Route::delete('/courses/{course}/tasks/{task}', 'DestroyController')->name('task.destroy');
        });
    });


    // Profile
    Route::group(['namespace' => 'App\Http\Controllers\Profile', 'middleware' => 'profileUser'], function () {
        Route::get('/profile/{user}', 'IndexController')->name('profile.index');
        Route::post('/profile/{user}/uploadPhoto', 'UploadPhotoController')->name('profile.uploadPhoto');
        Route::delete('/profile/{user}/destroyPhoto', 'DestroyPhotoController')->name('profile.destroyPhoto');
        Route::put('/profile/{user}', 'UpdateController')->name('profile.update');
    });


    // Admin
    Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'admin'], function () {
        Route::get('/admin', 'IndexController')->name('admin.index');
    });
});


Route::patch('/courses/{course}/tasks/{task}/message', StoreController::class)->name('task.message.store');

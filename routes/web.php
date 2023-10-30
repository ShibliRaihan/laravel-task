<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $tasks = Task::all();
    return view('task', ['tasks'=>$tasks]);
});

Route::get('/single/task/{id}', function ($id) {
    // $task = Task::findOrFail(1);

    // if (!$task) {
    //     return abort(404); 
    // }

    // return view('singel-task', ['task' => $task]);
    $task = Task::findOrFail($id);
    return view('singel-task',['task' => $task]) ;

})->name('singel.task');
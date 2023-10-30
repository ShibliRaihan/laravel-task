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
    $tasks = Task::latest()->where('completed', true)->get();
    $tasksFalse = Task::latest()->where('completed', false)->get();
    return view('task', ['tasks' => $tasks, 'tasksFalse' => $tasksFalse]);
});
Route::get('/create-task', function () {
    return view('create-task');
})->name('create.task');
Route::post('/create-task', function () {
dd($_POST);
})->name('create');
Route::get('/single/task/{id}', function ($id) {
    $task = Task::findOrFail($id);
    return view('singel-task', ['task' => $task]);
})->name('singel.task');
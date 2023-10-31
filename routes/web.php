<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
// use Illuminate\Http\Request;


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
#show all...
Route::get('/', function () {
    $tasks = Task::latest()
        ->where('completed', true)
        ->get();
    $tasksFalse = Task::latest()
        ->where('completed', false)
        ->get();
    return view('task', ['tasks' => $tasks, 'tasksFalse' => $tasksFalse]);
});
#show one...
Route::get('/single/task/{id}', function ($id) {
    $task = Task::findOrFail($id);
    return view('singel-task', ['task' => $task]);
})->name('singel.task');
#create form...
Route::get('/create-task', function () {
    return view('create-task');
})->name('create.task');
#create request...
Route::post('/create-tasks', function (TaskRequest $request) {
    Task::create($request->validated());
    return redirect('/');
})->name('create');
#task edite
Route::get('/edite/task/{task}', function (Task $task) {
    return view('edite-task', ['task' => $task]);
})->name('edite.task');
#task edite put
Route::put('/edit-task/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect('/');
})->name('put');

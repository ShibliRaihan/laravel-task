<?php

use App\Http\Requests\Task_Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;

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
Route::post('/create-task', function (Task_Request $request) {
    $task = new Task();
    $task = $request->validated();
    $task->title = $request['title'];
    $task->description = $request['description'];
    $task->long_description = $request['long_description'];
    $task->completed = true;
    $task->save();
    return redirect('/');
})->name('create');
#task edite
Route::get('/edite/task/{task}', function (task $task) {
    return view('edite-task', ['task' => $task]);
})->name('edite.task');
#task edite put
Route::put('/edit-task/{task}', function (Task $task, Task_Request $request) {
    $task = $request->validated();
    $task->title = $request['title'];
    $task->description = $request['description'];
    $task->long_description = $request['long_description'];
    $task->completed = true;
    $task->save();
    return redirect('/');
})->name('put');

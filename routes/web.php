<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;

Route::get("/", function () {
    return redirect()->route('task.index');
})->name("home");



Route::get('/tasks', function ()  {
    return view('index',["tasks" => Task::latest()->paginate()]);
})->name("task.index");



Route::view("/tasks/create", "create")
->name("tasks.create");



Route::get('/tasks/{task}/edit', function (Task $task)  {
    return view('edit',[
        'task'=> $task,
    ]);
})->name("task.edit");



Route::get('/tasks/{task}', function (Task $task)  {
    return view('task',[
        'task'=> $task]);
})->name("task.show");




Route::post("/tasks", function (TaskRequest $request) {

    $task = Task::create($request->validated());

    return redirect()->route("task.show", ["task" => $task])
        ->with("success","Task created succesfully");
})->name("task.store");


Route::put("/tasks/{task}", function (Task $task, TaskRequest $request) {


    $task->update(($request->validated()));

    return redirect()->route("task.show", ["task" => $task])
        ->with("success","Task created succesfully");
})->name("task.update");

Route::delete("/tasks/{task}", function(Task $task){
    $task->delete();
    return redirect()->route("task.index")
        ->with("success","Task deleted successfully");
})->name("task.destroy");


Route::put("/tasks/{task}/toggle-complete", function(Task $task){
    $task->completed = !$task->completed;
    $task->save();

    return redirect()->back()->with("success", "Task updated successfully");
})->name("tasks.toggle-complete");

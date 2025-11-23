<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;

Route::get("/", function () {
    return redirect()->route('task.index');
})->name("home");



Route::get('/tasks', function ()  {
    return view('index',["tasks" => Task::latest()->get()]);
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

    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data["title"];
    // $task->description = $data["description"];
    // $task->long_description = $data["long_description"];

    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route("task.show", ["task" => $task->id])
        ->with("success","Task created succesfully");
})->name("task.store");


Route::put("/tasks/{task}", function (Task $task, TaskRequest $request) {

    // $data = $request->validated();
    // $task->title = $data["title"];
    // $task->description = $data["description"];
    // $task->long_description = $data["long_description"];
    // $task->save();

    $task->update(($request->validated()));

    return redirect()->route("task.show", [$task => $task->id])
        ->with("success","Task created succesfully");
})->name("task.update");

// Route::get("/hello/{name}", function($name){
//     return "hello " . $name . "!";
// });


// Route::get("/hallo", function(){
//     return redirect("/hello");
// });


// Route::get("/hillo", function(){
//     return redirect()->route("hello");
// });


// Route::fallback(function () {
//     return "Opps sorry";
// });

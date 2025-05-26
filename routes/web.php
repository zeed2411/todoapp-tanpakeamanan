<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;
use Illuminate\Support\Facades\Route;




Route::get("login", [AuthManager::class,"login"])
        ->name("login");
        
Route::post("login", [AuthManager::class,"loginPost"])
                ->name("login.post");

Route::get("logout", [AuthManager::class,"logout"])
        ->name("logout");

Route::get("register", [AuthManager::class,"register"])
        ->name("register");

Route::post("register", [AuthManager::class,"registerPost"])
        ->name("register.post");

Route::middleware("auth")->group(function (){

    Route::get('/', [TaskManager::class, "listTask"])->name('home');

    Route::get("task/add", [TaskManager::class,"addTask"])->name("task.add");

    Route::post("task/add", [TaskManager::class,"addTaskPost"])->name("task.add.post");
    
    Route::get("task/status/{id}", [TaskManager::class,"updateTaskStatus"])->name("task.status.update");

    Route::get("task/delete/{id}", [TaskManager::class,"deleteTask"])->name("task.delete");
});
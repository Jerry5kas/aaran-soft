<?php

use Illuminate\Support\Facades\Route;

//testing
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/base', App\Livewire\Testing\TestingModule\Base::class)->name('base');
    Route::get('/base/{id}/sub', App\Livewire\Testing\TestingModule\Sub::class)->name('base.sub');
    Route::get('/sub/{id}/test_case', App\Livewire\Testing\TestingModule\TestCases::class)->name('sub.test-case');

    Route::get('/module', App\Livewire\Testing\SystemTesting\ModuleSys::class)->name('module');
    Route::get('/module/{id}/model', App\Livewire\Testing\SystemTesting\ModelSys::class)->name('module.model');
    Route::get('/model/{id}/db', App\Livewire\Testing\SystemTesting\DatabaseSys::class)->name('model.db');
    Route::get('/db/{id}/admin', App\Livewire\Testing\SystemTesting\AdminSys::class)->name('db.admin');
    Route::get('/admin/{id}/livewire_class', App\Livewire\Testing\SystemTesting\ClassSys::class)->name('admin.livewire-class');
    Route::get('/livewire_class/{id}/livewire_blade', App\Livewire\Testing\SystemTesting\BladeSys::class)->name('livewire-class.livewire-blade');
    Route::get('/livewire_blade/{id}/menu', App\Livewire\Testing\SystemTesting\MenuSys::class)->name('livewire-blade.menu');
});

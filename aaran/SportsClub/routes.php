<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('sportsClub', \App\Livewire\Sports\Club::class)->name('sportsClub');
    Route::get('sportsClub/masters', App\Livewire\Sports\Master::class)->name('sportsClub.masters');

});

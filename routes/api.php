<?php

use App\Actions\App\StatusAction;
use Illuminate\Support\Facades\Route;

Route::get('/status', StatusAction::class);

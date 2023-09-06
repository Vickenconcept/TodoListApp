<?php

use App\Models\User;

function user() : User {
    return auth()->user();
}

function access_token() : string {
    return session()->get('access_token');
}
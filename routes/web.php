<?php

use App\Filament\Pages\Auth\Login;
use Illuminate\Support\Facades\Route;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;


Route::get('/authorize', function(){
  
  	// dd(session()->all());
    $role_id = Session::get("role_id"); 
    $user_id = Session::get("user_id");

    // Check if role_id and user_id are correctly retrieved
    if (!$role_id || !$user_id) {
        abort(500, 'Role ID or User ID not found in session.');
    }
    
    $url = 'https://faculty.plmerp24.cloud/?role_id=' . urlencode($role_id) . '&user_id=' . urlencode($user_id);
    return redirect($url);
});

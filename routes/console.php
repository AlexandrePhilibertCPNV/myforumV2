<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/**
 * Promote a user to admin role
 */
Artisan::command('make:adminuser ${id}', function ($id) {
    $user = User::find($id);

    if (!isset($user)) {
        $this->info("L'utilisateur $id n'existe pas");
        return;
    }

    $admin_role = Role::where('slug', 'ADMI')->first();

    if (!isset($admin_role)) {
        $this->info("Le role d'administrateur n'existe pas dans la base de donnée");
        return;
    }

    $user->role_id = $admin_role->id;
    $user->save();

    $this->info("$user->pseudo est admin");
})->purpose('Grants the admin role to as user');
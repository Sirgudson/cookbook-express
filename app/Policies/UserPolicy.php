<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    //Can view and edit users
    public function viewUsers(User $user)
    {
        return $user->role->name === 'admin' || $user->role->name === 'hr';
    }

    public function viewRoles(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function manageRestaurants(User $user) {
        return $user->role->name === 'admin' || $user->role->name === 'hr';
    }

    public function manageCategories(User $user) {
        return $user->role->name === 'admin' || $user->role->name === 'chef';
    }

    public function manageMeasures(User $user) {
        return $user->role->name === 'admin' || $user->role->name === 'chef';
    }

    public function manageIngredients(User $user)
    {
        return $user->role->name === 'admin' || $user->role->name === 'chef';
    }

    public function manageRecipes(User $user)
    {
        return $user->role->name === 'admin'|| $user->role->name === 'chef';
    }

    public function manageBooks(User $user)
    {
        return $user->role->name === 'admin' || $user->role->name === 'publisher';
    }
}

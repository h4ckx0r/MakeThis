<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    /**
     * Get the redirect route based on user role.
     */
    public function getAccountRoute(): string
    {
        if (!Auth::check()) {
            return route('auth.login');
        }

        $user = Auth::user();

        // Assuming isAdmin is a boolean on the users table
        if ($user->isAdmin) {
            return route('admin.reports');
        }

        return route('client.requests');
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
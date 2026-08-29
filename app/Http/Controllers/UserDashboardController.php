<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use App\Models\Mountain;

class UserDashboardController extends Controller 
{ 
    public function __invoke()
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $user = auth()->user();

        $rentals = $user->rentals()
            ->with('rentalItems.gear')
            ->latest()
            ->take(5)
            ->get();

        $mountains = Mountain::orderBy('name')->take(3)->get();
        $availableGear = Gear::where('stock', '>', 0)->with('category')->take(3)->get();

        return view('dashboard', compact('user', 'rentals', 'mountains', 'availableGear'));
    } 
}

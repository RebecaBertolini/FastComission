<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the seller's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'seller' => $request->seller(),
        ]);
    }

    /**
     * Update the seller's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->seller()->fill($request->validated());

        if ($request->seller()->isDirty('email')) {
            $request->seller()->email_verified_at = null;
        }

        $request->seller()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the seller's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('sellerDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $seller = $request->seller();

        Auth::logout();

        $seller->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

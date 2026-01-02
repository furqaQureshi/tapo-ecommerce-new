<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserOnboarding;

class OnboardingController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $onboarding = $user->onboarding ?? $user->onboarding()->create(['user_id' => $user->id]);
        // return $onboarding;
        return view('front.onboarding', compact('onboarding'));
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        // $descriptions = $request->input('descriptions', []);
        // $preferences = $request->input('preferences', []);

        $request->validate([
            'descriptions' => 'required|array|min:1',
            'preferences' => 'required|array|min:1',
        ]);

        $descriptions = array_map('strtolower', $request->input('descriptions', []));
        $preferences  = array_map('strtolower', $request->input('preferences', []));

        // ✅ Create or fetch onboarding record
        $onboarding = $user->onboarding()->firstOrCreate(
            ['user_id' => $user->id],
            [
                'descriptions' => json_encode($descriptions),
                'preferences'  => json_encode($preferences),
            ]
        );

        // ✅ Update onboarding
        $onboarding->update([
            'descriptions' => json_encode($descriptions),
            'preferences'  => json_encode($preferences),
        ]);

        $user = auth()->user();
        $user->completed_profile = 1;
        $user->update();
        $message = $onboarding->wasRecentlyCreated ? 'Onboarding completed!' : 'Onboarding updated!';
        return redirect()->route('myaccount')->with('success', $message);
    }
}

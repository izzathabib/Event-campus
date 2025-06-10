<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewUserTemporaryPassword;
use App\Models\Advisor;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Auth\Events\Verified;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('login'));
    }

    public function add_society_advisor_view(): View
    {
        return view('society.add_society_advisor');
    }

    public function add_society_advisor(Request $request): RedirectResponse
    {
        $tempPassword = Str::random(10);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $user = User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
            'admin_verified' => true,
        ]);
        $user->markEmailAsVerified();

        // Save in advisor table
        // To map each advisor to specific society
        $advisor = Advisor::create([
            'user_id' => $request->user()->id,
            'society_advisor_id' => $user->id,
        ]);
        
        try {
            Mail::to($user->email)->send(new NewUserTemporaryPassword($user, $tempPassword));
        } catch (\Exception $e) {
            // Optionally log or handle the error
            return redirect()->back()->with('error', 'Advisor added, but failed to send email.');
        }

        return redirect()->route('society.dashboard')->with('success_add_advisor', 'Advisor added and credentials sent to their email.');    
    }
}

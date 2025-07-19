<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class ProfilePasswordController extends Controller
{
    /**
     * Update the user's password from profile page.
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'confirmed', Password::defaults()],
            ], [
                'current_password.current_password' => 'La password attuale non è corretta.',
                'password.required' => 'Il campo nuova password è obbligatorio.',
                'password.confirmed' => 'La conferma della password non corrisponde.',
                'password.min' => 'La password deve contenere almeno :min caratteri.',
                'password.letters' => 'La password deve contenere almeno una lettera.',
                'password.mixed_case' => 'La password deve contenere almeno una lettera maiuscola e una minuscola.',
                'password.numbers' => 'La password deve contenere almeno un numero.',
                'password.symbols' => 'La password deve contenere almeno un simbolo.',
                'password.uncompromised' => 'La password scelta è apparsa in una violazione di dati. Scegli una password diversa.',
            ]);

            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            return back()->with('success', 'Password aggiornata con successo!');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->with('error', 'Errore nell\'aggiornamento della password. Controlla i campi e riprova.');
        }
    }
}

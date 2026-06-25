<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Checkin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CheckinController extends Controller
{
    public function show(Apartment $apartment): View
    {
        return view('checkin.form', ['apartment' => $apartment]);
    }

    public function store(Request $request, Apartment $apartment): RedirectResponse
    {
        $validated = $request->validate([
            'contact_first_name' => ['required', 'string', 'max:100'],
            'contact_last_name' => ['required', 'string', 'max:100'],
            'contact_email' => ['required', 'email', 'max:150'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:8'],
            'guests' => ['required', 'array', 'min:1', 'max:8'],
            'guests.*.first_name' => ['required', 'string', 'max:100'],
            'guests.*.last_name' => ['required', 'string', 'max:100'],
            'guests.*.birth_date' => ['required', 'date', 'before:today'],
            'wants_invoice' => ['sometimes', 'boolean'],
            'billing_name' => [Rule::requiredIf((bool) $request->boolean('wants_invoice')), 'nullable', 'string', 'max:200'],
            'billing_address' => [Rule::requiredIf((bool) $request->boolean('wants_invoice')), 'nullable', 'string', 'max:300'],
            'company_id' => [Rule::requiredIf((bool) $request->boolean('wants_invoice')), 'nullable', 'string', 'max:50'],
            'tax_id' => [Rule::requiredIf((bool) $request->boolean('wants_invoice')), 'nullable', 'string', 'max:50'],
            'vat_id' => ['nullable', 'string', 'max:50'],
            'consent' => ['required', 'accepted'],
        ]);

        $checkin = $apartment->checkins()->create([
            'contact_first_name' => $validated['contact_first_name'],
            'contact_last_name' => $validated['contact_last_name'],
            'contact_email' => $validated['contact_email'],
            'contact_phone' => $validated['contact_phone'],
            'guest_count' => $validated['guest_count'],
            'wants_invoice' => $request->boolean('wants_invoice'),
            'billing_name' => $validated['billing_name'] ?? null,
            'billing_address' => $validated['billing_address'] ?? null,
            'company_id' => $validated['company_id'] ?? null,
            'tax_id' => $validated['tax_id'] ?? null,
            'vat_id' => $validated['vat_id'] ?? null,
            'consent' => true,
        ]);

        foreach ($validated['guests'] as $guest) {
            $checkin->guests()->create([
                'first_name' => $guest['first_name'],
                'last_name' => $guest['last_name'],
                'birth_date' => $guest['birth_date'],
            ]);
        }

        return redirect()->route('checkin.thankyou', ['checkin' => $checkin->id])
            ->with('success', 'Online check-in bol úspešne dokončený.');
    }

    public function thankyou(Checkin $checkin): View
    {
        $checkin->load(['apartment', 'guests']);

        return view('checkin.thankyou', ['checkin' => $checkin]);
    }
}
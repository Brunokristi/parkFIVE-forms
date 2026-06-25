<?php

namespace App\Http\Controllers;

use App\Mail\CheckinConfirmationMail;
use App\Mail\CheckinNotificationMail;
use App\Models\Apartment;
use App\Models\Checkin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            'contact_email' => ['required', 'email', 'max:150'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:8'],

            'guests' => ['required', 'array', 'min:1', 'max:8'],
            'guests.*.first_name' => ['required', 'string', 'max:100'],
            'guests.*.last_name' => ['required', 'string', 'max:100'],
            'guests.*.birth_date' => ['required', 'date', 'before:today'],

            'wants_invoice' => ['sometimes', 'boolean'],
            'billing_name' => [
                Rule::requiredIf((bool) $request->boolean('wants_invoice')),
                'nullable',
                'string',
                'max:200',
            ],
            'billing_address' => [
                Rule::requiredIf((bool) $request->boolean('wants_invoice')),
                'nullable',
                'string',
                'max:300',
            ],
            'company_id' => [
                Rule::requiredIf((bool) $request->boolean('wants_invoice')),
                'nullable',
                'string',
                'max:50',
            ],
            'tax_id' => [
                Rule::requiredIf((bool) $request->boolean('wants_invoice')),
                'nullable',
                'string',
                'max:50',
            ],
            'vat_id' => ['nullable', 'string', 'max:50'],

            'consent' => ['required', 'accepted'],
        ], [
            'contact_email.required' => 'Vyplňte e-mail.',
            'contact_email.email' => 'Zadajte platný e-mail.',
            'contact_email.max' => 'E-mail môže mať maximálne 150 znakov.',

            'contact_phone.required' => 'Vyplňte telefónne číslo.',
            'contact_phone.max' => 'Telefónne číslo môže mať maximálne 50 znakov.',

            'guest_count.required' => 'Vyberte počet hostí.',
            'guest_count.integer' => 'Počet hostí musí byť číslo.',
            'guest_count.min' => 'Musí byť vyplnený aspoň jeden hosť.',
            'guest_count.max' => 'Maximálny počet hostí je 8.',

            'guests.required' => 'Vyplňte údaje hostí.',
            'guests.array' => 'Údaje hostí nie sú vyplnené správne.',
            'guests.min' => 'Musí byť vyplnený aspoň jeden hosť.',
            'guests.max' => 'Maximálny počet hostí je 8.',

            'guests.*.first_name.required' => 'Vyplňte meno hosťa.',
            'guests.*.first_name.max' => 'Meno môže mať maximálne 100 znakov.',

            'guests.*.last_name.required' => 'Vyplňte priezvisko hosťa.',
            'guests.*.last_name.max' => 'Priezvisko môže mať maximálne 100 znakov.',

            'guests.*.birth_date.required' => 'Vyplňte dátum narodenia hosťa.',
            'guests.*.birth_date.date' => 'Zadajte platný dátum narodenia.',
            'guests.*.birth_date.before' => 'Dátum narodenia musí byť v minulosti.',

            'billing_name.required' => 'Vyplňte fakturačné meno alebo názov firmy.',
            'billing_name.max' => 'Fakturačné meno alebo názov firmy môže mať maximálne 200 znakov.',

            'billing_address.required' => 'Vyplňte fakturačnú adresu.',
            'billing_address.max' => 'Fakturačná adresa môže mať maximálne 300 znakov.',

            'company_id.required' => 'Vyplňte IČO.',
            'company_id.max' => 'IČO môže mať maximálne 50 znakov.',

            'tax_id.required' => 'Vyplňte DIČ.',
            'tax_id.max' => 'DIČ môže mať maximálne 50 znakov.',

            'vat_id.max' => 'IČ DPH môže mať maximálne 50 znakov.',

            'consent.required' => 'Pre pokračovanie je potrebný súhlas so spracovaním údajov.',
            'consent.accepted' => 'Pre pokračovanie je potrebný súhlas so spracovaním údajov.',
        ]);

        $checkin = $apartment->checkins()->create([
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

        $checkin->load(['apartment', 'guests']);

        Mail::to($checkin->contact_email)->send(new CheckinConfirmationMail($checkin));

        $ownerEmail = config('mail.owner_email');

        if ($ownerEmail) {
            Mail::to($ownerEmail)->send(new CheckinNotificationMail($checkin));
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
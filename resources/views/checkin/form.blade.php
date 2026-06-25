@extends('layouts.app')

@section('title', 'Online check-in — ' . $apartment->name)

@section('header-sub', $apartment->name)

@section('content')
<div class="mb-8">
    <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900">Online check-in</h1>
    <p class="mt-2 text-slate-500">Vyplňte prosím údaje pre váš príchod do apartmánu <strong class="text-slate-700">{{ $apartment->name }}</strong>. Po odoslaní vám zobrazíme všetky príchodové informácie a prístupový kód.</p>
</div>

@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4" role="alert">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div>
                <p class="font-medium text-red-800">Prosím skontrolujte vyplnené údaje</p>
                <p class="text-sm text-red-700 mt-0.5">Niektoré polia nie sú vyplnené správne. Opravte ich a odošlite formulár znova.</p>
            </div>
        </div>
    </div>
@endif

<form method="POST" action="{{ route('checkin.store', $apartment->slug) }}" id="checkin-form" novalidate>
    @csrf

    {{-- Sekcia: Kontakt --}}
    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-900">Kontakt</h2>
        </div>
        <div class="p-5 sm:p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="contact_email" class="block text-sm font-medium text-slate-700 mb-1.5">E-mail <span class="text-red-500">*</span></label>
                <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition @error('contact_email') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror" placeholder="jan.kovac@example.com" autocomplete="email">
                @error('contact_email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="contact_phone" class="block text-sm font-medium text-slate-700 mb-1.5">Telefón <span class="text-red-500">*</span></label>
                <input type="tel" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition @error('contact_phone') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror" placeholder="+421 900 000 000" autocomplete="tel">
                @error('contact_phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </section>

    {{-- Sekcia: Hostia --}}
    <section class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-900">Hostia</h2>
        </div>
        <div class="p-5 sm:p-6">
            <div class="max-w-xs">
                <label for="guest_count" class="block text-sm font-medium text-slate-700 mb-1.5">Počet hostí <span class="text-red-500">*</span></label>
                <select name="guest_count" id="guest_count" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition @error('guest_count') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @selected(old('guest_count') == $i)>{{ $i }}</option>
                    @endfor
                </select>
                @error('guest_count') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div id="guests-container" class="mt-6 space-y-5"></div>

            @error('guests') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </section>

    {{-- Sekcia: Faktúra --}}
    <section class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-900">Faktúra</h2>
        </div>
        <div class="p-5 sm:p-6">
            <label class="flex items-start gap-3 cursor-pointer select-none">
                <input type="checkbox" name="wants_invoice" id="wants_invoice" value="1" @checked(old('wants_invoice')) class="mt-1 w-5 h-5 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20 outline-none">
                <span class="text-sm text-slate-700">Chcem vystaviť faktúru</span>
            </label>

            <div id="invoice-fields" class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4 hidden">
                <div class="sm:col-span-2">
                    <label for="billing_name" class="block text-sm font-medium text-slate-700 mb-1.5">Fakturačné meno alebo názov firmy <span class="text-red-500">*</span></label>
                    <input type="text" name="billing_name" id="billing_name" value="{{ old('billing_name') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition @error('billing_name') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror" placeholder="Jan Kovac, alebo Názov s.r.o.">
                    @error('billing_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="billing_address" class="block text-sm font-medium text-slate-700 mb-1.5">Fakturačná adresa <span class="text-red-500">*</span></label>
                    <input type="text" name="billing_address" id="billing_address" value="{{ old('billing_address') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition @error('billing_address') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror" placeholder="Hlavná 1, 811 01 Bratislava">
                    @error('billing_address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="company_id" class="block text-sm font-medium text-slate-700 mb-1.5">IČO <span class="text-red-500">*</span></label>
                    <input type="text" name="company_id" id="company_id" value="{{ old('company_id') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition @error('company_id') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror" placeholder="12345678">
                    @error('company_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="tax_id" class="block text-sm font-medium text-slate-700 mb-1.5">DIČ <span class="text-red-500">*</span></label>
                    <input type="text" name="tax_id" id="tax_id" value="{{ old('tax_id') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition @error('tax_id') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror" placeholder="1234567890">
                    @error('tax_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="vat_id" class="block text-sm font-medium text-slate-700 mb-1.5">IČ DPH</label>
                    <input type="text" name="vat_id" id="vat_id" value="{{ old('vat_id') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition @error('vat_id') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror" placeholder="SK1234567890 (nepovinné)">
                    @error('vat_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </section>

    {{-- Sekcia: Súhlas --}}
    <section class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="p-5 sm:p-6">
            <label class="flex items-start gap-3 cursor-pointer select-none">
                <input type="checkbox" name="consent" id="consent" value="1" @checked(old('consent')) class="mt-1 w-5 h-5 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20 outline-none @error('consent') border-red-400 @enderror">
                <span class="text-sm text-slate-700">Súhlasím so spracovaním údajov za účelom vybavenia ubytovania a splnenia zákonných povinností ubytovateľa. <span class="text-red-500">*</span></span>
            </label>
            @error('consent') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </section>

    <div class="mt-8">
        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3.5 text-base font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/20 transition">
            Dokončiť online check-in
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </button>
    </div>
</form>
@endsection

@section('scripts')
<script>
    (function () {
        const guestCountSelect = document.getElementById('guest_count');
        const guestsContainer = document.getElementById('guests-container');
        const wantsInvoice = document.getElementById('wants_invoice');
        const invoiceFields = document.getElementById('invoice-fields');

        // Staré hodnoty hostí (pre zachovanie pri chybe validácie)
        const oldGuests = @json(old('guests', []));

        function guestRow(index, data) {
            data = data || {};
            const first = data.first_name || '';
            const last = data.last_name || '';
            const birth = data.birth_date || '';

            return `
            <div class="rounded-xl border border-slate-200 bg-slate-50/60 p-4 sm:p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-slate-900">Hosť ${index}</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Meno <span class="text-red-500">*</span></label>
                        <input type="text" name="guests[${index - 1}][first_name]" value="${escapeHtml(first)}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition bg-white" placeholder="Meno">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Priezvisko <span class="text-red-500">*</span></label>
                        <input type="text" name="guests[${index - 1}][last_name]" value="${escapeHtml(last)}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition bg-white" placeholder="Priezvisko">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Dátum narodenia <span class="text-red-500">*</span></label>
                        <input type="date" name="guests[${index - 1}][birth_date]" value="${escapeHtml(birth)}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none transition bg-white">
                    </div>
                </div>
            </div>`;
        }

        function escapeHtml(str) {
            if (str === null || str === undefined) return '';
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(String(str)));
            return div.innerHTML;
        }

        function renderGuests() {
            const count = parseInt(guestCountSelect.value, 10) || 1;
            let html = '';
            for (let i = 1; i <= count; i++) {
                html += guestRow(i, oldGuests[i - 1]);
            }
            guestsContainer.innerHTML = html;
        }

        function toggleInvoice() {
            if (wantsInvoice.checked) {
                invoiceFields.classList.remove('hidden');
            } else {
                invoiceFields.classList.add('hidden');
            }
        }

        guestCountSelect.addEventListener('change', renderGuests);
        wantsInvoice.addEventListener('change', toggleInvoice);

        renderGuests();
        toggleInvoice();
    })();
</script>
@endsection
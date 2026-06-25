@extends('layouts.app')

@section('title', 'Online check-in — ' . $apartment->name)

@section('header-sub', $apartment->name)

@section('content')
<div class="mb-10">
    <h1 class="font-lato text-3xl font-semibold tracking-tight text-park-gray sm:text-4xl">
        Online check-in
    </h1>

    <p class="mt-4 max-w-2xl text-base leading-7 text-park-gray">
        Vyplňte údaje potrebné k pobytu. Po odoslaní vám zobrazíme príchodové informácie, Wi-Fi a prístupový kód.
    </p>
</div>

@if ($errors->any())
    <div class="mb-6 rounded-md bg-park-green bg- p-5" role="alert">
        <p class="font-lato text-base font-semibold text-white">
            Skontrolujte údaje
        </p>

        <p class="mt-1 text-sm leading-6 text-white">
            Niektoré polia chýbajú alebo nie sú vyplnené správne. Opravte ich a odošlite formulár znova.
        </p>
    </div>
@endif

<form method="POST" action="{{ route('checkin.store', $apartment->slug) }}" id="checkin-form" novalidate>
    @csrf

    <section class="rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">1</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Kontakt na rezerváciu
                    </h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2">
            <div>
                <label for="contact_email" class="mb-2 block text-sm font-medium text-park-gray">
                    E-mail <span class="text-park-green">*</span>
                </label>

                <input
                    type="email"
                    name="contact_email"
                    id="contact_email"
                    value="{{ old('contact_email') }}"
                    class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green @error('contact_email') border-park-green @else border-park-gray @enderror"
                    placeholder="jan.kovac@example.com"
                    autocomplete="email"
                >

                @error('contact_email')
                    <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="contact_phone_number" class="mb-2 block text-sm font-medium text-park-gray">
                    Telefón <span class="text-park-green">*</span>
                </label>

                <input
                    type="hidden"
                    name="contact_phone"
                    id="contact_phone"
                    value="{{ old('contact_phone') }}"
                >

                <div class="grid grid-cols-[120px_1fr] gap-3">
                    <select
                        id="contact_phone_prefix"
                        class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green @error('contact_phone') border-park-green @else border-park-gray @enderror"
                    >
                        <option value="+421">+421</option>
                        <option value="+420">+420</option>
                        <option value="+43">+43</option>
                        <option value="+36">+36</option>
                        <option value="+48">+48</option>
                        <option value="+49">+49</option>
                        <option value="+44">+44</option>
                        <option value="+353">+353</option>
                        <option value="+380">+380</option>
                        <option value="+39">+39</option>
                        <option value="+33">+33</option>
                        <option value="+34">+34</option>
                    </select>

                    <input
                        type="tel"
                        id="contact_phone_number"
                        class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green @error('contact_phone') border-park-green @else border-park-gray @enderror"
                        placeholder="900 000 000"
                        autocomplete="tel"
                    >
                </div>

                @error('contact_phone')
                    <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>

    <section class="mt-6 rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">2</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Údaje hostí
                    </h2>

                    <p class="mt-1 text-sm leading-6 text-park-gray">
                        Meno, priezvisko a dátum narodenia potrebujeme kvôli ubytovacej evidencii.
                    </p>
                </div>
            </div>
        </div>

        <div class="p-5">
            <input
                type="hidden"
                name="guest_count"
                id="guest_count"
                value="{{ old('guest_count', 1) }}"
            >

            <div id="guests-container" class="space-y-4"></div>

            <div class="mt-5">
                <button
                    type="button"
                    id="add-guest-button"
                    class="inline-flex items-center justify-center rounded-md border border-park-green bg-white px-4 py-3 text-sm font-semibold text-park-green hover:bg-park-green hover:text-white focus:outline-none focus:ring-1 focus:ring-park-green"
                >
                    + Pridať ďalšieho hosťa
                </button>
            </div>

            @error('guest_count')
                <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
            @enderror

            @error('guests')
                <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
            @enderror
        </div>
    </section>

    <section class="mt-6 rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">3</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Faktúra
                    </h2>

                    <p class="mt-1 text-sm leading-6 text-park-gray">
                        Fakturačné údaje vyplňte iba v prípade, že potrebujete faktúru.
                    </p>
                </div>
            </div>
        </div>

        <div class="p-5">
            <label class="flex cursor-pointer select-none items-start gap-3 rounded-md border border-park-gray bg-white p-4">
                <input
                    type="checkbox"
                    name="wants_invoice"
                    id="wants_invoice"
                    value="1"
                    @checked(old('wants_invoice'))
                    class="peer sr-only"
                >

                <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-park-gray bg-white text-white peer-checked:border-park-green peer-checked:bg-park-green">
                    <svg
                        class="h-3 w-3"
                        viewBox="0 0 12 10"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M1 5L4.2 8L11 1"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>

                <span class="text-sm leading-6 text-park-gray">
                    Chcem vystaviť faktúru
                </span>
            </label>

            <div id="invoice-fields" class="mt-5 hidden grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="billing_name" class="mb-2 block text-sm font-medium text-park-gray">
                        Fakturačné meno alebo názov firmy <span class="text-park-green">*</span>
                    </label>

                    <input
                        type="text"
                        name="billing_name"
                        id="billing_name"
                        value="{{ old('billing_name') }}"
                        class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green @error('billing_name') border-park-green @else border-park-gray @enderror"
                        placeholder="Ján Kováč alebo Názov s.r.o."
                    >

                    @error('billing_name')
                        <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="billing_address" class="mb-2 block text-sm font-medium text-park-gray">
                        Fakturačná adresa <span class="text-park-green">*</span>
                    </label>

                    <input
                        type="text"
                        name="billing_address"
                        id="billing_address"
                        value="{{ old('billing_address') }}"
                        class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green @error('billing_address') border-park-green @else border-park-gray @enderror"
                        placeholder="Hlavná 1, 811 01 Bratislava"
                    >

                    @error('billing_address')
                        <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="company_id" class="mb-2 block text-sm font-medium text-park-gray">
                        IČO <span class="text-park-green">*</span>
                    </label>

                    <input
                        type="text"
                        name="company_id"
                        id="company_id"
                        value="{{ old('company_id') }}"
                        class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green @error('company_id') border-park-green @else border-park-gray @enderror"
                        placeholder="12345678"
                    >

                    @error('company_id')
                        <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tax_id" class="mb-2 block text-sm font-medium text-park-gray">
                        DIČ <span class="text-park-green">*</span>
                    </label>

                    <input
                        type="text"
                        name="tax_id"
                        id="tax_id"
                        value="{{ old('tax_id') }}"
                        class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green @error('tax_id') border-park-green @else border-park-gray @enderror"
                        placeholder="1234567890"
                    >

                    @error('tax_id')
                        <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="vat_id" class="mb-2 block text-sm font-medium text-park-gray">
                        IČ DPH
                    </label>

                    <input
                        type="text"
                        name="vat_id"
                        id="vat_id"
                        value="{{ old('vat_id') }}"
                        class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green @error('vat_id') border-park-green @else border-park-gray @enderror"
                        placeholder="SK1234567890"
                    >

                    @error('vat_id')
                        <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </section>

    <section class="mt-6 rounded-md border @error('consent') border-park-green @else border-park-gray @enderror bg-white">
        <div class="p-5">
            <label class="flex cursor-pointer select-none items-start gap-3">
                <input
                    type="checkbox"
                    name="consent"
                    id="consent"
                    value="1"
                    @checked(old('consent'))
                    class="peer sr-only"
                >

                <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-park-gray bg-white text-white peer-checked:border-park-green peer-checked:bg-park-green">
                    <svg
                        class="h-3 w-3"
                        viewBox="0 0 12 10"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M1 5L4.2 8L11 1"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>

                <span class="text-sm leading-6 text-park-gray">
                    Súhlasím so spracovaním údajov za účelom vybavenia ubytovania a splnenia zákonných povinností ubytovateľa.
                    <span class="text-park-green">*</span>
                </span>
            </label>

            @error('consent')
                <p class="mt-2 text-sm font-medium text-park-green">{{ $message }}</p>
            @enderror
        </div>
    </section>

    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
        <button
            type="submit"
            id="submit-button"
            class="inline-flex w-full items-center justify-center rounded-md border border-park-green bg-park-green px-5 py-3 text-base font-semibold text-white hover:bg-white hover:text-park-green focus:outline-none focus:ring-1 focus:ring-park-green sm:w-auto"
        >
            Zobraziť príchodové informácie
        </button>

        <p class="text-sm leading-6 text-park-gray">
            Po odoslaní sa vám ihneď zobrazí kód k apartmánu.
        </p>
    </div>
</form>

<div id="submit-loader" class="fixed inset-0 z-50 hidden items-center justify-center bg-white">
    <div class="flex flex-col items-center gap-4 rounded-md bg-white p-8">
        <img src="{{ asset('logo.svg') }}" alt="parkFIVE logo" class="h-12 w-auto">

        <p class="font-lato text-sm text-park-gray">
            Pripravujeme príchodové informácie...
        </p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    (function () {
        const form = document.getElementById('checkin-form');
        const submitButton = document.getElementById('submit-button');
        const submitLoader = document.getElementById('submit-loader');

        const phoneHidden = document.getElementById('contact_phone');
        const phonePrefix = document.getElementById('contact_phone_prefix');
        const phoneNumber = document.getElementById('contact_phone_number');

        const guestCountInput = document.getElementById('guest_count');
        const guestsContainer = document.getElementById('guests-container');
        const addGuestButton = document.getElementById('add-guest-button');

        const wantsInvoice = document.getElementById('wants_invoice');
        const invoiceFields = document.getElementById('invoice-fields');

        const oldGuests = @json(old('guests', []));
        const oldPhone = @json(old('contact_phone'));
        const errorMessages = @json($errors->messages());

        let guestData = oldGuests.length ? oldGuests : [
            {
                first_name: '',
                last_name: '',
                birth_date: '',
            },
        ];

        const phonePrefixes = [
            '+421',
            '+420',
            '+43',
            '+36',
            '+48',
            '+49',
            '+44',
            '+353',
            '+380',
            '+39',
            '+33',
            '+34',
        ];

        function escapeHtml(str) {
            if (str === null || str === undefined) {
                return '';
            }

            const div = document.createElement('div');
            div.appendChild(document.createTextNode(String(str)));

            return div.innerHTML;
        }

        function hasError(key) {
            return Object.prototype.hasOwnProperty.call(errorMessages, key);
        }

        function getError(key) {
            if (!hasError(key)) {
                return '';
            }

            return errorMessages[key][0] || '';
        }

        function parseOldPhone() {
            if (!oldPhone) {
                phonePrefix.value = '+421';
                return;
            }

            const trimmedPhone = String(oldPhone).trim();

            const matchedPrefix = phonePrefixes.find(function (prefix) {
                return trimmedPhone.startsWith(prefix);
            });

            if (matchedPrefix) {
                phonePrefix.value = matchedPrefix;
                phoneNumber.value = trimmedPhone.replace(matchedPrefix, '').trim();
            } else {
                phonePrefix.value = '+421';
                phoneNumber.value = trimmedPhone;
            }
        }

        function syncPhone() {
            const prefix = phonePrefix.value.trim();
            const number = phoneNumber.value.trim();

            phoneHidden.value = `${prefix} ${number}`.trim();
        }

        function collectGuestData() {
            const rows = guestsContainer.querySelectorAll('[data-guest-index]');

            guestData = Array.from(rows).map(function (row) {
                return {
                    first_name: row.querySelector('[data-guest-field="first_name"]').value,
                    last_name: row.querySelector('[data-guest-field="last_name"]').value,
                    birth_date: row.querySelector('[data-guest-field="birth_date"]').value,
                };
            });
        }

        function fieldErrorHtml(key) {
            if (!hasError(key)) {
                return '';
            }

            return `
                <p class="mt-2 text-sm font-medium text-park-green">
                    ${escapeHtml(getError(key))}
                </p>
            `;
        }

        function fieldBorderClass(key) {
            return hasError(key) ? 'border-park-green' : 'border-park-gray';
        }

        function guestRow(index, data) {
            data = data || {};

            const fieldIndex = index - 1;
            const first = data.first_name || '';
            const last = data.last_name || '';
            const birth = data.birth_date || '';

            const firstNameKey = `guests.${fieldIndex}.first_name`;
            const lastNameKey = `guests.${fieldIndex}.last_name`;
            const birthDateKey = `guests.${fieldIndex}.birth_date`;

            const removeButton = index > 1
                ? `
                    <button
                        type="button"
                        data-remove-guest="${fieldIndex}"
                        class="rounded-md border border-park-green bg-white px-3 py-2 text-sm font-semibold text-park-green hover:bg-park-green hover:text-white focus:outline-none focus:ring-1 focus:ring-park-green"
                    >
                        Odstrániť
                    </button>
                `
                : '';

            return `
                <div class="rounded-md border border-park-gray bg-white p-4" data-guest-index="${fieldIndex}">
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="flex h-7 w-7 items-center justify-center rounded-md border border-park-green bg-white">
                                <span class="font-lato text-sm font-semibold text-park-green">${index}</span>
                            </div>

                            <p class="font-lato text-base font-semibold text-park-gray">
                                Hosť ${index}
                            </p>
                        </div>

                        ${removeButton}
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-park-gray">
                                Meno <span class="text-park-green">*</span>
                            </label>

                            <input
                                type="text"
                                name="guests[${fieldIndex}][first_name]"
                                value="${escapeHtml(first)}"
                                data-guest-field="first_name"
                                class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green ${fieldBorderClass(firstNameKey)}"
                                placeholder="Meno"
                            >

                            ${fieldErrorHtml(firstNameKey)}
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-park-gray">
                                Priezvisko <span class="text-park-green">*</span>
                            </label>

                            <input
                                type="text"
                                name="guests[${fieldIndex}][last_name]"
                                value="${escapeHtml(last)}"
                                data-guest-field="last_name"
                                class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green ${fieldBorderClass(lastNameKey)}"
                                placeholder="Priezvisko"
                            >

                            ${fieldErrorHtml(lastNameKey)}
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-park-gray">
                                Dátum narodenia <span class="text-park-green">*</span>
                            </label>

                            <input
                                type="date"
                                name="guests[${fieldIndex}][birth_date]"
                                value="${escapeHtml(birth)}"
                                data-guest-field="birth_date"
                                class="w-full rounded-md border bg-white px-3 py-3 text-park-gray outline-none focus:border-park-green focus:ring-1 focus:ring-park-green ${fieldBorderClass(birthDateKey)}"
                            >

                            ${fieldErrorHtml(birthDateKey)}
                        </div>
                    </div>
                </div>
            `;
        }

        function renderGuests() {
            let html = '';

            guestData.forEach(function (guest, index) {
                html += guestRow(index + 1, guest);
            });

            guestsContainer.innerHTML = html;
            guestCountInput.value = guestData.length;

            if (guestData.length >= 8) {
                addGuestButton.classList.add('hidden');
            } else {
                addGuestButton.classList.remove('hidden');
            }
        }

        function addGuest() {
            collectGuestData();

            if (guestData.length >= 8) {
                return;
            }

            guestData.push({
                first_name: '',
                last_name: '',
                birth_date: '',
            });

            renderGuests();
        }

        function removeGuest(index) {
            collectGuestData();

            if (guestData.length <= 1) {
                return;
            }

            guestData.splice(index, 1);
            renderGuests();
        }

        function toggleInvoice() {
            if (wantsInvoice.checked) {
                invoiceFields.classList.remove('hidden');
                invoiceFields.classList.add('grid');
            } else {
                invoiceFields.classList.add('hidden');
                invoiceFields.classList.remove('grid');
            }
        }

        phonePrefix.addEventListener('change', syncPhone);
        phoneNumber.addEventListener('input', syncPhone);

        addGuestButton.addEventListener('click', addGuest);

        guestsContainer.addEventListener('click', function (event) {
            const button = event.target.closest('[data-remove-guest]');

            if (!button) {
                return;
            }

            removeGuest(parseInt(button.dataset.removeGuest, 10));
        });

        wantsInvoice.addEventListener('change', toggleInvoice);

        form.addEventListener('submit', function () {
            collectGuestData();
            syncPhone();

            submitButton.disabled = true;
            submitLoader.classList.remove('hidden');
            submitLoader.classList.add('flex');
        });

        parseOldPhone();
        syncPhone();
        renderGuests();
        toggleInvoice();
    })();
</script>
@endsection
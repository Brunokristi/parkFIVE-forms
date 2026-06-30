@extends('layouts.app')

@php
    $apartment = $checkin->apartment;
@endphp

@section('title', 'Check-in dokončený — ' . $apartment->name)

@section('header-sub', 'Potvrdenie')

@section('content')
<div class="mb-10">

    <h1 class="font-lato text-3xl font-semibold tracking-tight text-park-gray sm:text-4xl">
        Všetko je pripravené
    </h1>

    <p class="mt-4 max-w-2xl text-base leading-7 text-park-gray">
        Ďakujeme, vaše údaje boli úspešne odoslané. Nižšie nájdete všetky dôležité informácie k príchodu.
    </p>
</div>

<div class="mb-6 rounded-md bg-park-green p-5" role="alert">
    <p class="font-lato text-base font-semibold text-white">
        Informácie máte aj v e-maile
    </p>

    <p class="mt-1 text-sm leading-6 text-white">
        Informácie k príchodu sme vám poslali na e-mail uvedený vo formulári.
    </p>
</div>

<div id="arrival-info" class="space-y-6">
    <section class="rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">1</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Informácie k príchodu
                    </h2>

                    <p class="mt-1 text-sm leading-6 text-park-gray">
                        Tieto údaje budete potrebovať pri príchode do apartmánu.
                    </p>
                </div>
            </div>
        </div>

        <div class="p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-md border border-park-gray bg-white p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-park-green">
                        Apartmán
                    </p>

                    <p class="mt-2 text-sm font-medium text-park-gray" data-info-label="Apartmán">
                        {{ $apartment->name }}
                    </p>
                </div>

                <div class="rounded-md border border-park-gray bg-white p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-park-green">
                        Adresa
                    </p>

                    <p class="mt-2 text-sm font-medium text-park-gray" data-info-label="Adresa">
                        {{ $apartment->address }}
                    </p>
                </div>

                <div class="rounded-md border border-park-gray bg-white p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-park-green">
                        Check-in
                    </p>

                    <p class="mt-2 text-sm font-medium text-park-gray" data-info-label="Check-in">
                        {{ $apartment->checkin_time }}
                    </p>
                </div>

                <div class="rounded-md border border-park-gray bg-white p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-park-green">
                        Check-out
                    </p>

                    <p class="mt-2 text-sm font-medium text-park-gray" data-info-label="Check-out">
                        {{ $apartment->checkout_time }}
                    </p>
                </div>
            </div>

            <div class="mt-5 rounded-md border border-park-green bg-park-green p-5">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-white">
                            Prístupový kód
                        </p>

                        <p class="mt-2 font-lato text-3xl font-semibold tracking-widest text-white" data-info-label="Prístupový kód">
                            {{ $apartment->access_code }}
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="copyText(@js($apartment->access_code), 'Kód bol skopírovaný')"
                        class="inline-flex items-center justify-center rounded-md border border-white bg-white px-4 py-3 text-sm font-semibold text-park-green hover:bg-park-green hover:text-white focus:outline-none focus:ring-1 focus:ring-white"
                    >
                        Kopírovať kód
                    </button>
                </div>
            </div>

            @if ($apartment->arrival_instructions)
                <div class="mt-5 rounded-md border border-park-gray bg-white p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-park-green">
                        Postup príchodu
                    </p>

                    <p class="mt-2 text-sm leading-6 text-park-gray">
                        {{ $apartment->arrival_instructions }}
                    </p>
                </div>
            @endif

            @if ($apartment->key_instructions)
                <div class="mt-5 rounded-md border border-park-gray bg-white p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-park-green">
                        Kľúč
                    </p>

                    <p class="mt-2 text-sm leading-6 text-park-gray">
                        {{ $apartment->key_instructions }}
                    </p>
                </div>
            @endif
        </div>
    </section>

    <section class="rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">2</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Wi-Fi
                    </h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2">
            <div class="rounded-md border border-park-gray bg-white p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-park-green">
                    Názov siete
                </p>

                <p class="mt-2 text-sm font-medium text-park-gray" data-info-label="Wi-Fi názov">
                    {{ $apartment->wifi_name }}
                </p>
            </div>

            <div class="rounded-md border border-park-gray bg-white p-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-park-green">
                            Heslo
                        </p>

                        <p class="mt-2 text-sm font-semibold tracking-wide text-park-gray" data-info-label="Wi-Fi heslo">
                            {{ $apartment->wifi_password }}
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="copyText(@js($apartment->wifi_password), 'Wi-Fi heslo bolo skopírované')"
                        class="shrink-0 rounded-md border border-park-green bg-white px-3 py-2 text-sm font-semibold text-park-green hover:bg-park-green hover:text-white focus:outline-none focus:ring-1 focus:ring-park-green"
                    >
                        Kopírovať
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">3</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Parkovanie
                    </h2>
                </div>
            </div>
        </div>

        <div class="p-5">
            <p class="text-sm leading-6 text-park-gray" data-info-label="Parkovanie">
                {{ $apartment->parking_info }}
            </p>
        </div>
    </section>

    <section class="rounded-md border border-park-green bg-white">
        <div class="border-b border-park-green px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">4</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-green">
                        Bazén
                    </h2>

                    <p class="mt-1 text-sm leading-6 text-park-gray">
                        Bazén nie je automaticky zahrnutý v každej rezervácii.
                    </p>
                </div>
            </div>
        </div>

        <div class="p-5">
            <p class="text-sm leading-6 text-park-gray" data-info-label="Bazén">
                {{ $apartment->pool_info }}
            </p>

            <div class="mt-4 flex flex-col gap-3 sm:flex-row">
                <div class="rounded-md border border-park-green bg-park-green px-4 py-3">
                    <p class="text-sm font-semibold text-white">
                        Pri objednaní pred príchodom: 30 € / deň
                    </p>
                </div>

                <div class="rounded-md border border-park-gray bg-white px-4 py-3">
                    <p class="text-sm font-semibold text-park-gray">
                        Bežná cena: 40 € / deň
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">5</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Pravidlá pobytu
                    </h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2">
            <div class="rounded-md border border-park-gray bg-white p-4">
                <p class="text-sm font-semibold text-park-green">
                    Check-out
                </p>

                <p class="mt-1 text-sm leading-6 text-park-gray">
                    {{ $apartment->checkout_time }}
                </p>
            </div>

            <div class="rounded-md border border-park-gray bg-white p-4">
                <p class="text-sm font-semibold text-park-green">
                    Nočný kľud
                </p>

                <p class="mt-1 text-sm leading-6 text-park-gray">
                    {{ $apartment->quiet_hours }}
                </p>
            </div>

            <div class="rounded-md border border-park-gray bg-white p-4">
                <p class="text-sm font-semibold text-park-green">
                    Fajčenie
                </p>

                <p class="mt-1 text-sm leading-6 text-park-gray">
                    {{ $apartment->smoking_policy }}
                </p>
            </div>

            <div class="rounded-md border border-park-gray bg-white p-4">
                <p class="text-sm font-semibold text-park-green">
                    Domáce zvieratá
                </p>

                <p class="mt-1 text-sm leading-6 text-park-gray">
                    {{ $apartment->pets_policy }}
                </p>
            </div>

            <div class="rounded-md border border-park-gray bg-white p-4 sm:col-span-2">
                <p class="text-sm font-semibold text-park-green">
                    Skorší check-in / neskorší check-out
                </p>

                <p class="mt-1 text-sm leading-6 text-park-gray">
                    {{ $apartment->early_checkin }}
                </p>
            </div>
        </div>
    </section>

    @if ($apartment->equipment)
        <section class="rounded-md border border-park-gray bg-white">
            <div class="border-b border-park-gray px-5 py-5">
                <div class="flex items-start gap-4">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                        <span class="font-lato text-sm font-semibold text-white">6</span>
                    </div>

                    <div>
                        <h2 class="font-lato text-xl font-semibold text-park-gray">
                            Vybavenie apartmánu
                        </h2>
                    </div>
                </div>
            </div>

            <div class="p-5">
                <div class="flex flex-wrap gap-3">
                    @foreach ($apartment->equipment as $item)
                        <span class="inline-flex items-center gap-2 rounded-md border border-park-gray bg-white px-3 py-2 text-sm text-park-gray">
                            <span class="text-park-green">✓</span>
                            {{ $item }}
                        </span>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">7</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Odchod
                    </h2>
                </div>
            </div>
        </div>

        <div class="space-y-4 p-5">
            <div class="rounded-md border border-park-green bg-park-green p-4">
                <p class="text-sm font-semibold text-white">
                    Check-out je {{ $apartment->checkout_time }}
                </p>
            </div>

            @if ($apartment->key_instructions)
                <p class="text-sm leading-6 text-park-gray">
                    {{ $apartment->key_instructions }}
                </p>
            @endif
        </div>
    </section>

    <section class="rounded-md border border-park-gray bg-white">
        <div class="border-b border-park-gray px-5 py-5">
            <div class="flex items-start gap-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border border-park-green bg-park-green">
                    <span class="font-lato text-sm font-semibold text-white">8</span>
                </div>

                <div>
                    <h2 class="font-lato text-xl font-semibold text-park-gray">
                        Faktúra
                    </h2>
                </div>
            </div>
        </div>

        <div class="p-5">
            <p class="text-sm leading-6 text-park-gray">
                {{ $apartment->invoice_info }}
            </p>
        </div>
    </section>
</div>

<div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
    <button
        type="button"
        id="copy-btn"
        class="inline-flex w-full items-center justify-center rounded-md border border-park-green bg-park-green px-5 py-3 text-base font-semibold text-white hover:bg-white hover:text-park-green focus:outline-none focus:ring-1 focus:ring-park-green sm:w-auto"
    >
        Skopírovať informácie
    </button>

    <button
        type="button"
        id="share-btn"
        class="inline-flex w-full items-center justify-center rounded-md border border-park-green bg-white px-5 py-3 text-base font-semibold text-park-green hover:bg-park-green hover:text-white focus:outline-none focus:ring-1 focus:ring-park-green sm:w-auto"
    >
        Zdieľať informácie
    </button>
</div>

<div id="toast" class="fixed bottom-5 left-1/2 z-50 hidden -translate-x-1/2 rounded-md border border-park-green bg-white px-4 py-3">
    <p id="toast-text" class="text-sm font-medium text-park-green">
        Informácie boli skopírované
    </p>
</div>
@endsection

@section('scripts')
<script>
    function showToast(message) {
        const toast = document.getElementById('toast');
        const toastText = document.getElementById('toast-text');

        toastText.textContent = message;
        toast.classList.remove('hidden');

        setTimeout(function () {
            toast.classList.add('hidden');
        }, 2500);
    }

    async function copyToClipboard(text) {
        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(text);

                return true;
            }
        } catch (e) {}

        try {
            const textarea = document.createElement('textarea');

            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';

            document.body.appendChild(textarea);
            textarea.focus();
            textarea.select();

            const ok = document.execCommand('copy');

            document.body.removeChild(textarea);

            return ok;
        } catch (e) {
            return false;
        }
    }

    async function copyText(text, message) {
        const ok = await copyToClipboard(text);

        showToast(ok ? message : 'Skopírovanie zlyhalo');
    }

    (function () {
        const copyBtn = document.getElementById('copy-btn');
        const shareBtn = document.getElementById('share-btn');

        function buildInfoText() {
            const rows = document.querySelectorAll('#arrival-info [data-info-label]');
            let text = 'parkFIVE — Príchodové informácie\n\n';

            rows.forEach(function (row) {
                const label = row.getAttribute('data-info-label');
                const value = row.innerText.trim();

                text += label + ': ' + value + '\n';
            });

            return text;
        }

        copyBtn.addEventListener('click', async function () {
            const text = buildInfoText();
            const ok = await copyToClipboard(text);

            showToast(ok ? 'Informácie boli skopírované' : 'Skopírovanie zlyhalo');
        });

        shareBtn.addEventListener('click', async function () {
            const text = buildInfoText();

            if (navigator.share) {
                try {
                    await navigator.share({
                        title: 'parkFIVE — Príchodové informácie',
                        text: text,
                    });
                } catch (e) {
                    if (e.name !== 'AbortError') {
                        const ok = await copyToClipboard(text);

                        showToast(ok ? 'Informácie boli skopírované' : 'Skopírovanie zlyhalo');
                    }
                }
            } else {
                const ok = await copyToClipboard(text);

                showToast(ok ? 'Informácie boli skopírované' : 'Skopírovanie zlyhalo');
            }
        });
    })();
</script>
@endsection
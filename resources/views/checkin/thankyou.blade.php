@extends('layouts.app')

@section('title', 'Check-in dokončený — ' . $checkin->apartment->name)

@section('header-sub', 'Potvrdenie')

@php
    $apartment = $checkin->apartment;
@endphp

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-green-100 mb-4">
        <svg class="w-7 h-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
        </svg>
    </div>
    <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900">Online check-in je dokončený</h1>
    <p class="mt-2 text-slate-500">Ďakujeme, vaše údaje boli úspešne odoslané.</p>
</div>

@if (session('success'))
    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800" role="status">
        {{ session('success') }}
    </div>
@endif

<div id="arrival-info" class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="text-base font-semibold text-slate-900">Príchodové informácie</h2>
        <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">{{ $apartment->name }}</span>
    </div>

    <dl class="divide-y divide-slate-100">
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Apartmán</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900 font-medium" data-info-label="Apartmán">{{ $apartment->name }}</dd>
        </div>
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Adresa</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900" data-info-label="Adresa">{{ $apartment->address }}</dd>
        </div>
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Check-in čas</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900" data-info-label="Check-in čas">{{ $apartment->checkin_time }}</dd>
        </div>
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Prístupový kód</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900">
                <span class="inline-flex items-center gap-2">
                    <span class="font-mono text-lg font-semibold tracking-wider bg-slate-900 text-white px-3 py-1 rounded-md" data-info-label="Prístupový kód">{{ $apartment->access_code }}</span>
                </span>
            </dd>
        </div>
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Wi-Fi názov</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900" data-info-label="Wi-Fi názov">{{ $apartment->wifi_name }}</dd>
        </div>
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Wi-Fi heslo</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900">
                <span class="font-mono font-semibold" data-info-label="Wi-Fi heslo">{{ $apartment->wifi_password }}</span>
            </dd>
        </div>
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Parkovanie</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900" data-info-label="Parkovanie">{{ $apartment->parking_info }}</dd>
        </div>
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Bazén</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900" data-info-label="Bazén">{{ $apartment->pool_info }}</dd>
        </div>
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
            <dt class="text-sm font-medium text-slate-500">Kontakt</dt>
            <dd class="sm:col-span-2 text-sm text-slate-900" data-info-label="Kontakt">{{ $apartment->contact_info }}</dd>
        </div>
    </dl>
</div>

<div class="mt-6 flex flex-col sm:flex-row gap-3">
    <button type="button" id="copy-btn" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/20 transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
        </svg>
        Skopírovať informácie
    </button>
    <button type="button" id="share-btn" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-900/10 transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
        </svg>
        Zdieľať informácie
    </button>
</div>

<div id="toast" class="fixed bottom-5 left-1/2 -translate-x-1/2 translate-y-4 opacity-0 pointer-events-none transition-all duration-300 z-50">
    <div class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-medium text-white shadow-lg">
        <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
        </svg>
        <span id="toast-text">Informácie boli skopírované</span>
    </div>
</div>
@endsection

@section('scripts')
<script>
    (function () {
        const copyBtn = document.getElementById('copy-btn');
        const shareBtn = document.getElementById('share-btn');
        const toast = document.getElementById('toast');
        const toastText = document.getElementById('toast-text');

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

        function showToast(message) {
            toastText.textContent = message;
            toast.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(function () {
                toast.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                toast.classList.remove('opacity-100', 'translate-y-0');
            }, 2500);
        }

        async function copyToClipboard(text) {
            try {
                if (navigator.clipboard && window.isSecureContext) {
                    await navigator.clipboard.writeText(text);
                    return true;
                }
            } catch (e) {
                // fallback
            }
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
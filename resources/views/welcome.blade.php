@extends('layouts.app')

@section('title', 'parkFIVE')

@section('header-sub', '')

@section('content')
<div class="text-center py-12">
    <h1 class="text-3xl sm:text-4xl font-semibold tracking-tight text-slate-900">parkFIVE</h1>
    <p class="mt-3 text-slate-500 max-w-md mx-auto">Online self check-in pre ubytovanie. Pokračujte na stránku vášho apartmánu.</p>

    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('checkin.show', 'apartman-1') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3.5 text-base font-medium text-white shadow-sm hover:bg-slate-800 transition">
            Apartmán 1
        </a>
        <a href="{{ route('checkin.show', 'apartman-2') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-6 py-3.5 text-base font-medium text-slate-700 shadow-sm hover:bg-slate-50 transition">
            Apartmán 2
        </a>
    </div>
</div>
@endsection
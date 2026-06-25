@php
    $apartment = $checkin->apartment;
@endphp

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nový online check-in</title>
</head>

<body style="margin:0;padding:0;background-color:#ffffff;font-family:Inter, Lato, Arial, sans-serif;color:#a6a6a6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#ffffff;padding:24px 0;">
        <tr>
            <td align="center" style="padding:0 16px;">
                <table width="600" cellpadding="0" cellspacing="0" style="width:100%;max-width:600px;background-color:#ffffff;border:1px solid #a6a6a6;border-radius:6px;overflow:hidden;">

                    {{-- Header --}}
                    <tr>
                        <td style="padding:24px 28px;border-bottom:1px solid #a6a6a6;background-color:#ffffff;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <span style="font-size:20px;font-weight:700;color:#a6a6a6;letter-spacing:-0.02em;">
                                            parkFIVE
                                        </span>
                                    </td>

                                    <td align="right">
                                        <span style="display:inline-block;border:1px solid #99bd99;border-radius:6px;padding:6px 10px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Nový check-in
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Content --}}
                    <tr>
                        <td style="padding:28px;">
                            <h1 style="margin:0 0 10px;font-size:26px;line-height:1.25;font-weight:700;color:#a6a6a6;">
                                Bol odoslaný nový online check-in
                            </h1>

                            <p style="margin:0 0 24px;font-size:15px;line-height:1.7;color:#a6a6a6;">
                                Hosť vyplnil údaje pre apartmán
                                <strong style="color:#99bd99;">{{ $apartment->name }}</strong>.
                            </p>

                            {{-- Summary --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 24px;background-color:#99bd99;border-radius:6px;">
                                <tr>
                                    <td style="padding:20px;">
                                        <span style="display:block;margin-bottom:6px;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#ffffff;">
                                            Apartmán
                                        </span>

                                        <span style="display:block;font-size:22px;line-height:1.3;font-weight:700;color:#ffffff;">
                                            {{ $apartment->name }}
                                        </span>

                                        <span style="display:block;margin-top:8px;font-size:14px;line-height:1.6;color:#ffffff;">
                                            Check-in odoslaný: {{ $checkin->created_at->format('d.m.Y H:i') }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            {{-- Kontaktné údaje --}}
                            <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                Kontaktné údaje
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #a6a6a6;border-radius:6px;overflow:hidden;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;width:36%;">
                                        <span style="display:block;font-size:12px;font-weight:700;color:#99bd99;">
                                            E-mail
                                        </span>
                                    </td>

                                    <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                        <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                            {{ $checkin->contact_email }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 18px;width:36%;">
                                        <span style="display:block;font-size:12px;font-weight:700;color:#99bd99;">
                                            Telefón
                                        </span>
                                    </td>

                                    <td style="padding:14px 18px;">
                                        <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                            {{ $checkin->contact_phone }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            {{-- Hostia --}}
                            <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                Hostia ({{ $checkin->guest_count }})
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #a6a6a6;border-radius:6px;overflow:hidden;margin-bottom:24px;">
                                @foreach ($checkin->guests as $index => $guest)
                                    <tr>
                                        <td style="padding:16px 18px;@if(!$loop->last)border-bottom:1px solid #a6a6a6;@endif">
                                            <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                                Hosť {{ $index + 1 }}
                                            </span>

                                            <span style="display:block;font-size:16px;line-height:1.5;font-weight:700;color:#a6a6a6;">
                                                {{ $guest->first_name }} {{ $guest->last_name }}
                                            </span>

                                            <span style="display:block;margin-top:4px;font-size:13px;line-height:1.5;color:#a6a6a6;">
                                                Dátum narodenia: {{ $guest->birth_date->format('d.m.Y') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            {{-- Fakturácia --}}
                            @if ($checkin->wants_invoice)
                                <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                    Fakturačné údaje
                                </h2>

                                <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #99bd99;border-radius:6px;overflow:hidden;margin-bottom:24px;">
                                    <tr>
                                        <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;width:36%;">
                                            <span style="display:block;font-size:12px;font-weight:700;color:#99bd99;">
                                                Názov / Firma
                                            </span>
                                        </td>

                                        <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                            <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                                {{ $checkin->billing_name }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;width:36%;">
                                            <span style="display:block;font-size:12px;font-weight:700;color:#99bd99;">
                                                Adresa
                                            </span>
                                        </td>

                                        <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                            <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                                {{ $checkin->billing_address }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;width:36%;">
                                            <span style="display:block;font-size:12px;font-weight:700;color:#99bd99;">
                                                IČO
                                            </span>
                                        </td>

                                        <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                            <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                                {{ $checkin->company_id }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding:14px 18px;@if ($checkin->vat_id)border-bottom:1px solid #a6a6a6;@endif width:36%;">
                                            <span style="display:block;font-size:12px;font-weight:700;color:#99bd99;">
                                                DIČ
                                            </span>
                                        </td>

                                        <td style="padding:14px 18px;@if ($checkin->vat_id)border-bottom:1px solid #a6a6a6;@endif">
                                            <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                                {{ $checkin->tax_id }}
                                            </span>
                                        </td>
                                    </tr>

                                    @if ($checkin->vat_id)
                                        <tr>
                                            <td style="padding:14px 18px;width:36%;">
                                                <span style="display:block;font-size:12px;font-weight:700;color:#99bd99;">
                                                    IČ DPH
                                                </span>
                                            </td>

                                            <td style="padding:14px 18px;">
                                                <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                                    {{ $checkin->vat_id }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            @else
                                <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                    Faktúra
                                </h2>

                                <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #a6a6a6;border-radius:6px;margin-bottom:24px;">
                                    <tr>
                                        <td style="padding:18px;">
                                            <p style="margin:0;font-size:14px;line-height:1.7;color:#a6a6a6;">
                                                Hosť nepožiadal o vystavenie faktúry.
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            {{-- Footer note --}}
                            <p style="margin:28px 0 0;font-size:12px;line-height:1.6;color:#a6a6a6;">
                                Tento e-mail bol odoslaný automaticky po dokončení online check-inu.
                            </p>
                        </td>
                    </tr>
                </table>

                <p style="margin:16px 0 0;font-size:12px;color:#a6a6a6;">
                    © {{ date('Y') }} parkFIVE
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
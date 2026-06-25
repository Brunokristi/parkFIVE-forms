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
<body style="margin:0;padding:0;background-color:#f8fafc;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc;padding:24px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.08);">

                    {{-- Header --}}
                    <tr>
                        <td style="background-color:#0f172a;padding:24px 32px;">
                            <span style="font-size:20px;font-weight:600;color:#ffffff;letter-spacing:-0.02em;">parkFIVE</span>
                        </td>
                    </tr>

                    {{-- Content --}}
                    <tr>
                        <td style="padding:32px;">
                            <h1 style="margin:0 0 8px;font-size:24px;font-weight:600;color:#0f172a;">Nový online check-in</h1>
                            <p style="margin:0 0 24px;font-size:15px;color:#64748b;">Bol odoslaný nový online check-in pre <strong>{{ $apartment->name }}</strong>.</p>

                            {{-- Kontaktné údaje --}}
                            <h2 style="margin:0 0 12px;font-size:16px;font-weight:600;color:#0f172a;">Kontaktné údaje</h2>
                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;width:40%;">
                                        <span style="font-size:13px;color:#64748b;">E-mail</span>
                                    </td>
                                    <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:15px;color:#0f172a;">{{ $checkin->contact_email }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 20px;">
                                        <span style="font-size:13px;color:#64748b;">Telefón</span>
                                    </td>
                                    <td style="padding:12px 20px;">
                                        <span style="font-size:15px;color:#0f172a;">{{ $checkin->contact_phone }}</span>
                                    </td>
                                </tr>
                            </table>

                            {{-- Hostia --}}
                            <h2 style="margin:0 0 12px;font-size:16px;font-weight:600;color:#0f172a;">Hostia ({{ $checkin->guest_count }})</h2>
                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;margin-bottom:24px;">
                                @foreach ($checkin->guests as $index => $guest)
                                    <tr>
                                        <td style="padding:12px 20px;@if(!$loop->last)border-bottom:1px solid #f1f5f9;@endif">
                                            <span style="font-size:13px;color:#64748b;display:block;margin-bottom:2px;">Hosť {{ $index + 1 }}</span>
                                            <span style="font-size:15px;color:#0f172a;">{{ $guest->first_name }} {{ $guest->last_name }}</span>
                                            <span style="font-size:13px;color:#64748b;display:block;margin-top:2px;">Dátum narodenia: {{ $guest->birth_date->format('d.m.Y') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            {{-- Fakturácia --}}
                            @if ($checkin->wants_invoice)
                                <h2 style="margin:0 0 12px;font-size:16px;font-weight:600;color:#0f172a;">Fakturačné údaje</h2>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;margin-bottom:24px;">
                                    <tr>
                                        <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;width:40%;">
                                            <span style="font-size:13px;color:#64748b;">Názov / Firma</span>
                                        </td>
                                        <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;">
                                            <span style="font-size:15px;color:#0f172a;">{{ $checkin->billing_name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;">
                                            <span style="font-size:13px;color:#64748b;">Adresa</span>
                                        </td>
                                        <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;">
                                            <span style="font-size:15px;color:#0f172a;">{{ $checkin->billing_address }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;">
                                            <span style="font-size:13px;color:#64748b;">IČO</span>
                                        </td>
                                        <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;">
                                            <span style="font-size:15px;color:#0f172a;">{{ $checkin->company_id }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;">
                                            <span style="font-size:13px;color:#64748b;">DIČ</span>
                                        </td>
                                        <td style="padding:12px 20px;border-bottom:1px solid #f1f5f9;">
                                            <span style="font-size:15px;color:#0f172a;">{{ $checkin->tax_id }}</span>
                                        </td>
                                    </tr>
                                    @if ($checkin->vat_id)
                                        <tr>
                                            <td style="padding:12px 20px;">
                                                <span style="font-size:13px;color:#64748b;">IČ DPH</span>
                                            </td>
                                            <td style="padding:12px 20px;">
                                                <span style="font-size:15px;color:#0f172a;">{{ $checkin->vat_id }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            @endif

                            <p style="margin:24px 0 0;font-size:13px;color:#94a3b8;">Check-in odoslaný: {{ $checkin->created_at->format('d.m.Y H:i') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
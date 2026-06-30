@php
    $apartment = $checkin->apartment;
@endphp

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>parkFIVE — Online check-in dokončený</title>
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
                                        <span style="display:inline-block;border:1px solid #99bd99;border-radius:6px;padding:6px 10px;font-size:12px;font-weight:600;color:#99bd99;">
                                            Check-in dokončený
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
                                Váš online check-in je dokončený
                            </h1>

                            <p style="margin:0 0 24px;font-size:15px;line-height:1.7;color:#a6a6a6;">
                                Ďakujeme. Vaše údaje boli úspešne odoslané. Nižšie nájdete všetky dôležité informácie k príchodu.
                            </p>

                            {{-- Highlight access code --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 24px;background-color:#99bd99;border-radius:6px;">
                                <tr>
                                    <td style="padding:20px;">
                                        <span style="display:block;margin-bottom:6px;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#ffffff;">
                                            Prístupový kód
                                        </span>

                                        <span style="display:block;font-size:28px;line-height:1.2;font-weight:700;color:#ffffff;font-family:monospace;letter-spacing:0.12em;">
                                            {{ $apartment->access_code }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            {{-- Príchodové informácie --}}
                            <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                Príchodové informácie
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #a6a6a6;border-radius:6px;overflow:hidden;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Apartmán
                                        </span>

                                        <span style="display:block;font-size:15px;line-height:1.5;font-weight:600;color:#a6a6a6;">
                                            {{ $apartment->name }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Adresa
                                        </span>

                                        <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                            {{ $apartment->address }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Check-in
                                        </span>

                                        <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                            {{ $apartment->checkin_time }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 18px;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Check-out
                                        </span>

                                        <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                            {{ $apartment->checkout_time }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            @if ($apartment->arrival_instructions)
                                <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #99bd99;border-radius:6px;margin-bottom:24px;">
                                    <tr>
                                        <td style="padding:18px;">
                                            <span style="display:block;margin-bottom:6px;font-size:12px;font-weight:700;color:#99bd99;">
                                                Postup príchodu
                                            </span>

                                            <p style="margin:0;font-size:14px;line-height:1.7;color:#a6a6a6;">
                                                {{ $apartment->arrival_instructions }}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            {{-- Wi-Fi --}}
                            <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                Wi-Fi
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #a6a6a6;border-radius:6px;overflow:hidden;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Wi-Fi názov
                                        </span>

                                        <span style="display:block;font-size:15px;line-height:1.5;color:#a6a6a6;">
                                            {{ $apartment->wifi_name }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 18px;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Wi-Fi heslo
                                        </span>

                                        <span style="display:block;font-size:15px;line-height:1.5;font-weight:700;color:#a6a6a6;font-family:monospace;">
                                            {{ $apartment->wifi_password }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            {{-- Parkovanie --}}
                            <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                Parkovanie
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #a6a6a6;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:18px;">
                                        <p style="margin:0;font-size:14px;line-height:1.7;color:#a6a6a6;">
                                            {{ $apartment->parking_info }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Bazén --}}
                            <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                Bazén
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #99bd99;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:18px;">
                                        <p style="margin:0 0 14px;font-size:14px;line-height:1.7;color:#a6a6a6;">
                                            {{ $apartment->pool_info }}
                                        </p>

                                        <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="background-color:#99bd99;border-radius:6px;padding:10px 12px;">
                                                    <span style="font-size:13px;font-weight:700;color:#ffffff;">
                                                        Pri objednaní pred príchodom: 30 € / deň
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            {{-- Pravidlá pobytu --}}
                            <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                Pravidlá pobytu
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #a6a6a6;border-radius:6px;overflow:hidden;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Nočný kľud
                                        </span>

                                        <span style="display:block;font-size:14px;line-height:1.6;color:#a6a6a6;">
                                            {{ $apartment->quiet_hours }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #a6a6a6;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Fajčenie
                                        </span>

                                        <span style="display:block;font-size:14px;line-height:1.6;color:#a6a6a6;">
                                            {{ $apartment->smoking_policy }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 18px;">
                                        <span style="display:block;margin-bottom:4px;font-size:12px;font-weight:700;color:#99bd99;">
                                            Domáce zvieratá
                                        </span>

                                        <span style="display:block;font-size:14px;line-height:1.6;color:#a6a6a6;">
                                            {{ $apartment->pets_policy }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            {{-- Kontakt --}}
                            <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#a6a6a6;">
                                Kontakt
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #a6a6a6;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:18px;">
                                        <p style="margin:0;font-size:14px;line-height:1.7;color:#a6a6a6;">
                                            {{ $apartment->contact_info }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Footer note --}}
                            <p style="margin:28px 0 0;font-size:12px;line-height:1.6;color:#a6a6a6;">
                                Tento e-mail bol odoslaný automaticky po dokončení online check-inu. Prosím, neodpovedajte naň.
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
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
                            <h1 style="margin:0 0 8px;font-size:24px;font-weight:600;color:#0f172a;">Online check-in je dokončený</h1>
                            <p style="margin:0 0 24px;font-size:15px;color:#64748b;">Ďakujeme, vaše údaje boli úspešne odoslané.</p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Apartmán</span>
                                        <span style="font-size:15px;font-weight:600;color:#0f172a;">{{ $apartment->name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Adresa</span>
                                        <span style="font-size:15px;color:#0f172a;">{{ $apartment->address }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Check-in čas</span>
                                        <span style="font-size:15px;color:#0f172a;">{{ $apartment->checkin_time }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Prístupový kód</span>
                                        <span style="font-size:18px;font-weight:700;color:#0f172a;font-family:monospace;letter-spacing:0.05em;">{{ $apartment->access_code }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Wi-Fi názov</span>
                                        <span style="font-size:15px;color:#0f172a;">{{ $apartment->wifi_name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Wi-Fi heslo</span>
                                        <span style="font-size:15px;font-weight:600;color:#0f172a;font-family:monospace;">{{ $apartment->wifi_password }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Parkovanie</span>
                                        <span style="font-size:15px;color:#0f172a;">{{ $apartment->parking_info }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f1f5f9;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Bazén</span>
                                        <span style="font-size:15px;color:#0f172a;">{{ $apartment->pool_info }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <span style="font-size:13px;color:#64748b;display:block;margin-bottom:4px;">Kontakt</span>
                                        <span style="font-size:15px;color:#0f172a;">{{ $apartment->contact_info }}</span>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:24px 0 0;font-size:13px;color:#94a3b8;">Tento e-mail bol odoslaný automaticky po dokončení online check-inu. Prosím, neodpovedajte naň.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
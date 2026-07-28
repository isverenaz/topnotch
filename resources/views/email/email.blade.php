<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ !empty($data['name']) ? $data['name'] : null }} - Vakansiya Müraciəti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Vakansiya Məlumatları" name="description" />
    <meta content="afsi.gov.az" name="author" />
    <link rel="stylesheet" href="{{ asset('email/css/email.css') }}">
</head>
<body>
<div class="email-container">
        @if(!empty($data['type']) && $data['type'] == 'contact')
        <table>
            <tbody>
            <tr>
                <td>
                    <h2 class="page-title">Əlaqə Müraciəti - Bizimlə Əlaqə</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-body">
                        <p><strong>Müraciətçi adı:</strong> {{ $data['surname'] ?? '' }} {{ $data['name'] ?? '' }}</p>
                        <p><strong>E-poçt:</strong> {{ $data['email'] ?? 'N/A' }}</p>
                        <p><strong>Telefon:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
                        @if(!empty($data['note']))
                            <p><strong>Qeyd:</strong> {{ $data['note'] ?? 'N/A' }}</p>
                        @endif
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        @elseif(!empty($data['type']) && $data['type'] == 'study_abroad')
        <table>
            <tbody>
            <tr>
                <td>
                    <h2 class="page-title">Xaricdə təhsil müraciəti</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-body">
                        <p><strong>Müraciətçi adı:</strong> {{ $data['surname'] ?? '' }} {{ $data['name'] ?? '' }}</p>
                        <p><strong>E-poçt:</strong> {{ $data['email'] ?? 'N/A' }}</p>
                        <p><strong>Telefon:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
                        @if(!empty($data['study_title']))
                            <p><strong>Proqram:</strong> {{ $data['study_title'] }}</p>
                        @endif
                        @if(!empty($data['study_country']))
                            <p><strong>Ölkə:</strong> {{ $data['study_country'] }}</p>
                        @endif
                        @if(!empty($data['study_university']))
                            <p><strong>Universitet:</strong> {{ $data['study_university'] }}</p>
                        @endif
                        @if(!empty($data['study_degree']))
                            <p><strong>Dərəcə:</strong> {{ $data['study_degree'] }}</p>
                        @endif
                        @if(!empty($data['note']))
                            <p><strong>Qeyd:</strong> {{ $data['note'] ?? 'N/A' }}</p>
                        @endif
                        @if(!empty($data['study_url']))
                            <p><strong>Səhifə:</strong> <a href="{{ $data['study_url'] }}" target="_blank">{{ $data['study_url'] }}</a></p>
                        @endif
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        @endif
</div>
</body>
</html>

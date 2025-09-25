<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Code Preview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .qr-code {
            display: inline-block;
            border: 1px solid #ddd;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="company-name">
        {{ $record->company?->name ?? 'Untitled' }}
    </div>

    <div class="qr-code">
        @if (!empty($qr))
            <img src="{{ $qr }}" alt="QR Code">
        @else
            <p>No QR code available</p>
        @endif
    </div>
</body>

</html>

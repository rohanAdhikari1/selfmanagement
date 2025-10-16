<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Code Display</title>
    <style>
        /* General reset and font */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9fafc;
            color: #333;
            text-align: center;
            margin: 0;
        }

        /* Main container card */
        .qr-container {
            background: #fff;
            display: block;
            padding: 180px 0;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e6e6e6;
        }

        /* Company name styling */
        .company-name {
            font-size: 30px;
            font-weight: 700;
            color: #004aad;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        /* Record name or department */
        .record-name {
            font-size: 28px;
            font-weight: 500;
            color: #333;
            margin-bottom: 30px;
        }

        /* QR code section */
        .qr-code {
            display: inline-block;
            border: 2px dashed #004aad;
            border-radius: 12px;
            padding: 20px 16px;
            background: #f4f8ff;
        }

        .qr-code img {
            width: 460px;
            height: 460px;
        }

        /* Footer note */
        .note {
            margin-top: 25px;
            font-size: 20px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="qr-container">
        <div class="company-name">
            {{ $record->company?->name ?? 'Untitled Company' }}
        </div>

        <div class="record-name">
            {{ $record->name ?? 'Untitled Site' }}
        </div>

        <div class="qr-code">
            @if (!empty($qr))
                <img src="{{ $qr }}" alt="QR Code">
            @else
                <p>No QR code available</p>
            @endif
        </div>

        <div class="note">
            Scan this QR code to proceed task.
        </div>
    </div>
</body>

</html>

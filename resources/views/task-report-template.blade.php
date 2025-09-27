<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cleaner Task Report - {{ $record->report_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            padding: 30px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #4CAF50;
        }

        .report-info {
            margin-bottom: 30px;
        }

        .report-info div {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .task-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .task-images {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .task-images img {
            width: 45%;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <h1>Cleaner Task Report</h1>
            <div>{{ $record->report_number }}</div>
        </div>

        <div class="report-info">
            <div><strong>Site:</strong> {{ $record->site->name ?? 'N/A' }}</div>
            <div><strong>Cleaner:</strong> {{ $record->cleaner->full_name ?? 'N/A' }}</div>
            <div><strong>Entry At:</strong> {{ $record->attendance->start_time ?? 'N/A' }}</div>
            <div><strong>Exit At:</strong> {{ $record->attendance->end_time ?? 'N/A' }}</div>
            <div><strong>Date:</strong> {{ $record->created_at->format('Y-m-d') }}</div>
        </div>

        @foreach ($record->items as $index => $item)
            <div class="task-card">
                <div class="task-header">
                    <div>Task: {{ $item->task?->name ?? '-' }}</div>
                    <div>Start: {{ $item->start_time ?? '-' }} | Finish: {{ $item->finish_time ?? '-' }}</div>
                </div>

                @if ($item->before_image || $item->after_image)
                    <div class="task-images">
                        @if ($item->before_image)
                            <div>
                                <div><strong>Before</strong></div>
                                <img src="{{ Storage::temporary($img->file_path) }}" alt="Before Image">
                            </div>
                        @endif
                        @if ($item->after_image)
                            <div>
                                <div><strong>After</strong></div>
                                <img src="{{ Storage::temporary($item->after_image->file_path) }}" alt="After Image">
                            </div>
                        @endif
                    </div>
                @endif

                @if ($item->remarks)
                    <div style="margin-top:10px;"><strong>Remarks:</strong> {{ $item->remarks }}</div>
                @endif
            </div>
        @endforeach

        <div class="footer">
            Generated on {{ now()->format('d-m-Y H:i') }}
        </div>

    </div>
</body>

</html>

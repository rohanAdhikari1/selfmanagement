<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cleaning Inspection Report</title>
    <style>
        :root {
            --primary-color: #2563eb;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 0;
            background: #fff;
        }

        .report {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
        }

        /* Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            border-bottom: 3px solid var(--primary-color);
        }

        .header-left img {
            height: 50px;
            width: auto;
        }

        .header-left h1 {
            margin: 0;
            font-size: 20px;
            color: var(--primary-color);
        }

        .header-left p {
            margin: 0;
            font-size: 10px;
            color: #475569;
        }

        .header-right {
            text-align: right;
            font-size: 10px;
            color: #475569;
            white-space: nowrap;
        }

        /* Overall Points */
        .overall-points {
            font-weight: bold;
            font-size: 14px;
            color: var(--primary-color);
            margin-bottom: 10px;
            background: #e0f2fe;
            display: inline-block;
            padding: 6px 10px;
            border-radius: 6px;
        }

        /* Task title */
        .task-title {
            font-size: 14px;
            font-weight: bold;
            color: var(--primary-color);
            margin-top: 15px;
            margin-bottom: 6px;
        }

        /* Questions Table */
        .question-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .question-table td {
            padding: 6px 10px;
            vertical-align: top;
        }

        .answer-cell {
            text-align: right;
        }

        .answer-badge {
            color: #fff;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 12px;
            display: inline-block;
        }

        .excellent {
            background-color: #16a34a;
        }

        .good {
            background-color: #facc15;
            color: #000;
        }

        .poor {
            background-color: #dc2626;
        }

        /* Remarks */
        .remarks {
            font-size: 11px;
            color: #475569;
            margin: 4px 0 4px 0;
        }

        /* Question images */
        .q-images {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 8px;
        }

        .q-images img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }

        /* Divider after each question */
        .divider {
            border: none;
            border-bottom: 1px solid #e2e8f0;
            margin: 4px 0;
        }

        /* Checklist */
        .checklist {
            margin-top: 12px;
            margin-bottom: 12px;
        }

        .checklist h3 {
            font-size: 13px;
            color: var(--primary-color);
            margin-bottom: 4px;
        }

        .checklist ul {
            margin: 0;
            padding-left: 16px;
            font-size: 11px;
        }

        .checklist li {
            margin-bottom: 2px;
        }

        /* Signature */
        .signature {
            margin-top: 12px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .signature img {
            width: 120px;
            height: auto;
        }

        .signature p {
            font-size: 10px;
            color: #475569;
            margin-top: 2px;
        }

        /* All images */
        .all-images {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .all-images img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }

        /* Footer */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            border-top: 1px solid #e2e8f0;
            font-size: 0.9em;
            color: #94a3b8;
            width: 100%;
            padding: 5px 10px;
        }

        .page-number:before {
            content: "Page " counter(page) " of " counter(pages);
            position: absolute;
            right: 10px;
            bottom: 5px;
        }

        .footer-left {
            position: absolute;
            left: 10px;
            bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="report">

        <!-- Header -->
        <table class="header-table">
            <tr>
                <td style="width:70%;">
                    <table style="border-collapse:collapse;">
                        <tr>
                            <td style="padding-right:8px;"><img src="company-logo.png" alt="Logo"></td>
                            <td style="vertical-align:top;">
                                <h1>Cleaning Inspection Report</h1>
                                <p>SparkClean Facility Services</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width:30%;">
                    <div class="header-right">
                        <p><strong>Date:</strong> Oct 12, 2025</p>
                        <p><strong>Inspector:</strong> John Doe</p>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Overall Points -->
        <div class="overall-points">Overall Points: 52 / 55</div>

        <!-- Task 1 -->
        <div class="task-title">Restroom Cleaning (28 / 30)</div>

        <table class="question-table">
            <tr>
                <td>Are sinks and counters free of stains and debris?</td>
                <td class="answer-cell"><span class="answer-badge excellent">Excellent</span></td>
            </tr>
        </table>
        <p class="remarks">Minor watermarks near faucet; cleaned during recheck.</p>
        <div class="q-images">
            <img src="sink_before.jpg" alt="Image">
            <img src="sink_after.jpg" alt="Image">
        </div>
        <hr class="divider">

        <table class="question-table">
            <tr>
                <td>Are mirrors streak-free and polished?</td>
                <td class="answer-cell"><span class="answer-badge good">Good</span></td>
            </tr>
        </table>
        <p class="remarks">Slight streaks near edges.</p>
        <hr class="divider">

        <!-- Task 2 -->
        <div class="task-title">Office Area Cleaning (24 / 25)</div>
        <table class="question-table">
            <tr>
                <td>Are desks and surfaces dust-free?</td>
                <td class="answer-cell"><span class="answer-badge excellent">Excellent</span></td>
            </tr>
            <tr>
                <td>Are trash bins emptied?</td>
                <td class="answer-cell"><span class="answer-badge excellent">Excellent</span></td>
            </tr>
        </table>
        <hr class="divider">

        <!-- Checklist -->
        <div class="checklist">
            <h3>Material Availability</h3>
            <ul>
                <li>Cleaning detergents: Available</li>
                <li>Mop & Broom: Available</li>
                <li>Trash bags: Missing</li>
                <li>Gloves & Masks: Available</li>
            </ul>
        </div>

        <!-- Signature -->
        <div class="signature">
            <div>
                <img src="signature.png" alt="Signature">
                <p>John Doe</p>
            </div>
            <div>
                <p style="font-size:9px; color:#94a3b8;">Generated: Oct 12, 2025</p>
            </div>
        </div>

        <!-- All images -->
        <div class="all-images">
            <img src="office_desk.jpg" alt="Image">
            <img src="trash_bin.jpg" alt="Image">
        </div>

        <!-- Footer -->
        <footer>
            <div class="footer-left">© 2025 SparkClean Facility Services</div>
            <div class="page-number"></div>
        </footer>

    </div>
</body>

</html>

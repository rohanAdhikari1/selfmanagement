<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Commercial Cleaning Inspection</title>
    <style>
        /* DOMPDF COMPATIBILITY SETTINGS */
        @page {
            margin: 0px;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            /* Use standard fonts for PDF stability */
            font-size: 12px;
            color: #1e293b;
            margin: 0;
            padding: 30px;
            background: #ffffff;
            /* White bg is better for print */
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            vertical-align: top;
        }

        /* UTILITIES */
        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-secondary {
            color: #64748b;
        }

        .text-primary {
            color: #2563eb;
        }

        /* HEADER */
        .header-table {
            margin-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }

        .header-brand-img {
            width: 50px;
            padding-right: 15px;
        }

        .header-title h1 {
            margin: 0;
            font-size: 24px;
            color: #2563eb;
        }

        .header-title p {
            margin: 2px 0 0;
            font-size: 16px;
            color: #64748b;
        }

        .confidential-badge {
            font-size: 10px;
            color: #b91c1c;
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            padding: 2px 6px;
            border-radius: 4px;
            /* Reduced radius for PDF */
            text-transform: uppercase;
            display: inline-block;
        }

        /* OVERALL SCORE */
        .score-box {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 13px;
            display: inline-block;
            /* Helps width in PDF */
            margin-bottom: 20px;
        }

        /* CHECKLIST / SUMMARY */
        .checklist-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .checklist-title {
            color: #2563eb;
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 10px 0;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .checklist-item {
            padding-bottom: 4px;
        }

        /* TASK SECTIONS */
        .task-header {
            background-color: #f1f5f9;
            border-left: 4px solid #2563eb;
            padding: 8px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 14px;
        }

        /* QUESTION ITEMS (Converted to Table) */
        .question-table {
            margin-bottom: 8px;
            page-break-inside: avoid;
            /* Prevent splitting row across pages */
            border: 1px solid #e2e8f0;
        }

        .question-table td {
            padding: 10px;
            vertical-align: middle;
        }

        .q-text {
            color: #334155;
            font-weight: 500;
        }

        /* BADGES */
        .badge {
            font-size: 10px;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 10px;
            text-transform: uppercase;
            text-align: center;
            display: inline-block;
            min-width: 40px;
        }

        .badge-excellent {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-good {
            background-color: #fef9c3;
            color: #854d0e;
        }

        .badge-poor {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* FOOTER */
        .footer {
            position: fixed;
            bottom: -20px;
            /* Adjust based on margin */
            left: 0;
            right: 0;
            height: 30px;
            font-size: 10px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
        }

        .page-number:after {
            content: counter(page);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td style="width: 60px;">
                <!-- Use public_path() for images -->
                <!-- Example: <img src="{{ public_path('images/logo.png') }}" class="header-brand-img"> -->
                <!-- For testing without real image: -->
                <div style="width: 50px; height: 50px; background: #eee; border-radius: 4px;"></div>
            </td>
            <td>
                <div class="header-title">
                    <h1>Commercial Cleaning Inspection</h1>
                    <p>TESKI CLEANING</p>
                </div>
            </td>
            <td class="text-right" style="width: 180px;">
                <div class="confidential-badge">Private & Confidential</div>
                <p class="text-secondary" style="margin: 5px 0 0;">
                    <strong>Date:</strong> 22.08.2025<br>
                    <strong>Ref:</strong> #INS-2025-001
                </p>
            </td>
        </tr>
    </table>

    <!-- Overall Score -->
    <div class="score-box">
        Overall Score: 346 / 361 (95.85%)
    </div>

    <!-- Summary Section -->
    <div class="checklist-box">
        <div class="checklist-title">Perth Radiological Clinic - Armadale North</div>
        <table>
            <tr>
                <td width="50%" class="checklist-item">Conducted On: <strong>22.08.2025</strong></td>
                <td width="50%" class="checklist-item">Contractor: <strong>Steven McGarry</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="checklist-item">Method: <strong>Client Attended Inspection</strong></td>
            </tr>
        </table>
    </div>

    <!-- Inspection Details -->
    <div class="task-section">
        <div class="task-header">
            Inspection Details
        </div>

        <!-- Question 1 -->
        <table class="question-table">
            <tr>
                <td class="q-text">General cleanliness of reception area</td>
                <td style="width: 60px; text-align: right;">
                    <span class="badge badge-excellent">Pass</span>
                </td>
            </tr>
        </table>

        <!-- Question 2 -->
        <table class="question-table">
            <tr>
                <td class="q-text">Floors swept and mopped</td>
                <td style="width: 60px; text-align: right;">
                    <span class="badge badge-good">Pass</span>
                </td>
            </tr>
        </table>

        <!-- Question 3 (Example Fail) -->
        <table class="question-table">
            <tr>
                <td class="q-text">Dusting of high surfaces</td>
                <td style="width: 60px; text-align: right;">
                    <span class="badge badge-poor">Fail</span>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 10px;">
        <table style="width: 100%">
            <tr>
                <td>
                    <!-- Signature Image -->
                    <!-- <img src="{{ public_path('images/signature.png') }}" style="height: 40px;"> -->
                    <div style="height: 40px; border-bottom: 1px solid #000; width: 150px;"></div>
                    <p style="margin: 5px 0 0; font-weight: bold;">Steven McGarry</p>
                </td>
                <td class="text-right" style="vertical-align: bottom;">
                    <p style="color: #94a3b8; font-size: 10px;">Generated: 22.08.2025</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <table style="width: 100%;">
            <tr>
                <td>Inspection Report for Perth Radiological Clinic</td>
                <td class="text-right">Page <span class="page-number"></span></td>
            </tr>
        </table>
    </div>

</body>

</html>
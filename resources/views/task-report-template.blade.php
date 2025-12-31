<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cleaning Inspection Report</title>
    <style>
        /* DOMPDF SETTINGS */
        @page {
            margin: 0px;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 30px;
            /* Internal margin */
            line-height: 1.4;
        }

        /* RESET & UTILITIES */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        td {
            vertical-align: top;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-secondary {
            color: #64748b;
        }

        /* HEADER */
        .header-container {
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            /* Primary Blue */
            margin: 0;
        }

        .company-sub {
            font-size: 14px;
            color: #64748b;
            margin: 2px 0 0;
        }

        /* OVERALL SCORE */
        .score-box {
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            color: #2563eb;
            font-weight: bold;
            font-size: 13px;
            padding: 8px 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: inline-block;
        }

        /* TASKS SECTIONS */
        .section-title {
            background-color: #f8fafc;
            /* Optional: adds subtle header bg */
            border-left: 4px solid #2563eb;
            padding: 8px 10px;
            margin-bottom: 10px;
            color: #1e293b;
            font-weight: bold;
            font-size: 14px;
        }

        .section-score {
            float: right;
            color: #64748b;
            font-weight: normal;
            font-size: 12px;
        }

        /* QUESTION TABLES */
        .question-table {
            border: 1px solid #e2e8f0;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .question-table td {
            padding: 8px 10px;
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
            padding: 3px 8px;
            border-radius: 10px;
            /* DomPDF renders this okay, often looks square though */
            text-transform: uppercase;
            display: inline-block;
            text-align: center;
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

        /* REMARKS */
        .remarks-row td {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 11px;
            border-top: 1px solid #e2e8f0;
            padding: 6px 10px;
        }

        /* IMAGES IN QUESTIONS */
        .img-row td {
            padding-top: 5px;
            padding-bottom: 10px;
        }

        .q-img {
            width: 50px;
            height: 50px;
            border: 1px solid #e2e8f0;
            margin-right: 5px;
            display: inline-block;
        }

        /* CHECKLIST */
        .checklist-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 15px;
            border-radius: 4px;
            margin-top: 10px;
            page-break-inside: avoid;
        }

        .checklist-header {
            color: #2563eb;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .check-item {
            padding: 4px 0;
            font-size: 12px;
        }

        .dot {
            color: #2563eb;
            font-size: 16px;
            line-height: 10px;
            margin-right: 5px;
        }

        .missing-item {
            color: #991b1b;
        }

        .missing-dot {
            color: #ef4444;
        }

        /* FOOTER SIGNATURES */
        .signature-section {
            margin-top: 30px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            page-break-inside: avoid;
        }

        .sig-img {
            height: 40px;
            margin-bottom: 5px;
        }

        .footer-fixed {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 30px;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
            font-size: 10px;
            color: #94a3b8;
        }

        .page-number:after {
            content: counter(page);
        }

        /* GALLERY AT BOTTOM */
        .gallery-img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            margin-right: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <table class="header-container">
        <tr>
            <td style="width: 60px;">
                <!-- Placeholder for logo. In Laravel: <img src="{{ public_path('images/company-logo.png') }}" class="logo"> -->
                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 4px;"></div>
            </td>
            <td>
                <h1 class="company-name">Cleaning Inspection Report</h1>
                <p class="company-sub">SparkClean Facility Services Private Limited.</p>
            </td>
            <td class="text-right" style="width: 200px;">
                <p style="margin: 0;">
                    <span class="text-secondary">Date:</span> <strong>Oct 12, 2025</strong><br>
                    <span class="text-secondary">Inspector:</span> <strong>John Doe</strong>
                </p>
            </td>
        </tr>
    </table>

    <!-- Overall Score -->
    <div class="score-box">
        Overall Points: 52 / 55
    </div>

    <!-- Task 1: Restroom -->
    <div style="margin-bottom: 20px;">
        <div class="section-title">
            Restroom Cleaning
            <span class="section-score">(28 / 30)</span>
        </div>

        <!-- Question 1 -->
        <table class="question-table">
            <tr>
                <td class="q-text">Are sinks and counters free of stains and debris?</td>
                <td style="width: 80px; text-align: right;">
                    <span class="badge badge-excellent">Excellent</span>
                </td>
            </tr>
            <!-- Remarks Row -->
            <tr class="remarks-row">
                <td colspan="2">
                    Minor watermarks near faucet; cleaned during recheck.
                </td>
            </tr>
            <!-- Images Row -->
            <tr class="img-row">
                <td colspan="2">
                    <!-- Use public_path() for images -->
                    <div class="q-img" style="background:#eee;"></div>
                    <div class="q-img" style="background:#ddd;"></div>
                </td>
            </tr>
        </table>

        <!-- Question 2 -->
        <table class="question-table">
            <tr>
                <td class="q-text">Are mirrors streak-free and polished?</td>
                <td style="width: 80px; text-align: right;">
                    <span class="badge badge-good">Good</span>
                </td>
            </tr>
            <tr class="remarks-row">
                <td colspan="2">Slight streaks near edges.</td>
            </tr>
        </table>
    </div>

    <!-- Task 2: Office Area -->
    <div style="margin-bottom: 20px;">
        <div class="section-title">
            Office Area Cleaning
            <span class="section-score">(24 / 25)</span>
        </div>

        <table class="question-table">
            <tr>
                <td class="q-text">Are desks and surfaces dust-free?</td>
                <td style="width: 80px; text-align: right;">
                    <span class="badge badge-excellent">Excellent</span>
                </td>
            </tr>
        </table>

        <table class="question-table">
            <tr>
                <td class="q-text">Are trash bins emptied?</td>
                <td style="width: 80px; text-align: right;">
                    <span class="badge badge-excellent">Excellent</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Checklist (Converted from Grid to Table columns) -->
    <div class="checklist-box">
        <div class="checklist-header">Material Availability</div>
        <table>
            <tr>
                <!-- Column 1 -->
                <td width="50%" class="check-item">
                    <span class="dot">&bull;</span> Cleaning detergents: <strong>Available</strong>
                </td>
                <!-- Column 2 -->
                <td width="50%" class="check-item">
                    <span class="dot">&bull;</span> Mop & Broom: <strong>Available</strong>
                </td>
            </tr>
            <tr>
                <!-- Column 1 -->
                <td width="50%" class="check-item missing-item">
                    <span class="dot missing-dot">&bull;</span> Trash bags: <strong>Missing</strong>
                </td>
                <!-- Column 2 -->
                <td width="50%" class="check-item">
                    <span class="dot">&bull;</span> Gloves & Masks: <strong>Available</strong>
                </td>
            </tr>
        </table>
    </div>

    <!-- Signature & Bottom Gallery -->
    <div class="signature-section">
        <table>
            <tr>
                <td width="50%">
                    <!-- Signature Image -->
                    <!-- <img src="{{ public_path('images/signature.png') }}" class="sig-img"> -->
                    <div style="height:40px; border-bottom:1px solid #000; width:150px; margin-bottom:5px;"></div>
                    <p style="margin:0; font-weight:bold;">John Doe</p>
                </td>
                <td width="50%" class="text-right" style="vertical-align: bottom;">
                    <p class="text-secondary" style="font-size:11px;">Generated: Oct 12, 2025</p>
                </td>
            </tr>
        </table>

        <div style="margin-top: 15px;">
            <!-- Gallery Images -->
            <div class="gallery-img" style="background:#eee;"></div>
            <div class="gallery-img" style="background:#ddd;"></div>
        </div>
    </div>

    <!-- Fixed Footer -->
    <div class="footer-fixed">
        <table>
            <tr>
                <td>&copy; 2025 SparkClean Facility Services</td>
                <td class="text-right">Page <span class="page-number"></span></td>
            </tr>
        </table>
    </div>

</body>

</html>
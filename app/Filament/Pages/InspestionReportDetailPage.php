<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class InspestionReportDetailPage extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'inspection-report-detail';

    protected string $view = 'filament.pages.inspestion-resport-detail-page';
}

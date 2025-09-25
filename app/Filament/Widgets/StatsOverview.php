<?php

namespace App\Filament\Widgets;

use App\Models\Cleaner;
use App\Models\CleanerAttendance;
use App\Models\Company;
use App\Models\Site;
use App\Models\Task;
use App\Models\UserEnrollment;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    use HasWidgetShield;

    protected function getStats(): array
    {
        if (auth()->user()->hasRole('cleaner')) {
            return $this->userStats();
        } elseif (auth()->user()->hasRole('site_user')) {
            return $this->siteStats();
        } elseif (auth()->user()->hasRole('company_user')) {
            return $this->clientStats();
        } else {
            return $this->adminStats();
        }
    }

    protected function getColumns(): int | array | null
    {
        if (auth()->user()->hasRole('cleaner')) {
            return ['@xl' => 3];
        } elseif (auth()->user()->hasRole('site_user')) {
            return ['@xl' => 3];
        } elseif (auth()->user()->hasRole('company_user')) {
            return ['@xl' => 3];
        } else {
            return ['@xl' => 4];
        }
    }


    protected function adminStats(): array
    {
        $total_active_cleaner_today = CleanerAttendance::whereDate('updated_at', Carbon::today())
            ->distinct('cleaner_id')
            ->count('cleaner_id');

        return [
            Stat::make('Clients', Company::count())
                ->description('Total registered clients')
                ->icon(Heroicon::BuildingOffice)
                ->color('primary'),
            Stat::make('Sites', Site::count())
                ->description('Active work sites')
                ->icon(Heroicon::BuildingOffice2)
                ->color('primary'),
            Stat::make('Cleaners', Cleaner::count())
                ->description('Total registered cleaners')
                ->icon(Heroicon::UserGroup)
                ->color('primary'),
            Stat::make('Tasks', Task::count())
                ->description('Total Tasks')
                ->icon(Heroicon::ClipboardDocumentList)
                ->color('primary'),

            Stat::make('Today Active Cleaners', $total_active_cleaner_today)
                ->description('Total Cleaners active today')
                ->icon(Heroicon::User)
                ->color('success'),
        ];
    }

    protected function clientStats(): array
    {
        return [
            Stat::make('Sites', Site::where('company_id', auth()->user()->company_id)->count())
                ->description('Active work sites')
                ->icon(Heroicon::BuildingOffice2)
                ->color('success'),
            Stat::make('Cleaners', UserEnrollment::whereHas('site', function ($query) {
                $query->where('company_id', auth()->user()->company_id);
            })->count())
                ->description('Total registered cleaners')
                ->icon(Heroicon::UserGroup)
                ->color('warning'),
            Stat::make('Tasks', Task::count())
                ->description('Total Tasks')
                ->icon(Heroicon::ClipboardDocumentList)
                ->color('danger'),
        ];
    }

    protected function siteStats(): array
    {
        return [
            Stat::make('Cleaners', UserEnrollment::whereHas('site_id', auth()->user()->site_id)->count())
                ->description('Total registered cleaners')
                ->icon(Heroicon::UserGroup)
                ->color('warning'),
            Stat::make('Tasks', Cleaner::count())
                ->description('Total Tasks')
                ->icon(Heroicon::ClipboardDocumentList)
                ->color('danger'),
        ];
    }

    protected function userStats(): array
    {
        return [
            Stat::make('Tasks', Cleaner::count())
                ->description('Total Tasks')
                ->icon(Heroicon::ClipboardDocumentList)
                ->color('danger'),
        ];
    }
}

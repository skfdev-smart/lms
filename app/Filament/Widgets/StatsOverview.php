<?php

namespace App\Filament\Widgets;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Learners', User::count())
                ->description('Active registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Active Courses', Course::where('is_published', true)->count())
                ->description('Courses available for enrollment')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),

            Stat::make('Certificates Issued', Certificate::count())
                ->description('Total certifications granted')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning')
                ->chart([1, 5, 2, 8, 4, 10, 12]),
        ];
    }
}

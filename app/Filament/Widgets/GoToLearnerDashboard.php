<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget as BaseWidget;

class GoToLearnerDashboard extends BaseWidget
{
    protected static ?int $sort = -10;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.widgets.admin-dashboard-header';
}

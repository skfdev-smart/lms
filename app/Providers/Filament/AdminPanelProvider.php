<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            // ->login(\App\Filament\Pages\Auth\Login::class)
            ->brandName('PT SPINDO LMS') 
            ->font('Raleway')
            ->colors([
                'primary' => '#DA251D',
                'gray' => Color::Slate,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn (): string => new \Illuminate\Support\HtmlString('
                    <style>
                        /* Raleway Font Global for Admin */
                        body {
                            font-family: "Raleway", sans-serif !important;
                        }

                        /* ============ LIGHT MODE ENHANCEMENTS ============ */
                        
                        /* Main Content Area - Soft Off-White */
                        .fi-main {
                            background-color: #f8fafc !important; /* Slate 50 */
                        }

                        /* Statistics Widgets - Premium Cards */
                        .fi-wi-stats-overview-stat {
                            background: white !important;
                            border: 1px solid #e2e8f0 !important; /* Slate 200 */
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05) !important;
                            border-radius: 1rem !important;
                        }

                        .fi-wi-stats-overview-stat:hover {
                            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08) !important;
                            border-color: #cbd5e1 !important;
                            transform: translateY(-2px);
                        }

                        /* Sections & Cards */
                        .fi-section, .fi-wi-account {
                            background: white !important;
                            border: 1px solid #e2e8f0 !important;
                            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1) !important;
                            border-radius: 1rem !important;
                        }

                        /* Sidebar - Subtle Separation */
                        .fi-sidebar {
                            background-color: #ffffff !important;
                            border-right: 1px solid #e2e8f0 !important;
                        }

                        /* Buttons - Premium Primary */
                        .fi-btn-primary {
                            background: linear-gradient(135deg, #DA251D, #b91c1c) !important;
                            box-shadow: 0 4px 10px rgba(218, 37, 29, 0.3) !important;
                            border: none !important;
                        }

                        .fi-btn-primary:hover {
                            box-shadow: 0 6px 15px rgba(218, 37, 29, 0.4) !important;
                            transform: scale(1.02);
                        }

                        /* ============ DARK THEME SCOPED ============ */
                        
                        /* Main Content Area */
                        .dark .fi-main {
                            background-color: #0f172a !important; /* Slate 900 */
                        }
                        
                        /* Top Navigation Bar */
                        .dark .fi-topbar {
                            background-color: #111827 !important;
                            border-bottom: 1px solid #1e293b !important;
                        }
                        
                        /* Sidebar Background */
                        .dark .fi-sidebar {
                            background-color: #111827 !important;
                            border-right-color: #1e293b !important;
                        }
                        
                        /* Sidebar Navigation Text */
                        .dark .fi-sidebar-item-label {
                            color: #e5e7eb !important;
                        }
                        
                        /* Sidebar Icons */
                        .dark .fi-sidebar-item-icon {
                            color: #9ca3af !important;
                        }

                        /* Hover State */
                        .dark .fi-sidebar-item:hover {
                            background-color: rgba(218, 37, 29, 0.1) !important;
                        }
                        .dark .fi-sidebar-item:hover .fi-sidebar-item-label {
                            color: #ffffff !important;
                        }

                        /* Active State */
                        .dark .fi-sidebar-item.fi-active {
                            background-color: #DA251D !important;
                        }
                        .dark .fi-sidebar-item.fi-active .fi-sidebar-item-label,
                        .dark .fi-sidebar-item.fi-active .fi-sidebar-item-icon {
                            color: #ffffff !important;
                        }
                        
                        /* Group Labels */
                        .dark .fi-sidebar-group-label {
                            color: #9ca3af !important;
                            text-transform: uppercase;
                            font-size: 0.7rem;
                            letter-spacing: 0.1em;
                        }
                        
                        /* ============ STATS WIDGETS (DARK) ============ */
                        
                        .dark .fi-wi-stats-overview-stat {
                            background: linear-gradient(145deg, #1e293b, #0f172a) !important;
                            border: 1px solid #334155 !important;
                            border-radius: 0.75rem !important;
                            box-shadow: none !important;
                        }
                        
                        .dark .fi-wi-stats-overview-stat:hover {
                            border-color: rgba(218, 37, 29, 0.5) !important;
                            box-shadow: 0 0 20px rgba(218, 37, 29, 0.15) !important;
                        }
                        
                        .dark .fi-wi-stats-overview-stat-value {
                            color: #ffffff !important;
                        }
                        
                        .dark .fi-wi-stats-overview-stat-label {
                            color: #94a3b8 !important;
                        }
                        
                        .dark .fi-wi-stats-overview-stat-description {
                            color: #64748b !important;
                        }
                        
                        /* ============ CARDS & SECTIONS (DARK) ============ */
                        
                        .dark .fi-section, .dark .fi-wi-account {
                            background: linear-gradient(145deg, #1e293b, #0f172a) !important;
                            border: 1px solid #334155 !important;
                            box-shadow: none !important;
                        }
                        
                        .dark .fi-section-header {
                            border-bottom-color: #334155 !important;
                        }
                        
                        .dark .fi-section-header-heading {
                            color: #ffffff !important;
                        }
                        
                        /* ============ TABLES (DARK) ============ */
                        
                        .dark .fi-ta-table {
                            background-color: transparent !important;
                        }
                        
                        .dark .fi-ta-header-cell {
                            background-color: #1e293b !important;
                            color: #94a3b8 !important;
                        }
                        
                        .dark .fi-ta-row {
                            background-color: #0f172a !important;
                            border-bottom: 1px solid #1e293b !important;
                        }
                        
                        .dark .fi-ta-cell {
                            color: #e2e8f0 !important;
                        }
                        
                        /* ============ PAGE HEADER (DARK) ============ */
                        
                        .dark .fi-header-heading {
                            color: #ffffff !important;
                        }
                        
                        .dark .fi-header-subheading {
                            color: #94a3b8 !important;
                        }
                        
                        /* ============ SCROLLBAR STYLING ============ */
                        
                        ::-webkit-scrollbar {
                            width: 8px;
                            height: 8px;
                        }
                        
                        ::-webkit-scrollbar-track {
                            background: transparent;
                        }
                        
                        ::-webkit-scrollbar-thumb {
                            background: #cbd5e1;
                            border-radius: 4px;
                        }
                        
                        .dark ::-webkit-scrollbar-thumb {
                            background: #334155;
                        }
                        
                        ::-webkit-scrollbar-thumb:hover {
                            background: #DA251D;
                        }
                    </style>
                '),
            );
    }
}

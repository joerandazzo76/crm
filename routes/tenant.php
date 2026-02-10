<?php

declare(strict_types=1);

use App\Livewire\Auth\Login;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Contacts\ContactIndex;
use App\Livewire\Contacts\ContactCreate;
use App\Livewire\Contacts\ContactShow;
use App\Livewire\Companies\CompanyIndex;
use App\Livewire\Companies\CompanyCreate;
use App\Livewire\Companies\CompanyShow;
use App\Livewire\Dashboard;
use App\Livewire\Deals\DealIndex;
use App\Livewire\Deals\DealCreate;
use App\Livewire\Deals\DealKanban;
use App\Livewire\Deals\DealShow;
use App\Livewire\Emails\EmailIndex;
use App\Livewire\Emails\EmailCompose;
use App\Livewire\Reports\ReportIndex;
use App\Livewire\Settings\GeneralSettings;
use App\Livewire\Settings\PipelineSettings;
use App\Livewire\Settings\TeamMembers;
use App\Livewire\Settings\CustomFields;
use App\Livewire\Settings\Profile;
use App\Livewire\Tasks\TaskIndex;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', Login::class)->name('login');
        Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    });

    // Auth routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', function () {
            auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/login');
        })->name('logout');

        Route::get('/', Dashboard::class)->name('dashboard');

        // Contacts
        Route::get('/contacts', ContactIndex::class)->name('contacts.index');
        Route::get('/contacts/create', ContactCreate::class)->name('contacts.create');
        Route::get('/contacts/{contact}', ContactShow::class)->name('contacts.show');
        Route::get('/contacts/{contact}/edit', ContactCreate::class)->name('contacts.edit');

        // Companies
        Route::get('/companies', CompanyIndex::class)->name('companies.index');
        Route::get('/companies/create', CompanyCreate::class)->name('companies.create');
        Route::get('/companies/{company}', CompanyShow::class)->name('companies.show');
        Route::get('/companies/{company}/edit', CompanyCreate::class)->name('companies.edit');

        // Deals
        Route::get('/deals', DealIndex::class)->name('deals.index');
        Route::get('/deals/kanban', DealKanban::class)->name('deals.kanban');
        Route::get('/deals/create', DealCreate::class)->name('deals.create');
        Route::get('/deals/{deal}', DealShow::class)->name('deals.show');
        Route::get('/deals/{deal}/edit', DealCreate::class)->name('deals.edit');

        // Tasks
        Route::get('/tasks', TaskIndex::class)->name('tasks.index');

        // Emails
        Route::get('/emails', EmailIndex::class)->name('emails.index');
        Route::get('/emails/compose', EmailCompose::class)->name('emails.compose');

        // Reports
        Route::get('/reports', ReportIndex::class)->name('reports.index');

        // Settings (profile for all, rest admin/manager only)
        Route::get('/settings/profile', Profile::class)->name('settings.profile');
        Route::middleware('role:admin,manager')->group(function () {
            Route::get('/settings', GeneralSettings::class)->name('settings.general');
            Route::get('/settings/pipeline', PipelineSettings::class)->name('settings.pipeline');
            Route::get('/settings/team', TeamMembers::class)->name('settings.team');
            Route::get('/settings/custom-fields', CustomFields::class)->name('settings.custom-fields');
        });
    });
});

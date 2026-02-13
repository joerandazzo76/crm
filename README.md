# CRM SaaS

A full-featured, multi-tenant CRM (Customer Relationship Management) application built as a SaaS platform.

## Tech Stack

- **Backend:** Laravel 12, PHP 8.4
- **Frontend:** Livewire 4, Tailwind CSS v4, Alpine.js
- **Multi-Tenancy:** stancl/tenancy v3 (database-per-tenant, subdomain identification)
- **Build:** Vite 7
- **Import/Export:** maatwebsite/excel
- **Billing (optional):** Laravel Cashier (Stripe)
- **Permissions:** Role-based (admin, manager, member)
- **coderabbit**

## Features

### Core CRM
- **Contacts** - Full CRUD with search, filtering, sorting, pagination, and CSV import/export
- **Companies** - Company management linked to contacts, with CSV export
- **Deals & Pipeline** - Deal tracking with drag-and-drop Kanban board, multiple pipelines, and stage management
- **Tasks** - Task management with priorities, due dates, and polymorphic linking to contacts/companies/deals
- **Notes** - Polymorphic notes on contacts, companies, and deals
- **Emails** - Email composition and tracking per contact/deal
- **Activity Timeline** - Automatic activity logging across all modules

### Dashboard & Reports
- Stats overview (contacts, deals, revenue, tasks)
- Pipeline funnel chart
- Revenue trend chart
- Recent activities feed
- Sales pipeline, revenue forecast, activity, and contact growth reports

### Multi-Tenancy
- Each tenant gets an isolated database (subdomain-based routing)
- Central marketing site with registration and pricing
- Automatic tenant database provisioning on signup
- Default sales pipeline seeded per tenant

### Admin Panel (God Mode)
- Separate auth guard for central administrators
- View all tenants, their users, and usage stats
- Tenant detail view with contact/company/deal/task counts
- Tenant management (delete tenants)

### Settings & Customization
- **General Settings** - Organization info, usage stats, timezone/currency/date format preferences
- **Pipeline Settings** - Create/delete pipelines, add/remove stages with colors
- **Custom Fields** - Per-module (contacts, companies, deals) custom fields with types: text, number, date, dropdown, textarea, checkbox
- **Team Management** - Add/remove team members with role assignment
- **Profile** - Update name, email, phone, timezone, and password
- **Global Search** - Search across contacts, companies, and deals from the top bar
- **Role-Based Access** - Admin-only settings tabs hidden from regular members

## Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/joerandazzo76/crm.git crm
   cd crm
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Edit `.env` with your database and domain settings:
   ```env
   APP_URL=http://localhost:8888
   APP_DOMAIN=localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=crm_central
   DB_USERNAME=root
   DB_PASSWORD=your-password

   SESSION_DRIVER=file
   SESSION_DOMAIN=null
   ```

4. **Create the central database:**
   ```sql
   CREATE DATABASE crm_central;
   ```

5. **Run migrations and seeders:**
   ```bash
   php artisan migrate
   php artisan db:seed --class=PlanSeeder
   php artisan db:seed --class=AdminUserSeeder
   ```

6. **Build assets:**
   ```bash
   npm run build
   ```

7. **Start the server:**
   ```bash
   php artisan serve --host=0.0.0.0 --port=8888
   ```

## Usage

### Central Site
- **Landing page:** `http://localhost:8888/`
- **Register a tenant:** `http://localhost:8888/register`
- **Central login (tenant selector):** `http://localhost:8888/login`
- **Admin login:** `http://localhost:8888/admin/login` (default: `admin@crm.com` / `admin123`)

### Tenant App
- Access via subdomain: `http://{subdomain}.localhost:8888/`
- Login with the credentials created during tenant registration

### Seeding Demo Data
```bash
php artisan db:seed --class=DemoTenantSeeder
```
This creates a `demo` tenant accessible at `http://demo.localhost:8888/`.

## Project Structure

```
app/
  Http/Middleware/       # CheckRole, AdminAuth
  Livewire/
    Admin/               # AdminLogin, AdminDashboard, TenantShow
    Auth/                # Login, Register, ForgotPassword
    Companies/           # CompanyIndex, CompanyCreate, CompanyShow
    Contacts/            # ContactIndex, ContactCreate, ContactShow
    Deals/               # DealIndex, DealKanban, DealCreate, DealShow
    Emails/              # EmailIndex, EmailCompose
    Reports/             # ReportIndex
    Settings/            # GeneralSettings, PipelineSettings, CustomFields,
                         # TeamMembers, Profile
    Tasks/               # TaskIndex
    Dashboard.php
    GlobalSearch.php
  Models/                # Tenant, User, Contact, Company, Deal, Pipeline,
                         # PipelineStage, Task, Note, Activity, Email, Tag,
                         # CustomField, CustomFieldValue, AdminUser
  Exports/               # ContactsExport, CompaniesExport
  Imports/               # ContactsImport
database/
  migrations/            # Central: tenants, domains, plans, admin_users
  migrations/tenant/     # Tenant: users, companies, contacts, pipelines,
                         # deals, tasks, notes, activities, emails, tags,
                         # custom_fields
  seeders/               # PlanSeeder, AdminUserSeeder, DemoTenantSeeder
routes/
  web.php                # Central routes (landing, register, admin panel)
  tenant.php             # Tenant routes (all CRM features)
```

## Roles

| Role      | Access                                                    |
|-----------|-----------------------------------------------------------|
| `admin`   | Full access including all settings, team management       |
| `manager` | Full access including all settings, team management       |
| `member`  | CRM features only (contacts, deals, tasks, etc.) + profile settings |

## License

MIT

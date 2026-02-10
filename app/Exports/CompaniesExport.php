<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CompaniesExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Company::query();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Domain', 'Industry', 'Employees', 'Annual Revenue', 'Phone', 'Email', 'Website', 'City', 'State', 'Country', 'Created At'];
    }

    public function map($company): array
    {
        return [
            $company->id,
            $company->name,
            $company->domain,
            $company->industry,
            $company->employee_count,
            $company->annual_revenue,
            $company->phone,
            $company->email,
            $company->website,
            $company->city,
            $company->state,
            $company->country,
            $company->created_at->format('Y-m-d H:i'),
        ];
    }
}

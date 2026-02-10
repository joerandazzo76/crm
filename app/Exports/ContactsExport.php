<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactsExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Contact::with('company');
    }

    public function headings(): array
    {
        return ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Mobile', 'Company', 'Status', 'Source', 'Position', 'City', 'State', 'Country', 'Created At'];
    }

    public function map($contact): array
    {
        return [
            $contact->id,
            $contact->first_name,
            $contact->last_name,
            $contact->email,
            $contact->phone,
            $contact->mobile,
            $contact->company?->name,
            $contact->status,
            $contact->source,
            $contact->position,
            $contact->city,
            $contact->state,
            $contact->country,
            $contact->created_at->format('Y-m-d H:i'),
        ];
    }
}

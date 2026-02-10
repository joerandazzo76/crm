<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Contact([
            'first_name' => $row['first_name'] ?? $row['first name'] ?? '',
            'last_name' => $row['last_name'] ?? $row['last name'] ?? '',
            'email' => $row['email'] ?? null,
            'phone' => $row['phone'] ?? null,
            'mobile' => $row['mobile'] ?? null,
            'status' => $row['status'] ?? 'lead',
            'source' => $row['source'] ?? null,
            'position' => $row['position'] ?? null,
            'city' => $row['city'] ?? null,
            'state' => $row['state'] ?? null,
            'country' => $row['country'] ?? null,
            'owner_id' => auth()->id(),
        ]);
    }
}

<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function store(
        String $name,
        String $email,
        String $contact
    ) {
        return Contact::create([
            'name' => $name,
            'email' => $email,
            'contact' => $contact
        ]);
    }

    public function update(
        Contact $contact,
        String $name,
        String $email,
        String $contactData
    ) {
        return $contact->update([
            'name' => $name,
            'email' => $email,
            'contact' => $contactData
        ]);
    }

    public function destroy(Contact $contact) {
        return $contact->delete();
    }
}

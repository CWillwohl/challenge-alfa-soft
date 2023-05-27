<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    private ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $contacts = Contact::paginate(10); 

        return view('contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(StoreContactRequest $storeContactRequest)
    {
        $data = $storeContactRequest->validated();

        $this->contactService->store(
            $data['name'],
            $data['email'],
            $data['contact']
        );

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully');
    }

    public function show(Contact $contact)
    {
        return view('contact.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    public function update(UpdateContactRequest $updateContactRequest, Contact $contact)
    {
        $data = $updateContactRequest->validated();

        $this->contactService->update(
            $contact,
            $data['name'],
            $data['email'],
            $data['contactData']
        );

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully');
    }

    public function destroy(Contact $contact)
    {
        $this->contactService->destroy($contact);

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
    }
}

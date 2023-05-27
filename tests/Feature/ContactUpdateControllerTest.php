<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Validation\Rule;
use Tests\TestCase;

class ContactUpdateControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_update_method_with_valid_data()
    {
        $contact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contactData' => '996351784',
        ];

        $response = $this->put(route('contacts.update', $contact), $request);

        $response->assertRedirect(route('contacts.index'));

        $request['contact'] = $request['contactData'];

        unset($request['contactData']);

        $this->assertDatabaseHas('contacts', $request);

        $this->assertTrue(session()->has('success'));

        $this->assertEquals('Contact updated successfully', session('success'));
    }

    public function test_store_method_with_over_9_digits_data_contact()
    {
        $contact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contactData' => '12345678910',
        ];

        $response = $this->put(route('contacts.update', $contact), $request);

        $response->assertSessionHasErrors(['contactData']);

        $request['contact'] = $request['contactData'];

        unset($request['contactData']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_under_9_digits_data_contact()
    {
        $contact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contactData' => '12345678',
        ];

        $response = $this->put(route('contacts.update', $contact), $request);

        $response->assertSessionHasErrors(['contactData']);

        $request['contact'] = $request['contactData'];

        unset($request['contactData']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_null_value_digits_data_contact()
    {
        $contact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contactData' => '',
        ];

        $response = $this->put(route('contacts.update', $contact), $request);

        $response->assertSessionHasErrors(['contactData']);

        $request['contact'] = $request['contactData'];

        unset($request['contactData']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_duplicate_value_data_contact()
    {

        $contact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $contact2 = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '123456789',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ];

        $validator = $this->app['validator']->make($request, [
            'contact' => ['required', 'digits:9', Rule::unique('contacts', 'contact')->whereNull('deleted_at')->ignore($contact2)],
        ]);

        $this->assertTrue($validator->fails());

        $this->assertEquals('The contact has already been taken.', $validator->errors()->first('contact'));
    }

    public function test_store_method_with_over_255_digits_data_email()
    {
        $contact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => str_repeat('a', 256) . '@gmail.com',
            'contactData' => '12345678910',
        ];

        $response = $this->put(route('contacts.update', $contact), $request);

        $response->assertSessionHasErrors(['email']);

        $request['contact'] = $request['contactData'];

        unset($request['contactData']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_null_value_data_email()
    {
        $contact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => '',
            'contactData' => '12345678910',
        ];

        $response = $this->put(route('contacts.update', $contact), $request);

        $response->assertSessionHasErrors(['email']);

        $request['contact'] = $request['contactData'];

        unset($request['contactData']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_duplicate_value_data_email()
    {

        $contact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'example.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $contact2 = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'example.caiowillwohl2@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'example.caiowillwohl@gmail.com',
            'contactData' => '996351784',
        ];

        $validator = $this->app['validator']->make($request, [
            'email' => ['required', 'email', 'max:255', Rule::unique('contacts')->whereNull('deleted_at')->ignore($contact2->id)],
        ]);

        $this->assertTrue($validator->fails());

        $this->assertEquals('The email has already been taken.', $validator->errors()->first('email'));
    }
}

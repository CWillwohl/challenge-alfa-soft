<?php

namespace Tests\Feature;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule as ValidationRule;
use Tests\TestCase;

class ContactStoreControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_store_method_with_valid_data()
    {
        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ];

        $response = $this->post(route('contacts.store'), $request);

        $response->assertRedirect(route('contacts.index'));

        $this->assertDatabaseHas('contacts', $request);

        $this->assertTrue(session()->has('success'));

        $this->assertEquals('Contact created successfully', session('success'));
    }

    public function test_store_method_with_over_9_digits_data_contact()
    {
        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '5645648657891',
        ];

        $response = $this->post(route('contacts.store'), $request);

        $response->assertSessionHasErrors(['contact']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_under_9_digits_data_contact()
    {
        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '12345678',
        ];

        $response = $this->post(route('contacts.store'), $request);

        $response->assertSessionHasErrors(['contact']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_null_value_data_contact()
    {
        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '',
        ];

        $response = $this->post(route('contacts.store'), $request);

        $response->assertSessionHasErrors(['contact']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_duplicate_value_data_contact()
    {

        $duplicateContact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ];

        $validator = $this->app['validator']->make($request, [
            'contact' => ['required', 'digits:9', ValidationRule::unique('contacts')->whereNull('deleted_at')],
        ]);

        $this->assertTrue($validator->fails());

        $this->assertEquals('The contact has already been taken.', $validator->errors()->first('contact'));
    }

    public function test_store_method_with_over_255_digits_data_email()
    {
        $request = [
            'name' => 'Caio Willwohl',
            'email' => str_repeat('a', 256) . '@gmail.com',
            'contact' => '996351784',
        ];

        $response = $this->post(route('contacts.store'), $request);

        $response->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_null_value_data_email()
    {
        $request = [
            'name' => 'Caio Willwohl',
            'email' => '',
            'contact' => '996351784',
        ];

        $response = $this->post(route('contacts.store'), $request);

        $response->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('contacts', $request);
    }

    public function test_store_method_with_duplicate_value_data_email()
    {

        $duplicateContact = Contact::create([
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ]);

        $request = [
            'name' => 'Caio Willwohl',
            'email' => 'developer.caiowillwohl@gmail.com',
            'contact' => '996351784',
        ];

        $validator = $this->app['validator']->make($request, [
            'email' => ['required', 'email', 'max:255', ValidationRule::unique('contacts')->whereNull('deleted_at')],
        ]);

        $this->assertTrue($validator->fails());

        $this->assertEquals('The email has already been taken.', $validator->errors()->first('email'));
    }

}

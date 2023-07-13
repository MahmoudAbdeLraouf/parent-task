<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_users_api_returns_a_successful_response(): void
    {
        $response = $this->getJson('api/users',[
        'provider'=>'DataProviderX',
        'statusCode'=>'authorised',
        'currency'=>'USD']);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->first(fn (AssertableJson $json) =>
                $json->where('provider', 'DataProviderX')
                    ->where('statusCode', 'authorised')
                    ->etc()
                )
            );
    }
}

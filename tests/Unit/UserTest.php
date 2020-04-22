<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class UserTest extends TestCase
{
    use CreatesApplication;


    public function testUserCreateAccount()
    {
        $graphql = <<<'GRAPHQL'
        mutation {
            signUp(
            name: "tester"
            email:"1123@test.com"
            password:"123333"
            password_confirmation: "123333"
          ) {
            email,
            name,
          }
        }
GRAPHQL;

        $result = $this->call('GET', '/graphql/auth', [
            'query' => $graphql,
        ])->json();

        $expected = [
            'data' =>
                [
                    'signUp' =>
                        [
                            'email' => '1123@test.com',
                            'name' => 'tester',
                        ],
                ],
        ];
        unset($result['errors'][0]['trace']);
        $this->assertSame( $result, $expected);
    }

    public function testUserRegisterValidationError()
    {
        $graphql = <<<'GRAPHQL'
            mutation {
                signUp(
                name: "tester"
                email:"1123@test.com"
                password:"123"
                password_confirmation: "123"
              ) {
                id,
                email,
                name,
                api_token
              }
            }
GRAPHQL;

        $result = $this->call('GET', '/graphql/auth', [
            'query' => $graphql,
        ])->json();

        $expected = ['errors' => Array  (
            0 => Array  (
                'message' => 'validation',
                'extensions' => Array  (
                    'category' => 'validation',
                    'validation' => Array  (
                        'password' => Array  (
                            0 => 'The password must be at least 6 characters.'
                        )
                    )
                ),
            )
        )];

        unset($result['errors'][0]['trace']);
        $this->assertArraySubset($expected, $result);
    }
}

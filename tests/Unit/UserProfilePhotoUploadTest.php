<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\UploadedFile;
use Tests\CreatesApplication;

class UserProfilePhotoUploadTest extends TestCase
{
//    use RefreshDatabase;
    use CreatesApplication;

    public function testUpdateUserProfilePhoto(): void
    {
        $user = factory(User::class)->create();
        $fileToUpload = UploadedFile::fake()->create('file.png');
        fwrite($fileToUpload->tempFile, "This is the\nuploaded\ndata");

        $result = $this->actingAs($user, 'api')
            ->call(
                'POST',
                '/graphql',
                // $parameters
                [
                    'operations' => json_encode([
                        'query' => 'mutation($file: Upload!) { UpdateUserProfilePhoto(profilePicture: $file){id, name, email} }',
                        'variables' => [
                            'file' => null,
                        ],
                    ]),
                    'map' => json_encode([
                        '0' => ['variables.file'],
                    ]),
                ],
                // $cookies
                [],
                // $files
                [
                    '0' => $fileToUpload,

                ],
                // $server
                [
                    'CONTENT_TYPE' => 'multipart/form-data',
                    'Accept' => 'application/json',
                ]
            )
            ->json();
        unset($result['errors'][0]['trace']);

        $expectedResult = [
            'data' => [
                'UpdateUserProfilePhoto' => [],
            ],
        ];
        $this->assertArraySubset($expectedResult, $result);
    }
}

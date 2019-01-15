<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\KeystrokeBasedAlgorithms\Persistence\FirebaseKBADatabase;
use App\Http\Helpers\TestHelper;

class DataProviderGetAllUserInfoTest extends TestCase
{
    private $test_path = 'test/';
    private $user_info = [
        'Dummy1' => [
            'name' => 'Peter',
            'age' => 21
        ],
        'Dummy2' => [
            'name' => 'Joe',
            'age' => 27
        ],
        'Dummy3' => [
            'name' => 'Mary',
            'age' => 34
        ]
    ];

    /** @before */
    public function add_user_infos_to_firebase()
    {
        FirebaseKBADatabase::setTestPath($this->test_path);
        TestHelper::getFirebaseDatabaseReference()
            ->getReference($this->test_path . '/path_to_users')
            ->set($this->user_info);
    }

    /** @test */
    public function information_about_all_the_users_provided()
    {
        $all_user_info = FirebaseKBADatabase::getAllUserInfo();
        $this->assertNotNull($all_user_info);
        $this->assertEquals($all_user_info, $this->user_info);

    }

    /** @after */
    public function remove_user_infos_to_firebase()
    {
        TestHelper::getFirebaseDatabaseReference()
            ->getReference($this->test_path . '/path_to_users')
            ->set([]);
        FirebaseKBADatabase::setTestPath("");
    }

}

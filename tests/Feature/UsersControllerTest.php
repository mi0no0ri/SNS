<?php

namespace Tests\Feature;

use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * @test
     * @dataProvider providerValidAge
     * @return void
     */
    public function validAgeTest($age, $expected)
    {
        $UserController = new UsersController;
        $result = $UserController->validAge($age);
        $this->assertSame($expected, $result);
    }

    public function providerValidAge()
    {
        return [
            [17, false],
            [18, true],
            [65, true],
            [66, false],
            [-1, false],
            [18.1, true],
            ['a', 'Error, arguments is must be numeric.'],
        ];
    }
}

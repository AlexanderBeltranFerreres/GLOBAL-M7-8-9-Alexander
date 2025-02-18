<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_is_super_admin_function()
    {
        // Crear superadmin
        $superAdmin = create_superadmin_user();

        //isSuperAdmin retorna true per al superadmin
        $this->assertTrue($superAdmin->isSuperAdmin());

        //usuari regular
        $regularUser = create_regular_user();

        //isSuperAdmin retorna false per a un usuari regular
        $this->assertFalse($regularUser->isSuperAdmin());
    }
}

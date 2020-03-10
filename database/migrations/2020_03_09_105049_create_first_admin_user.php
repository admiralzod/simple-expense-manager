<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;
use App\User;

class CreateFirstAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role = Role::create([
            'name' => 'Administrator',
            'description' => 'super user'
        ]);


        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => $role->id,
            'password' => bcrypt('12345678')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('first_admin_user');
    }
}

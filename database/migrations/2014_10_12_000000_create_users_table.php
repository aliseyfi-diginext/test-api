<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80)->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $emails = [
            'ali.seyfi68@gmail.com',
            'atefe.rashidi1372@gmail.com',
            'h.ebadi7091@gmail.com',
            'hamed.hamze2212@gmail.com',
            'javadi.sabbas@gmail.com',
            'mohamadzahedi1375@gmail.com',
            'soltanpooranahita@gmail.com',
            'talamhashemi@gmail.com',
            'zebardast.bardia@gmail.com',
        ];

        foreach ($emails as $email) {
            \App\Models\User::create([
                'name' => $email,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => bcrypt($email),
                'api_token' => \Str::random(80),
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

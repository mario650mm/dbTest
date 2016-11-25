<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

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
            $db = \DB::connection('remote')->getDatabaseName();
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('proveedor_id');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')
                ->on(new Expression($db.'.proveedores'))->onUpdate('cascade')->onDelete('cascade');
        });

        $now = \Carbon\Carbon::now();

        \DB::table('users')->insert([
            'name' => 'proveedor 1',
            'email' => 'prueba@prueba.com',
            'password' => bcrypt('secret'),
            'proveedor_id' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

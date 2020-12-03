<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->integer('role_id')->unsigned();
            $table->integer('owner_id')->unsigned();
            $table->integer('notification_id')->unsigned();
            $table->string('region_oid')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');
            $table->foreign('notification_id')->references('id')->on('notification_type')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign('users_owner_id_foreign');
            $table->dropColumn('owner_id');

            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');

            $table->dropForeign('users_notification_id_foreign');
            $table->dropColumn('notification_id');

        });


        Schema::dropIfExists('users');
    }
}

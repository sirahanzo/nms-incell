<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostReceivedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_received', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_oid');
            $table->string('site_name');
            $table->string('type_message');
            $table->text('content_message');
            $table->timestamps();

            $table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');

        });

        DB::unprepared('
        CREATE EVENT `delete_post_received` ON SCHEDULE EVERY 1 DAY STARTS \'2020-01-01 00:00:00\'
            DO BEGIN
            DELETE FROM post_received WHERE updated_at < DATE_SUB(NOW(),INTERVAL 1 MONTH );
        END;

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_received', function (Blueprint $table) {

            $table->dropForeign('post_received_site_oid_foreign');
            $table->dropColumn('site_oid');
        });

        DB::unprepared('DROP EVENT delete_post_received');

        Schema::dropIfExists('post_received');
    }
}

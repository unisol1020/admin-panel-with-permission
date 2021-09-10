<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResellerUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseller_user', function (Blueprint $table) {
            $table->unsignedBigInteger('reseller_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reseller_id')->references('id')->on('resellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reseller_user');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBusinessActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_activity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('owner_user_id')->nullable();
            $table->string('business_id')->nullable();
            $table->string('business_line')->nullable();
            $table->string('unit_no')->nullable();
            $table->string('capitalization')->nullable();
            $table->string('essentials')->nullable();
            $table->string('non_essentials')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_activity');
    }
}

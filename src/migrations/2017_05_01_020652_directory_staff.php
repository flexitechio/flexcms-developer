<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DirectoryStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directory_staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            // $table->string('type')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('female_quantity')->default(0);
            $table->string('short_description', 256)->nullable();
            $table->string('description', 1200)->nullable();
            $table->integer('directory_id')->nullable();
            $table->integer('seq_no')->default(0);
            $table->boolean('is_active')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('directory_staffs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->text('qualifications');
            $table->string('country');
            $table->text('experience');
            $table->text('skills');
            $table->enum('type', ['Full Time', 'Part Time']);
            $table->string('companyName');
            $table->integer('salary');
            $table->text('aboutCompany');
            $table->string('logo');
            $table->boolean('status')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('jobs');
    }
}
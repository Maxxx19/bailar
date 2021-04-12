<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('class')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->text('trainer')->nullable();
            $table->text('club')->nullable();
            $table->text('dance')->nullable();
            $table->text('parentname')->nullable();
            $table->string('parentphone')->nullable();
            $table->string('parentemail')->nullable();
            $table->string('status')->nullable();
            $table->string('memberable_id')->nullable();
            $table->string('memberable_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}

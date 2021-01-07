<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('status');
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamp('starts_at');
            $table->timestamp('ends_at')->nullable();
            $table->enum('type', [
                'ONCE',
                'EVERY',
                'WEEKLY',
                'MONTHLY',
                'YEARLY',
                'CUSTOMIZED',
                'DEFAULT'
            ])->default('DEFAULT');
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
        Schema::dropIfExists('reminders');
    }
}

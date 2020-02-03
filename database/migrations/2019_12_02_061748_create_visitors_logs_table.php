<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('visit_date')->nullable();
            $table->string('purpose')->nullable();
            $table->enum('followUp_status',['Yes','No'])->default('no');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('visitors_logs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wo_number')->unique();
            $table->string('title');
            $table->enum('category', ['technical', 'nontechnical']);
            $table->unsignedBigInteger('assign_id');
            $table->unsignedBigInteger('from_id');
            $table->text('description');
            $table->enum('status', ['open', 'progress', 'finish']);
            $table->timestamps();

            $table->foreign('assign_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

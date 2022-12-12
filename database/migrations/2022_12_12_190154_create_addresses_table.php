<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
            ->constrained('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('district', 150);
            $table->string('city', 150);
            $table->string('street', 150);
            $table->string('street', 150);
            $table->integer('number');
            $table->string('state', 100);
            $table->string('country', 100);
            $table->string('cep', 8);
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
        Schema::dropIfExists('addresses');
    }
};

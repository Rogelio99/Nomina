<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('employee');
        Schema::create('employee', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('code', 10)->nullable(false)->unique();
            $table->string('name', 50)->nullable(false);
            $table->string('paternal_surname', 50)->nullable(false);
            $table->string('maternal_surname', 50)->nullable(false);
            $table->string('email', 100)->nullable(false)->unique();
            $table->boolean('status')->default(true)->nullable(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreignId('type_of_contract_id')->constrained('type_of_contract', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}

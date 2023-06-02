<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up()
    {
        if(!Schema::hasTable('employees')){
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nationalidnumber');
            $table->string('title');
            $table->date('birthdate');
            $table->timestamps();
        });
    }}
 
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
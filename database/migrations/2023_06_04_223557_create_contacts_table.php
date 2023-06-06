<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            
            $table->unsignedBigInteger('customer_id');

            $table->string('name');
            $table->string('phone');
            $table->date('ModifiedDate');
            $table->foreign('customer_id')
            ->references('id')->on('customers')->onDelete('cascade');

            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_items');
            $table->unsignedBigInteger('id_invoices');
            $table->unsignedBigInteger('id_users');
            $table->string('name');
            $table->string('quantity');
            $table->integer('subtotal');
            $table->timestamps();

            $table->foreign('id_items')->references('id')->on('items')->onDelete('CASCADE');
            $table->foreign('id_invoices')->references('id')->on('invoices')->onDelete('CASCADE');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_invoices');
    }
}

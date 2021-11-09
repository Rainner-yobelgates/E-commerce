<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->Integer('invoice_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone', 14);
            $table->integer('province');
            $table->integer('city');
            $table->integer('subdistrict');
            $table->string('postal_code', 6);
            $table->string('courier');
            $table->string('courier_service');
            $table->text('address');
            $table->integer('cost');
            $table->integer('total_price');
            $table->integer('subtotal');
            $table->string('status', 2) ->default(0);
            $table->string('resi') ->default(0);
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
        Schema::dropIfExists('invoices');
    }
}

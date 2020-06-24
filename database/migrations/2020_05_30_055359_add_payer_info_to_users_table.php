<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayerInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('identification_type', ['DNI', 'C.E', 'RUC', 'Otro'])->nullable();
            $table->string('identification_number', 20)->nullable();
            $table->string('phone_number')->nullable();
            $table->string('zip_code', 256)->nullable();
            $table->string('street_name', 256)->nullable();
            $table->integer('street_number')->nullable();
            $table->enum('withdrawal_method', ['Banco de Crédito del Peru', 'Banco Interbank', 'Banco Scotiabank', 'Banco BBVA Continental', 'Mercadopago'])->nullable();
            $table->string('withdrawal_account', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('identification_type');
            $table->dropColumn('identification_number');
            $table->dropColumn('phone_number');
            $table->dropColumn('zip_code');
            $table->dropColumn('street_name');
            $table->dropColumn('street_number');
            $table->dropColumn('withdrawal_method');
            $table->dropColumn('withdrawal_account');
        });
    }
}

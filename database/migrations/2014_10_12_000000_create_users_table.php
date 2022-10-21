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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pseudo')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('country');
            $table->enum('isAgreedWithTerms', ['on', 'off']);
            $table->enum('wishNewsletter', ['on', 'off']);
            // All nullable columns 
            $table->string('neph_number')->nullable();
            $table->string('juridique_status')->nullable();
            $table->string('bilan_enterprise')->nullable();
            $table->string('adresse')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('iban')->nullable();
            $table->string('identity_card')->nullable();
            $table->string('source_of_income')->nullable();
            $table->string('user_profession')->nullable();
            $table->string('nationality')->nullable();
            $table->string('genre')->nullable();
            $table->string('birthday_date')->nullable();
            $table->string('residence_country')->nullable();
            $table->string('city')->nullable();
            $table->string('home_justificatif')->nullable();
            $table->string('relation_to_call_name')->nullable();
            $table->string('relation_to_call_adress')->nullable();
            $table->string('relation_to_call_phoneNumber')->nullable();
            $table->string('bank_account_owner_name')->nullable();
            $table->string('bank_account_owner_lastName')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('source_of_income_justificatif')->nullable();
            // End
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

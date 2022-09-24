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
        if(!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');
                $table->decimal('amount');
                $table->string('location');
                $table->string('images')->nullable();
                $table->string('campaignTime'); 
                $table->decimal('minInvest', 4, 2); // Minimum invest price
                $table->string('ytbVideo')->nullable();
                $table->string('docs')->nullable();
                $table->bigInteger('totalViews')->nullable();
                $table->string('type_return_on_investissment');
                $table->foreignId('user_id')->constrained();
                $table->softDeletes('desactived_at');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};

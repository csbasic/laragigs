<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public $timestamps = true;
    public function up(): void


    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->string('logo')->nullable();
            $table->longText('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->NULL;
            // $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('updated_at')->nullable()->change();
            // $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
            $table->integer('status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};

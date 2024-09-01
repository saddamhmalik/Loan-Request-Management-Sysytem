<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->date('dob');
            $table->string('pan');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->decimal('loan_amount', 15, 2);
            $table->enum('loan_purpose', ['home', 'car', 'education', 'business', 'personal']);
            $table->integer('loan_term');
            $table->enum('employment_status', ['employed', 'self-employed', 'unemployed', 'retired']);
            $table->decimal('annual_income', 15, 2);
            $table->string('employer_name');
            $table->boolean('agreed_to_terms');
            $table->string('request_hash')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_requests');
    }
};

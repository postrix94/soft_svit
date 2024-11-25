<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sent_emails', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string("from", 50);
            $table->string("to", 50);
            $table->string("cc", 50)->nullable();
            $table->tinyText("subject");
            $table->enum("type", ["text", "html"]);
            $table->text("body");
            $table->tinyText("ip");
            $table->tinyText("user_agent");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sent_emails');
    }
};

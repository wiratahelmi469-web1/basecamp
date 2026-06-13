<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keranjangs', function (Blueprint $table) {

            $table->id();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('produk_id');

            $table->unsignedSmallInteger('jumlah')
                ->default(1);

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('produk_id')
                ->references('id')
                ->on('produk')
                ->cascadeOnDelete();

            $table->unique([
                'user_id',
                'produk_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->date('tanggal_sewa')->nullable()->after('jumlah');
            $table->date('tanggal_kembali')->nullable()->after('tanggal_sewa');
        });
    }

    public function down(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_sewa',
                'tanggal_kembali',
            ]);
        });
    }
};

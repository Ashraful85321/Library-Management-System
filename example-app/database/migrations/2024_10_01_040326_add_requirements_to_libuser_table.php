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
        Schema::table('libuser', function (Blueprint $table) {
            $table->bigInteger('req_1')->nullable()->after('image');
            $table->bigInteger('req_2')->nullable()->after('req_1');
            $table->bigInteger('req_3')->nullable()->after('req_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('libuser', function (Blueprint $table) {
            $table->dropColumn(['req_1', 'req_2', 'req_3']);
        });
    }
};

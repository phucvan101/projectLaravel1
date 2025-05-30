<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // chạy migration
    {
        Schema::table('menus', function (Blueprint $table) {
            //
            $table->string('slug'); // thhêm cột slug vào bảng menus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // hoàn tác migration
    {
        Schema::table('menus', function (Blueprint $table) {
            //
            $table->dropColumn('slug'); // xóa cột slug khỏi bảng menus -> đồng bộ với bảng menus
        });
    }
};

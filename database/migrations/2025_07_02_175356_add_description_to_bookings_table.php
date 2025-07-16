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
    if (!Schema::hasColumn('bookings', 'description')) {
        Schema::table('bookings', function (Blueprint $table) {
            $table->text('description')->nullable(false);
        });
    }
}


public function down(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn('description');
    });
}

};

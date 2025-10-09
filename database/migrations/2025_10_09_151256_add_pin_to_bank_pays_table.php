<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('bank_pays', function (Blueprint $table) {
            $table->string('pin')->nullable()->after('user_id'); // add 'pin' after 'user_id'
        });
    }


    public function down(): void
    {
        Schema::table('bank_pays', function (Blueprint $table) {
            $table->dropColumn('pin');
        });
    }
};

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
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('signer_name')->nullable()->after('issued_at');
            $table->string('signer_position')->nullable()->after('signer_name');
            $table->string('signature_path')->nullable()->after('signer_position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn(['signer_name', 'signer_position', 'signature_path']);
        });
    }
};

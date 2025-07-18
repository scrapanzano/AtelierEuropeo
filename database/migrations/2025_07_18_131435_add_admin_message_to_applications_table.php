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
        Schema::table('applications', function (Blueprint $table) {
            $table->text('admin_message')->nullable()->after('status');
            $table->timestamp('status_updated_at')->nullable()->after('admin_message');
            $table->unsignedBigInteger('updated_by_admin_id')->nullable()->after('status_updated_at');
            
            $table->foreign('updated_by_admin_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['updated_by_admin_id']);
            $table->dropColumn(['admin_message', 'status_updated_at', 'updated_by_admin_id']);
        });
    }
};

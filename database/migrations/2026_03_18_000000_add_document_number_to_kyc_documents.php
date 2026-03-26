<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('kyc_documents', 'document_number')) {
            Schema::table('kyc_documents', function (Blueprint $table) {
                $table->string('document_number')->nullable()->after('document_path');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('kyc_documents', 'document_number')) {
            Schema::table('kyc_documents', function (Blueprint $table) {
                $table->dropColumn('document_number');
            });
        }
    }
};

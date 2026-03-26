<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // User Relations (Hierarchy: Distributor → Retailer)
        Schema::create('user_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('child_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['parent_id', 'child_id']);
        });

        // Profiles
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('business_name')->nullable();
            $table->string('shop_name')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('pan_number', 20)->nullable();
            $table->string('gst_number', 20)->nullable();
            $table->enum('kyc_status', ['pending', 'submitted', 'verified', 'rejected'])->default('pending');
            $table->string('profile_photo')->nullable();
            $table->timestamps();
        });

        // KYC Documents
        Schema::create('kyc_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('aadhaar_hash')->nullable();
            $table->string('aadhaar_last4', 4)->nullable();
            $table->string('bank_id')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('document_type')->nullable();
            $table->string('document_path')->nullable();
            $table->timestamp('txn_time')->nullable();
            $table->timestamps();
        });

        // Banks
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('iin_number')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Wallets
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->decimal('asset_balance', 15, 2)->default(0.00);
            $table->enum('status', ['active', 'frozen', 'closed'])->default('active');
            $table->timestamps();
            $table->unique('user_id');
        });

        // Ledger Entries
        Schema::create('ledger_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->enum('transaction_type', ['debit', 'credit']);
            $table->decimal('amount', 15, 2);
            $table->decimal('opening_balance', 15, 2);
            $table->decimal('closing_balance', 15, 2);
            $table->string('reference_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->index('reference_id');
        });

        // API Providers
        Schema::create('api_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('api_url');
            $table->text('api_key')->nullable()->comment('Encrypted');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // AEPS Transactions (Critical table from ER)
        Schema::create('aeps_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->enum('service_type', ['cash_withdrawal', 'balance_enquiry', 'mini_statement', 'aadhaar_pay']);
            $table->foreignId('bank_id')->nullable()->constrained()->nullOnDelete();
            $table->string('aadhaar_hash')->nullable();
            $table->string('aadhaar_last4', 4)->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('commission', 15, 2)->default(0);
            $table->decimal('charge', 15, 2)->default(0);
            $table->enum('status', ['pending', 'success', 'failed', 'reversed'])->default('pending');
            $table->text('response_message')->nullable();
            $table->string('rrn')->nullable()->comment('Retrieval Reference Number');
            $table->foreignId('api_provider_id')->nullable()->constrained('api_providers')->nullOnDelete();
            $table->string('device_fingerprint')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'status']);
            $table->index('created_at');
        });

        // API Logs
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('txn_id')->nullable();
            $table->text('request')->nullable();
            $table->text('response')->nullable();
            $table->enum('status', ['success', 'failed', 'timeout'])->default('success');
            $table->foreignId('api_provider_id')->nullable()->constrained('api_providers')->nullOnDelete();
            $table->timestamps();
            $table->index('txn_id');
        });

        // Settlements
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('utr')->nullable();
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->date('settlement_date')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'status']);
        });

        // Device Mapping
        Schema::create('device_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('device_id')->unique();
            $table->string('device_model')->nullable();
            $table->string('serial_number')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Service Charges
        Schema::create('service_charges', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');
            $table->decimal('amount', 10, 2);
            $table->decimal('percentage', 5, 2)->default(0);
            $table->decimal('min_amount', 15, 2)->default(0);
            $table->decimal('max_amount', 15, 2)->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Commission Reports
        Schema::create('commission_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('type')->nullable();
            $table->date('transaction_date')->nullable();
            $table->timestamps();
        });

        // Reversals (Fphum Handling)
        Schema::create('reversals', function (Blueprint $table) {
            $table->id();
            $table->string('txn_log_id')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type')->nullable();
            $table->enum('status', ['pending', 'completed', 'rejected'])->default('pending');
            $table->date('settlement_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        // Bill Payments
        Schema::create('bill_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('device_serial')->nullable();
            $table->string('operator')->nullable();
            $table->string('service_type')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('customer_id')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->text('response')->nullable();
            $table->timestamps();
        });

        // Fund Transfers
        Schema::create('fund_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('to_user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('reference_id')->unique();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        // Support Tickets
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
            $table->text('admin_reply')->nullable();
            $table->timestamps();
        });

        // Login Logs
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('ip_address', 45)->nullable();
            $table->integer('login_attempts')->default(0);
            $table->enum('status', ['success', 'failed'])->default('success');
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });

        // Audit Logs
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        // Transaction Logs
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->string('txn_id')->nullable();
            $table->string('status')->nullable();
            $table->string('service_type')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->text('details')->nullable();
            $table->timestamps();
            $table->index('txn_id');
        });

        // Activity Logs
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        // IP Providers
        Schema::create('ip_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('api_url')->nullable();
            $table->text('api_key')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $tables = [
            'ip_providers', 'activity_logs', 'transaction_logs', 'audit_logs',
            'login_logs', 'support_tickets', 'fund_transfers', 'bill_payments',
            'reversals', 'commission_reports', 'service_charges', 'device_mappings',
            'settlements', 'api_logs', 'aeps_transactions', 'api_providers',
            'ledger_entries', 'wallets', 'banks', 'kyc_documents', 'profiles',
            'user_relations'
        ];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bank;
use App\Models\Wallet;
use App\Models\Profile;
use App\Models\ApiProvider;
use App\Models\ServiceCharge;
use App\Models\AepsTransaction;
use App\Models\CommissionReport;
use App\Models\Settlement;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@aeps.com'],
            [
                'name' => 'Super Admin',
                'mobile' => '9999999999',
                'role' => 'admin',
                'status' => 'active',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        \App\Models\Wallet::updateOrCreate(['user_id' => $admin->id], ['balance' => 1000000]);
        \App\Models\Profile::updateOrCreate(['user_id' => $admin->id], ['kyc_status' => 'verified', 'business_name' => 'AEPS Admin HQ', 'city' => 'Mumbai', 'state' => 'Maharashtra']);

        // Create Distributor
        $distributor = User::updateOrCreate(
            ['email' => 'distributor@aeps.com'],
            [
                'name' => 'Demo Distributor',
                'mobile' => '8888888888',
                'role' => 'distributor',
                'status' => 'active',
                'password' => Hash::make('dist123'),
                'email_verified_at' => now(),
            ]
        );
        \App\Models\Wallet::updateOrCreate(['user_id' => $distributor->id], ['balance' => 500000]);
        \App\Models\Profile::updateOrCreate(['user_id' => $distributor->id], ['kyc_status' => 'verified', 'business_name' => 'Demo Distribution Co.', 'city' => 'Delhi', 'state' => 'Delhi']);
        \App\Models\UserRelation::updateOrCreate(['parent_id' => $admin->id, 'child_id' => $distributor->id], ['parent_id' => $admin->id, 'child_id' => $distributor->id]);

        // Create Retailer
        $retailer = User::updateOrCreate(
            ['email' => 'retailer@aeps.com'],
            [
                'name' => 'Demo Retailer',
                'mobile' => '7777777777',
                'role' => 'retailer',
                'status' => 'active',
                'password' => Hash::make('retail123'),
                'email_verified_at' => now(),
                'aadhaar_last4' => '4321',
            ]
        );
        \App\Models\Wallet::updateOrCreate(['user_id' => $retailer->id], ['balance' => 50000]);
        \App\Models\Profile::updateOrCreate(['user_id' => $retailer->id], ['kyc_status' => 'verified', 'business_name' => 'Demo CSP Center', 'shop_name' => 'Retailer Shop', 'city' => 'Jaipur', 'state' => 'Rajasthan']);
        \App\Models\UserRelation::updateOrCreate(['parent_id' => $distributor->id, 'child_id' => $retailer->id], ['parent_id' => $distributor->id, 'child_id' => $retailer->id]);

        // Banks
        $banks = [
            ['bank_name' => 'State Bank of India', 'iin_number' => '607094'],
            ['bank_name' => 'Punjab National Bank', 'iin_number' => '607027'],
            ['bank_name' => 'Bank of Baroda', 'iin_number' => '508505'],
            ['bank_name' => 'Union Bank of India', 'iin_number' => '607095'],
            ['bank_name' => 'Canara Bank', 'iin_number' => '508534'],
            ['bank_name' => 'Indian Bank', 'iin_number' => '508549'],
            ['bank_name' => 'Bank of India', 'iin_number' => '508500'],
            ['bank_name' => 'Central Bank of India', 'iin_number' => '508535'],
            ['bank_name' => 'HDFC Bank', 'iin_number' => '607152'],
            ['bank_name' => 'ICICI Bank', 'iin_number' => '508534'],
            ['bank_name' => 'Axis Bank', 'iin_number' => '607153'],
            ['bank_name' => 'Kotak Mahindra Bank', 'iin_number' => '508549'],
        ];
        foreach ($banks as $bank) {
            Bank::updateOrCreate(
                ['iin_number' => $bank['iin_number']],
                array_merge($bank, ['status' => 'active'])
            );
        }

        // API Provider
        ApiProvider::updateOrCreate(
            ['name' => 'FinoPayTech'],
            [
                'api_url' => 'https://api.finopaytech.com/aeps',
                'api_key' => encrypt('demo_api_key_12345'),
                'status' => 'active',
            ]
        );

        // Service Charges
        $charges = [
            ['service_type' => 'cash_withdrawal', 'amount' => 10.00, 'percentage' => 0, 'min_amount' => 100, 'max_amount' => 10000],
            ['service_type' => 'balance_enquiry', 'amount' => 0.00, 'percentage' => 0, 'min_amount' => 0, 'max_amount' => 0],
            ['service_type' => 'mini_statement', 'amount' => 5.00, 'percentage' => 0, 'min_amount' => 0, 'max_amount' => 0],
            ['service_type' => 'aadhaar_pay', 'amount' => 0.00, 'percentage' => 1.0, 'min_amount' => 100, 'max_amount' => 50000],
            ['service_type' => 'bill_payment', 'amount' => 5.00, 'percentage' => 0, 'min_amount' => 0, 'max_amount' => 0],
            ['service_type' => 'mobile_recharge', 'amount' => 2.00, 'percentage' => 0, 'min_amount' => 10, 'max_amount' => 5000],
        ];
        foreach ($charges as $charge) {
            ServiceCharge::updateOrCreate(
                ['service_type' => $charge['service_type']],
                array_merge($charge, ['status' => 'active'])
            );
        }

        $demoTransactions = [
            ['transaction_id' => 'DEMO-TXN-1001', 'service_type' => 'cash_withdrawal', 'amount' => 2500, 'commission' => 18, 'charge' => 10, 'status' => 'success', 'bank_iin' => '607094', 'created_at' => now()->subDays(6)->setTime(10, 10)],
            ['transaction_id' => 'DEMO-TXN-1002', 'service_type' => 'balance_enquiry', 'amount' => 0, 'commission' => 2, 'charge' => 0, 'status' => 'success', 'bank_iin' => '607027', 'created_at' => now()->subDays(5)->setTime(11, 20)],
            ['transaction_id' => 'DEMO-TXN-1003', 'service_type' => 'mini_statement', 'amount' => 0, 'commission' => 3, 'charge' => 5, 'status' => 'success', 'bank_iin' => '508500', 'created_at' => now()->subDays(5)->setTime(15, 5)],
            ['transaction_id' => 'DEMO-TXN-1004', 'service_type' => 'cash_withdrawal', 'amount' => 4000, 'commission' => 26, 'charge' => 10, 'status' => 'success', 'bank_iin' => '607152', 'created_at' => now()->subDays(4)->setTime(13, 40)],
            ['transaction_id' => 'DEMO-TXN-1005', 'service_type' => 'aadhaar_pay', 'amount' => 1200, 'commission' => 12, 'charge' => 0, 'status' => 'failed', 'bank_iin' => '607153', 'created_at' => now()->subDays(3)->setTime(9, 25)],
            ['transaction_id' => 'DEMO-TXN-1006', 'service_type' => 'cash_withdrawal', 'amount' => 1800, 'commission' => 14, 'charge' => 10, 'status' => 'pending', 'bank_iin' => '607094', 'created_at' => now()->subDays(2)->setTime(17, 50)],
            ['transaction_id' => 'DEMO-TXN-1007', 'service_type' => 'cash_withdrawal', 'amount' => 3200, 'commission' => 22, 'charge' => 10, 'status' => 'success', 'bank_iin' => '607027', 'created_at' => now()->subDay()->setTime(12, 15)],
            ['transaction_id' => 'DEMO-TXN-1008', 'service_type' => 'cash_withdrawal', 'amount' => 2700, 'commission' => 19, 'charge' => 10, 'status' => 'success', 'bank_iin' => '508500', 'created_at' => now()->setTime(10, 30)],
            ['transaction_id' => 'DEMO-TXN-0901', 'service_type' => 'cash_withdrawal', 'amount' => 2100, 'commission' => 16, 'charge' => 10, 'status' => 'success', 'bank_iin' => '607094', 'created_at' => now()->subDays(13)->setTime(10, 45)],
            ['transaction_id' => 'DEMO-TXN-0902', 'service_type' => 'mini_statement', 'amount' => 0, 'commission' => 3, 'charge' => 5, 'status' => 'success', 'bank_iin' => '607027', 'created_at' => now()->subDays(11)->setTime(14, 0)],
            ['transaction_id' => 'DEMO-TXN-0903', 'service_type' => 'cash_withdrawal', 'amount' => 2900, 'commission' => 21, 'charge' => 10, 'status' => 'success', 'bank_iin' => '607152', 'created_at' => now()->subDays(9)->setTime(16, 25)],
        ];

        foreach ($demoTransactions as $transaction) {
            $createdAt = $transaction['created_at']->copy();
            $bankId = Bank::where('iin_number', $transaction['bank_iin'])->value('id');

            AepsTransaction::updateOrCreate(
                ['transaction_id' => $transaction['transaction_id']],
                [
                    'user_id' => $retailer->id,
                    'service_type' => $transaction['service_type'],
                    'bank_id' => $bankId,
                    'aadhaar_last4' => '4321',
                    'amount' => $transaction['amount'],
                    'commission' => $transaction['commission'],
                    'charge' => $transaction['charge'],
                    'status' => $transaction['status'],
                    'response_message' => $transaction['status'] === 'success' ? 'Processed successfully' : ucfirst($transaction['status']) . ' request',
                    'rrn' => 'RRN' . substr($transaction['transaction_id'], -4),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]
            );

            if ($transaction['status'] === 'success') {
                CommissionReport::updateOrCreate(
                    ['user_id' => $retailer->id, 'transaction_id' => $transaction['transaction_id']],
                    [
                        'amount' => $transaction['commission'],
                        'type' => 'retailer_commission',
                        'transaction_date' => $createdAt->toDateString(),
                    ]
                );

                CommissionReport::updateOrCreate(
                    ['user_id' => $distributor->id, 'transaction_id' => $transaction['transaction_id'] . '-DIST'],
                    [
                        'amount' => round($transaction['commission'] * 0.45, 2),
                        'type' => 'distributor_override',
                        'transaction_date' => $createdAt->toDateString(),
                    ]
                );
            }
        }

        Settlement::updateOrCreate(
            ['user_id' => $retailer->id, 'utr' => 'UTR-DEMO-1001'],
            [
                'amount' => 4200,
                'status' => 'pending',
                'settlement_date' => now()->toDateString(),
                'remarks' => 'Awaiting settlement release',
            ]
        );

        Settlement::updateOrCreate(
            ['user_id' => $retailer->id, 'utr' => 'UTR-DEMO-1002'],
            [
                'amount' => 3600,
                'status' => 'completed',
                'settlement_date' => now()->subDays(2)->toDateString(),
                'remarks' => 'Settled successfully',
            ]
        );

        SupportTicket::updateOrCreate(
            ['user_id' => $retailer->id, 'subject' => 'Need assistance with biometric device'],
            [
                'description' => 'Demo ticket created to show dashboard support metrics.',
                'priority' => 'medium',
                'status' => 'open',
            ]
        );
    }
}

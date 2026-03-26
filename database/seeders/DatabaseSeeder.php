<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bank;
use App\Models\Wallet;
use App\Models\Profile;
use App\Models\ApiProvider;
use App\Models\ServiceCharge;
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
        ApiProvider::create([
            'name' => 'FinoPayTech',
            'api_url' => 'https://api.finopaytech.com/aeps',
            'api_key' => encrypt('demo_api_key_12345'),
            'status' => 'active',
        ]);

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
            ServiceCharge::create(array_merge($charge, ['status' => 'active']));
        }
    }
}

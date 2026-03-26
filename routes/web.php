<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AepsController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillPaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;

// ========== PUBLIC ROUTES ==========
Route::get('/', function () {
    // Provide sample testimonials (can be replaced with DB-driven data later)
    $testimonials = [
        [
            'name' => 'Mintu Borgohain',
            'sub' => 'Internet Cafe',
            'quote' => 'RudraxPay AEPS Services consistently introduces new features and services. The addition of insurance policies boosted my income significantly.',
            // try public storage first, fall back to bundled asset
            'image' => file_exists(public_path('storage/users/mintu.jpg')) ? asset('storage/users/mintu.jpg') : asset('assets/logo2.png'),
            'rating' => 3.5,
        ],
        [
            'name' => 'Shubham Gupta',
            'sub' => 'CSC Center',
            'quote' => 'RudraxPay से जुड़ने के बाद हमारी दुकान पूरे गांव में बैंकिंग सेवाओं के लिए मशहूर हो गई है जिसकी वजह से हमारे ग्राहकों की संख्या काफी बढ़ गयी है।',
            'image' => file_exists(public_path('storage/users/shubham.jpg')) ? asset('storage/users/shubham.jpg') : asset('assets/logo3.png'),
            'rating' => 3,
        ],
        [
            'name' => 'Pradip Mili',
            'sub' => 'Retail Store',
            'quote' => 'RudraxPay का प्लेटफ़ॉर्म बहुत ही आसान और उपयोगी है। AePS, बिल भुगतान और रिचार्ज जैसी सेवाएँ बहुत ही आसान हैं — इससे मेरी हर महीने 70 हज़ार कमाने में मदद मिली।',
            'image' => file_exists(public_path('storage/users/pradip.jpg')) ? asset('storage/users/pradip.jpg') : asset('assets/logo.jpeg'),
            'rating' => 4,
        ],
    ];

    return view('landing', compact('testimonials'));
})->name('home');

// Contact form endpoint (landing page)
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Public static pages
Route::get('/services', [App\Http\Controllers\PageController::class, 'services'])->name('services');
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/features', [App\Http\Controllers\PageController::class, 'features'])->name('features');
Route::get('/team', [App\Http\Controllers\PageController::class, 'team'])->name('team');

// ========== AUTH ROUTES ==========
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/password/reset', function () {
        return redirect()->route('login');
    })->name('password.request');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ========== AUTHENTICATED ROUTES ==========
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/kyc', [ProfileController::class, 'uploadKyc'])->name('profile.kyc.upload');

    // Wallet
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/fund-transfers', [WalletController::class, 'fundTransfers'])->name('wallet.fund_transfers');

    // Support Tickets
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/create', [SupportController::class, 'create'])->name('support.create');
    Route::post('/support', [SupportController::class, 'store'])->name('support.store');
    Route::get('/support/{id}', [SupportController::class, 'show'])->name('support.show');

    // Reports
    Route::get('/reports/settlements', [ReportController::class, 'settlements'])->name('reports.settlements');
    Route::get('/reports/commissions', [ReportController::class, 'commissions'])->name('reports.commissions');
    Route::post('/reports/settlements/request', [ReportController::class, 'requestSettlement'])->name('reports.settlement.request');

    // ========== ADMIN ROUTES ==========
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        // User Management
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::post('/users/{id}/approve', [AdminController::class, 'approveUser'])->name('users.approve');

        // Banks
        Route::get('/banks', [AdminController::class, 'banks'])->name('banks');
        Route::post('/banks', [AdminController::class, 'storeBank'])->name('banks.store');
        Route::put('/banks/{id}', [AdminController::class, 'updateBank'])->name('banks.update');
        Route::delete('/banks/{id}', [AdminController::class, 'deleteBank'])->name('banks.delete');

        // API Providers
        Route::get('/api-providers', [AdminController::class, 'apiProviders'])->name('api_providers');
        Route::post('/api-providers', [AdminController::class, 'storeApiProvider'])->name('api_providers.store');
        Route::put('/api-providers/{id}', [AdminController::class, 'updateApiProvider'])->name('api_providers.update');

        // Service Charges
        Route::get('/service-charges', [AdminController::class, 'serviceCharges'])->name('service_charges');
        Route::post('/service-charges', [AdminController::class, 'storeServiceCharge'])->name('service_charges.store');
        Route::put('/service-charges/{id}', [AdminController::class, 'updateServiceCharge'])->name('service_charges.update');

        // Device Mappings
        Route::get('/device-mappings', [AdminController::class, 'deviceMappings'])->name('device_mappings');
        Route::post('/device-mappings', [AdminController::class, 'storeDeviceMapping'])->name('device_mappings.store');

        // Settlements
        Route::get('/settlements', [AdminController::class, 'settlements'])->name('settlements');
        Route::put('/settlements/{id}', [AdminController::class, 'processSettlement'])->name('settlements.process');

        // Commission Reports
        Route::get('/commission-reports', [AdminController::class, 'commissionReports'])->name('commission_reports');

        // Reversals
        Route::get('/reversals', [AdminController::class, 'reversals'])->name('reversals');
        Route::put('/reversals/{id}', [AdminController::class, 'processReversal'])->name('reversals.process');

        // KYC
        Route::get('/kyc', [AdminController::class, 'kycDocuments'])->name('kyc');
        Route::put('/kyc/{id}', [AdminController::class, 'updateKyc'])->name('kyc.update');

        // Support Tickets
        Route::get('/support-tickets', [AdminController::class, 'supportTickets'])->name('support_tickets');
        Route::put('/support-tickets/{id}', [AdminController::class, 'replyTicket'])->name('support_tickets.reply');

        // Logs
        Route::get('/logs/login', [AdminController::class, 'loginLogs'])->name('logs.login');
        Route::get('/logs/audit', [AdminController::class, 'auditLogs'])->name('logs.audit');
        Route::get('/logs/transaction', [AdminController::class, 'transactionLogs'])->name('logs.transaction');
        Route::get('/logs/activity', [AdminController::class, 'activityLogs'])->name('logs.activity');
        Route::get('/logs/api', [AdminController::class, 'apiLogs'])->name('logs.api');

        // General site enquiries / contacts
        Route::get('/general-requests', [AdminController::class, 'generalRequests'])->name('general_requests');
        Route::get('/general-requests/{id}', [AdminController::class, 'showGeneralRequest'])->name('general_requests.show');

        // Add Funds
        Route::get('/add-funds', [WalletController::class, 'addFunds'])->name('add_funds');
        Route::post('/add-funds', [WalletController::class, 'processAddFunds'])->name('add_funds.process');
    });

    // ========== DISTRIBUTOR ROUTES ==========
    Route::middleware('role:distributor')->prefix('distributor')->name('distributor.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'distributor'])->name('dashboard');
        Route::get('/add-funds', [WalletController::class, 'addFunds'])->name('add_funds');
        Route::post('/add-funds', [WalletController::class, 'processAddFunds'])->name('add_funds.process');
    });

    // ========== RETAILER ROUTES ==========
    Route::middleware('role:retailer')->prefix('retailer')->name('retailer.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'retailer'])->name('dashboard');

        // AEPS Services
        Route::get('/aeps/cash-withdrawal', [AepsController::class, 'cashWithdrawal'])->name('aeps.cash_withdrawal');
        Route::post('/aeps/cash-withdrawal', [AepsController::class, 'processCashWithdrawal'])->name('aeps.cash_withdrawal.process');
        Route::get('/aeps/balance-enquiry', [AepsController::class, 'balanceEnquiry'])->name('aeps.balance_enquiry');
        Route::post('/aeps/balance-enquiry', [AepsController::class, 'processBalanceEnquiry'])->name('aeps.balance_enquiry.process');
        Route::get('/aeps/mini-statement', [AepsController::class, 'miniStatement'])->name('aeps.mini_statement');
        Route::post('/aeps/mini-statement', [AepsController::class, 'processMiniStatement'])->name('aeps.mini_statement.process');
        Route::get('/aeps/transactions', [AepsController::class, 'transactions'])->name('aeps.transactions');

        // Bill Payments
        Route::get('/bill-payments', [BillPaymentController::class, 'index'])->name('bill_payments');
        Route::get('/bill-payments/create', [BillPaymentController::class, 'create'])->name('bill_payments.create');
        Route::post('/bill-payments', [BillPaymentController::class, 'store'])->name('bill_payments.store');
    });
});

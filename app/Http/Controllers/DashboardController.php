<?php

namespace App\Http\Controllers;

use App\Models\AepsTransaction;
use App\Models\CommissionReport;
use App\Models\Settlement;
use App\Models\SupportTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function admin()
    {
        $transactionScope = AepsTransaction::query();

        $totalUsers = User::count();
        $totalRetailers = User::where('role', 'retailer')->count();
        $totalDistributors = User::where('role', 'distributor')->count();
        $pendingUsers = User::where('status', 'pending')->count();
        $todayTransactions = AepsTransaction::whereDate('created_at', today())->count();
        $todayVolume = AepsTransaction::whereDate('created_at', today())
            ->where('status', 'success')
            ->sum('amount');
        $totalTransactions = AepsTransaction::count();
        $totalVolume = AepsTransaction::where('status', 'success')->sum('amount');
        $pendingSettlements = Settlement::where('status', 'pending')->count();
        $openTickets = SupportTicket::where('status', 'open')->count();

        $data = [
            'totalUsers' => $totalUsers,
            'totalRetailers' => $totalRetailers,
            'totalDistributors' => $totalDistributors,
            'pendingUsers' => $pendingUsers,
            'todayTransactions' => $todayTransactions,
            'todayVolume' => $todayVolume,
            'totalTransactions' => $totalTransactions,
            'totalVolume' => $totalVolume,
            'pendingSettlements' => $pendingSettlements,
            'openTickets' => $openTickets,
            'recentTransactions' => AepsTransaction::with('user', 'bank')->latest()->take(8)->get(),
            'recentUsers' => User::latest()->take(5)->get(),
            'dashboardRoleKey' => 'admin',
            'dashboardCards' => [
                $this->makeCard('Total Users', $totalUsers, 'fa-users', 'purple', 'Across the whole platform'),
                $this->makeCard('Retailers', $totalRetailers, 'fa-store', 'blue', 'Live service points'),
                $this->makeCard('Distributors', $totalDistributors, 'fa-sitemap', 'green', 'Network partners'),
                $this->makeCard('Today Volume', $todayVolume, 'fa-rupee-sign', 'amber', 'Successful AEPS turnover', 'Rs '),
                $this->makeCard('Open Tickets', $openTickets, 'fa-life-ring', 'blue', 'Support items needing review'),
            ],
            'dashboardPerformance' => $this->buildPerformanceChart($transactionScope),
            'dashboardSchedule' => $this->buildStatusChart($transactionScope),
            'dashboardPie' => $this->buildServicePieChart($transactionScope),
            'dashboardSpotlight' => [
                'eyebrow' => 'System live',
                'title' => 'Operational Spotlight',
                'headline' => number_format($todayTransactions) . ' transactions recorded today',
                'description' => 'Compare this week with last week and keep approvals, settlements, and support queues moving.',
                'items' => [
                    ['icon' => 'fa-user-clock', 'label' => 'Pending approvals', 'value' => number_format($pendingUsers)],
                    ['icon' => 'fa-money-check-dollar', 'label' => 'Pending settlements', 'value' => number_format($pendingSettlements)],
                    ['icon' => 'fa-bolt', 'label' => 'Success rate', 'value' => $this->calculateSuccessRate($transactionScope) . '%'],
                    ['icon' => 'fa-layer-group', 'label' => 'Top service', 'value' => $this->resolveTopService($transactionScope)],
                ],
                'action' => ['label' => 'Review Tickets', 'url' => route('admin.support_tickets')],
            ],
            'dashboardTableTitle' => 'Recent Transactions',
            'dashboardTableDescription' => 'Latest AEPS activity from across the platform.',
            'dashboardShowUser' => true,
            'dashboardTableEmpty' => 'No transactions available yet.',
        ];

        return view('admin.dashboard', $data);
    }

    public function distributor()
    {
        $user = auth()->user();
        $retailerIds = $user->children()->pluck('users.id');
        $transactionScope = AepsTransaction::query()->whereIn('user_id', $retailerIds);

        $walletBalance = $user->getWalletBalance();
        $totalRetailers = $retailerIds->count();
        $activeRetailers = User::whereIn('id', $retailerIds)->where('status', 'active')->count();
        $todayTransactions = AepsTransaction::whereIn('user_id', $retailerIds)->whereDate('created_at', today())->count();
        $todayVolume = AepsTransaction::whereIn('user_id', $retailerIds)
            ->whereDate('created_at', today())
            ->where('status', 'success')
            ->sum('amount');
        $totalCommission = CommissionReport::where('user_id', $user->id)->sum('amount');

        $data = [
            'walletBalance' => $walletBalance,
            'totalRetailers' => $totalRetailers,
            'activeRetailers' => $activeRetailers,
            'todayTransactions' => $todayTransactions,
            'todayVolume' => $todayVolume,
            'totalCommission' => $totalCommission,
            'retailers' => User::whereIn('id', $retailerIds)->with('wallet')->latest()->take(10)->get(),
            'recentTransactions' => AepsTransaction::whereIn('user_id', $retailerIds)->with('user', 'bank')->latest()->take(8)->get(),
            'dashboardRoleKey' => 'distributor',
            'dashboardCards' => [
                $this->makeCard('Wallet Balance', $walletBalance, 'fa-wallet', 'purple', 'Available for retailer support', 'Rs '),
                $this->makeCard('Retailers', $totalRetailers, 'fa-store', 'blue', 'Mapped below your network'),
                $this->makeCard('Active Retailers', $activeRetailers, 'fa-user-check', 'green', 'Currently approved and active'),
                $this->makeCard('Today Volume', $todayVolume, 'fa-rupee-sign', 'amber', 'Network transaction turnover', 'Rs '),
                $this->makeCard('Total Commission', $totalCommission, 'fa-coins', 'purple', 'Lifetime commission earned', 'Rs '),
            ],
            'dashboardPerformance' => $this->buildPerformanceChart($transactionScope),
            'dashboardSchedule' => $this->buildStatusChart($transactionScope),
            'dashboardPie' => $this->buildServicePieChart($transactionScope),
            'dashboardSpotlight' => [
                'eyebrow' => 'Retailer network',
                'title' => 'Distribution Snapshot',
                'headline' => number_format($activeRetailers) . ' of ' . number_format($totalRetailers) . ' retailers active',
                'description' => 'Use the weekly trend and status mix below to spot underperforming days and support your retailers faster.',
                'items' => [
                    ['icon' => 'fa-wallet', 'label' => 'Wallet ready', 'value' => 'Rs ' . number_format((float) $walletBalance)],
                    ['icon' => 'fa-bolt', 'label' => 'Success rate', 'value' => $this->calculateSuccessRate($transactionScope) . '%'],
                    ['icon' => 'fa-chart-column', 'label' => 'Today transactions', 'value' => number_format($todayTransactions)],
                    ['icon' => 'fa-layer-group', 'label' => 'Top service', 'value' => $this->resolveTopService($transactionScope)],
                ],
                'action' => ['label' => 'Add Funds', 'url' => route('distributor.add_funds')],
            ],
            'dashboardTableTitle' => 'Retailer Transactions',
            'dashboardTableDescription' => 'Most recent AEPS activity generated by your retailers.',
            'dashboardShowUser' => true,
            'dashboardTableEmpty' => 'No retailer transactions yet.',
        ];

        return view('distributor.dashboard', $data);
    }

    public function retailer()
    {
        $user = auth()->user();
        $transactionScope = $user->aepsTransactions();

        $walletBalance = $user->getWalletBalance();
        $todayTransactions = $user->aepsTransactions()->whereDate('created_at', today())->count();
        $todayVolume = $user->aepsTransactions()
            ->whereDate('created_at', today())
            ->where('status', 'success')
            ->sum('amount');
        $todayCommission = $user->aepsTransactions()
            ->whereDate('created_at', today())
            ->where('status', 'success')
            ->sum('commission');
        $totalTransactions = $user->aepsTransactions()->count();
        $totalCommission = CommissionReport::where('user_id', $user->id)->sum('amount');
        $kycStatus = $user->profile ? $user->profile->kyc_status : 'pending';

        $data = [
            'walletBalance' => $walletBalance,
            'todayTransactions' => $todayTransactions,
            'todayVolume' => $todayVolume,
            'todayCommission' => $todayCommission,
            'totalTransactions' => $totalTransactions,
            'totalCommission' => $totalCommission,
            'recentTransactions' => $user->aepsTransactions()->with('bank')->latest()->take(8)->get(),
            'kycStatus' => $kycStatus,
            'dashboardRoleKey' => 'retailer',
            'dashboardCards' => [
                $this->makeCard('Wallet Balance', $walletBalance, 'fa-wallet', 'purple', 'Ready for customer service', 'Rs '),
                $this->makeCard('Today Transactions', $todayTransactions, 'fa-exchange-alt', 'blue', 'Services processed today'),
                $this->makeCard('Today Volume', $todayVolume, 'fa-rupee-sign', 'green', 'Successful AEPS amount', 'Rs '),
                $this->makeCard('Today Commission', $todayCommission, 'fa-coins', 'amber', 'Commission earned today', 'Rs '),
                $this->makeCard('Total Transactions', $totalTransactions, 'fa-chart-line', 'purple', 'Lifetime transaction count'),
            ],
            'dashboardPerformance' => $this->buildPerformanceChart($transactionScope),
            'dashboardSchedule' => $this->buildStatusChart($transactionScope),
            'dashboardPie' => $this->buildServicePieChart($transactionScope),
            'dashboardSpotlight' => [
                'eyebrow' => 'AEPS live',
                'title' => 'Service Snapshot',
                'headline' => number_format($todayTransactions) . ' customer requests served today',
                'description' => 'Track your weekly momentum, watch failed or pending requests, and keep your wallet and KYC healthy.',
                'items' => [
                    ['icon' => 'fa-id-card', 'label' => 'KYC status', 'value' => ucfirst($kycStatus)],
                    ['icon' => 'fa-wallet', 'label' => 'Wallet ready', 'value' => 'Rs ' . number_format((float) $walletBalance)],
                    ['icon' => 'fa-bolt', 'label' => 'Success rate', 'value' => $this->calculateSuccessRate($transactionScope) . '%'],
                    ['icon' => 'fa-layer-group', 'label' => 'Top service', 'value' => $this->resolveTopService($transactionScope)],
                ],
                'action' => ['label' => 'Start Withdrawal', 'url' => route('retailer.aeps.cash_withdrawal')],
            ],
            'dashboardTableTitle' => 'Recent Transactions',
            'dashboardTableDescription' => 'Your latest AEPS requests and outcomes.',
            'dashboardShowUser' => false,
            'dashboardTableEmpty' => 'No transactions yet. Start with a cash withdrawal or balance enquiry.',
        ];

        return view('retailer.dashboard', $data);
    }

    private function buildPerformanceChart(Builder|HasMany $transactionsQuery): array
    {
        $currentDays = collect(range(6, 0))
            ->map(fn (int $offset) => today()->subDays($offset)->copy())
            ->values();

        $previousDays = $currentDays
            ->map(fn (Carbon $day) => $day->copy()->subWeek())
            ->values();

        $currentSeries = $this->buildSuccessfulVolumeSeries($transactionsQuery, $currentDays);
        $previousSeries = $this->buildSuccessfulVolumeSeries($transactionsQuery, $previousDays);

        return [
            'labels' => $currentDays->map(fn (Carbon $day) => $day->format('d M'))->values()->all(),
            'currentLabel' => 'This Week',
            'previousLabel' => 'Last Week',
            'currentSeries' => $currentSeries,
            'previousSeries' => $previousSeries,
            'currentTotal' => array_sum($currentSeries),
            'previousTotal' => array_sum($previousSeries),
        ];
    }

    private function buildStatusChart(Builder|HasMany $transactionsQuery): array
    {
        $days = collect(range(5, 0))
            ->map(fn (int $offset) => today()->subDays($offset)->copy())
            ->values();

        $rows = (clone $transactionsQuery)
            ->whereBetween('created_at', [$days->first()->copy()->startOfDay(), $days->last()->copy()->endOfDay()])
            ->selectRaw('DATE(created_at) as chart_date')
            ->selectRaw("SUM(CASE WHEN status = 'success' THEN 1 ELSE 0 END) as success_total")
            ->selectRaw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_total")
            ->selectRaw("SUM(CASE WHEN status IN ('failed', 'reversed') THEN 1 ELSE 0 END) as issue_total")
            ->groupBy('chart_date')
            ->orderBy('chart_date')
            ->get()
            ->keyBy('chart_date');

        $successSeries = [];
        $pendingSeries = [];
        $issueSeries = [];

        foreach ($days as $day) {
            $row = $rows->get($day->toDateString());
            $successSeries[] = (int) ($row->success_total ?? 0);
            $pendingSeries[] = (int) ($row->pending_total ?? 0);
            $issueSeries[] = (int) ($row->issue_total ?? 0);
        }

        return [
            'labels' => $days->map(fn (Carbon $day) => $day->format('d M'))->values()->all(),
            'datasets' => [
                ['label' => 'Success', 'data' => $successSeries, 'backgroundColor' => '#2563eb'],
                ['label' => 'Pending', 'data' => $pendingSeries, 'backgroundColor' => '#22c55e'],
                ['label' => 'Issues', 'data' => $issueSeries, 'backgroundColor' => '#fb7185'],
            ],
        ];
    }

    private function buildSuccessfulVolumeSeries(Builder|HasMany $transactionsQuery, Collection $days): array
    {
        $rows = (clone $transactionsQuery)
            ->where('status', 'success')
            ->whereBetween('created_at', [$days->first()->copy()->startOfDay(), $days->last()->copy()->endOfDay()])
            ->selectRaw('DATE(created_at) as chart_date, SUM(amount) as total_amount')
            ->groupBy('chart_date')
            ->orderBy('chart_date')
            ->pluck('total_amount', 'chart_date');

        return $days
            ->map(fn (Carbon $day) => round((float) ($rows[$day->toDateString()] ?? 0), 2))
            ->values()
            ->all();
    }

    private function buildServicePieChart(Builder|HasMany $transactionsQuery): array
    {
        $colorMap = [
            'cash_withdrawal' => '#2563eb',
            'balance_enquiry' => '#22c55e',
            'mini_statement' => '#f97316',
            'aadhaar_pay' => '#eab308',
        ];

        $serviceRows = (clone $transactionsQuery)
            ->selectRaw('service_type, COUNT(*) as total')
            ->groupBy('service_type')
            ->orderByDesc('total')
            ->get();

        $items = $serviceRows->map(function ($row) use ($colorMap) {
            $serviceType = (string) $row->service_type;
            $label = str($serviceType)->replace('_', ' ')->title()->toString();

            return [
                'label' => $label,
                'value' => (int) $row->total,
                'color' => $colorMap[$serviceType] ?? '#8b5cf6',
            ];
        })->values();

        $total = $items->sum('value');

        return [
            'labels' => $items->pluck('label')->all(),
            'series' => $items->pluck('value')->all(),
            'colors' => $items->pluck('color')->all(),
            'total' => $total,
            'items' => $items->map(fn (array $item) => [
                'label' => $item['label'],
                'value' => $item['value'],
                'color' => $item['color'],
                'share' => $total > 0 ? (int) round(($item['value'] / $total) * 100) : 0,
            ])->all(),
        ];
    }

    private function calculateSuccessRate(Builder|HasMany $transactionsQuery): int
    {
        $totalTransactions = (clone $transactionsQuery)->count();

        if ($totalTransactions === 0) {
            return 0;
        }

        $successfulTransactions = (clone $transactionsQuery)
            ->where('status', 'success')
            ->count();

        return (int) round(($successfulTransactions / $totalTransactions) * 100);
    }

    private function resolveTopService(Builder|HasMany $transactionsQuery): string
    {
        $topService = (clone $transactionsQuery)
            ->selectRaw('service_type, COUNT(*) as total')
            ->groupBy('service_type')
            ->orderByDesc('total')
            ->first();

        if (! $topService || ! $topService->service_type) {
            return 'No activity yet';
        }

        return str($topService->service_type)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }

    private function makeCard(
        string $label,
        float|int $value,
        string $icon,
        string $tone,
        string $meta,
        string $prefix = ''
    ): array {
        return [
            'label' => $label,
            'value' => $value,
            'icon' => $icon,
            'tone' => $tone,
            'meta' => $meta,
            'prefix' => $prefix,
        ];
    }
}

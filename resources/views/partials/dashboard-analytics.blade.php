@once
    <style>
        .dashboard-kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .dashboard-kpi-grid .stat-card {
            min-height: 164px;
            border-radius: 18px;
            background:
                radial-gradient(circle at top right, rgba(37, 99, 235, 0.08), transparent 42%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(248, 250, 252, 0.96));
            cursor: default;
        }

        body.dark-theme .dashboard-kpi-grid .stat-card {
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.13), transparent 42%),
                linear-gradient(180deg, rgba(35, 35, 37, 0.98), rgba(28, 28, 30, 0.98));
        }

        .dashboard-kpi-grid .stat-card::before {
            opacity: 0.06;
            background:
                radial-gradient(circle, rgba(148, 163, 184, 0.18) 1px, transparent 1px);
            background-size: 10px 10px;
        }

        .dashboard-kpi-grid .stat-value[data-prefix]::before,
        .dashboard-kpi-grid .stat-value[data-suffix]::after {
            font-size: 16px;
            font-weight: 700;
            margin: 0 4px 0 0;
            color: var(--text-muted);
        }

        .dashboard-kpi-grid .stat-value[data-prefix]::before {
            content: attr(data-prefix);
        }

        .dashboard-kpi-grid .stat-value[data-suffix]::after {
            content: attr(data-suffix);
            margin: 0 0 0 4px;
        }

        .dashboard-kpi-grid .stat-value {
            font-size: 30px;
            letter-spacing: -0.03em;
        }

        .dashboard-kpi-grid .stat-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow:
                0 26px 54px rgba(15, 23, 42, 0.18),
                0 0 0 1px rgba(255, 122, 26, 0.12);
        }

        .dashboard-kpi-grid .stat-card:hover .stat-icon {
            transform: translateY(-3px) scale(1.06);
            box-shadow: 0 16px 28px rgba(37, 99, 235, 0.18);
        }

        .dashboard-kpi-grid .stat-card:hover .card-accent {
            width: 10px;
            filter: saturate(1.2);
        }

        .dashboard-kpi-grid .stat-meta {
            margin-top: 12px;
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .dashboard-main-grid,
        .dashboard-secondary-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.7fr) minmax(300px, 0.92fr);
            gap: 24px;
            margin-bottom: 24px;
        }

        .dashboard-side-stack {
            display: grid;
            gap: 24px;
            align-content: start;
        }

        .dashboard-chart-card .card-header,
        .dashboard-spotlight-card .card-header,
        .dashboard-status-card .card-header,
        .dashboard-pie-card .card-header {
            align-items: flex-start;
            gap: 16px;
        }

        .dashboard-chart-card,
        .dashboard-spotlight-card,
        .dashboard-status-card,
        .dashboard-pie-card {
            border-radius: 20px;
            transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
        }

        .dashboard-chart-card:hover,
        .dashboard-spotlight-card:hover,
        .dashboard-status-card:hover,
        .dashboard-pie-card:hover {
            transform: translateY(-8px);
            box-shadow:
                0 28px 56px rgba(15, 23, 42, 0.16),
                0 0 0 1px rgba(255, 122, 26, 0.10);
        }

        .dashboard-chart-card .card-body,
        .dashboard-status-card .card-body,
        .dashboard-pie-card .card-body {
            padding-top: 18px;
        }

        .dashboard-chart-meta {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .dashboard-legend {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            color: var(--text-muted);
        }

        .dashboard-legend .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-flex;
        }

        .dashboard-chart-total {
            min-width: 96px;
        }

        .dashboard-chart-total strong {
            display: block;
            font-size: 18px;
            color: var(--text-primary);
            transition: transform 0.24s ease, color 0.24s ease;
        }

        .dashboard-chart-total span {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
        }

        .dashboard-canvas {
            position: relative;
            height: 320px;
        }

        .dashboard-status-card .dashboard-canvas {
            height: 300px;
        }

        .dashboard-canvas canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .dashboard-chart-card:hover .dashboard-chart-total strong {
            transform: translateY(-2px);
            color: var(--primary);
        }

        .dashboard-spotlight-card {
            overflow: hidden;
        }

        .dashboard-spotlight-card .card-body {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 18px;
            min-height: 100%;
            background:
                radial-gradient(circle at top right, rgba(249, 115, 22, 0.18), transparent 32%),
                radial-gradient(circle at bottom left, rgba(37, 99, 235, 0.12), transparent 34%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(249, 250, 252, 0.96));
        }

        body.dark-theme .dashboard-spotlight-card .card-body {
            background:
                radial-gradient(circle at top right, rgba(249, 115, 22, 0.2), transparent 30%),
                radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.18), transparent 34%),
                linear-gradient(180deg, rgba(36, 36, 38, 0.98), rgba(27, 27, 29, 0.98));
        }

        .dashboard-spotlight-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(249, 115, 22, 0.12);
            color: #ea580c;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        body.dark-theme .dashboard-spotlight-badge {
            background: rgba(255, 255, 255, 0.08);
            color: #fed7aa;
        }

        .dashboard-spotlight-copy h4 {
            margin: 0 0 8px;
            font-size: 26px;
            line-height: 1.15;
            font-family: var(--font-display);
            transition: transform 0.24s ease;
        }

        .dashboard-spotlight-copy p {
            margin: 0;
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 14px;
        }

        .dashboard-spotlight-items {
            display: grid;
            gap: 12px;
        }

        .dashboard-spotlight-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, 0.16);
            background: rgba(255, 255, 255, 0.72);
            transition: transform 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
        }

        body.dark-theme .dashboard-spotlight-item {
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.06);
        }

        .dashboard-spotlight-item i {
            width: 34px;
            height: 34px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
        }

        body.dark-theme .dashboard-spotlight-item i {
            background: rgba(255, 255, 255, 0.08);
            color: #93c5fd;
        }

        .dashboard-spotlight-item strong,
        .dashboard-spotlight-item span {
            display: block;
        }

        .dashboard-spotlight-item strong {
            font-size: 12px;
            color: var(--text-muted);
        }

        .dashboard-spotlight-item span {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 3px;
        }

        .dashboard-spotlight-item:hover {
            transform: translateX(4px);
            border-color: rgba(255, 122, 26, 0.22);
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.08);
        }

        .dashboard-spotlight-card:hover .dashboard-spotlight-copy h4 {
            transform: translateY(-2px);
        }

        .dashboard-section-note {
            margin-top: 4px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .dashboard-table-card table td,
        .dashboard-table-card table th {
            white-space: nowrap;
        }

        .dashboard-pie-layout {
            display: grid;
            grid-template-columns: minmax(0, 180px) minmax(0, 1fr);
            gap: 18px;
            align-items: center;
        }

        .dashboard-pie-canvas {
            position: relative;
            height: 220px;
        }

        .dashboard-pie-legend {
            display: grid;
            gap: 10px;
        }

        .dashboard-pie-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 14px;
            background: var(--surface-alt);
            border: 1px solid var(--border-color);
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
        }

        .dashboard-pie-item strong,
        .dashboard-pie-item span {
            display: block;
        }

        .dashboard-pie-item strong {
            font-size: 13px;
            color: var(--text-primary);
        }

        .dashboard-pie-item span {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .dashboard-pie-item .dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            flex: 0 0 auto;
        }

        .dashboard-pie-item-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .dashboard-pie-item:hover {
            transform: translateY(-2px);
            border-color: rgba(37, 99, 235, 0.2);
            box-shadow: 0 14px 24px rgba(15, 23, 42, 0.08);
        }

        body.dark-theme .dashboard-chart-card:hover,
        body.dark-theme .dashboard-spotlight-card:hover,
        body.dark-theme .dashboard-status-card:hover,
        body.dark-theme .dashboard-pie-card:hover {
            box-shadow:
                0 30px 64px rgba(0, 0, 0, 0.34),
                0 0 0 1px rgba(255, 122, 26, 0.10);
        }

        @media (max-width: 1120px) {
            .dashboard-main-grid,
            .dashboard-secondary-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-chart-meta {
                width: 100%;
            }

            .dashboard-canvas,
            .dashboard-status-card .dashboard-canvas {
                height: 260px;
            }

            .dashboard-pie-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-pie-canvas {
                height: 240px;
            }
        }
    </style>
@endonce

<div class="dashboard-kpi-grid">
    @foreach ($dashboardCards as $card)
        @php
            $rawValue = (float) $card['value'];
            $decimals = floor($rawValue) === $rawValue ? 0 : 2;
            $formattedValue = number_format($rawValue, $decimals);
        @endphp
        <div class="stat-card {{ $card['tone'] }} dynamic-card">
            <div class="card-accent"></div>
            <div class="stat-icon"><i class="fas {{ $card['icon'] }}"></i></div>
            <div
                class="stat-value"
                data-number="{{ $rawValue }}"
                data-decimals="{{ $decimals }}"
                @if(!empty($card['prefix'])) data-prefix="{{ $card['prefix'] }}" @endif
                @if(!empty($card['suffix'])) data-suffix="{{ $card['suffix'] }}" @endif
            >{{ $formattedValue }}</div>
            <div class="stat-label">{{ $card['label'] }}</div>
            <div class="stat-meta">{{ $card['meta'] }}</div>
        </div>
    @endforeach
</div>

<div class="dashboard-main-grid">
    <div class="card dashboard-chart-card">
        <div class="card-header">
            <div>
                <h3><i class="fas fa-wave-square" style="margin-right:8px;"></i>Performance Overview</h3>
                <div class="dashboard-section-note">Successful transaction volume across the last 7 days.</div>
            </div>
            <div class="dashboard-chart-meta">
                <div class="dashboard-legend"><span class="dot" style="background:#2563eb;"></span>{{ $dashboardPerformance['currentLabel'] }}</div>
                <div class="dashboard-legend"><span class="dot" style="background:#22c55e;"></span>{{ $dashboardPerformance['previousLabel'] }}</div>
                <div class="dashboard-chart-total">
                    <span>{{ $dashboardPerformance['currentLabel'] }}</span>
                    <strong>Rs {{ number_format((float) $dashboardPerformance['currentTotal']) }}</strong>
                </div>
                <div class="dashboard-chart-total">
                    <span>{{ $dashboardPerformance['previousLabel'] }}</span>
                    <strong>Rs {{ number_format((float) $dashboardPerformance['previousTotal']) }}</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="dashboard-canvas">
                <canvas id="dashboard-performance-{{ $dashboardRoleKey }}"></canvas>
            </div>
        </div>
    </div>

    <div class="card dashboard-spotlight-card">
        <div class="card-header">
            <div>
                <h3><i class="fas fa-satellite-dish" style="margin-right:8px;"></i>{{ $dashboardSpotlight['title'] }}</h3>
                <div class="dashboard-section-note">Quick insights tied to this dashboard's live data.</div>
            </div>
        </div>
        <div class="card-body">
            <div class="dashboard-spotlight-badge"><i class="fas fa-signal"></i>{{ $dashboardSpotlight['eyebrow'] }}</div>
            <div class="dashboard-spotlight-copy">
                <h4>{{ $dashboardSpotlight['headline'] }}</h4>
                <p>{{ $dashboardSpotlight['description'] }}</p>
            </div>

            <div class="dashboard-spotlight-items">
                @foreach ($dashboardSpotlight['items'] as $item)
                    <div class="dashboard-spotlight-item">
                        <i class="fas {{ $item['icon'] }}"></i>
                        <div>
                            <strong>{{ $item['label'] }}</strong>
                            <span>{{ $item['value'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (!empty($dashboardSpotlight['action']))
                <a href="{{ $dashboardSpotlight['action']['url'] }}" class="btn btn-primary">
                    <i class="fas fa-arrow-right"></i> {{ $dashboardSpotlight['action']['label'] }}
                </a>
            @endif
        </div>
    </div>
</div>

<div class="dashboard-secondary-grid">
    <div class="card dashboard-table-card">
        <div class="card-header">
            <div>
                <h3><i class="fas fa-table-list" style="margin-right:8px;"></i>{{ $dashboardTableTitle }}</h3>
                <div class="dashboard-section-note">{{ $dashboardTableDescription }}</div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Txn ID</th>
                            @if ($dashboardShowUser)
                                <th>User</th>
                            @endif
                            <th>Service</th>
                            <th>Bank</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentTransactions as $txn)
                            <tr>
                                <td style="font-family:monospace;font-size:12px;">{{ $txn->transaction_id }}</td>
                                @if ($dashboardShowUser)
                                    <td>{{ $txn->user->name ?? 'N/A' }}</td>
                                @endif
                                <td><span class="badge badge-info">{{ ucwords(str_replace('_', ' ', $txn->service_type)) }}</span></td>
                                <td>{{ $txn->bank->bank_name ?? 'N/A' }}</td>
                                <td style="font-weight:700;">Rs {{ number_format((float) $txn->amount, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $txn->status === 'success' ? 'success' : ($txn->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($txn->status) }}
                                    </span>
                                </td>
                                <td style="font-size:12px;">{{ $txn->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $dashboardShowUser ? 7 : 6 }}" style="text-align:center;padding:40px;color:#64748b;">
                                    {{ $dashboardTableEmpty }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="dashboard-side-stack">
        <div class="card dashboard-status-card">
            <div class="card-header">
                <div>
                    <h3><i class="fas fa-chart-column" style="margin-right:8px;"></i>Transaction Status Mix</h3>
                    <div class="dashboard-section-note">Daily success, pending, and issue counts for the last 6 days.</div>
                </div>
            </div>
            <div class="card-body">
                <div class="dashboard-canvas">
                    <canvas id="dashboard-status-{{ $dashboardRoleKey }}"></canvas>
                </div>
            </div>
        </div>

        <div class="card dashboard-pie-card">
            <div class="card-header">
                <div>
                    <h3><i class="fas fa-chart-pie" style="margin-right:8px;"></i>Service Distribution</h3>
                    <div class="dashboard-section-note">Live split of requests by AEPS service type.</div>
                </div>
            </div>
            <div class="card-body">
                @if (($dashboardPie['total'] ?? 0) > 0)
                    <div class="dashboard-pie-layout">
                        <div class="dashboard-pie-canvas">
                            <canvas id="dashboard-pie-{{ $dashboardRoleKey }}"></canvas>
                        </div>
                        <div class="dashboard-pie-legend">
                            @foreach ($dashboardPie['items'] as $item)
                                <div class="dashboard-pie-item">
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <span class="dot" style="background:{{ $item['color'] }};"></span>
                                        <div>
                                            <strong>{{ $item['label'] }}</strong>
                                            <span>{{ $item['share'] }}% of total requests</span>
                                        </div>
                                    </div>
                                    <div class="dashboard-pie-item-value">{{ number_format($item['value']) }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="empty-state" style="padding:36px 12px;">
                        <i class="fas fa-chart-pie"></i>
                        <p>No service distribution data yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

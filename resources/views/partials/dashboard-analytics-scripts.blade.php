@once
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endonce
<script>
    (function () {
        const performanceCanvas = document.getElementById('dashboard-performance-{{ $dashboardRoleKey }}');
        const statusCanvas = document.getElementById('dashboard-status-{{ $dashboardRoleKey }}');
        const pieCanvas = document.getElementById('dashboard-pie-{{ $dashboardRoleKey }}');

        if (!performanceCanvas || !statusCanvas || typeof Chart === 'undefined') {
            return;
        }

        const performanceData = @json($dashboardPerformance);
        const statusData = @json($dashboardSchedule);
        const pieData = @json($dashboardPie);

        function formatCurrency(value) {
            return 'Rs ' + new Intl.NumberFormat('en-IN', {
                maximumFractionDigits: 0,
            }).format(value || 0);
        }

        function destroyIfExists(canvas) {
            if (!canvas) {
                return;
            }

            const existingChart = Chart.getChart(canvas);
            if (existingChart) {
                existingChart.destroy();
            }
        }

        function buildCommonColors() {
            const styles = getComputedStyle(document.body);

            return {
                textColor: styles.getPropertyValue('--text-muted').trim() || '#64748b',
                titleColor: styles.getPropertyValue('--text-primary').trim() || '#0f172a',
                gridColor: document.body.classList.contains('dark-theme')
                    ? 'rgba(148, 163, 184, 0.14)'
                    : 'rgba(148, 163, 184, 0.18)',
                tooltipBg: document.body.classList.contains('dark-theme') ? '#09090b' : '#0f172a',
                tooltipText: '#f8fafc',
            };
        }

        function renderCharts() {
            const palette = buildCommonColors();

            destroyIfExists(performanceCanvas);
            destroyIfExists(statusCanvas);
            destroyIfExists(pieCanvas);

            new Chart(performanceCanvas, {
                type: 'line',
                data: {
                    labels: performanceData.labels,
                    datasets: [
                        {
                            label: performanceData.currentLabel,
                            data: performanceData.currentSeries,
                            borderColor: '#2563eb',
                            backgroundColor: 'rgba(37, 99, 235, 0.24)',
                            fill: true,
                            tension: 0.42,
                            pointRadius: 0,
                            pointHoverRadius: 5,
                            borderWidth: 3,
                        },
                        {
                            label: performanceData.previousLabel,
                            data: performanceData.previousSeries,
                            borderColor: '#22c55e',
                            backgroundColor: 'rgba(34, 197, 94, 0.18)',
                            fill: true,
                            tension: 0.42,
                            pointRadius: 0,
                            pointHoverRadius: 5,
                            borderWidth: 3,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1200,
                        easing: 'easeOutQuart'
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: palette.tooltipBg,
                            titleColor: palette.tooltipText,
                            bodyColor: palette.tooltipText,
                            callbacks: {
                                label: function (context) {
                                    return context.dataset.label + ': ' + formatCurrency(context.parsed.y);
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: palette.textColor
                            },
                            grid: {
                                display: false
                            },
                            border: {
                                color: palette.gridColor
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: palette.textColor,
                                callback: function (value) {
                                    return formatCurrency(value);
                                }
                            },
                            grid: {
                                color: palette.gridColor
                            },
                            border: {
                                color: palette.gridColor
                            }
                        }
                    }
                }
            });

            new Chart(statusCanvas, {
                type: 'bar',
                data: {
                    labels: statusData.labels,
                    datasets: statusData.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1100,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: palette.titleColor,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 16
                            }
                        },
                        tooltip: {
                            backgroundColor: palette.tooltipBg,
                            titleColor: palette.tooltipText,
                            bodyColor: palette.tooltipText
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            ticks: {
                                color: palette.textColor
                            },
                            grid: {
                                display: false
                            },
                            border: {
                                color: palette.gridColor
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                color: palette.textColor,
                                precision: 0
                            },
                            grid: {
                                color: palette.gridColor
                            },
                            border: {
                                color: palette.gridColor
                            }
                        }
                    }
                }
            });

            if (pieCanvas && Array.isArray(pieData.series) && pieData.series.length > 0) {
                new Chart(pieCanvas, {
                    type: 'pie',
                    data: {
                        labels: pieData.labels,
                        datasets: [
                            {
                                data: pieData.series,
                                backgroundColor: pieData.colors,
                                borderColor: document.body.classList.contains('dark-theme') ? '#1d1d1f' : '#ffffff',
                                borderWidth: 3,
                                hoverOffset: 10,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1200,
                            easing: 'easeOutQuart'
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: palette.tooltipBg,
                                titleColor: palette.tooltipText,
                                bodyColor: palette.tooltipText,
                                callbacks: {
                                    label: function (context) {
                                        return context.label + ': ' + new Intl.NumberFormat('en-IN').format(context.parsed);
                                    }
                                }
                            }
                        }
                    }
                });
            }
        }

        renderCharts();
        window.addEventListener('aeps:theme-changed', renderCharts);
    })();
</script>

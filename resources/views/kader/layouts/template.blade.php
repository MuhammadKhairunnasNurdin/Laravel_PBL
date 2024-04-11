<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset ('node_modules/apexcharts/dist/apexcharts.css') }}">
</head>
<body class="bg-gray-200 w-full h-screen">
    @include('kader.layouts.header')
    <div class="grid grid-cols-6">
        <div class="col-span-1">
            @include('kader.layouts.sidebar')
        </div>
        <div class="col-span-5">
            <div class="flex px-5 text-2xl pt-5">
                @include('kader.layouts.breadcrumb')
            </div>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('node_modules/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('node_modules/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

    <script>
    window.addEventListener('load', () => {
        (function () {
        buildChart('#hs-single-bar-chart', (mode) => ({
            chart: {
            type: 'bar',
            height: 300,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            }
            },
            series: [
            {
                name: 'Sales',
                data: [23000, 44000, 55000, 57000, 56000, 61000, 58000, 63000, 60000, 66000, 34000, 78000]
            }
            ],
            plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '16px',
                borderRadius: 0
            }
            },
            legend: {
            show: false
            },
            dataLabels: {
            enabled: false
            },
            stroke: {
            show: true,
            width: 8,
            colors: ['transparent']
            },
            xaxis: {
            categories: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                show: false
            },
            labels: {
                style: {
                colors: '#9ca3af',
                fontSize: '13px',
                fontFamily: 'Inter, ui-sans-serif',
                fontWeight: 400
                },
                offsetX: -2,
                formatter: (title) => title.slice(0, 3)
            }
            },
            yaxis: {
            labels: {
                align: 'left',
                minWidth: 0,
                maxWidth: 140,
                style: {
                colors: '#9ca3af',
                fontSize: '13px',
                fontFamily: 'Inter, ui-sans-serif',
                fontWeight: 400
                },
                formatter: (value) => value >= 1000 ? `${value / 1000}k` : value
            }
            },
            states: {
            hover: {
                filter: {
                type: 'darken',
                value: 0.9
                }
            }
            },
            tooltip: {
            y: {
                formatter: (value) => `$${value >= 1000 ? `${value / 1000}k` : value}`
            },
            custom: function (props) {
                const { categories } = props.ctx.opts.xaxis;
                const { dataPointIndex } = props;
                const title = categories[dataPointIndex];
                const newTitle = `${title}`;

                return buildTooltip(props, {
                title: newTitle,
                mode,
                hasTextLabel: true,
                wrapperExtClasses: 'min-w-28',
                labelDivider: ':',
                labelExtClasses: 'ms-2'
                });
            }
            },
            responsive: [{
            breakpoint: 568,
            options: {
                chart: {
                height: 300
                },
                plotOptions: {
                bar: {
                    columnWidth: '14px'
                }
                },
                stroke: {
                width: 8
                },
                labels: {
                style: {
                    colors: '#9ca3af',
                    fontSize: '11px',
                    fontFamily: 'Inter, ui-sans-serif',
                    fontWeight: 400
                },
                offsetX: -2,
                formatter: (title) => title.slice(0, 3)
                },
                yaxis: {
                labels: {
                    align: 'left',
                    minWidth: 0,
                    maxWidth: 140,
                    style: {
                    colors: '#9ca3af',
                    fontSize: '11px',
                    fontFamily: 'Inter, ui-sans-serif',
                    fontWeight: 400
                    },
                    formatter: (value) => value >= 1000 ? `${value / 1000}k` : value
                }
                },
            },
            }]
        }), {
            colors: ['#2563eb', '#d1d5db'],
            grid: {
            borderColor: '#e5e7eb'
            }
        }, {
            colors: ['#3b82f6', '#2563eb'],
            grid: {
            borderColor: '#374151'
            }
        });
        })();
    });
    </script>
</body>
</html>
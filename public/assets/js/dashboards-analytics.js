/**
 * Dashboard Analytics
 */

"use strict";

(function () {
    let cardColor, headingColor, axisColor, shadeColor, borderColor;

    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    // Total Revenue Report Chart - Bar Chart
    // --------------------------------------------------------------------
    const totalRevenueChartEl = document.querySelector("#totalRevenueChart"),
        totalRevenueChartOptions = {
            series: [
                {
                    name: "2021",
                    data: [18, 7, 15, 29, 18, 12, 9],
                },
                {
                    name: "2020",
                    data: [-13, -18, -9, -14, -5, -17, -15],
                },
            ],
            chart: {
                height: 300,
                stacked: true,
                type: "bar",
                toolbar: { show: false },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "33%",
                    borderRadius: 12,
                    startingShape: "rounded",
                    endingShape: "rounded",
                },
            },
            colors: [config.colors.primary, config.colors.info],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
                width: 6,
                lineCap: "round",
                colors: [cardColor],
            },
            legend: {
                show: true,
                horizontalAlign: "left",
                position: "top",
                markers: {
                    height: 8,
                    width: 8,
                    radius: 12,
                    offsetX: -3,
                },
                labels: {
                    colors: axisColor,
                },
                itemMargin: {
                    horizontal: 10,
                },
            },
            grid: {
                borderColor: borderColor,
                padding: {
                    top: 0,
                    bottom: -8,
                    left: 20,
                    right: 20,
                },
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                labels: {
                    style: {
                        fontSize: "13px",
                        colors: axisColor,
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: "13px",
                        colors: axisColor,
                    },
                },
            },
            responsive: [
                {
                    breakpoint: 1700,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "32%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1580,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "35%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1440,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "42%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1300,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "48%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1200,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "40%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1040,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 11,
                                columnWidth: "48%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 991,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "30%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 840,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "35%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 768,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "28%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 640,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "32%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "37%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 480,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "45%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 420,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "52%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 380,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "60%",
                            },
                        },
                    },
                },
            ],
            states: {
                hover: {
                    filter: {
                        type: "none",
                    },
                },
                active: {
                    filter: {
                        type: "none",
                    },
                },
            },
        };
    if (
        typeof totalRevenueChartEl !== undefined &&
        totalRevenueChartEl !== null
    ) {
        const totalRevenueChart = new ApexCharts(
            totalRevenueChartEl,
            totalRevenueChartOptions
        );
        totalRevenueChart.render();
    }

    // Growth Chart - Radial Bar Chart
    // --------------------------------------------------------------------
    const growthChartEl = document.querySelector("#growthChart"),
        growthChartOptions = {
            series: [78],
            labels: ["Growth"],
            chart: {
                height: 240,
                type: "radialBar",
            },
            plotOptions: {
                radialBar: {
                    size: 150,
                    offsetY: 10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: "55%",
                    },
                    track: {
                        background: cardColor,
                        strokeWidth: "100%",
                    },
                    dataLabels: {
                        name: {
                            offsetY: 15,
                            color: headingColor,
                            fontSize: "15px",
                            fontWeight: "600",
                            fontFamily: "Public Sans",
                        },
                        value: {
                            offsetY: -25,
                            color: headingColor,
                            fontSize: "22px",
                            fontWeight: "500",
                            fontFamily: "Public Sans",
                        },
                    },
                },
            },
            colors: [config.colors.primary],
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 0.6,
                    stops: [30, 70, 100],
                },
            },
            stroke: {
                dashArray: 5,
            },
            grid: {
                padding: {
                    top: -35,
                    bottom: -10,
                },
            },
            states: {
                hover: {
                    filter: {
                        type: "none",
                    },
                },
                active: {
                    filter: {
                        type: "none",
                    },
                },
            },
        };
    if (typeof growthChartEl !== undefined && growthChartEl !== null) {
        const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
        growthChart.render();
    }

    // Profile Report Chart
    const profileReportChartEl = document.querySelector("#profileReportChart");

    if (profileReportChartEl) {
        fetch("/api/profile-report-stats")
            .then((response) => response.json())
            .then((data) => {
                const formatRupiah = (angka) => {
                    if (angka >= 1000000) {
                        return "Rp " + (angka / 1000000).toFixed(1) + "jt";
                    } else if (angka >= 1000) {
                        return "Rp " + (angka / 1000).toFixed(1) + "K";
                    }
                    return "Rp " + angka.toLocaleString("id-ID");
                };

                const profileReportChartConfig = {
                    chart: {
                        height: 120,
                        type: "line",
                        toolbar: {
                            show: false,
                        },
                        dropShadow: {
                            enabled: true,
                            top: 10,
                            left: 5,
                            blur: 3,
                            color: config.colors.warning,
                            opacity: 0.15,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    grid: {
                        show: false,
                        padding: {
                            right: 8,
                        },
                    },
                    colors: [config.colors.warning],
                    dataLabels: {
                        enabled: true,
                        formatter: (val) => formatRupiah(val),
                        style: {
                            fontSize: "10px",
                            fontWeight: "bold",
                            colors: ["#ffa60d"], // Warna label
                        },
                    },
                    stroke: {
                        width: 5,
                        curve: "smooth",
                    },
                    series: [
                        {
                            data: data.trend, // Data trend dari API
                        },
                    ],
                    xaxis: {
                        categories: data.months,
                        labels: {
                            style: {
                                fontSize: "12px",
                                colors: "#6c757d",
                            },
                        },
                    },
                    yaxis: {
                        labels: {
                            formatter: (val) => formatRupiah(val),
                            style: {
                                fontSize: "12px",
                                colors: "#6c757d",
                            },
                        },
                    },
                };

                const profileReportChart = new ApexCharts(
                    profileReportChartEl,
                    profileReportChartConfig
                );
                profileReportChart.render();
            })
            .catch((error) =>
                console.error("Error fetching profile report data:", error)
            );
    }

    // Order Statistics Chart
    // --------------------------------------------------------------------
    const chartOrderStatistics = document.querySelector(
        "#orderStatisticsChart"
    );
    const orderStatisticsList = document.querySelector("#orderStatisticsList");

    if (chartOrderStatistics !== null && orderStatisticsList !== null) {
        // Fetch data dari backend
        fetch("/api/order-statistics")
            .then((response) => response.json())
            .then((data) => {
                // Update chart configuration
                const orderChartConfig = {
                    chart: {
                        height: 165,
                        width: 130,
                        type: "donut",
                    },
                    labels: data.labels, // Labels dari API
                    series: data.series, // Series dari API
                    colors: [
                        config.colors.primary,
                        config.colors.secondary,
                        config.colors.info,
                        config.colors.success,
                    ],
                    stroke: {
                        width: 5,
                        colors: cardColor,
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val, opt) {
                            return parseInt(val) + "%";
                        },
                    },
                    legend: {
                        show: false,
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            right: 15,
                        },
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: "75%",
                                labels: {
                                    show: true,
                                    value: {
                                        fontSize: "1.5rem",
                                        fontFamily: "Public Sans",
                                        color: headingColor,
                                        offsetY: -15,
                                        formatter: function (val) {
                                            return parseInt(val);
                                        },
                                    },
                                    name: {
                                        offsetY: 20,
                                        fontFamily: "Public Sans",
                                    },
                                    total: {
                                        show: true,
                                        fontSize: "0.8125rem",
                                        color: axisColor,
                                        label: "Total",
                                        formatter: function (w) {
                                            return w.globals.seriesTotals.reduce(
                                                (a, b) => a + b,
                                                0
                                            );
                                        },
                                    },
                                },
                            },
                        },
                    },
                };

                // Render chart
                const statisticsChart = new ApexCharts(
                    chartOrderStatistics,
                    orderChartConfig
                );
                statisticsChart.render();

                // Render list items
                orderStatisticsList.innerHTML = ""; // Clear existing items
                data.labels.forEach((label, index) => {
                    const seriesValue = data.series[index];
                    orderStatisticsList.innerHTML += `
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-box"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">${label}</h6>
                                <small class="text-muted">Sales</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">${seriesValue}</small>
                            </div>
                        </div>
                    </li>
                `;
                });
            })
            .catch((error) =>
                console.error("Error fetching chart data:", error)
            );
    }

    // Income Chart - Area chart
    // --------------------------------------------------------------------
    const incomeChartEl = document.querySelector("#incomeChart");
    const expensesOfWeekEl = document.querySelector("#expensesOfWeek");
    const totalBalanceEl = document.querySelector("#totalBalance");
    const expenseDifferenceEl = document.querySelector("#expenseDifference");

    if (incomeChartEl && expensesOfWeekEl) {
        fetch("/api/dashboard-stats")
            .then((response) => response.json())
            .then((data) => {
                // Konversi semua nilai ke angka
                const totalIncome = parseFloat(data.totalIncome) || 0;
                const totalExpenses = parseFloat(data.totalExpenses) || 0;
                const totalProfit = parseFloat(data.totalProfit) || 0;
                const expensesThisWeek = parseFloat(data.expensesThisWeek) || 0;
                const expenseDifference =
                    parseFloat(data.expenseDifference) || 0;

                // Konversi incomeTrend ke format angka
                const incomeTrend = Object.entries(data.incomeTrend).reduce(
                    (acc, [month, value]) => {
                        acc[month] = parseFloat(value);
                        return acc;
                    },
                    {}
                );

                // Format angka ke mata uang Rupiah
                const formatRupiah = (angka) => {
                    return angka.toLocaleString("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        minimumFractionDigits: 0,
                    });
                };

                // Update Total Balance
                totalBalanceEl.innerText = `${formatRupiah(totalIncome)}`;
                const balanceChange =
                    totalIncome > 0
                        ? ((totalProfit / totalIncome) * 100).toFixed(1)
                        : 0;
                totalBalanceEl.nextElementSibling.innerHTML = `
            <i class="bx ${
                balanceChange > 0
                    ? "bx-chevron-up text-success"
                    : "bx-chevron-down text-danger"
            }"></i> ${balanceChange}%
        `;

                // Render Income Chart
                const incomeChartConfig = {
                    series: [
                        {
                            data: Object.values(incomeTrend),
                        },
                    ],
                    chart: {
                        height: 430,
                        type: "area",
                        toolbar: {
                            show: true,
                        },
                    },
                    xaxis: {
                        categories: Object.keys(incomeTrend),
                    },
                    yaxis: {
                        labels: {
                            formatter: function (val) {
                                if (val >= 1000000) {
                                    return (
                                        "Rp " +
                                        (val / 1000000).toFixed(2) +
                                        "jt"
                                    );
                                } else if (val >= 1000) {
                                    return (
                                        "Rp " + (val / 1000).toFixed(1) + "K"
                                    );
                                }
                                return "Rp " + val.toLocaleString("id-ID");
                            },
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            if (val >= 1000000) {
                                return (
                                    "Rp " + (val / 1000000).toFixed(2) + "jt"
                                );
                            } else if (val >= 1000) {
                                return "Rp " + (val / 1000).toFixed(1) + "K";
                            }
                            return "Rp " + val.toLocaleString("id-ID");
                        },
                        style: {
                            colors: ["#ffa60d"], // Optional: Warna teks label
                        },
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "Rp " + val.toLocaleString("id-ID");
                            },
                        },
                    },
                    colors: [config.colors.primary],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: "light",
                            shadeIntensity: 0.6,
                            opacityFrom: 0.5,
                            opacityTo: 0.25,
                        },
                    },
                };

                const incomeChart = new ApexCharts(
                    incomeChartEl,
                    incomeChartConfig
                );
                incomeChart.render();
            })
            .catch((error) =>
                console.error("Error fetching dashboard stats:", error)
            );
    }
})();

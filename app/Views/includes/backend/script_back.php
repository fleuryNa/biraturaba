

<script src="<?= base_url('public/dist/js/jquery-4.0.0.min.js') ?>"></script>
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)-->

<!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)-->

<!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)-->

<!--begin::Required Plugin(AdminLTE) - CHEMIN CORRIGÉ -->
<script src="<?= base_url('public/dist/js/adminlte.js') ?>"></script>
<!--end::Required Plugin(AdminLTE)-->

<!--begin::OverlayScrollbars Configure-->
<script>
  const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
  const Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'leave',
    scrollbarClickScroll: true,
  };
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

    // Disable OverlayScrollbars on mobile devices to prevent touch interference
    const isMobile = window.innerWidth <= 992;

    if (
      sidebarWrapper &&
      OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
      !isMobile
    ) {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
          theme: Default.scrollbarTheme,
          autoHide: Default.scrollbarAutoHide,
          clickScroll: Default.scrollbarClickScroll,
        },
      });
    }
  });
</script>
<!--end::OverlayScrollbars Configure-->

<!--begin::Color Mode Toggle (#6010)-->
<script>
  (() => {
    'use strict';

    const STORAGE_KEY = 'lte-theme';

    const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
    const setStoredTheme = (theme) => localStorage.setItem(STORAGE_KEY, theme);

    const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;

    const getPreferredTheme = () => {
      const stored = getStoredTheme();
      if (stored) return stored;
      return prefersDark() ? 'dark' : 'light';
    };

    const setTheme = (theme) => {
      const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
      document.documentElement.setAttribute('data-bs-theme', resolved);
    };

    setTheme(getPreferredTheme());

    const showActiveTheme = (theme) => {
      document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
        el.classList.remove('active');
        el.setAttribute('aria-pressed', 'false');
        const check = el.querySelector('.bi-check-lg');
        if (check) check.classList.add('d-none');
      });
      const active = document.querySelector(`[data-bs-theme-value="${theme}"]`);
      if (active) {
        active.classList.add('active');
        active.setAttribute('aria-pressed', 'true');
        const check = active.querySelector('.bi-check-lg');
        if (check) check.classList.remove('d-none');
      }
      document.querySelectorAll('[data-lte-theme-icon]').forEach((icon) => {
        icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== theme);
      });
    };

    globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
      const stored = getStoredTheme();
      if (!stored || stored === 'auto') setTheme(getPreferredTheme());
    });

    document.addEventListener('DOMContentLoaded', () => {
      showActiveTheme(getPreferredTheme());
      document.querySelectorAll('[data-bs-theme-value]').forEach((toggle) => {
        toggle.addEventListener('click', () => {
          const theme = toggle.getAttribute('data-bs-theme-value');
          setStoredTheme(theme);
          setTheme(theme);
          showActiveTheme(theme);
        });
      });
    });
  })();
</script>
<!--end::Color Mode Toggle-->

<!-- OPTIONAL SCRIPTS -->

<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>

<script>
  // APEXCHARTS CONFIGURATION
  // Monthly Sales Chart
  const sales_chart_options = {
    series: [
      {
        name: 'Digital Goods',
        data: [28, 48, 40, 19, 86, 27, 90],
      },
      {
        name: 'Electronics',
        data: [65, 59, 80, 81, 56, 55, 40],
      },
    ],
    chart: {
      height: 180,
      type: 'area',
      toolbar: {
        show: false,
      },
    },
    legend: {
      show: false,
    },
    colors: ['#0d6efd', '#20c997'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
    },
    xaxis: {
      type: 'datetime',
      categories: [
        '2023-01-01',
        '2023-02-01',
        '2023-03-01',
        '2023-04-01',
        '2023-05-01',
        '2023-06-01',
        '2023-07-01',
      ],
    },
    tooltip: {
      x: {
        format: 'MMMM yyyy',
      },
    },
  };

  // Vérifier si l'élément existe avant de créer le graphique
  const salesChartElement = document.querySelector('#sales-chart');
  if (salesChartElement) {
    const sales_chart = new ApexCharts(salesChartElement, sales_chart_options);
    sales_chart.render();
  }

  // Sparkline Charts
  function createSparklineChart(selector, data) {
    const element = document.querySelector(selector);
    if (!element) return;
    
    const options = {
      series: [{ data }],
      chart: {
        type: 'line',
        width: 150,
        height: 30,
        sparkline: {
          enabled: true,
        },
      },
      colors: ['var(--bs-primary)'],
      stroke: {
        width: 2,
      },
      tooltip: {
        fixed: {
          enabled: false,
        },
        x: {
          show: false,
        },
        y: {
          title: {
            formatter() {
              return '';
            },
          },
        },
        marker: {
          show: false,
        },
      },
    };

    const chart = new ApexCharts(element, options);
    chart.render();
  }

  const table_sparkline_1_data = [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54];
  const table_sparkline_2_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44];
  const table_sparkline_3_data = [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64];
  const table_sparkline_4_data = [30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64];
  const table_sparkline_5_data = [20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64];
  const table_sparkline_6_data = [5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44];
  const table_sparkline_7_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74];

  createSparklineChart('#table-sparkline-1', table_sparkline_1_data);
  createSparklineChart('#table-sparkline-2', table_sparkline_2_data);
  createSparklineChart('#table-sparkline-3', table_sparkline_3_data);
  createSparklineChart('#table-sparkline-4', table_sparkline_4_data);
  createSparklineChart('#table-sparkline-5', table_sparkline_5_data);
  createSparklineChart('#table-sparkline-6', table_sparkline_6_data);
  createSparklineChart('#table-sparkline-7', table_sparkline_7_data);

  // Pie Chart
  const pie_chart_options = {
    series: [700, 500, 400, 600, 300, 100],
    chart: {
      type: 'donut',
      height: 350,
    },
    labels: ['Chrome', 'Edge', 'FireFox', 'Safari', 'Opera', 'IE'],
    dataLabels: {
      enabled: false,
    },
    colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'],
  };

  const pieChartElement = document.querySelector('#pie-chart');
  if (pieChartElement) {
    const pie_chart = new ApexCharts(pieChartElement, pie_chart_options);
    pie_chart.render();
  }
</script>

<!-- Tabulator Data Table -->
<script src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/js/tabulator.min.js" crossorigin="anonymous"></script>

<script>
  const statusBadge = (cell) => {
    const value = cell.getValue();
    const map = { Active: 'success', Invited: 'info', Suspended: 'secondary' };
    const color = map[value] || 'secondary';
    return `<span class="badge text-bg-${color}">${value}</span>`;
  };

  document.addEventListener('DOMContentLoaded', () => {
    const usersTableElement = document.querySelector('#users-table');
    if (!usersTableElement) return;

    const data = [
      { id: 1, name: 'Olivia Bennett', email: 'olivia@example.com', role: 'Admin', status: 'Active', joined: '2024-03-12' },
      { id: 2, name: 'Liam Carter', email: 'liam@example.com', role: 'Editor', status: 'Active', joined: '2024-04-08' },
      { id: 3, name: 'Emma Dawson', email: 'emma@example.com', role: 'Viewer', status: 'Invited', joined: '2024-06-21' },
      { id: 4, name: 'Noah Evans', email: 'noah@example.com', role: 'Editor', status: 'Suspended', joined: '2024-07-15' },
      { id: 5, name: 'Ava Foster', email: 'ava@example.com', role: 'Admin', status: 'Active', joined: '2024-08-30' },
      { id: 6, name: 'Ethan Grant', email: 'ethan@example.com', role: 'Viewer', status: 'Active', joined: '2024-09-14' },
      { id: 7, name: 'Sophia Hayes', email: 'sophia@example.com', role: 'Editor', status: 'Active', joined: '2024-10-02' },
      { id: 8, name: 'Mason Ingram', email: 'mason@example.com', role: 'Viewer', status: 'Invited', joined: '2024-11-19' },
      { id: 9, name: 'Isabella Jones', email: 'isabella@example.com', role: 'Admin', status: 'Active', joined: '2025-01-05' },
      { id: 10, name: 'Lucas Klein', email: 'lucas@example.com', role: 'Viewer', status: 'Suspended', joined: '2025-02-18' },
      { id: 11, name: 'Mia Lopez', email: 'mia@example.com', role: 'Editor', status: 'Active', joined: '2025-03-22' },
      { id: 12, name: 'Logan Moore', email: 'logan@example.com', role: 'Viewer', status: 'Active', joined: '2025-04-09' },
      { id: 13, name: 'Charlotte Nelson', email: 'charlotte@example.com', role: 'Admin', status: 'Active', joined: '2025-04-27' },
      { id: 14, name: 'Henry Owens', email: 'henry@example.com', role: 'Editor', status: 'Invited', joined: '2025-05-11' },
      { id: 15, name: 'Amelia Price', email: 'amelia@example.com', role: 'Viewer', status: 'Active', joined: '2025-05-17' },
    ];

    const table = new Tabulator('#users-table', {
      data: data,
      layout: 'fitColumns',
      pagination: true,
      paginationSize: 10,
      paginationSizeSelector: [10, 25, 50, 100],
      movableColumns: true,
      columns: [
        { title: '#', field: 'id', width: 60, headerSort: true },
        { title: 'Name', field: 'name', headerFilter: 'input' },
        { title: 'Email', field: 'email', headerFilter: 'input' },
        { title: 'Role', field: 'role', headerFilter: 'list', headerFilterParams: { values: ['', 'Admin', 'Editor', 'Viewer'] }, width: 120 },
        { title: 'Status', field: 'status', formatter: statusBadge, headerFilter: 'list', headerFilterParams: { values: ['', 'Active', 'Invited', 'Suspended'] }, width: 130, hozAlign: 'center' },
        { title: 'Joined', field: 'joined', sorter: 'date', width: 130 },
      ],
    });

    const filterInput = document.getElementById('table-filter');
    if (filterInput) {
      filterInput.addEventListener('input', (e) => {
        const value = e.target.value;
        if (value) {
          table.setFilter([
            [
              { field: 'name', type: 'like', value: value },
              { field: 'email', type: 'like', value: value },
            ],
          ]);
        } else {
          table.clearFilter();
        }
      });
    }

    const exportCsvBtn = document.getElementById('export-csv');
    if (exportCsvBtn) {
      exportCsvBtn.addEventListener('click', () => table.download('csv', 'users.csv'));
    }
    
    const exportJsonBtn = document.getElementById('export-json');
    if (exportJsonBtn) {
      exportJsonBtn.addEventListener('click', () => table.download('json', 'users.json'));
    }
    
    const printBtn = document.getElementById('print-table');
    if (printBtn) {
      printBtn.addEventListener('click', () => table.print(false, true));
    }
  });
</script>
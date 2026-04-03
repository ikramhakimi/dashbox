import Chart from 'chart.js/auto';

const parseConfig = (text) => {
  try {
    const parsed = JSON.parse(text);
    return parsed && typeof parsed === 'object' ? parsed : null;
  } catch (_error) {
    return null;
  }
};

const buildDataset = (dataset, index) => {
  const tones = [
    {
      border: 'rgb(55 65 81)',
      background: 'rgb(55 65 81 / 0.14)',
    },
    {
      border: 'rgb(14 165 233)',
      background: 'rgb(14 165 233 / 0.14)',
    },
    {
      border: 'rgb(16 185 129)',
      background: 'rgb(16 185 129 / 0.14)',
    },
  ];

  const tone = tones[index % tones.length];

  return {
    label: typeof dataset.label === 'string' ? dataset.label : `Series ${index + 1}`,
    data: Array.isArray(dataset.data) ? dataset.data : [],
    borderColor: typeof dataset.border_color === 'string' ? dataset.border_color : tone.border,
    backgroundColor: typeof dataset.background_color === 'string' ? dataset.background_color : tone.background,
    borderWidth: typeof dataset.border_width === 'number' ? dataset.border_width : 2,
    borderRadius: typeof dataset.border_radius === 'number' ? dataset.border_radius : 0,
    borderSkipped: typeof dataset.border_skipped === 'string' ? dataset.border_skipped : undefined,
    tension: typeof dataset.tension === 'number' ? dataset.tension : 0.35,
    fill: typeof dataset.fill === 'boolean' ? dataset.fill : false,
    pointRadius: typeof dataset.point_radius === 'number' ? dataset.point_radius : 2,
    pointHoverRadius: typeof dataset.point_hover_radius === 'number' ? dataset.point_hover_radius : 4,
  };
};

const buildOptions = (prefix, yTicksDisplay, legendPosition) => ({
  responsive: true,
  maintainAspectRatio: false,
  interaction: {
    mode: 'index',
    intersect: false,
  },
  plugins: {
    legend: {
      display: true,
      position: legendPosition,
      labels: {
        boxWidth: 8,
        boxHeight: 8,
        color: 'rgb(75 85 99)',
        usePointStyle: false,
        padding: 14,
      },
    },
    tooltip: {
      backgroundColor: 'rgb(17 24 39)',
      titleColor: 'rgb(243 244 246)',
      bodyColor: 'rgb(229 231 235)',
      padding: 10,
      displayColors: false,
      callbacks: {
        label: (context) => {
          const value = typeof context.parsed.y === 'number' ? context.parsed.y : context.parsed;
          return `${context.dataset.label}: ${prefix}${Number(value).toLocaleString()}`;
        },
      },
    },
  },
  scales: {
    x: {
      grid: {
        display: false,
      },
      ticks: {
        color: 'rgb(107 114 128)',
      },
      border: {
        display: false,
      },
    },
    y: {
      beginAtZero: true,
      ticks: {
        display: yTicksDisplay,
        color: 'rgb(107 114 128)',
        callback: (value) => `${prefix}${Number(value).toLocaleString()}`,
      },
      grid: {
        color: 'rgb(243 244 246)',
      },
      border: {
        display: false,
      },
    },
  },
});

export const initChart = () => {
  const chartElements = document.querySelectorAll('[data-chart]');
  if (chartElements.length === 0) {
    return;
  }

  chartElements.forEach((canvasElement) => {
    if (!(canvasElement instanceof HTMLCanvasElement) || !canvasElement.id) {
      return;
    }

    const configElement = document.querySelector(`[data-chart-config-for="${canvasElement.id}"]`);
    if (!(configElement instanceof HTMLScriptElement)) {
      return;
    }

    const parsedConfig = parseConfig(configElement.textContent || '');
    if (!parsedConfig) {
      return;
    }

    const labels = Array.isArray(parsedConfig.labels) ? parsedConfig.labels : [];
    const datasets = Array.isArray(parsedConfig.datasets)
      ? parsedConfig.datasets.map((item, index) => buildDataset(item, index))
      : [];

    const prefix = typeof parsedConfig.y_prefix === 'string' ? parsedConfig.y_prefix : '';
    const yTicksDisplay = typeof parsedConfig.y_ticks_display === 'boolean'
      ? parsedConfig.y_ticks_display
      : true;
    const legendPosition = ['top', 'bottom', 'left', 'right'].includes(parsedConfig.legend_position)
      ? parsedConfig.legend_position
      : 'top';

    const chartType = typeof parsedConfig.type === 'string' ? parsedConfig.type : 'line';

    const chartConfig = {
      type: chartType,
      data: {
        labels,
        datasets,
      },
      options: buildOptions(prefix, yTicksDisplay, legendPosition),
    };

    // eslint-disable-next-line no-new
    new Chart(canvasElement, chartConfig);
  });
};

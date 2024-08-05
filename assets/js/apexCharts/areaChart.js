// ==================================================================== Area chart
var options = {
  chart: {
    type: "area",
    height: 350,
  },
  series: [
    {
      name: "sales",
      data: [30, 40, 45, 50, 49, 60, 70, 91, 125],
    },
  ],
  xaxis: {
    categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999],
  },
};

var chart = new ApexCharts(document.querySelector("#areachart"), options);

chart.render();



// ==================================================================== line chart Weekly
var options = {
  series: [
    {
      name: "Net Profit",
      data: [44, 55, 57, 56, 61, 58, 63],
    },
    {
      name: "Revenue",
      data: [76, 85, 101, 98, 87, 105, 91],
    },
    {
      name: "Free Cash Flow",
      data: [35, 41, 36, 26, 45, 48, 52],
    },
  ],
  chart: {
    type: "bar",
    height: 180,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "55%",
      endingShape: "rounded",
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ["transparent"],
  },
  xaxis: {
    categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
  },
  yaxis: {
    title: {
      text: "$ (thousands)",
    },
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands";
      },
    },
  },
};

var chart = new ApexCharts(document.querySelector("#weeklychart"), options);
chart.render();

// ==================================================================== line chart Monthly
var options = {
  series: [
    {
      name: "Net Profit",
      data: [44, 55, 57, 56, 61, 50, 60, 66, 58, 63, 60, 66],
    },
    {
      name: "Revenue",
      data: [76, 85, 101, 98, 87, 105, 91, 50, 60, 66, 114, 94],
    },
    {
      name: "Free Cash Flow",
      data: [35, 41, 36, 26, 45, 48, 52, 53, 41, 50, 60, 66],
    },
  ],
  chart: {
    type: "bar",
    height: 180,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "55%",
      endingShape: "rounded",
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ["transparent"],
  },
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
  },
  yaxis: {
    title: {
      text: "$ (thousands)",
    },
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands";
      },
    },
  },
};

var chart = new ApexCharts(document.querySelector("#yearlychart"), options);
chart.render();

// ==================================================================== line chart Yearly
var options = {
  series: [
    {
      name: "Net Profit",
      data: [
        44, 55, 57, 56, 61, 50, 60, 66, 58, 63, 60, 66, 12, 20, 30, 44, 55, 57,
        56, 61, 50, 60, 66, 58, 63, 60, 66, 12, 20, 30,
      ],
    },
    {
      name: "Revenue",
      data: [
        76, 85, 101, 98, 87, 105, 91, 50, 60, 66, 114, 94, 76, 85, 101, 98, 87,
        105, 91, 50, 60, 66, 114, 94, 91, 50, 60, 66, 114, 94,
      ],
    },
    {
      name: "Free Cash Flow",
      data: [
        35, 41, 36, 26, 45, 48, 52, 53, 41, 50, 60, 66, 35, 41, 36, 26, 45, 48,
        52, 53, 41, 50, 60, 66, 52, 53, 41, 50, 60, 66,
      ],
    },
  ],
  chart: {
    type: "bar",
    height: 180,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "55%",
      endingShape: "rounded",
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ["transparent"],
  },
  xaxis: {
    categories: [
      "1",
      "2",
      "3",
      "4",
      "5",
      "6",
      "7",
      "8",
      "9",
      "10",
      "11",
      "12",
      "13",
      "14",
      "15",
      "16",
      "17",
      "18",
      "19",
      "20",
      "21",
      "22",
      "23",
      "24",
      "25",
      "26",
      "27",
      "28",
      "29",
      "30",
    ],
  },
  yaxis: {
    title: {
      text: "$ (thousands)",
    },
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands";
      },
    },
  },
};

var chart = new ApexCharts(document.querySelector("#monthlychart"), options);
chart.render();


// ==================================================================== Column with Data Labels

var options = {
  series: [
    {
      name: "Inflation",
      data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2],
    },
  ],
  chart: {
    height: 350,
    type: "bar",
  },
  plotOptions: {
    bar: {
      borderRadius: 10,
      dataLabels: {
        position: "top", // top, center, bottom
      },
    },
  },
  dataLabels: {
    enabled: true,
    formatter: function (val) {
      return val + "%";
    },
    offsetY: -20,
    style: {
      fontSize: "12px",
      colors: ["#304758"],
    },
  },

  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    position: "top",
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    crosshairs: {
      fill: {
        type: "gradient",
        gradient: {
          colorFrom: "#D8E3F0",
          colorTo: "#BED1E6",
          stops: [0, 100],
          opacityFrom: 0.4,
          opacityTo: 0.5,
        },
      },
    },
    tooltip: {
      enabled: true,
    },
  },
  yaxis: {
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    labels: {
      show: false,
      formatter: function (val) {
        return val + "%";
      },
    },
  },
  title: {
    text: "Monthly Inflation in Argentina, 2002",
    floating: true,
    offsetY: 330,
    align: "center",
    style: {
      color: "#444",
    },
  },
};

var chart = new ApexCharts(
  document.querySelector("#columncharts_data_labels"),
  options
);
chart.render();

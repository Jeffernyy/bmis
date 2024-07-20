<script>
  $(function () {
    <?php
    $ages = [];
    $residents = [];

    // query to fetch distinct ages ordered by descending
    $qry = mysqli_query($con, "SELECT DISTINCT resident_age FROM tblresident ORDER BY resident_age ASC");

    // loop through the result set to fetch ages and count residents for each age
    while ($row = mysqli_fetch_assoc($qry)) {
      $age = $row['resident_age'];
      $ages[] = $age;

      // query to count residents for each age
      $countQuery = mysqli_query($con, "SELECT COUNT(*) as res_count FROM tblresident WHERE resident_age = '$age'");
      $countRow = mysqli_fetch_assoc($countQuery);
      $residents[] = $countRow['res_count'];
    } ?>

    var barChartCanvas = $('#age').get(0).getContext('2d');
    var ageGradient = barChartCanvas.createLinearGradient(0, 0, 0, 360); // it depends on the viewport height
    ageGradient.addColorStop(0, 'rgba(131, 255, 81, 1)');
    ageGradient.addColorStop(1, 'rgba(131, 255, 81, 0)');

    var barChartData = {
      labels: <?php echo json_encode($ages) ?>,
      datasets: [
        {
          label: 'Total Residents with this Age',
          data: <?php echo json_encode($residents) ?>,
          backgroundColor: ageGradient
        }
      ]
    };

    var barChart;

    function createChart() {
      if (barChart) {
        barChart.destroy();
      }

      // determine if the device is a mobile or has a small screen width
      var isMobile = window.innerWidth <= 768;

      // update x-axis settings based on device type
      var xAxisSettings = {
        gridLines: {
          display: true,
          color: '#4f4f4f' // line color for x-axis
        },
        ticks: {
          fontColor: '#d6d6d6',
          autoSkip: isMobile, // enable auto skipping for mobile devices
          maxRotation: 0,
          minRotation: 0,
          maxTicksLimit: isMobile ? 5 : 10, // adjust the limit based on the device
          callback: function (value, index, values) {
            var step = Math.ceil(values.length / (isMobile ? 5 : 15)); // adjust based on the number of labels
            return index % step === 0 ? value : ''; // show labels at every step interval
          }
        }
      };

      // redefine the chart options based on the device type
      var barChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        animation: {
          duration: 1500
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true,
          bodyFontSize: 14,
          backgroundColor: 'rgba(50, 50, 50, 0.7)',
          bodyFontColor: 'white',
          titleFontColor: 'white',
          mode: 'index',
          intersect: false,
          callbacks: {
            label: function (tooltipItem, data) {
              var label = data.datasets[tooltipItem.datasetIndex].label || '';
              if (label) {
                label += ': ';
              }
              label += Math.round(tooltipItem.yLabel * 100) / 100; // round to integer
              return label;
            }
          }
        },
        layout: {
          padding: {
            left: 10
          }
        },
        scales: {
          xAxes: [xAxisSettings],
          yAxes: [{
            gridLines: {
              display: true,
              color: '#4f4f4f' // line color for x-axis
            },
            ticks: {
              fontColor: '#d6d6d6',
              beginAtZero: true,
              stepSize: false,
              padding: 15
            }
          }]
        }
      };

      barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      });
    }

    createChart(); // create the chart initially

    // redraw the chart on window resize for better responsiveness
    $(window).on('resize', function () {
      createChart();
    });
  });
</script>
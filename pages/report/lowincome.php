<script>
  $(document).ready(function () {
    // initialize the chart
    const areaChartCanvas = document.getElementById('lowincome').getContext('2d');
    window.lowincomeChart = createChart(areaChartCanvas);

    // default to showing daily report
    fetchData('daily');

    // handle dropdown selection
    $('.dropdown-item').click(function () {
      const period = $(this).data('lowincome');
      fetchData(period);
    });

    // ajax call to fetch data from db
    function fetchData(period) {
      let url;
      switch (period) {

        case 'daily':
          url = '../../ajax/daily.lwncm.ajax.php';
          break;

        case 'weekly':
          url = '../../ajax/weekly.lwncm.ajax.php';
          break;

        case 'monthly':
          url = '../../ajax/monthly.lwncm.ajax.php';
          break;

        case 'yearly':
          url = '../../ajax/yearly.lwncm.ajax.php';
          break;
      }

      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
          updateChart(data);
        },
        error: function (xhr, status, error) {
          // will sort this toms
          // console.error('Error fetching data:', error);
        }
      });
    }

    function updateChart(data) {
      // debugging shttttttt
      console.log('Received...', data);

      // convert data arrays to numeric values for daily report
      const daily_requested = data.daily_lowincome_requested ? data.daily_lowincome_requested.map(Number) : [];
      const daily_approved = data.daily_lowincome_approved ? data.daily_lowincome_approved.map(Number) : [];
      const daily_disapproved = data.daily_lowincome_disapproved ? data.daily_lowincome_disapproved.map(Number) : [];

      // update chart data for daily report
      lowincomeChart.data.labels = data.daily_lowincome_labels || [];
      lowincomeChart.data.datasets[0].data = daily_requested;
      lowincomeChart.data.datasets[1].data = daily_approved;
      lowincomeChart.data.datasets[2].data = daily_disapproved;

      // update chart data for weekly report
      if (data.weekly_lowincome_labels && data.weekly_lowincome_requested && data.weekly_lowincome_approved && data.weekly_lowincome_disapproved) {
        const weekly_requested = data.weekly_lowincome_requested.map(Number);
        const weekly_approved = data.weekly_lowincome_approved.map(Number);
        const weekly_disapproved = data.weekly_lowincome_disapproved.map(Number);

        lowincomeChart.data.labels = data.weekly_lowincome_labels;
        lowincomeChart.data.datasets[0].data = weekly_requested;
        lowincomeChart.data.datasets[1].data = weekly_approved;
        lowincomeChart.data.datasets[2].data = weekly_disapproved;
      }

      // update chart data for monthly report
      if (data.monthly_lowincome_labels && data.monthly_lowincome_requested && data.monthly_lowincome_approved && data.monthly_lowincome_disapproved) {
        const monthly_requested = data.monthly_lowincome_requested.map(Number);
        const monthly_approved = data.monthly_lowincome_approved.map(Number);
        const monthly_disapproved = data.monthly_lowincome_disapproved.map(Number);

        lowincomeChart.data.labels = data.monthly_lowincome_labels;
        lowincomeChart.data.datasets[0].data = monthly_requested;
        lowincomeChart.data.datasets[1].data = monthly_approved;
        lowincomeChart.data.datasets[2].data = monthly_disapproved;
      }

      // update chart data for yearly report
      if (data.yearly_lowincome_labels && data.yearly_lowincome_requested && data.yearly_lowincome_approved && data.yearly_lowincome_disapproved) {
        const yearly_requested = data.yearly_lowincome_requested.map(Number);
        const yearly_approved = data.yearly_lowincome_approved.map(Number);
        const yearly_disapproved = data.yearly_lowincome_disapproved.map(Number);

        lowincomeChart.data.labels = data.yearly_lowincome_labels;
        lowincomeChart.data.datasets[0].data = yearly_requested;
        lowincomeChart.data.datasets[1].data = yearly_approved;
        lowincomeChart.data.datasets[2].data = yearly_disapproved;

        // debugging
        console.log('Labels:', lowincomeChart.data.labels);
        console.log('Dataset 0:', lowincomeChart.data.datasets[0].data);
        console.log('Dataset 1:', lowincomeChart.data.datasets[1].data);
        console.log('Dataset 2:', lowincomeChart.data.datasets[2].data);
      }

      lowincomeChart.update();
    }

    function createChart(canvas) {
      // debugging shttttttt
      console.log('Created...');
      const newGradient = canvas.createLinearGradient(0, 0, 0, 360); // it depends on the viewport height
      newGradient.addColorStop(0, 'rgba(255,205,86,1)');
      newGradient.addColorStop(1, 'rgba(255,205,86,0)');

      const disapprovedGradient = canvas.createLinearGradient(0, 0, 0, 360); // it depends on the viewport height
      disapprovedGradient.addColorStop(0, 'rgba(255,99,132,1)');
      disapprovedGradient.addColorStop(1, 'rgba(255,99,132,0)');

      return new Chart(canvas, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [{
            label: 'New',
            data: [],
            backgroundColor: newGradient,
            order: 1
          },
          {
            label: 'Approved',
            data: [],
            backgroundColor: 'transparent',
            borderColor: 'rgba(54,162,235,1)',
            borderWidth: 5,
            pointRadius: 5,
            pointBackgroundColor: 'rgb(255,255,255)',
            pointBorderColor: 'rgb(255,255,255)',
            pointBorderWidth: 0,
            pointHoverRadius: 7,
            pointHoverBackgroundColor: 'rgb(220,220,220)',
            pointHoverBorderColor: 'rgb(220,220,220)',
            type: 'line',
            order: 0
          },
          {
            label: 'Disapproved',
            data: [],
            backgroundColor: disapprovedGradient,
            order: 1
          },
          ]
        },
        options: {
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
          },
          scales: {
            xAxes: [{
              gridLines: {
                display: true,
                color: '#4f4f4f'
              },
              ticks: {
                fontColor: '#d6d6d6'
              }
            }],
            yAxes: [{
              gridLines: {
                display: true,
                color: '#4f4f4f'
              },
              ticks: {
                fontColor: '#d6d6d6',
                beginAtZero: true, // start y-axis from zero
                stepSize: false, // specify the step size for y-axis labels
                padding: 20
              }
            }]
          }
        }
      });
    }
  });
</script>
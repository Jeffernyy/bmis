<script>
  $(document).ready(function () {
    // initialize the chart
    const areaChartCanvas = document.getElementById('blotter').getContext('2d');
    window.blotterChart = createChart(areaChartCanvas);

    // default to showing daily report
    fetchData('daily');

    // handle dropdown selection
    $('.dropdown-item').click(function () {
      const period = $(this).data('blotter');
      fetchData(period);
    });

    // ajax call to fetch data from db
    function fetchData(period) {
      let url;
      switch (period) {

        case 'daily':
          url = '../../ajax/daily.blttr.ajax.php';
          break;

        case 'weekly':
          url = '../../ajax/weekly.blttr.ajax.php';
          break;

        case 'monthly':
          url = '../../ajax/monthly.blttr.ajax.php';
          break;

        case 'yearly':
          url = '../../ajax/yearly.blttr.ajax.php';
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
      const daily_solved = data.daily_blotter_solved ? data.daily_blotter_solved.map(Number) : [];
      const daily_unsolved = data.daily_blotter_unsolved ? data.daily_blotter_unsolved.map(Number) : [];

      // update chart data for daily report
      blotterChart.data.labels = data.daily_blotter_labels || [];
      blotterChart.data.datasets[0].data = daily_solved;  // Index should be 0
      blotterChart.data.datasets[1].data = daily_unsolved;  // Index should be 1

      // update chart data for weekly report
      if (data.weekly_blotter_labels && data.weekly_blotter_solved && data.weekly_blotter_unsolved) {
        const weekly_solved = data.weekly_blotter_solved.map(Number);
        const weekly_unsolved = data.weekly_blotter_unsolved.map(Number);

        blotterChart.data.labels = data.weekly_blotter_labels;
        blotterChart.data.datasets[0].data = weekly_solved;  // Index should be 0
        blotterChart.data.datasets[1].data = weekly_unsolved;  // Index should be 1
      }

      // update chart data for monthly report
      if (data.monthly_blotter_labels && data.monthly_blotter_solved && data.monthly_blotter_unsolved) {
        const monthly_solved = data.monthly_blotter_solved.map(Number);
        const monthly_unsolved = data.monthly_blotter_unsolved.map(Number);

        blotterChart.data.labels = data.monthly_blotter_labels;
        blotterChart.data.datasets[0].data = monthly_solved;  // Index should be 0
        blotterChart.data.datasets[1].data = monthly_unsolved;  // Index should be 1
      }

      // update chart data for yearly report
      if (data.yearly_blotter_labels && data.yearly_blotter_solved && data.yearly_blotter_unsolved) {
        const yearly_solved = data.yearly_blotter_solved.map(Number);
        const yearly_unsolved = data.yearly_blotter_unsolved.map(Number);

        blotterChart.data.labels = data.yearly_blotter_labels;
        blotterChart.data.datasets[0].data = yearly_solved;  // Index should be 0
        blotterChart.data.datasets[1].data = yearly_unsolved;  // Index should be 1
      }

      blotterChart.update();
    }

    function createChart(canvas) {
      // debugging shttttttt
      console.log('Created...');
      const solvedGradient = canvas.createLinearGradient(0, 0, 0, 360); // it depends on the viewport height
      solvedGradient.addColorStop(0, 'rgba(255,99,132,1)');
      solvedGradient.addColorStop(1, 'rgba(255,99,132,0)');

      const unsolvedGradient = canvas.createLinearGradient(0, 0, 0, 360); // it depends on the viewport height
      unsolvedGradient.addColorStop(0, 'rgba(0,247,247,1)');
      unsolvedGradient.addColorStop(1, 'rgba(0,247,247,0)');

      return new Chart(canvas, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [{
            label: 'Solved',
            data: [],
            backgroundColor: solvedGradient
          },
          {
            label: 'Unsolved',
            data: [],
            backgroundColor: unsolvedGradient
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
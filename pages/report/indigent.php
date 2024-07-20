<script>
  $(document).ready(function () {
    // initialize the chart
    const areaChartCanvas = document.getElementById('indigent').getContext('2d');
    window.indigentChart = createChart(areaChartCanvas);

    // default to showing daily report
    fetchData('daily');

    // handle dropdown selection
    $('.dropdown-item').click(function () {
      const period = $(this).data('indigent');
      fetchData(period);
    });

    // ajax call to fetch data from db
    function fetchData(period) {
      let url;
      switch (period) {

        case 'daily':
          url = '../../ajax/daily.ndgnt.ajax.php';
          break;

        case 'weekly':
          url = '../../ajax/weekly.ndgnt.ajax.php';
          break;

        case 'monthly':
          url = '../../ajax/monthly.ndgnt.ajax.php';
          break;

        case 'yearly':
          url = '../../ajax/yearly.ndgnt.ajax.php';
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
      const daily_requested = data.daily_indigent_requested ? data.daily_indigent_requested.map(Number) : [];
      const daily_approved = data.daily_indigent_approved ? data.daily_indigent_approved.map(Number) : [];
      const daily_disapproved = data.daily_indigent_disapproved ? data.daily_indigent_disapproved.map(Number) : [];

      // update chart data for daily report
      indigentChart.data.labels = data.daily_indigent_labels || [];
      indigentChart.data.datasets[0].data = daily_requested;
      indigentChart.data.datasets[1].data = daily_approved;
      indigentChart.data.datasets[2].data = daily_disapproved;

      // update chart data for weekly report
      if (data.weekly_indigent_labels && data.weekly_indigent_requested && data.weekly_indigent_approved && data.weekly_indigent_disapproved) {
        const weekly_requested = data.weekly_indigent_requested.map(Number);
        const weekly_approved = data.weekly_indigent_approved.map(Number);
        const weekly_disapproved = data.weekly_indigent_disapproved.map(Number);

        indigentChart.data.labels = data.weekly_indigent_labels;
        indigentChart.data.datasets[0].data = weekly_requested;
        indigentChart.data.datasets[1].data = weekly_approved;
        indigentChart.data.datasets[2].data = weekly_disapproved;
      }

      // update chart data for monthly report
      if (data.monthly_indigent_labels && data.monthly_indigent_requested && data.monthly_indigent_approved && data.monthly_indigent_disapproved) {
        const monthly_requested = data.monthly_indigent_requested.map(Number);
        const monthly_approved = data.monthly_indigent_approved.map(Number);
        const monthly_disapproved = data.monthly_indigent_disapproved.map(Number);

        indigentChart.data.labels = data.monthly_indigent_labels;
        indigentChart.data.datasets[0].data = monthly_requested;
        indigentChart.data.datasets[1].data = monthly_approved;
        indigentChart.data.datasets[2].data = monthly_disapproved;
      }

      // update chart data for yearly report
      if (data.yearly_indigent_labels && data.yearly_indigent_requested && data.yearly_indigent_approved && data.yearly_indigent_disapproved) {
        const yearly_requested = data.yearly_indigent_requested.map(Number);
        const yearly_approved = data.yearly_indigent_approved.map(Number);
        const yearly_disapproved = data.yearly_indigent_disapproved.map(Number);

        indigentChart.data.labels = data.yearly_indigent_labels;
        indigentChart.data.datasets[0].data = yearly_requested;
        indigentChart.data.datasets[1].data = yearly_approved;
        indigentChart.data.datasets[2].data = yearly_disapproved;

        // debugging
        console.log('Labels:', indigentChart.data.labels);
        console.log('Dataset 0:', indigentChart.data.datasets[0].data);
        console.log('Dataset 1:', indigentChart.data.datasets[1].data);
        console.log('Dataset 2:', indigentChart.data.datasets[2].data);
      }

      indigentChart.update();
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

<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h2 class="m-0 font-weight-bold text-primary">PROFIT PRODUCT</h2>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chart_profit"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card shadow">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h2 class="m-0 font-weight-bold text-primary">SOLD PRODUCT</h2>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chart_sold"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card shadow">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h2 class="m-0 font-weight-bold text-primary">UCS PRODUCT</h2>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chart_ucs"></canvas>
                </div>
            </div>
        </div>
    </div>
    

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    $(function(){
      //GETTING DATA FROM THE CONTROLLER
      var profit = JSON.parse(`<?php echo $profit; ?>`);
      var profit_id = $("#chart_profit");

      var sold = JSON.parse(`<?php echo $sold; ?>`);
      var sold_id = $("#chart_sold");

      var ucs = JSON.parse(`<?php echo $ucs; ?>`);
      var ucs_id = $("#chart_ucs");
      
      //DATA
      var profit_data = {
        labels: profit.label,
        datasets: [
          {
            label: "PROFIT BY %",
            data: profit.data,
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            borderWidth: [1, 1, 1, 1, 1,1,1]
          }
        ]
      };

      var sold_data = {
        labels: sold.label,
        datasets: [
          {
            label: "SOLD",
            data: sold.data,
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            borderWidth: [1, 1, 1, 1, 1,1,1]
          }
        ]
      };

      var ucs_data = {
        labels: ucs.label,
        datasets: [
          {
            label: "UCS",
            data: ucs.data,
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            borderWidth: [1, 1, 1, 1, 1,1,1]
          }
        ]
      };
 
      //options
      var options = {
        maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
            },
      };
 
      var profit_chart = new Chart(profit_id, {
        type: "line",
        data: profit_data,
        options: options
      });

      var sold_chart = new Chart(sold_id, {
        type: "line",
        data: sold_data,
        options: options
      });

      var ucs_chart = new Chart(ucs_id, {
        type: "line",
        data: ucs_data,
        options: options
      });
 
  });

</script>




      <!-- Left side column. contains the logo and sidebar -->
      @extends('layout.master')
      @section("title", "Home")
      @section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <!-- small box -->
              <x-stats-card 
                quantity="{{ $newOrders }}"
                name="New Orders"
                icon="ion ion-bag"
                color="bg-aqua"
                href="/admin/orders?status=pending"
              />
              <x-stats-card 
                quantity="{{ round($delivered30Days) }} RS"
                name="Earning in Last 30 days"
                icon="ion ion-stats-bars"
                color="bg-green"
                href="/admin/orders?status=delivered"
              />
              <x-stats-card 
                quantity="{{ $usersQty }}"
                name="User Registration"
                icon="ion ion-person-add"
                color="bg-yellow"
                href="/admin/users"
              />
              <x-stats-card 
                quantity="{{ $ordersSum }} RS"
                name="All time Income"
                icon="ion ion-pie-graph"
                color="bg-red"
                href="/admin/orders"
              />
          </div><!-- /.row -->
          <!-- Main row -->
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Comparison of this month and last month</h3>
              </div>
              <div class="box-body">
                <canvas id="lineChart" height="250"></canvas>
                
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            
              <!-- DONUT CHART -->
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Most used Categories</h3>
                </div>
                <div class="box-body">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="250"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
      </div><!-- /.content-wrapper -->
      @push('scripts')
          <!-- jQuery 2.1.3 -->
    <script src="/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="/assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
      <script>
        const colorGenerator = () => {
          const symbols = ["A", "B", "C", "D", "E", "F", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
          let color = "#";
          for(let i = 0; i < 6; i++) {
            let random = Math.floor(Math.random() * ((symbols.length - 1) - 0 + 1)) + 0
            color += symbols[random];
          }
          return color;
        }
        const ordersByMonth = `{{ $ordersByMonth }}`;
        const ordersByYear = `{{ $ordersByYear }}`;
        // console.log({{ \App\Models\Order::first()->created_at }})
        $(function () {
          var areaChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
              {
                label: "Electronics",
                fillColor: "rgba(210, 214, 222, 1)",
                strokeColor: "rgba(210, 214, 222, 1)",
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: JSON.parse(ordersByYear)
              },
              {
                label: "Digital Goods",
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: JSON.parse(ordersByMonth)
              }
            ]
          };
  
          var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
          };
  
  
          //-------------
          //- LINE CHART -
          //--------------
          var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
          var lineChart = new Chart(lineChartCanvas);
          var lineChartOptions = areaChartOptions;
          lineChartOptions.datasetFill = false;
          lineChart.Line(areaChartData, lineChartOptions);     
          
          
          
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
          @foreach($categories as $category)
          {
            value: {{ $category->products_count }},
            color: colorGenerator(),
            highlight: colorGenerator(),
            label: "{{ $category->name }}"
          },
          @endforeach
          // {
          //   value: 500,
          //   color: "#00a65a",
          //   highlight: "#00a65a",
          //   label: "IE"
          // },
          // {
          //   value: 400,
          //   color: "#f39c12",
          //   highlight: "#f39c12",
          //   label: "FireFox"
          // },
          // {
          //   value: 600,
          //   color: "#00c0ef",
          //   highlight: "#00c0ef",
          //   label: "Safari"
          // },
          // {
          //   value: 300,
          //   color: "#3c8dbc",
          //   highlight: "#3c8dbc",
          //   label: "Opera"
          // },
          // {
          //   value: 100,
          //   color: "#d2d6de",
          //   highlight: "#d2d6de",
          //   label: "Navigator"
          // }
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: false,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
        });
      </script>
      @endpush
      @endsection
    
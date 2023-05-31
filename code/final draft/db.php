<?php
    $connect=mysqli_connect('localhost','root','','db_draft');
    include ('header.php');
    if (!isset($_SESSION['staffid']))
   {
      echo"<script> alert('Authorized Personnel Only')</script>";
      echo"<script> window.location='stafflogin.php'</script>";
   }

 ?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Chart.js</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mt-4">
                        <div class="card-header">Medicine Per Supplier</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="pie_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-4">
                        <div class="card-header">Doctors Per Department</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="doughnut_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-4 mb-4">
                        <div class="card-header">This Week's Pharmacy Gross Sales/Day</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="bar_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-4 mb-4">
                        <div class="card-header">This Week's Appointments/Day</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="bar_chart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php') ?>
    </body>
</html>

<script>
    
$(document).ready(function(){

    makechart();

    function makechart()
    {
        $.ajax({
            url:"data.php",
            method:"POST",
            data:{action:'fetch'},
            dataType:"JSON",
            success:function(data)
            {
                var DepartmentID = [];
                var total = [];
                var color = [];

                for(var count = 0; count < data.length; count++)
                {
                    DepartmentID.push(data[count].DepartmentID);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data = {
                    labels:DepartmentID,
                    datasets:[
                        {
                            label:DepartmentID,
                            backgroundColor:color,
                            color:'#fff',
                            data:total
                        }
                    ]
                };

                var group_chart2 = $('#doughnut_chart');

                var graph2 = new Chart(group_chart2, {
                    type:"doughnut",
                    data:chart_data
                });
            }
        })
        $.ajax({
            url:"data.php",
            method:"POST",
            data:{action:'pie'},
            dataType:"JSON",
            success:function(data)
            {
                var companyname = [];
                var total = [];
                var color = [];

                for(var count = 0; count < data.length; count++)
                {
                    companyname.push(data[count].companyname);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data = {
                    labels:companyname,
                    datasets:[
                        {
                            label:companyname,
                            backgroundColor:color,
                            color:'#fff',
                            data:total
                        }
                    ]
                };

                var group_chart1 = $('#pie_chart');

                var graph1 = new Chart(group_chart1, {
                    type:"pie",
                    data:chart_data
                });
            }
        })
        $.ajax({
            url:"data.php",
            method:"POST",
            data:{action:'bar'},
            dataType:"JSON",
            success:function(data)
            {
                var date = [];
                var total = [];
                var color = [];

                for(var count = 0; count < data.length; count++)
                {
                    date.push(data[count].date);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data = {
                    labels:date,
                    datasets:[
                        {
                            label:date,
                            backgroundColor:color,
                            color:'#fff',
                            data:total
                        }
                    ]
                };

                var options = {
                    responsive:true,
                    scales:{
                        yAxes:[{
                            ticks:{
                                min:0
                            }
                        }]
                    }
                };

                var group_chart3 = $('#bar_chart');

                var graph3 = new Chart(group_chart3, {
                    type:'bar',
                    data:chart_data,
                    options:options
                });
            }
        })
        $.ajax({
            url:"data.php",
            method:"POST",
            data:{action:'bar2'},
            dataType:"JSON",
            success:function(data)
            {
                var date = [];
                var total = [];
                var color = [];

                for(var count = 0; count < data.length; count++)
                {
                    date.push(data[count].date);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data2 = {
                    labels:date,
                    datasets:[
                        {
                            label:date,
                            backgroundColor:color,
                            color:'#fff',
                            data:total
                        }
                    ]
                };

                var options2 = {
                    responsive:true,
                    scales:{
                        yAxes:[{
                            ticks:{
                                min:0
                            }
                        }]
                    }
                };

                var group_chart3 = $('#bar_chart2');

                var graph3 = new Chart(group_chart3, {
                    type:'bar',
                    data:chart_data2,
                    options:options2
                });
            }
        })
    }

});

</script>
<?php include('partials/menu.php'); ?>


       <!-- Main Content Section Starts -->
       <div class="main-content">
            <div class=wrapper> 
                <h1>DASHBOARD</h1> 
                <br><br>

                <ul class="chart">
                    <li class ="box-A"><canvas id="salesChart"></canvas></li>
                    <li class = "box-B">
                        <div class="col-4 col-1 text-center">
                            Top 5 Sold Items
                            <?php 
                                $sql4 = "SELECT SUM(total) AS Total from tbl_order WHERE status = 'Delivered'";
                                $res4 = mysqli_query($conn, $sql4);
                                $row4 = mysqli_fetch_assoc($res4);
                                $total_revenue = $row4['Total'];
                            ?>
                            <h1>₱ <?php echo $total_revenue; ?></h1> 
                            <br>
                            
                            
                        </div>
                    </li>
                    <li class = "box-C">
                        <div class="col-4 col-1 text-center">
                            Top 5 Sold Items
                            <?php 
                                $sql4 = "SELECT SUM(total) AS Total from tbl_order WHERE status = 'Delivered'";
                                $res4 = mysqli_query($conn, $sql4);
                                $row4 = mysqli_fetch_assoc($res4);
                                $total_revenue = $row4['Total'];
                            ?>
                            <h1>₱ <?php echo $total_revenue; ?></h1> 
                            <br>
                            
                            
                        </div>
                    </li>
                
                
                </ul>
                
                
                
               
                
            </div>
            

                <div class="col-4 text-center">
                    <?php 
                        $sql = "SELECT * from tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count;?></h1> 
                    <br>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <?php 
                        $sql2 ="SELECT * FROM tbl_food";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2;?></h1>
                    <br>
                    Foods
                </div>
                <div class="col-4 text-center">
                <?php 
                        $sql3 ="SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3;?></h1> 
                    <br>
                    Total Orders
                </div>
                <div class="col-4 text-center">
                    <?php 
                        $sql4 = "SELECT SUM(total) AS Total from tbl_order WHERE status = 'Delivered'";
                        $res4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);
                        $total_revenue = $row4['Total'];
                    ?>
                    <h1>₱ <?php echo $total_revenue; ?></h1> 
                    <br>
                    Revenue Generated
                </div>
                
                <div class="clearfix"></div>
            
            <!--Sales Chart-->
            <div> 
                <!--Buttons for Specifying Time Range-->
                <form method="POST">
                    <button type="submit" name="daily">Daily</button>
                    <button type="submit" name="monthly">Monthly</button>
                    <button type="submit" name="yearly">Yearly</button>

                </form>
                
            </div>
            
            
            
                <!--Chart.js-->
                <script src = "https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src = "https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>

                <!-- PHP SCRIPT TO CHANGE THE Time range depending on pressed button -->
                <?php 
                    #Daily
                    $sql5 = "SELECT order_date as timePeriod, total as total FROM tbl_order WHERE status = 'Delivered' ORDER BY order_date ASC";
                    # Monthly
                    if (isset($_POST['monthly'])) {
                        $sql5 = "SELECT CONCAT(MONTHNAME(order_date), ' ', YEAR(order_date)) as timePeriod,  SUM(total) as total FROM tbl_order WHERE status = 'Delivered'   GROUP BY YEAR(order_date), MONTHNAME(order_date) ORDER BY MONTH(order_date) ASC";
                    # Chart to display yearly     
                    } else if (isset($_POST['yearly'])) {
                        $sql5 = "SELECT YEAR(order_date) as timePeriod, SUM(total) as total FROM tbl_order  WHERE status = 'Delivered' GROUP BY timePeriod ORDER BY YEAR(order_date)";
                    }
                    $res5 = mysqli_query($conn, $sql5);

                        foreach($res5 as $data) {              
                            $amount[] = $data['total'];
                            $time[] = $data['timePeriod'];
                        }
                ?>
                
                <script>
                    

                    const labels = <?php echo json_encode($time);?>;
                    const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Total Sales',
                        data: <?php echo json_encode($amount);?>,
                        fill: true,
                        borderColor: 'rgb(23, 74,65)',
                        borderWidth: 3,
                        tension: 0.4,
                    }
                    ]
                    
                    };
                    const config = {
                    type: 'line',
                    data: data,
                    options: {
                        
                        responsive: true,
                        
                        scales: {
                            y: {
                                ticks: {
                                    font: {
                                    size: 16,
                                    },
                                callback: function(value, index, ticks) {
                                    return '₱ ' + value;
                                }
                                }
                        },
                        x: {
                                ticks: {
                                    font: {
                                    size: 16,
                                    },
                                }
                        },
                    },
                        plugins: {
                            title: {
                                display: true,
                                weight: 'bold',
                                position: 'top',
                                align: 'start',
                                text: 'Sales Summary',
                                font: {
                                    size: 25,
                                },
                                padding: {
                                    top: 10,
                                    bottom: 30
                                }
                            },
                            datalabels: {
                                anchor: 'end',
                                align : 'top',
                                formatter: Math.round,
                                font: {
                                    weight: 'bold',
                                    size: 14
                                }
                            }
                        }
                    }
                
                    };
                    Chart.register(ChartDataLabels);
                    var salesChart = new Chart(document.getElementById('salesChart'), config);
                </script>
            <!--Sales Chart Ends Here-->
            
            </div>
            <!--Main Content Ends Here-->

<?php include('partials/footer.php'); ?>
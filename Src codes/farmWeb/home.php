<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smart Farm</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<?php

    function getTemperature() {
        $filename = '/sys/bus/w1/devices/28-3cfdf649c14f/w1_slave';
        $handle = fopen($filename, 'r');
        $lines = array();

        while (!feof($handle)) {
            $lines[] = fgets($handle);
        }

        fclose($handle);

        $tempLine = $lines[1];
        $temp = substr($tempLine, -6) / 1000;

        return $temp;
    }

    function getHumidity() {
       
        shell_exec("python3 /home/pi/raspberry_master_i2c.py");
        $file = fopen("/home/pi/current_values/yl_69.txt", "r") or die("Impossible d'ouvrir le fichier !");
        $value = fgets($file);
        fclose($file);

        return $value;
    }
    
    $temperature = getTemperature();
    $humidity = getHumidity();

?>

<!------------------------------------------------------------------------------------------------------------->
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                      </svg>
                </div>
                <div class="sidebar-brand-text mx-3">Smart<sup>Farm</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

          

            <!-- Heading -->
            <div class="sidebar-heading">
                Outils
            </div>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Database</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Prediction</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
                 <!-- Divider -->

            <hr class="sidebar-divider my-0">
                 <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <span>Log out</span></a>
            </li>
            <hr class="sidebar-divider my-0">
                 <li class="nav-item text-gray-300 fs-6 lead p-2 my-3">
                    <h6>This project is the subject of the Soft Embarque Module exam and our subject of participation in the science fair Luxembourg edition 2023. This project is under development (15-05-2023). Please check our github profiles for the latest version.</h6>
            </li>
 
        </ul>
        <!-- End of Sidebar -->
<!------------------------------------------------------------------------------------------------------------->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid p-5">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Home</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- ------------------------------------------------------------ -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Moist</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            <h1><?php echo $humidity; ?>%</h1>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <div class="col-auto text-gray-300 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-droplet" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z"/>
  <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z"/>
</svg>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ---------------------------------------------------- -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Temperature</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                            <h2><?php echo $temperature; ?>°C</h2>
                                           </div>
                                        </div>
                                        <div class="col-auto text-gray-300 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-thermometer-half" viewBox="0 0 16 16">
  <path d="M9.5 12.5a1.5 1.5 0 1 1-2-1.415V6.5a.5.5 0 0 1 1 0v4.585a1.5 1.5 0 0 1 1 1.415z"/>
  <path d="M5.5 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM8 1a1.5 1.5 0 0 0-1.5 1.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0l-.166-.15V2.5A1.5 1.5 0 0 0 8 1z"/>
</svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pressure
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                   <h4>1013,25 hPa </h4>        
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
  <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
  <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
</svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Wind Speed</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                               <h1>2 mph </h1> 
                                            </div>
                                        </div>
                                        <div class="col-auto text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-wind" viewBox="0 0 16 16">
  <path d="M12.5 2A2.5 2.5 0 0 0 10 4.5a.5.5 0 0 1-1 0A3.5 3.5 0 1 1 12.5 8H.5a.5.5 0 0 1 0-1h12a2.5 2.5 0 0 0 0-5zm-7 1a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 2 2h-5a.5.5 0 0 1 0-1h5a1 1 0 0 0 0-2zM0 9.5A.5.5 0 0 1 .5 9h10.042a3 3 0 1 1-3 3 .5.5 0 0 1 1 0 2 2 0 1 0 2-2H.5a.5.5 0 0 1-.5-.5z"/>
</svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ............................Content Row............................ -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Temperature graph</h6>
          
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5 ">
                            <div class="card shadow mb-4 bg-success">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Description</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body py-4">
                                    <p class="text-white">The following graph describe the evolution of the temperature based on the data collected through the Ds sensor.</p>
                            
                                </div>
                            </div>
                        </div>
                    </div>

<!-------------------------------------------------- Content Row ------------------------------------------------------------>
                          <!-- ............................Content Row............................ -->

                          <div class="row">

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Moisture graph</h6>

        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart1"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5 ">
    <div class="card shadow mb-4 bg-success">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Description</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body py-4">
            <p class="text-white">The following graph describe the evolution of the moisture based on the data collected through the yl 69 sensor.</p>
    
        </div>
    </div>
</div>
</div>

<!-------------------------------------------------- Content Row ------------------------------------------------------------>
                    <!-- ............................Content Row............................ -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Water level Evolution</h6>
          
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                    <canvas id="pieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5 ">
                            <div class="card shadow mb-4 bg-success">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Description</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body py-4">
                                    <p class="text-white">The following graph describe the level of the water in order to control the water consumption</p>
                            
                                </div>
                            </div>
                        </div>
                    </div>

<!-------------------------------------------------- Content Row ------------------------------------------------------------>
                         <!-- ............................Content Row............................ -->

                         <div class="row">

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Pressure graph</h6>

        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart2"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5 ">
    <div class="card shadow mb-4 bg-success">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Description</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body py-4">
            <p class="text-white">The following graph describe the evolution of the pressure based on the data collected through the barometer.</p>
    
        </div>
    </div>
</div>
</div>

<!-------------------------------------------------- Content Row ------------------------------------------------------------>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;Smart Farm</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
<!-- Page level plugins -->
    <script >
        <?php 
        $myPDO = new PDO('sqlite:/home/pi/current_values/tempbase.db');
        
        $result=$myPDO->query("SELECT * FROM temps");
        foreach ($result as $row){
            $time[]=$row['timestamp'];
            $value[]=$row['temp'];}
        ?>
       //line
var ctxL = document.getElementById("myAreaChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($time);?>,
    datasets: [{
      label: "Temperature",
      data: <?php echo json_encode($value);?>,
     
      borderColor: [
        'rgba(200, 99, 132, .7)',
      ],
      borderWidth: 2
    }
    ]
  },
  options: {
    responsive: true
  }
});
    </script>

<script >
        <?php 
        $myPDO = new PDO('sqlite:/home/pi/current_values/moistbase.db');
        
        $result=$myPDO->query("SELECT * FROM moistt");
        foreach ($result as $row){
            $time[]=$row['timestamp'];
            $value[]=$row['moist'];}
        ?>
       //line
var ctxL = document.getElementById("myAreaChart1").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($time);?>,
    datasets: [{
      label: "Moisture",
      data: <?php echo json_encode($value);?>,
     
      borderColor: [
        'rgba(200, 99, 132, .7)',
      ],
      borderWidth: 2
    }
    ]
  },
  options: {
    responsive: true
  }
});
    </script>
    <script>
        <?php 
        $myPDO = new PDO('sqlite:/home/pi/current_values/waterbase.db');
        $pos=0;
        $neg=0;
        $result=$myPDO->query("SELECT * FROM watertable");
        foreach ($result as $row){
            $time[]=$row['timestamp'];
            if($row['water_level']==1){
                $pos=$pos+1;
            }
            else{
                $neg=$neg+1;
            }
            $value[]=$row['water_level'];
    
        }
        ?>
//pie
var ctxP = document.getElementById("pieChart").getContext('2d');
  var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
      labels: ["Shortage", "Enough"],
      datasets: [{
        data: [<?php echo $neg;?>,<?php echo $pos;?>],
        backgroundColor: ["red", "forestgreen"],
      }]
    },
    options: {
      responsive: true
    }
  });
    </script>

<script >
        <?php 
        $myPDO = new PDO('sqlite:/home/pi/current_values/pressurebase.db');
        
        $result=$myPDO->query("SELECT * FROM pressure");
        foreach ($result as $row){
            $time[]=$row['timestamp'];
            $value[]=$row['pressure_value'];}
        ?>
       //line
var ctxL = document.getElementById("myAreaChart2").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($time);?>,
    datasets: [{
      label: "Pressure",
      data: <?php echo json_encode($value);?>,
     
      borderColor: [
        'rgba(200, 99, 132, .7)',
      ],
      borderWidth: 2
    }
    ]
  },
  options: {
    responsive: true
  }
});
    </script>
</body>

</html>
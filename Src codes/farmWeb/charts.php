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
                        <h1 class="h1 mb-0 text-gray-800"><a href ="#" onclick="all()" style="text-decoration:none; color: forestgreen;">Database</a></h1>
                        <div class="d-sm-flex">
                        <a href="#" onclick="temp()" style="text-decoration:none; color: forestgreen;"><div class="h6 mx-3"> Temperature</div></a>
                        <a href="#" onclick="moist()"style="text-decoration:none; color: forestgreen;"><div class="h6 mx-3"> Moisture</div></a>
                        <a href="#" onclick="pres()" style="text-decoration:none; color: forestgreen;"><div class="h6 mx-3"> Pression</div></a>
                        <a href="#" onclick="temp()" style="text-decoration:none; color: forestgreen;"><div class="h6 mx-3"> Wind Speed</div></a>
                        </div>
                    </div>
<!------------------------------------------------------------------------------------------------------------->
        <div class="container" id="temperature">
    <h1 class="h4 mb-4 text-danger ">Temperature</h1> 
    <table class="table table-hover">
  <thead>
    
    <tr>
      <th scope="col">Time</th>
      <th scope="col">Temperature</th>
    </tr>
  </thead>
  <tbody>
            <?php

            $dbh = new PDO("sqlite:/home/pi/current_values/tempbase.db");
            $sql = "SELECT * FROM temps" ;
            foreach ($dbh->query($sql) as $row)
            {
                echo "<tr>
                    <td>$row[timestamp]</td>
                    <td>$row[temp]</td>
             </tr>";
            }
            $dbh = null;
            ?>

  </tbody>
</table>
    </div>
    <!------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------->
<div class="container my-2" id="moisture">
    <h1 class="h4 mb-4 text-info">Moisture</h1> 
    <table class="table table-hover">
  <thead>
    
    <tr>
      <th scope="col">Time</th>
      <th scope="col">Moisture</th>
    </tr>
  </thead>
  <tbody>
            <?php

            $dbh = new PDO("sqlite:/home/pi/current_values/moistbase.db");
            $sql = "SELECT * FROM moistt" ;
            foreach ($dbh->query($sql) as $row)
            {
                echo "<tr>
                    <td>$row[timestamp]</td>
                    <td>$row[moist]</td>
             </tr>";
            }
            $dbh = null;
            ?>

  </tbody>
</table>
    </div>
    <!------------------------------------------------------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------------->
<div class="container my-2" id="pressure">
    <h1 class="h4 mb-4 text-secondary">Pressure</h1> 
    <table class="table table-hover">
  <thead>
    
    <tr>
      <th scope="col">Time</th>
      <th scope="col">Pressure</th>
    </tr>
  </thead>
  <tbody>
            <?php

            $dbh = new PDO("sqlite:/home/pi/current_values/pressurebase.db");
            $sql = "SELECT * FROM pressure" ;
            foreach ($dbh->query($sql) as $row)
            {
                echo "<tr>
                    <td>$row[timestamp]</td>
                    <td>$row[pressure_value]</td>
             </tr>";
            }
            $dbh = null;
            ?>

  </tbody>
</table>
    </div>
    <!------------------------------------------------------------------------------------------------------------->
                </div>
        </div>
    </div>
   <script>
    const tempdiv=document.getElementById("temperature");
    const moistdiv=document.getElementById("moisture");
    const presdiv=document.getElementById("pressure");
    function temp(){
        moistdiv.style.display="none";
        presdiv.style.display="none";
        tempdiv.style.display="block";

    }
    function moist(){
        moistdiv.style.display="block";
        presdiv.style.display="none";
        tempdiv.style.display="none";
    }
    function all(){
        presdiv.style.display="block";
        moistdiv.style.display="block";
        tempdiv.style.display="block";

    }
    function pres(){
        presdiv.style.display="block";
        moistdiv.style.display="none";
        tempdiv.style.display="none";

    }
   </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>
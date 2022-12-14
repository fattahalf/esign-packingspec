<?php
//Redirect ke Login Page jika User belum Login
session_start();
if (empty($_SESSION['loginStatus']) || $_SESSION['loginStatus'] == '') {
  header("Location: login.php");
  die();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard - Packing Spec E-Sign System</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- Choices CSS-->
  <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
  <div class="page">
    <!-- Main Navbar-->
    <header class="header z-index-50">
      <nav class="nav navbar py-3 px-0 shadow-sm text-white position-relative">
        <div class="container-fluid w-100">
          <div class="navbar-holder d-flex align-items-center justify-content-between w-100">
            <!-- Navbar Header-->
            <div class="navbar-header">
              <!-- Navbar Brand --><a class="navbar-brand d-none d-sm-inline-block" href="index.php">
                <div class="brand-text d-none d-lg-inline-block">Packing Spec E-Sign System | Production Engineering - Packing Departement</div>
            </div>
            <!-- Log Out-->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <li class="nav-item d-flex align-items-center"><a class="nav-link text-white" href="logout.php"> <span class="d-none d-sm-inline">Logout</span>
                  <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                    <use xlink:href="#security-1"> </use>
                  </svg></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
      <!-- Side Navbar -->
      <nav class="side-navbar z-index-40">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center py-4 px-3"><img class="avatar shadow-0 img-fluid rounded-circle" src="img/avatar-1.jpg" alt="...">
          <div class="ms-3 title">
            <h1 class="h4 mb-2"><?php echo $_SESSION['name']; ?></h1>
            <p class="text-sm text-gray-500 fw-light mb-0 lh-1"><?php echo $_SESSION['role']; ?></p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus-->
        <ul class="list-unstyled py-4">
          <li class="sidebar-item"><a class="sidebar-link" href="index.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#real-estate-1"> </use>
              </svg>Dashboard </a></li>

          <!-- Sidebar Menu Role Filter -->
          <?php 
                if($_SESSION['role'] == 'Staff PE' || 'Super User'){
                  echo "
                  <li class='sidebar-item active'><a class='sidebar-link' href='issue.php'> 
                  <svg class='svg-icon svg-icon-sm svg-icon-heavy me-xl-2'>
                    <use xlink:href='#portfolio-grid-1'></use>
                  </svg>Issue Documents</a>
                  </li>";

                  echo "<li class='sidebar-item'><a class='sidebar-link' href='approve.php'> 
                  <svg class='svg-icon svg-icon-sm svg-icon-heavy me-xl-2'>
                    <use xlink:href='#sales-up-1'> </use>
                  </svg>Approve Documents </a>
                  </li>";

                }
                else if ($_SESSION['role'] ==  'Staff QA' || 'SPV' || 'General Foreman' || 'Manager') {
                  echo "<li class='sidebar-item'><a class='sidebar-link' href='approve.php'> 
                  <svg class='svg-icon svg-icon-sm svg-icon-heavy me-xl-2'>
                    <use xlink:href='#sales-up-1'> </use>
                  </svg>Approve Documents </a>
                </li>";
                }
              ?>
      </nav>
      <div class="content-inner w-100">
        <!-- Page Header-->
        <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Issue Documents</h2>
          </div>
        </header>

        <!-- User Dashboard -->
        <section class="pb-0">
          <div class="container-fluid">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row gx-5 bg-white">
                  <!-- Item -->
                  <div class="col-xl-4 col-sm-6 py-4 border-lg-end border-gray-200">
                    <div class="d-flex align-items-center">
                      <div class="mx-3">
                        <h6 class="h4 fw-light text-gray-600 mb-3">Issued<br>Documents</h6>
                        <div class="progress" style="height: 4px">
                          <div class="progress-bar bg-violet" role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="number"><strong class="text-lg"><?php echo $_SESSION['summaryIssued']; ?></strong></div>
                    </div>
                  </div>
                  <!-- Item -->
                  <div class="col-xl-4 col-sm-6 py-4 border-lg-end border-gray-200">
                    <div class="d-flex align-items-center">
                      <div class="mx-3">
                        <h6 class="h4 fw-light text-gray-600 mb-3">Need<br>Revise</h6>
                        <div class="progress" style="height: 4px">
                          <div class="progress-bar bg-green" role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="number"><strong class="text-lg"><?php echo $_SESSION['summaryNeedRevise']; ?></strong></div>
                    </div>
                  </div>
                  <!-- Item -->
                  <div class="col-xl-4 col-sm-6 py-4">
                    <div class="d-flex align-items-center">
                      <div class="mx-3">
                        <h6 class="h4 fw-light text-gray-600 mb-3">Fully<br>Approved</h6>
                        <div class="progress" style="height: 4px">
                          <div class="progress-bar bg-orange" role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="number"><strong class="text-lg"><?php echo $_SESSION['summaryApproved']; ?></strong></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!--Document Upload -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.form.min.js"></script>
        <script>
          function preview_image() {
            var total_file = document.getElementById("upload_file").files.length;
            for (var i = 0; i < total_file; i++) {
              $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'width='124px' height='175px'> ");
            }
          }

          $(document).ready(function() {
            $('form').ajaxForm(function() {
              alert("Document Uploaded Successfully");
              location.reload();
            });
          });
        </script>

          <div id="wrapper">
            <div class="w-25 p-3 m-3">
              <form action="upload_file.php" method="POST" enctype="multipart/form-data">
                <input class="form-control" type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple />
                <input type="submit" class="btn btn-primary mt-3 mb-3" name='submit_image' value="Upload Image">
              </form>
            </div>
            <div class="m-4">
              <div id="image_preview"></div>
            </div>
          </div>

          <!-- Page Footer-->
          <footer class="position-absolute bottom-0 bg-darkBlue text-white text-center py-3 w-100 text-xs" id="footer">
            <div class="container-fluid">
              <div class="row gy-2">
                <div class="col-sm-6 text-sm-start">
                  <p class="mb-0">Yamaha Indonesia Motor MFG &copy; Production Engineering Packing Dept. | 2022</p>
                </div>
              </div>
            </div>
          </footer>
      </div>
    </div>
  </div>
  <!-- JavaScript files-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/just-validate/js/just-validate.min.js"></script>
  <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="js/charts-home.js"></script>
  <!-- Main File-->
  <script src="js/front.js"></script>
  <script>
    // ------------------------------------------------------- //
    //   Inject SVG Sprite - 
    //   see more here 
    //   https://css-tricks.com/ajaxing-svg-sprite/
    // ------------------------------------------------------ //
    function injectSvgSprite(path) {

      var ajax = new XMLHttpRequest();
      ajax.open("GET", path, true);
      ajax.send();
      ajax.onload = function(e) {
        var div = document.createElement("div");
        div.className = 'd-none';
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
      }
    }
    // this is set to BootstrapTemple website as you cannot 
    // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
    // while using file:// protocol
    // pls don't forget to change to your domain :)
    injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
  </script>
  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>

</html>
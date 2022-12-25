<?php
      //Redirect ke Login Page jika User belum Login
      include 'dbconnect.php';
      session_start();
      if(empty($_SESSION['loginStatus']) || $_SESSION['loginStatus'] == ''){
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
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js">
    </script>
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
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
                <div class="brand-text d-none d-lg-inline-block">Packing Spec E-Sign System | Production Engineering -
                  Packing Departement</div>
            </div>
            <!-- Log Out-->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <li class="nav-item d-flex align-items-center"><a class="nav-link text-white" href="logout.php"> <span
                    class="d-none d-sm-inline">Logout</span>
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
        <div class="sidebar-header d-flex align-items-center py-4 px-3"><img
            class="avatar shadow-0 img-fluid rounded-circle" src="img/avatar-1.jpg" alt="...">
          <div class="ms-3 title">
            <h1 class="h4 mb-2">
              <?php echo $_SESSION['name'];?>
            </h1>
            <p class="text-sm text-gray-500 fw-light mb-0 lh-1">
              <?php echo $_SESSION['role'];?>
            </p>
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
                if($_SESSION['role'] == 'Staff PE'){
                  echo "
                  <li class='sidebar-item'><a class='sidebar-link' href='issue.php'> 
                  <svg class='svg-icon svg-icon-sm svg-icon-heavy me-xl-2'>
                    <use xlink:href='#portfolio-grid-1'></use>
                  </svg>Issue Documents</a>
                  </li>";

                  echo "<li class='sidebar-item active'><a class='sidebar-link' href='approve.php'> 
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
            <h2 class="mb-0 p-1">Approve Documents</h2>
          </div>
        </header>
        <!--Table-->
        <section class="tables">
          <div class="container-fluid">
            <div class="row gy-1">
              <div class="col-lg-0" style=" height: 70vh;">
                <div class="card mb-4 " style="height: 70vh;">
                  <div class="card-header">
                    <div class="card-close">
                    </div>
                    <h3 class="h4 mb-0">Issued by Prod. Engineering Dept.</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <div class="tableFixHead">

                        <!-- <div class="scrollable-table"> -->
                        <table class="table mb-0">
                          <thead>
                            <tr>
                              <th>File Name</th>
                              <th>PIC</th>
                              <th>Location</th>
                              <th>Revise Note</th>
                              <th>Revise From</th>
                              <th>Issued on</th>
                              <th>Last Update</th>
                              <th>Action</th>
                              <!-- <th>Last Approval</th>
                              <th>Last Update Time</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <?php
                            // print("<pre>".print_r($documents,true)."</pre>");
                            $files = mysqli_query($connection,"SELECT * FROM files");
                            $file_data = mysqli_fetch_assoc($files);
                            $account_location = $_SESSION['role'];

                            $sql = "SELECT id, file_name, file_owner, file_location, file_revise_note, revise_from, issued_on, last_update_on FROM files WHERE file_location='$account_location'";
                            $result = $connection->query($sql);
                            if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                echo "  <tr>
                                        <td>" . $row["file_name"] . "</td>
                                        <td>" . $row["file_owner"] . "</td>
                                        <td>" . $row["file_location"] . "</td>
                                        <td>" . $row["file_revise_note"] . "</td>
                                        <td>" . $row["revise_from"] . "</td>
                                        <td>" . $row["issued_on"] . "</td>
                                        <td>" . $row["last_update_on"] . "</td>
                                        <td>
                                          <button type='button' onclick='showspec(`" . $row["file_name"] . "`)' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#checkDocModal'>
                                            Check
                                          </button>
                                          <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                            Remove
                                          </button>                                        
                                        </td>  
                                      </tr>
                              ";

                            }
                            echo "</table>";
                            } else { echo "0 results"; }
                            $connection->close();
                          ?>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>

        <!--Modal Button Approval-->
        <div class="modal fade" id="checkDocModal" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="checkDocModalLabel">Approve a Document</h1>
                <!--Button Close-->
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div class="text-center">
                  <img src="" id="imgdata" alt="" width="400">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveDocModal">
                  Approve Document
                </button>
              </div>
            </div>
          </div>
        </div>

        <!--Modal for Approval Confirmation-->
        <div class="modal fade" id="approveDocModal" tabindex="-1" role="dialog" data-bs-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="approveDocModalLabel">Approval Confirmation</h1>
                <!--Button Close-->
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </button>
              </div>
              <div class="modal-body">
                Are you sure want to Sign this document?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                  data-bs-target="#checkDocModal">Cancel</button>
                <button id="mergeButton" type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="merge();">Yes</button>
              </div>
            </div>
          </div>
        </div>
        <canvas id="canvas_id"  width="2480" height="3508" style="border:1px solid #000000;"></canvas>
        
		<div id="img" style="display:none;">
			<img src="" id="newimg" class="top" />
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
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.form.min.js"></script>

  <script>
    $("#confirmApprove").on("click", function () {
      $('#approveDocModal').modal('show');
    });

    function showspec(filename) {
      var _filename = filename
      document.querySelector("#imgdata").src = "http://localhost/esign/esign-packingspec/packing-spec/under-approval/" + _filename;
      localStorage.setItem('tempfile', filename);
    }
    $(function () {
            $("#mergeButton").click(function () {
                html2canvas(document.querySelector("#canvas_id"), {
                    onrendered: function (canvas) {
                        var imgsrc = canvas.toDataURL("image/png");
                        console.log(imgsrc);
                        // $("#newimg").attr('src', imgsrc);
                        // $("#img").show();
                        var dataURL = canvas.toDataURL();
                        $.ajax({
                            type: "POST",
                            url: "script.php",
                            data: {
                                imgBase64: dataURL
                            }
                        }).done(function (o) {
                            console.log('saved');
                        });
                    }
                });
            });
        });

  </script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/just-validate/js/just-validate.min.js"></script>
  <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="js/charts-home.js"></script>

  <!-- Main File-->
  <script src="js/front.js"></script>
  <script>
    function merge() {
      var canvas = document.getElementById('canvas_id');
      var context = canvas.getContext('2d');

      var imageObj1 = new Image();
      const tempDoc = localStorage.getItem('tempfile');
      imageObj1.src = "http://localhost/esign/esign-packingspec/packing-spec/under-approval/" + tempDoc;
      
      imageObj1.onload = function () {
        // imageObj1.width = 10;
        // imageObj1.height = 10;
        context.drawImage(imageObj1, 0, 0, 2480, 3508);
      };

      var imageObj2 = new Image();
      imageObj2.src = "http://localhost/esign/esign-packingspec/signature/" + "<?php echo $_SESSION['username']?>" +".jpg";
      imageObj2.onload = function () {
        context.drawImage(imageObj2, 200, 700, 1000, 1700);
      };

      // var download = document.getElementById("mergeButton");
      // var image = document.getElementById("canvas_id").toDataURL("image/jpg")
      //   .replace("image/jpg", "image/octet-stream");
      // download.setAttribute("href", image);
      // document.getElementById('canvas_id').src = image;


      html2canvas($("#canvas_id"), {
                    onrendered: function (canvas) {
                        var imgsrc = canvas.toDataURL("image/jpg");
                        console.log(imgsrc);
                        $("#newimg").attr('src', imgsrc);
                        $("#img").show();
                        var dataURL = canvas.toDataURL();
                        $.ajax({
                            type: "POST",
                            url: "script.php",
                            data: {
                                imgBase64: dataURL
                            }
                        }).done(function (o) {
                            console.log('saved');
                        });
                    }
                });
    }
      // ------------------------------------------------------- //
      //   Inject SVG Sprite - 
      //   see more here 
      //   https://css-tricks.com/ajaxing-svg-sprite/
      // ------------------------------------------------------ //
      function injectSvgSprite(path) {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", path, true);
        ajax.send();
        ajax.onload = function (e) {
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.form.min.js"></script>
</body>

</html>
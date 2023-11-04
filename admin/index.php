<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Monkey Apes | Admin Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <?php include "admin-header.php"; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Sales</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <?php
                          include 'connect.php';

                          // SQL query to calculate the total quantity
                          $sql = "SELECT SUM(quantity) AS total_quantity FROM payment_cart";

                          $result = $db->query($sql);

                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                              $total_quantity = $row["total_quantity"];
                              echo '<h6>' . $total_quantity . '</h6>';
                          } else {
                              echo '<h6>No items found in the payment cart.</h6>';
                          }

                          // Close the database connection
                          $db->close();
                          ?>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Revenue</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <?php
                          include 'connect.php';

                          // SQL query to calculate the total quantity
                          $sql = "SELECT SUM(total_price) AS total_prices FROM checkout";

                          $result = $db->query($sql);

                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                              $total_prices = $row["total_prices"];
                              echo '<h6>' . $total_prices . '</h6>';
                          } else {
                              echo '<h6>No items found in the checkout.</h6>';
                          }

                          // Close the database connection
                          $db->close();
                          ?>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

            <div class="card-body">
              <h5 class="card-title">Customer</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <?php
                          include 'connect.php';

                          // SQL query to calculate the total quantity
                          $sql = "SELECT SUM(cust_id) AS cust_ids FROM user";

                          $result = $db->query($sql);

                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                              $cust_ids = $row["cust_ids"];
                              echo '<h6>' . $cust_ids . '</h6>';
                          } else {
                              echo '<h6>No items found in the user.</h6>';
                          }

                          // Close the database connection
                          $db->close();
                          ?>
                </div>
              </div>
            </div>
          </div>

        </div><!-- End Customers Card -->

        <!-- Reports -->
        <div class="col-12">
          <div class="card">

            <!-- Line Chart -->
            <div class="card-body">
              <h5 class="card-title">Reports</h5>

              <?php
                      include 'connect.php';

                      // SQL query to calculate the total quantity for Sales
                      $sqlSales = "SELECT SUM(quantity) AS total_quantity FROM payment_cart";
                      $resultSales = $db->query($sqlSales);

                      $totalQuantitySales = 0;
                      if ($resultSales->num_rows > 0) {
                          $rowSales = $resultSales->fetch_assoc();
                          $totalQuantitySales = $rowSales["total_quantity"];
                      }

                      // SQL query to calculate the total revenue
                      $sqlRevenue = "SELECT SUM(total_price) AS total_prices FROM checkout";
                      $resultRevenue = $db->query($sqlRevenue);

                      $totalRevenue = 0;
                      if ($resultRevenue->num_rows > 0) {
                          $rowRevenue = $resultRevenue->fetch_assoc();
                          $totalRevenue = $rowRevenue["total_prices"];
                      }

                      // SQL query to calculate the total number of customers
                      $sqlCustomers = "SELECT COUNT(cust_id) AS cust_ids FROM user";
                      $resultCustomers = $db->query($sqlCustomers);

                      $totalCustomers = 0;
                      if ($resultCustomers->num_rows > 0) {
                          $rowCustomers = $resultCustomers->fetch_assoc();
                          $totalCustomers = $rowCustomers["cust_ids"];
                      }

                      // Close the database connection
                      $db->close();
                    ?>

              <!-- Line Chart -->
              <div id="reportsChart"></div>
              <script>
                  // Sample data (replace with your actual data)
                  var chartData = [
                      { x: '2023-01-01', y: 500, z: 100 },
                      { x: '2023-01-02', y: 600, z: 150 },
                      { x: '2023-01-03', y: 750, z: 200 },
                      // Add more data points
                  ];

                  document.addEventListener("DOMContentLoaded", function () {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                          series: [{
                              name: 'Revenue',
                              data: chartData.map(function (item) {
                                  return { x: new Date(item.x), y: item.y };
                              })
                          }, {
                              name: 'Sales',
                              data: chartData.map(function (item) {
                                  return { x: new Date(item.x), y: item.z };
                              })
                          }],
                          chart: {
                              height: 350,
                              type: 'line',
                              toolbar: {
                                  show: false
                              },
                          },
                          markers: {
                              size: 4
                          },
                          colors: ['#2eca6a', '#ff771d'],
                          xaxis: {
                              type: 'datetime',
                          },
                          yaxis: [
                              {
                                  title: {
                                      text: 'Revenue',
                                  },
                              },
                              {
                                  opposite: true,
                                  title: {
                                      text: 'Sales',
                                  },
                              },
                          ],
                          dataLabels: {
                              enabled: false
                          },
                          stroke: {
                              curve: 'smooth',
                              width: 2
                          },
                          tooltip: {
                              x: {
                                  format: 'yyyy-MM-dd' // Update to match your date format
                              },
                          }
                      }).render();
                  });
              </script>
              <!-- End Line Chart -->
            </div>

          </div>
        </div><!-- End Reports -->

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="card-body">
              <h5 class="card-title">Recent Sales</h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include 'connect.php';

                    // Fetch checkout data from the database
                    $result = mysqli_query($db, "SELECT checkout_id, user.username, payment_cart, total_price, payment_method, date FROM checkout JOIN user ON checkout.user = user.cust_id");

                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<th scope='row'><a href='#'>#{$row['checkout_id']}</a></th>";
                      echo "<td>{$row['username']}</td>";
                      echo "<td><a href='#' class='text-primary'>{$row['payment_cart']}</a></td>";
                      echo "<td>\${$row['total_price']}</td>";
                      echo "<td><span class='badge bg-success'>{$row['payment_method']}</span></td>";
                      echo "</tr>";
                    }

                    // Close the database connection
                    $db->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- End Recent Sales -->

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">

            <div class="card-body pb-0">
              <h5 class="card-title">Top Selling</h5>

              <?php
                  include 'connect.php';

                  // SQL query to retrieve the top-selling products
                  $sql = "
                  SELECT 
                      p.product_id, 
                      p.product_title, 
                      p.product_price, 
                      p.product_image, 
                      SUM(pc.quantity) AS total_quantity
                  FROM 
                      products AS p
                  JOIN 
                      payment_cart AS pc ON p.product_id = pc.product_id
                  GROUP BY 
                      p.product_id, p.product_title, p.product_price, p.product_image -- Add product_image here
                  ORDER BY 
                      total_quantity DESC
                  LIMIT 10;
                  ";

                  $result = mysqli_query($db, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      echo "<table class='table table-borderless'>";
                      echo "<thead>";
                      echo "<tr>";
                      echo "<th scope='col'>Preview</th>";
                      echo "<th scope='col'>Product</th>";
                      echo "<th scope='col'>Price</th>";
                      echo "<th scope='col'>Sold</th>";
                      echo "<th scope='col'>Revenue</th>";
                      echo "</tr>";
                      echo "</thead>";
                      echo "<tbody>";

                      while ($row = mysqli_fetch_assoc($result)) {
                        $imagePath = './products_images/' . $row["product_image"]; // Define image path
                        echo "<tr>";
                        echo "<th scope='row'><img src='{$imagePath}' alt=''></a></th>";
                        echo "<td>{$row['product_title']}</td>";
                        echo "<td>RM{$row['product_price']}</td>";
                        echo "<td class='fw-bold'>{$row['total_quantity']}</td>";
                        $totalRevenue = $row['product_price'] * $row['total_quantity']; // Calculate total revenue
                        echo "<td>RM{$totalRevenue}</td>";
                        echo "</tr>";
                      }

                      echo "</tbody>";
                      echo "</table>";
                  } else {
                      echo "No top-selling products found.";
                  }

                  // Close the database connection
                  $db->close();
                  ?>
            </div>


          </div>
        </div><!-- End Top Selling -->

        <!-- Website Ratings -->
        <?php
          include 'connect.php';
          // Fetch ratings statistics from your database
          $query = "SELECT rating, COUNT(*) as count FROM ratings GROUP BY rating";
          $result = $db->query($query);

          $ratingsData = array();
          while ($row = $result->fetch_assoc()) {
              $rating = $row['rating'];
              $count = $row['count'];

              // Build an array for each rating
              $ratingsData[] = array(
                  "name" => $rating . " Star",
                  "value" => $count
              );
          }

          // Close the database connection
          $db->close();
        ?>
        
        <div class="col-12">
          <div class="card top-selling overflow-auto">
            <div class="card-body pb-0">
              <h5 class="card-title">Ratings</h5>

                <div id="ratingsChart" style="min-height: 400px;" class="echart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const ratingsData = <?php echo json_encode($ratingsData); ?>;

                        const chart = echarts.init(document.querySelector("#ratingsChart"));
                        chart.setOption({
                            tooltip: {
                                trigger: 'item'
                            },
                            legend: {
                                top: '5%',
                                left: 'center'
                            },
                            series: [{
                                name: 'Ratings',
                                type: 'pie',
                                radius: ['40%', '70%'],
                                avoidLabelOverlap: false,
                                label: {
                                    show: false,
                                    position: 'center'
                                },
                                emphasis: {
                                    label: {
                                        show: true,
                                        fontSize: '18',
                                        fontWeight: 'bold'
                                    }
                                },
                                labelLine: {
                                    show: false
                                },
                                data: ratingsData // Use the ratings data from your database
                            }]
                        });
                    });
                </script>
            </div>
          </div>
        </div>
        <!-- End Website Ratings -->

      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    $(document).ready( function () {
        $('#salesTable').DataTable();
    } );
  </script>

</body>

</html>
<link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet" type="text/css" >
@vite(['resources/js/dashboard.js', 'resources/css/dashboard/dashboard.css'])


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <!-- <title>Dashboard</title> -->
    <!-- Boxicons CSS -->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>


  <body>
  <x-nav></x-nav>
    <section class="overlay"></section>

    <section class="dashboard">
        <div class="dashboard-content">
            <div class="upper-section">
                <!-- Upper Section Boxes -->
                <div class="upper-section-left">
                    <h2>Sales of the Week</h2>
                    <div class="box" id="box-1"></div>
                </div>
                <div class="upper-section-right">
                    <h5>Recently Sold Items</h5>
                    <div class="box" id="box-2"></div>
                    <h5>Recent Performance</h5>
                    <div class="box" id="box-3"></div>
                </div>
            </div>

            <div class="lower-section">
                <!-- Lower Section Boxes -->
                <div class="left-box">
                    <h5>Graph 1</h5>
                    <div class="box" id="box-4">
                        <img src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
                    </div>
                </div>

                <div class="middle-box">
                    <h5>Graph 2</h5>
                    <div class="box" id="box-5">
                        <img src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
                    </div>
                </div>
                <div class="right-box">
                    <h5>Graph 3</h5>
                    <div class="box" id="box-6">
                        <img src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
                    </div>
                </div>
            </div>
        </div>
    </section>

  </body>
</html>

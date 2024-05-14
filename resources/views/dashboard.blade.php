<link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet" type="text/css" >
@vite(['resources/js/dashboard.js', 'resources/css/dashboard/dashboard.css'])


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Dashboard</title>
    <!-- Boxicons CSS -->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>


  <body>
    <nav>

      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name">[Company Name]</span>
      </div>

      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">[Company Name]</span>
        </div>
        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="/dashboard" class="nav-link">
                <i class="bx bx-home-alt icon"></i>
                <span class="link">Dashboard</span>
              </a>
            </li>
            <li class="list">
              <a href="/inventory" class="nav-link">
                <i class='bx bx-package icon'></i>
                <span class="link">Inventory</span>
              </a>
            </li>
            <li class="list">
              <a href="/supplier" class="nav-link">
                <i class='bx bxs-cart-add icon'></i>
                <span class="link">Supplies</span>
              </a>
            </li>
            <li class="list">
              <a href="/sales" class="nav-link">
                <i class='bx bx-line-chart icon'></i>
                <span class="link">Sales</span>
              </a>
            </li>
            <li class="list">
              <a href="/cashier" class="nav-link">
                <i class='bx bx-money icon' ></i>
                <span class="link">Cashier</span>
              </a>
            </li>
          </ul>
          {{-- bottom content  --}}
          <div class="bottom-cotent">
            <li class="list">
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-log-out icon"></i>
                <span class="link">Logout</span>
              </a>
              <!-- Hidden logout form -->
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          </div>
        </div>
      </div>
    </nav>
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

@vite(['resources/js/dashboard.js', 'resources/css/app.css'])


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Boxicons CSS -->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    <style>
      
      nav {
        position: fixed;
        top: 0;
        left: 0;
        height: 50px;
        width: 100%;
        display: flex;
        align-items: center;
        background: #fff;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.3);
      }
      nav .logo {
        display: flex;
        align-items: center;
        margin: 0 24px;
      }
      .logo .menu-icon {
        color: var(--main-color);
        font-size: 24px;
        margin-right: 14px;
        cursor: pointer;
      }
      .logo .logo-name {
        color: var(--main-color);
        font-size: 22px;
        font-weight: 500;
      }
      nav .sidebar {
        position: fixed;
        top: 0;
        left: -100%;
        height: 100%;
        width: 260px;
        padding: 20px 0;
        background-color: #fff;
        box-shadow: 0 5px 1px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
      }
      nav.open .sidebar {
        left: 0;
      }
      .sidebar .sidebar-content {
        display: flex;
        height: 100%;
        flex-direction: column;
        justify-content: space-between;
        padding: 30px 16px;
      }
      .sidebar-content .list {
        list-style: none;
      }
      .list .nav-link {
        display: flex;
        align-items: center;
        margin: 8px 0;
        padding: 14px 12px;
        border-radius: 8px;
        text-decoration: none;
      }
      .lists .nav-link:hover {
        background-color: #4070f4;
      }
      .nav-link .icon {
        margin-right: 14px;
        font-size: 20px;
        color: var(--main-color);
      }
      .nav-link .link {
        font-size: 16px;
        color: var(--main-color);
        font-weight: 400;
      }
      .lists .nav-link:hover .icon,.lists .nav-link:hover .link {
        color: #fff;
      }
      .overlay {
        position: fixed;
        top: 0;
        left: -100%;
        height: 1000vh;
        width: 200%;
        opacity: 0;
        pointer-events: none;
        transition: all 0.4s ease;
        background: rgba(0, 0, 0, 0.3);
      }
      nav.open ~ .overlay {
        opacity: 1;
        left: 260px;
        pointer-events: auto;
      }
    </style>
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
              <a href="#" class="nav-link">
                <i class="bx bx-log-out icon"></i>
                <span class="link">Logout</span>
              </a>
            </li>
          </div>
        </div>
      </div>

    </nav>
  </body>
</html>
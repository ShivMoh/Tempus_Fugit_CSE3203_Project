<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
        <title>Cashier</title>
        <link href="{{ asset('resources/css/cashier/cashier.css') }}" rel="stylesheet" type="text/css" >
        @vite(['resources/css/cashier/cashier.css','resources/js/cashier.js','resources/js/dashboard.js', 'resources/css/dashboard/dashboard.css'])
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
        <section class="overlay"></section>

        <div class="cashier-content">
            <table class="cashier">
                <thead>
                    <tr>
                        <th class="item-id">ID</th>
                        <th class="name-of-item">Name of Item</th>
                        <th class="amount">Amount</th>
                        <th class="discount">Discount (%)</th>
                        <th class="item-total">Item Total</th>
                    </tr>
                </thead>

                <tbody>
                    @for ($i = 0; $i < 15; $i++)
                        <tr>
                            <td class="item-id">{{ $i + 1 }}</td>
                            <td class="name-of-item">
                                <select name="item_name" onchange="updateRow(this)">
                                    <option value="">Select Item</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="amount">
                                <input type="number" min="1" value="" onchange="updateTotal(this)">
                            </td>
                            <td class="discount">
                                <input type="number" min="0" value="" onchange="updateTotal(this)">
                            </td>
                            <td class="item-total"></td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <div class="total-and-print">
                <input type="text" id="totalCost" value="">
                <button class="confirm-and-print-bill">Confirm and Print Bill</button>
                <button class="confirm-order">Confirm Order</button>
                <button class="manage-bills">Manage Bills</button>
            </div>
        </div>
    
      <!-- Pass items array to js -->
      <script>
          var items = <?php echo json_encode($items); ?>;
      </script>

    </body>
</html>

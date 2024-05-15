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
        <x-nav></x-nav>
        
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
                <button class="confirm-and-print-bill">
                    <a href="/bill_preview">Confirm and Print Bill</a>
                </button>

                <button class="manage-bills">
                    <a href="/bills">Manage Bills</a>
                </button>
            </div>
        </div>
    
      <!-- Pass items array to js -->
      <script>
          var items = <?php echo json_encode($items); ?>;
      </script>

    </body>
</html>

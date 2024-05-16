// Calculates an item's total and updates it.
function updateTotal(element) {
    var row = element.closest('tr');
    var amountInput = row.querySelector('.amount input');
    var discountInput = row.querySelector('.discount input');
    var itemTotalCell = row.querySelector('.item-total');
    
    var selectedItemName = row.querySelector('select[name="item_name[]"]').value;
    var selectedItem = items.find(item => item.name === selectedItemName);
    var sellingPrice = selectedItem ? selectedItem.selling_price : 0;

    row.querySelector('input[name="price[]"]').value = sellingPrice;

    var amount = parseFloat(amountInput.value) || 0;
    var discount = parseFloat(discountInput.value) || 0;
    var total = amount * sellingPrice * (1 - discount / 100);

    itemTotalCell.textContent = total.toFixed(2);
    
    // Trigger recalculation of the total amount at the bottom
    updateTotalCost();
}

// Updates row when an option has been selected.
// Defaults amount to 1 and discount to 0.
/* function updateRow(selectElement) {
    var row = selectElement.closest('tr');
    var amountInput = row.querySelector('.amount input');
    var discountInput = row.querySelector('.discount input');
    
    var selectedItemName = selectElement.value;
    var selectedItem = items.find(item => item.name === selectedItemName);
    
    amountInput.value = 1;
    discountInput.value = 0;

    updateTotal(amountInput);
}
 */

// Updates row when an option has been selected.
// Defaults amount to 1 and discount to 0.

function updateRow(selectElement) {
    var row = selectElement.closest('tr');
    var amountInput = row.querySelector('.amount input');
    var discountInput = row.querySelector('.discount input');

    // Get the selected option
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    
    // Get the stock count from the selected option
    var stockCount = parseFloat(selectedOption.getAttribute('data-stock')) || 0;
    
    // Set the maximum attribute of the amount input field to the stock count
    amountInput.setAttribute('max', stockCount);

    var selectedItemName = selectElement.value;
    var selectedItem = items.find(item => item.name === selectedItemName);
    
    amountInput.value = 1;
    discountInput.value = 0;

    updateTotal(amountInput);
}

// Calculates and updates the total cost.
function updateTotalCost() {
    var itemTotalCells = document.querySelectorAll('.item-total');
    var totalCost = 0;

    itemTotalCells.forEach(function(cell) {
        totalCost += parseFloat(cell.textContent) || 0;
    });

    // Add duty to the total cost
    var duty = 0.16 * totalCost;
    totalCost += duty;

    // If delivery fee is checked, add it to the total cost
    var deliveryFee = document.getElementById('delivery_fee').checked ? parseFloat(document.getElementById('delivery_fee').value) : 0;
    totalCost += deliveryFee;
    
    document.getElementById('totalCost').value = totalCost.toFixed(2);
}

document.querySelectorAll('.amount input, .discount input').forEach(function(input) {
    input.addEventListener('input', function() {
        updateTotal(this);
    });
});

document.querySelectorAll('select[name="item_name[]"]').forEach(function(select) {
    select.addEventListener('change', function() {
        updateRow(this);
    });
});

document.getElementById('delivery_fee').addEventListener('change', function() {
    updateTotalCost();
});

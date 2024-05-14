function updateTotal(element) {
    var row = element.closest('tr');
    var amountInput = row.querySelector('.amount input');
    var discountInput = row.querySelector('.discount input');
    var itemTotalCell = row.querySelector('.item-total');
    
    var selectedItemName = row.querySelector('select[name="item_name"]').value;
    var selectedItem = items.find(item => item.name === selectedItemName);
    var sellingPrice = selectedItem ? selectedItem.selling_price : 0;
    
    // Convert the amount and discount values to floats, then calculate the item total
    var amount = parseFloat(amountInput.value) || 0;
    var discount = parseFloat(discountInput.value) || 0;
    var total = amount * sellingPrice * (1 - discount / 100);

    itemTotalCell.textContent = total.toFixed(2);
    
    // Trigger recalculation of the total amount at the bottom
    updateTotalCost();
}

function updateRow(selectElement) {
    var row = selectElement.closest('tr');
    var amountInput = row.querySelector('.amount input');
    var discountInput = row.querySelector('.discount input');
    
    var selectedItemName = selectElement.value;
    var selectedItem = items.find(item => item.name === selectedItemName);
    
    // Set the default values for amount and discount
    amountInput.value = 1;
    discountInput.value = 0;

    updateTotal(amountInput);
}

function updateTotalCost() {
    var itemTotalCells = document.querySelectorAll('.item-total');
    var totalCost = 0;

    itemTotalCells.forEach(function(cell) {
        totalCost += parseFloat(cell.textContent) || 0;
    });
    
    document.getElementById('totalCost').value = totalCost.toFixed(2);
}

document.querySelectorAll('.amount input, .discount input').forEach(function(input) {
    input.addEventListener('input', function() {
        updateTotal(this);
    });
});

document.querySelectorAll('select[name="item_name"]').forEach(function(select) {
    select.addEventListener('change', function() {
        updateRow(this);
    });
});

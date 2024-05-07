window.addItem = function() {
    var item = document.getElementById('item');
    var amount = document.getElementById('amount');
    var items = document.getElementById('items');
    var item_display = document.getElementById('item-display');
    var item_str = `${amount.value}X ${item.value}`;

    console.log(document.getElementById('supplier').value)

    if(item_display.innerHTML.length == 0) {
      item_display.innerHTML = item_display.innerHTML + item_str ;
    } else {
      item_display.innerHTML = item_display.innerHTML + " | " +  item_str ;
    }
    
    items.value = item_display.innerText;
}

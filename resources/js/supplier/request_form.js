window.addItem = function() {
    var item = document.getElementById('item');
    var amount = document.getElementById('amount');
    var items = document.getElementById('items');
    var item_display = document.getElementById('item-display');
    var item_displayer = document.getElementById('item-displayer');

    var item_str = `${amount.value}X${item.value}`;
    var item_name = (item.value.split("x")[0]).replaceAll("_", " ");
    var item_displayer_str = `${amount.value} ${item_name}`;

    if(item_display.innerHTML.length == 0) {
      item_display.innerHTML = item_display.innerHTML + item_str ;
    } else {
      item_display.innerHTML = item_display.innerHTML + " | " +  item_str ;
    }
    
    items.value = item_display.innerText;
    console.log(items.value)

    item_displayer.innerHTML = item_displayer.innerHTML + "<p class='item'>" + item_displayer_str + "</p>"

}




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

    var index = (item_display.innerHTML.split("|")).length - 1;
    
    items.value = item_display.innerText;
    console.log(items.value)
    item_displayer.innerHTML = item_displayer.innerHTML + "<div class='list-item'><p class'item-name'>" + item_displayer_str + "</p><span class='delete' onclick=deleteItem("+index+")>Delete</span></div>"

}

window.deleteItem = function(index) {
  var item_display = document.getElementById('item-display');
  var list_items = document.querySelectorAll('list-item');
  var arr = item_display.innerHTML.split("|");
  arr.pop();
  item_display.innerHTML = arr.join("|");

  if (list_items.length > 0) {
    list_items[list_items.length - 1].remove();
  }

}

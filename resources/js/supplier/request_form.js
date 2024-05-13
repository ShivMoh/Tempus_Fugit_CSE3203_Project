


window.addItem = function() {
    var item = document.getElementById('item');
    var amount = document.getElementById('amount');
    var items = document.getElementById('items');
    var item_display = document.getElementById('item-display');
    var item_displayer = document.getElementById('item-displayer');
    var item_errors = document.getElementById('item-errors');

    if(amount.value.length == 0) {
      item_errors.innerHTML = "<span class='error'>Amount is required</span>"
      return;
    } else {
      item_errors.innerHTML = "";
    }

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
  var item_displayer = document.getElementById('item-displayer');
  var items = document.getElementById('items');

  // var list_items = document.querySelectorAll('list-item');
  var arr = item_display.innerHTML.split("|");

  item_displayer.innerHTML = removeListItem(item_displayer.innerHTML, index);
  
  var list_items = item_display.innerHTML.split('|')

  list_items.splice(index, 1);

  var item_list = list_items.join('|');

  item_display.innerHTML = item_list;
  items.value = item_list;

}

function removeListItem(htmlString, x) {
  // Create a temporary element to hold the HTML string
  var tempElement = document.createElement('div');
  tempElement.innerHTML = htmlString;

  // Find all elements with class "list-item"
  var listItems = tempElement.getElementsByClassName('list-item');

  // Iterate over the list items
  for (var i = 0; i < listItems.length; i++) {
      // Find the delete button inside the list item
      var deleteButton = listItems[i].getElementsByClassName('delete')[0];
      // Extract the ID from the onclick attribute value
      var match = deleteButton.getAttribute('onclick').match(/\((\d+)\)/);
      if (match) {
          var itemId = parseInt(match[1]);
          // Check if the ID matches the specified ID (x)
          if (itemId === x) {
              // Remove the list item from the temporary element
              tempElement.removeChild(listItems[i]);
          }
      }
  }

  // Return the updated HTML string
  return tempElement.innerHTML;
}

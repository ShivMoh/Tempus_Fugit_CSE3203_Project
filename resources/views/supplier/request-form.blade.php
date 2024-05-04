@vite('resources/css/supplier/request_form.css')
@vite('resources/js/supplier/request_form.js')

<form id="regForm" method="POST" action="/register">
    @csrf
    
    <h1>Register:</h1>
    
    <div class="tab">Address:
        <select name="job-role" id="item">
            <option value="cashier" selected>Cashier</option>
            <option value="manager">Manager</option>
        </select>
        <p><input placeholder="Amount" type="number" name="amount" id="amount"></p>
        <p class="item-display" id="item-display"></p>
        <input type="hidden" name="items" id="items">
        <button type="button" onclick="addItem()">Add Item</button>
    </div>
    
    <div class="tab">Contact Information:
        <p><input placeholder="Line 1" type="text" name="line-1"></p>
        <p><input placeholder="Line 2" type="text" name="line-2"></p>
        <p><input placeholder="City" type="text" name="city"></p>
        <p><input placeholder="State" type="text" name="State"></p>

        <div class="country-container">
            <p><input placeholder="Country" type="text" name="Country"></p>
            <p><input placeholder="Zip" type="text" name="zip"></p>
        </div>
    </div>
    
    <div class="tab">Home Address:
        <p><input placeholder="Card Holder Name" type="text" name="card-holder"></p>
        <p><input placeholder="Card Number" type="text" name="card-number"></p>

        <div class="security-container">
            <p><input placeholder="Security" type="text" name="security-pin"></p>
            <p><input placeholder="Expiray Date" type="text" name="expirary-date"></p>    
        </div>        
    </div>
    
    <div class="tab">Order Bill`:
        <h1>This is the order bill. It is indeed a bill</h1>
    </div>
    
    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
    
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
    
</form>


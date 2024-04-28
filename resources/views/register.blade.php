@vite('resources/css/register.css')
@vite('resources/js/register.js')

<form id="regForm" method="POST" action="/register">
    @csrf
    
    <h1>Register:</h1>
    
    <div class="tab">Personal Information:
        <p><input placeholder="First name..." type="text" name="first_name"></p>
        <p><input placeholder="Last name..." type="text" name="last_name"></p>
        <p><input placeholder="Date of Birth..." type="text" name="dob"></p>
        <select name="job-role">
            <option value="cashier" selected>Cashier</option>
            <option value="manager">Manager</option>
        </select>
    </div>
    
    <div class="tab">Contact Information:
        <p><input placeholder="Your Number..." type="text" name="primary_number"></p>
        <p><input placeholder="Emergency Contact Number..." name="secondary_number"></p>
        
    </div>
    
    <div class="tab">Home Address:
        <p><input placeholder="Line 1..." type="text" name="line_1"></p>
        <p><input placeholder="Line 2..." type="text" name="line_2"></p>
        <p><input placeholder="City..." type="text" name="city"></p>
        <p><input placeholder="State..." type="text" name="state"></p>
        <p><input placeholder="Country..." type="text" name="country"></p>
    </div>
    
    <div class="tab">Login Info:
        <p><input placeholder="Email..." name="email"></p>
        <p><input placeholder="Password..." name="password"></p>
        <p><input placeholder="Confirm Password..." name="confirm_password"></p>

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


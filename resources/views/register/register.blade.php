@vite('resources/css/register/register.css')
@vite('resources/js/register.js')

<form id="regForm" method="POST" action="/register">
    @csrf
    
    <h1>Register:</h1>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="tab">Personal Information:
        <p><input placeholder="First name..." type="text" name="first_name" value="{{ old('first_name') }}"></p>
        @error('first_name')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <p><input placeholder="Last name..." type="text" name="last_name" value="{{ old('last_name') }}"></p>
        @error('last_name')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <div class="date"><p><input placeholder="Date of Birth..." type="date" name="dob" value="{{ old('dob') }}" required></p></div>
        @error('dob')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <select name="job_role" id="job_role" required>
            <option value="" disabled {{ old('job_role') ? '' : 'selected' }}>Select job role:</option>
            <option value="cashier" {{ old('job_role') == 'cashier' ? 'selected' : '' }}>Cashier</option>
            <option value="manager" {{ old('job_role') == 'manager' ? 'selected' : '' }}>Manager</option>
        </select>
        @error('job_role')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="tab">Contact Information:
        <p><input placeholder="Your Number..." type="text" name="primary_number" value="{{ old('primary_number') }}"></p>
        @error('primary_number')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <p><input placeholder="Emergency Contact Number..." name="secondary_number" value="{{ old('secondary_number') }}"></p>
        @error('secondary_number')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="tab">Home Address:
        <p><input placeholder="Line 1..." type="text" name="line_1" value="{{ old('line_1') }}"></p>
        @error('line_1')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <p><input placeholder="Line 2..." type="text" name="line_2" value="{{ old('line_2') }}"></p>
        @error('line_2')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <p><input placeholder="City..." type="text" name="city" value="{{ old('city') }}"></p>
        @error('city')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <p><input placeholder="State..." type="text" name="state" value="{{ old('state') }}"></p>
        @error('state')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <p><input placeholder="Country..." type="text" name="country" value="{{ old('country') }}"></p>
        @error('country')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="tab">Login Info:
        <p><input placeholder="Email..." name="email" value="{{ old('email') }}"></p>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <p><input placeholder="Password..." type="password" name="password"></p>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <p><input placeholder="Confirm Password..." type="password" name="confirm_password"></p>
        @error('confirm_password')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
    
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
</form>

<script>
  var currentTab = {{ session('current_tab', 0) }}; // Read current tab from session or default to 0
</script>
<link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet" type="text/css" >
@vite(['resources/js/app.js', 'resources/css/dashboard/dashboard.css'])


<!-- The sidebar -->
<div class="sidebar">

    <div id="nav-bar">
        <input id="nav-toggle" type="checkbox"/>
        <div id="nav-header"><a id="nav-title" href="/dashboard">Dashboard</a>
          <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
          <hr/>
        </div>
        <div id="nav-content">
          <div class="nav-button"><a href="/inventory">Inventory</a></div>
          <div class="nav-button"><a href="/supplier">Supplier</a></div>
          <div class="nav-button"><a href="/sales">Sales</a></div>
          <div class="nav-button"><a href="#">Money</a></div>
          <div id="nav-content-highlight"></div>
        </div>
        <input id="nav-footer-toggle" type="checkbox"/>
        <div id="nav-footer">
          <div id="nav-footer-heading">
            <div id="nav-footer-avatar"><img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547"/></div>
            <div id="nav-footer-titlebox"><a id="nav-footer-title" href="#" >[Company name]</a><a id="nav-footer-subtitle" href="#">Logout</a></div>
          </div>
        </div>
    </div>


    <div class="content">
        <!-- Upper Page content -->
        <div class="upper content">
            <div class="box">
                <h2>Recently Sold Items</h2>
                <div class="container">
                    <!-- Three containers for upper div 1 -->
                    <div class="item">Lorem Ipsum</div>
                    <div class="item">Lorem Ipsum</div>
                    <div class="item">Lorem Ipsum</div>
                </div>
            </div>
            <div class="box">
                <h2>Recently Performance</h2>
                <div class="container">
                    <!-- Four containers for upper div 2 -->
                    <div class="item">Lorem Ipsum</div>
                    <div class="item"> Lorem Ipsum</div>
                    <div class="item">Lorem Ipsum</div>
                    <div class="item">Lorem Ipsum</div>
                </div>
            </div>
        </div>
        <!-- Lower Page content -->
        <div class="lower content">
            <div class="box">
                <img src="{{ asset('images/graph-line.jpg') }}" alt="Graph 1">
                <p>Graph 1</p>
            </div>
            <div class="box">
                <img src="{{ asset('images/graph-line.jpg') }}" alt="Graph 2">
                <p>Graph 2</p>
            </div>
            <div class="box">
                <img src="{{ asset('images/graph-line.jpg') }}" alt="Graph 3">
                <p>Graph 3</p>
            </div>
        </div>

    </div>
  </div>
</div>

</body>
</html>

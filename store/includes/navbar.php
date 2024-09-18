<style>
  .navbar-nav li:hover > ul.dropdown-menu {
    display: block;
}
.dropdown-submenu {
    position:relative;
}
.dropdown-submenu>.dropdown-menu {
    top:0;
    left:100%;
    margin-top:-6px;
}

/* rotate caret on hover */
.dropdown-menu > li > a:hover:after {
    text-decoration: underline;
    transform: rotate(-90deg);
} 
</style>

<nav class="navbar navbar-expand-md  navbar-light sticky-top" style="background-color:#EDEDED">

  <a class="navbar-brand" href="#"><img style="margin-top: -6px" id="logo" src="..\img\logo_old.svg" width="150" class="img" alt="a" ></a>
  

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
  
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
      </li>
      
    <li class="nav-item">
        <a class="nav-link" href="service.php">Service</a>
      </li>


    <!--<li class="nav-item dropdown">-->
    <!--<a class="nav-link dropdown-toggle nav_color" href="#" data-toggle="dropdown">Profile</a>-->
    <!--<ul class="dropdown-menu">-->
    <!--<li class="dropdown-submenu"><a class="dropdown-item" href="company.php">Company</a></li>-->
    <!--<li class="dropdown-submenu"><a class="dropdown-item" href="terms_condition.php">Terms & Condition</a></li>-->
    <!--</ul>-->
    <!--</li>-->
         <li class="nav-item"><a class="nav-link" href="task.php">Timeline</a></li>
        <li class="nav-item"><a class="nav-link" href="enquiry_management.php">Enquiry Management</a></li>

    <!--<li class="nav-item dropdown">-->
    <!--<a class="nav-link dropdown-toggle nav_color" href="#" data-toggle="dropdown">Q</a>-->
    <!--<ul class="dropdown-menu">-->
    <!--<li class="dropdown-submenu"><a class="dropdown-item" href="enquiry_management.php">Enquiry Management</a></li>-->
   <!-- <li class="dropdown-submenu"><a class="dropdown-item" href="quotation.php">Quotation</a></li>-->
   <!-- <li class="dropdown-submenu"><a class="dropdown-item" href="purchase_order.php">Purchase Order</a></li>-->
	  <!--<li class="dropdown-submenu"><a class="dropdown-item" href="purchase_entry.php">Purchase Entry</a></li>-->
    <!--</ul>-->
    <!--</li>-->

    

    </ul>



        <div class="ml-auto">
          <a class="navbar-brand" href="../views/logout.php" onclick="return confirm('\Are you sure')"><img src="../img/logout.png" width="30px"></a>
         </div>
</div>
  </div>
</nav> 
<br>
<script>
// Prevent closing from click inside dropdown
$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});

// make it as accordion for smaller screens
if ($(window).width() <  992) {
  $('.dropdown-menu a').click(function(e){
    e.preventDefault();
      if($(this).next('.submenu').length){
        $(this).next('.submenu').toggle();
      }
      $('.dropdown').on('hide.bs.dropdown', function () {
     $(this).find('.submenu').hide();
  });
  });
}


</script>

<style>
    .nav_color,.nav_color:hover{
  color:#ffffff;

}
</style>

























<!-- <nav class="navbar navbar-expand-md bg-light navbar-light fixed-top">
  
  <img src='..\img\logo_old.svg' style="margin-top: -6px;margin-bottom: -6px;margin-left:10px;margin-right: 18px" id="logo" width="150px" class="img" alt="a" /></a> -->

  <!-- Navbar links -->
  <!-- <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      
    <li class="nav-item">
      <a class="nav-link dashboard" href="../views/dashboard.php">Dashboard</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link tender" href="../views/tender_quotation.php">Tender Quotation</a>
    </li>

     <li class="nav-item">
      <a class="nav-link tender" href="../views/inventory_transfers.php">Inventory Transfers</a>
    </li> -->
    <!-- <li class="nav-item">
      <a class="nav-link tender" href="../views/inventory_summary.php">Inventory Summary</a>
    </li> -->
    <!-- <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Inventory Summary
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="../views/location_wise_inventory.php">Item Summary</a>
        <a class="dropdown-item" href="../views/inventory_in_location.php">Location Summary</a>
        <a class="dropdown-item" href="../views/purchase_inventory.php">Purchase Inventory</a>
        <a class="dropdown-item" href="../views/sale_inventory.php">Sale Inventory</a>
      </div>
    </li> -->
    <!-- <li class="nav-item">
      <a class="nav-link tender" href="../views/stock_locations.php">Stock Locations</a>
    </li> -->
<!-- 
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Stock Locations
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="../views/stock_locations_category.php">Stock Location Category</a>
        <a class="dropdown-item" href="../views/stock_locations.php">Stock Location</a>
      </div>
    </li>
    </ul>
  </div>
  <div class="nav-item" >
      <a class="nav-link" href="../views/logout.php" onclick="return confirm('Are you sure')"><img src="../img/logout.png" width="25px"></a>
    </div>
</nav> 
<hr>
<br>
<br>
<br> -->

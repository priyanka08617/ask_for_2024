<!-- bg-light navbar-light -->
<nav class="navbar navbar-expand-md  fixed-top" style="background-color:#2a4747">

    <img src='../../store/images/kost.svg' style="margin-top: -6px;margin-bottom: -6px;margin-left:10px;margin-right: 18px" id="logo" width="150px" class="img" alt="" /></a>


    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link dashboard nav_color" href="../views/dashboard.php">Dashboard</a>
            </li>

            <!-- <li class="nav-item"><a class="nav-link dashboard" href="../views/purchase_entry.php">Purchase Entry</a></li> -->


            <!-- <li class="nav-item dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Purchase<span class="caret"></span></a>
          <ul class="dropdown-menu">
         
           <li><a href="purchase_entry.php">Purchase Item Entry </a></li>
         
           <li><a href="purchase_resume.php">Purchase Resume</a></li>
           <li><a href="sale_purchase_details.php">Inventory </a></li>
                <li><a href="inventory.php">Inventory </a></li> -->
<!--   <li><a href="raw_material_inventory.php">Item Inventory</a></li>
            <li><a href="distributor_payment.php">Item In Distributor</a></li> -->
          <!-- </ul>
          
        </li> --> 


            <li class="nav-item">
                <a class="nav-link tender nav_color" href="../views/inventory_transfers.php">Inventory Transfers</a>
            </li>

            <!-- <li class="nav-item">
      <a class="nav-link tender" href="../views/inventory_summary.php">Inventory Summary</a>
    </li> -->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav_color" href="#" id="navbardrop" data-toggle="dropdown">
                    Inventory Summary
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../views/location_wise_inventory.php">Item Summary</a>
                    <a class="dropdown-item" href="../views/item_timeline.php">Item Timeline</a>
                    <hr>
                    <a class="dropdown-item" href="../views/inventory_in_location.php">Location Summary</a>
                    <a class="dropdown-item" href="../views/location_timeline.php">Location Timeline</a>
                </div>
            </li>



            <!-- <li class="nav-item">
      <a class="nav-link tender" href="../views/stock_locations.php">Stock Locations</a>
    </li> -->

            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Stock Locations
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../views/stock_locations_category.php">Stock Location Category</a>
                    <a class="dropdown-item" href="../views/stock_locations.php">Stock Location</a>
                </div>
            </li> -->


            <!-- <li class="nav-item">
      <a class="nav-link tender" href="../views/product_assembly.php">Product_assembly</a>
    </li>  -->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav_color" href="#" id="navbardrop" data-toggle="dropdown">
                    Assembly</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../views/product_assembly.php">Product Assembly</a>
                    <a class="dropdown-item" href="../views/stock_shifting.php">Inventory Shifting</a>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav_color" href="#" id="navbardrop" data-toggle="dropdown">
                    Process
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../views/process_master.php">Process Master</a>
                    <a class="dropdown-item" href="../views/process_action.php">Process Action</a>
                </div>
            </li>





          

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle nav_color" href="#" data-toggle="dropdown">Master Data</a>
    <ul class="dropdown-menu">
	  <li><a class="dropdown-item" href="#">UoM Master &raquo   </a>
		 <ul class="submenu dropdown-menu">
		    <li><a class="dropdown-item " href="../views/uom_category.php">UoM Category</a></li>
		    <li><a class="dropdown-item" href="../views/uom.php">UoM </a></li>
            <li><a class="dropdown-item" href="../views/uom_conversion.php">UoM conversion</a></li>
            </ul>
</li>

<li><a class="dropdown-item" href="#">Hsn Master &raquo   </a>
		 <ul class="submenu dropdown-menu">
		    <li><a class="dropdown-item" href="../views/hsn.php">Hsn Table</a></li>
		    <li><a class="dropdown-item" href="../views/hsn_rate.php">HsN Rate </a></li>
            </ul>
</li>


<li><a class="dropdown-item" href="#">Item Master &raquo   </a>
		 <ul class="submenu dropdown-menu">
         <li><a class="dropdown-item" href="../views/category.php">DP Category</a></li>
         <li><a class="dropdown-item" href="../views/subcategory.php">DP Sub-Category</a></li>
         <li><a class="dropdown-item" href="../views/item.php">Direct Purchased Items</a></li>
<hr></hr>
         <li><a class="dropdown-item" href="../views/assemble_purchase_category.php">AP Category</a></li>
         <li><a class="dropdown-item" href="../views/assemble_purchase_sub_category.php">AP Sub-Category</a></li>
         <li><a class="dropdown-item" href="../views/assembled_product.php">Assembled Products</a></li>
         </ul>
</li>

     <li><a class="dropdown-item" href="#">Supplier &raquo</a>
        <ul class="submenu dropdown-menu">
		<li><a class="dropdown-item" href="vendor.php">Supplier Details</a></li>
        <!-- <li><a class="dropdown-item" href="vendor_credential.php">Supplier Credentials</a></li> -->
        </ul>
      </li>

    </ul>
</li>

<li class="nav-item"><a class="nav-link tender nav_color" href="receipts.php">Invoice</a></li>
<!-- <li class="nav-item"><a class="nav-link tender nav_color" href="invoice.php">Invoice</a></li> -->




<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle nav_color" href="#" data-toggle="dropdown">Master Data</a>
    <ul class="dropdown-menu">
	  <li><a class="dropdown-item" href="#">UoM Master &raquo   </a>
		 <ul class="submenu dropdown-menu">
		    <li><a class="dropdown-item " href="../views/uom_category.php">UoM Category</a></li>
		    <li><a class="dropdown-item" href="../views/uom.php">UoM </a></li>
            <li><a class="dropdown-item" href="../views/uom_conversion.php">UoM conversion</a></li>
            </ul>
</li>

<li><a class="dropdown-item" href="#">Hsn Master &raquo   </a>
		 <ul class="submenu dropdown-menu">
		    <li><a class="dropdown-item" href="../views/hsn.php">Hsn Table</a></li>
		    <li><a class="dropdown-item" href="../views/hsn_rate.php">HsN Rate </a></li>
            </ul>
</li>


<li><a class="dropdown-item" href="#">Item Master &raquo   </a>
		 <ul class="submenu dropdown-menu">
         <li><a class="dropdown-item" href="../views/category.php">DP Category</a></li>
         <li><a class="dropdown-item" href="../views/subcategory.php">DP Sub-Category</a></li>
         <li><a class="dropdown-item" href="../views/item.php">Direct Purchased Items</a></li>
<hr></hr>
         <li><a class="dropdown-item" href="../views/assemble_purchase_category.php">AP Category</a></li>
         <li><a class="dropdown-item" href="../views/assemble_purchase_sub_category.php">AP Sub-Category</a></li>
         <li><a class="dropdown-item" href="../views/assembled_product.php">Assembled Products</a></li>
         </ul>
</li>

     <li><a class="dropdown-item" href="#">Supplier &raquo</a>
        <ul class="submenu dropdown-menu">
		<li><a class="dropdown-item" href="vendor.php">Supplier Details</a></li>
        <!-- <li><a class="dropdown-item" href="vendor_credential.php">Supplier Credentials</a></li> -->
        </ul>
      </li>

    </ul>
</li>







        </ul>
    </div>
    <div class="nav-item">
    <a class="nav-link nav_color" href="../views/logout.php" onclick="return confirm('Are you sure ?')">Log-Out</a>
        <!-- <a class="nav-link" href="../views/logout.php"><img src="../img/log_out.jpg" width="25px" ></a> -->


    </div>


</nav>
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
<br>
<br>
<br>
<br>
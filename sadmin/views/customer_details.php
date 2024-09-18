<?php
ob_start();
include '../includes/connection.php';
include '../includes/functions.php';                         
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include '../includes/header.php'; ?>
    <title></title>
    <style>
    /* #box{
            border: 1px solid gray;
            margin: 100px 100px 100px 100px;
            padding: 70px 70px 70px 70px;
        }

        #p_format{
            font-size: 20px;
        }

        .footer{
            display: disabled;
        }

        h4{
            color:#606060;
        }


  */
    </style>
</head>

<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container-fluid">
        <h3 style="font-family: Sans-serif;"><b>Customer Details</b></h3>
        <p style="font-family: Sans-serif;color: #808080;">Import and Showing all existing customer details</p>


    </div>
    <hr>
    </hr>
    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    <center>
                        <h4 style="font-family: Sans-serif;color: #808080;color:cadetblue;font-style:italic"><b>Import
                                and Showing all existing customer details</b></h4>
                    </center>

                </a>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion">
                <div class="card-body">


                    <center>
                        <h4> <b>Please Upload A CSV file with the Following Specifications</b></h4>
                        <h6>1. The file containg the text data should be in <b>.CSV Format</b>.</h6>
                        <h6>2. The data in the columns shall be in this Order : <b><a data-toggle="collapse"
                                    data-target="#demo1">View Data Template</a></b></h6>
                        <div id="demo1" class="well collapse">
                            <b><i>
                                    1. company name<br>
                                    2. vendor<br>
                                    3. phone<br>
                                    4. email<br>
                                    5. address<br>
                                    6. gst<br>
                                </i></b>

                            <a href="temp.csv" download>
                                <h6 style="color: red;"><i>Click To Download An Example Of The CSV File.</i></h6>
                            </a>
                        </div>
                        <br><br>

                        <form class="form-horizontal" action="../controllers/import.php" method="post"
                            name="upload_excel" enctype="multipart/form-data">
                            <fieldset>

                                <!-- File Button -->
                                <div class="form-group row">
                                    <label class="col-md-3 control-label" for="filebutton"></label>
                                    <label class="col-md-2 control-label" for="filebutton">Select File</label>
                                    <div class="col-md-3">
                                        <input type="file" name="file" id="file" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" id="submit" name="Import"
                                            class="btn btn-secondary button-loading"
                                            data-loading-text="Loading...">Import</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </center>

                </div>
            </div>
        </div>
    </div>



    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Customer Creation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Existing Customer</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active container" id="home">

            <br><br>
            <!--  -->
            <form class="form-horizontal" action="../controllers/customer_cont.php" method="post"
                enctype="multipart/form-data" class="myForm">
                <!-- <center> -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:600px">

                            <input type="radio" id="html" name="customer_type" value="2">&nbsp &nbsp
                            <label for="css">Business</label>&nbsp &nbsp
                            <input type="radio" id="css" name="customer_type" value="1">&nbsp &nbsp
                            <label for="css">Indivisual</label><br>

                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" placeholder=" " id="name" name="name" onkeyup="fetch_name(this.value)">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Attention</span>
                            <input type="text" class="form-control" placeholder=" " id="attention" name="attention">
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Display Name</span>
                            <input type="text" class="form-control" placeholder=" " id="display_name"
                                name="display_name">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="input-group mb-3" style="width:500px">

                        <span class="input-group-text">Phone No</span>
                            <input type="text" class="form-control" placeholder=" " id="phone" name="phone">

                          
                        </div>

                    </div>
                </div>



                <div class="row">

                    <div class="col-md-6">

                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Email</span>
                            <input type="email" class="form-control" placeholder=" " id="email" name="email">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">City</span>
                            <input type="text" class="form-control" placeholder=" " id="city" name="city">
                        </div>

                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                    <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">State</span>
                        <select class="form-control" name="state_id" id="state_id">
                            <option value="">select state</option>
                            <?php
                $sql="SELECT * FROM `state`";
                $query=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($query)){
                  echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
                ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                        <span class="input-group-text">Zip Code</span>
                            <input type="text" class="form-control" placeholder="zip code" id="zip_code"
                                name="zip_code">
                      
                        </div>

                    </div>
                </div>





                <div class="row">

                    <div class="col-md-6">

                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">GST</span>
                            <input type="text" class="form-control" placeholder="Enter gst (if)" id="gst" name="gst">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                        

                                <span class="input-group-text">Address</span>
                            <textarea type="text" class="form-control" placeholder=" " id="address"
                                name="address"></textarea>



                        </div>
                    </div>

                </div>

                <div class="input-group mb-3 d-grid" style="width:1070px">
                    <button type="submit" class="btn btn-outline-primary btn-block btn-float">Submit</button>
                </div>
                <!-- </center> -->


            </form>
        </div>
        <div class="tab-pane" id="menu1">


            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                          <th>GST</th>
                        <!--<th>Receivables</th>-->
                        <!--<th>Unused Credits</th>-->
                        <!--<th>Edit</th>-->
                        <!--<th>Action</th>-->
                    </tr>
                </thead>
                <tbody>

                    <?php
    $c=0;
     $sql="SELECT * FROM `customer_details` WHERE `status`='1'";
     $query=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_array($query)){
       $c++;
       $id=$row["id"];
       $name=$row["display_name"];
       $mobile=$row["mobile"];
       $email=$row["email"];
       $address=$row["address"];
       $gst=$row["gst"];
    
    ?>
                    <tr>
                        <td><?php echo $c; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $mobile; ?></td>
                        <td><?php echo $gst; ?></td>
                        <!--<td><?php echo $mobile; ?></td>-->
                        <!--<td><button type="button" class="btn btn-primary btn-block"> Edit</button></td>-->
                        <!--<td><button type="button" class="btn btn-danger btn-block"> Del</button></td>-->
                    </tr>


                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>

    <!-- <div class="container-fluid"><br><br>
    <!-- <br> -->
    <!-- <h3  style="font-family: Sans-serif;"><b>CUSTOMER DETAILS</b></h3>
         <p  style="font-family: Sans-serif;color: #808080;">Import and Showing all existing customer details</p>
         <hr style="color:gray;height:3px" ></hr>
         <br><br><br> -->

</body>
<script>
  // $('.myForm').on('submit',function(e){
  //   e.preventDefault();
  //   alert("hello");
//   swal("Are you sure you want to do this?", {
//   buttons: ["Oh noez!", "Aww yiss!"],
//   if(Oh noez!){
//     alert("hello");
//   } else {
//     alert("hello");
//   }
// });
// });

//   $.ajax({
//     type: 'POST',
//     url: "../controllers/customer_cont.php",
//     data: $('.myForm').serialize() ,
//     success: function (data) { // here I'm adding data as a parameter which stores the response
//         console.log(data); // instead of alert I'm changing this to console.log which logs all the response in console.
//     }
// });

function fetch_name(name){
    $("#display_name").val(name);
}
</script>

</html>
<?php 
session_start();

if(!isset($_SESSION['LOGGEDIN'])){
    header("location:login.php?unauth=unauthorized access?");
}
?>
<!DOCTYPE html>
<html>
<head>

 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.js"></script>
 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<body>
      <div class="container"><br>
        <div>
          <button  class="float-right" ><span>Username :</span><?php echo $_SESSION['LOGGEDIN']['name']; ?></button>
          <h2 align="center" class="">Stock Management System</h2>
        </div>
        <!-- <div id="order-error"></div> -->
          <nav class="navbar navbar-inverse">
            </nav>
             <div class="row">
              <div class="col-md-10 mx-auto">
              <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                <div class="card-header">
                  <h4>New order</h4>
                </div>
                 <div class="card-body">
                  <form id="order-form-data" onsubmit="return false" action="#" method="POST">
                    <div class="form-group row ml-5">
                      <label align="right">Date :</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control form-control-sm" name="order_date" id="order_date" value='<?= date("d-m-Y"); ?>' readonly>
                      </div>
                       <label align="right">Cutsomer Name :</label>
                      <div class="col-sm-6">
                        <input type="text" name="customer_name" class="form-control form-control-sm" id="customer_name">
                        <small id="c_error"></small>
                      </div>
                    </div>
                    <div class="form-group row ml-5">
                      <label class="" align="center">Address:</label>
                      <div class="col-sm-9">
                        <input type="text" name="address" class="form-control form-control-sm" id="address">
                        <small id="a_error"></small>
                      </div>
                    </div>
                    <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                      <div class="card-header"><h4>Make order list</h4></div>
                      <div class="card-body">
                        <table align="center" width="800px;">
                          <thead class="bg-secondary table-bordered text-white text-center">
                            <tr>
                              <th>#</th>
                              <th>Item Name</th>
                              <th>Total Quantity</th>
                              <th>Quantity</th>
                              <th>Price (Rs.)</th>
                              <th colspan="2" width="12%">Total (Rs.)</th>
                            </tr>
                          </thead>
                          <tbody id="invoice_item">
                            <!-- <tr>
                              <td class="form-control form-control-sm"><b class="number">1</b></td>
                              <td>
                                  <select name="p_id[]" class="form-control form-control-sm" required>
                                    <option>Washing Machine</option> 
                                  </select>
                              </td>
                              <td><input type="text" name="total_qty[]" class="form-control form-control-sm" readonly></td>
                              <td><input type="text" name="qty[]" class="form-control form-control-sm" required></td>
                              <td><input type="text" name="price[]" class="form-control form-control-sm" readonly></td>
                              <td class="form-control form-control-sm">Rs. 1540</td>
                            </tr> -->
                          </tbody>
                        </table>
                        <div class="float-right pt-2">
                          <button id="add" class="btn btn-success btn-sm">+ Add</button>
                          <button id="remove" class="btn btn-danger btn-sm">- Remove</button>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <label for="subtotal" class="col-sm-3 col-form-label" align="right">Sub Total :</label>
                      <div class="col-sm-6">
                        <input type="text" name="subtotal" id="subtotal" class="form-control form-control-sm" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="gst" class="col-sm-3 col-form-label" align="right">GST(18%) :</label>
                      <div class="col-sm-6">
                        <input type="text" name="gst" id="gst" class="form-control form-control-sm" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="discount" class="col-sm-3 col-form-label" align="right">Discount :</label>
                      <div class="col-sm-6">
                        <input type="text" name="discount" id="discount" class="form-control form-control-sm">
                        <small id="d_error"></small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total :</label>
                      <div class="col-sm-6">
                        <input type="text" name="net_total" id="net_total" class="form-control form-control-sm" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="paid" class="col-sm-3 col-form-label" align="right">Paid :</label>
                      <div class="col-sm-6">
                        <input type="text" name="paid" id="paid" class="form-control form-control-sm">
                        <small id="paid_error"></small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="due" class="col-sm-3 col-form-label" align="right">Due :</label>
                      <div class="col-sm-6">
                        <input type="text" name="due" id="due" class="form-control form-control-sm" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="payment_method" class="col-sm-3 col-form-label" align="right">Payment Method :</label>
                      <div class="col-sm-6">
                        <select  name="payment_method" id="payment_method" class="form-control form-control-sm">
                          <option>Cash</option>
                          <option>Credit Card</option>
                          <option>Draft</option>
                          <option>Cheque</option>
                        </select>
                      </div>
                    </div>
                      <center>
                      <input type="submit" id="order_form" class="btn btn-info btn-sm" value="Save Order and Invoice">
                      <input type="submit" id="print-invoice" class="btn btn-success d-none" value="Print Invoice"></center>
                      <a href="index.php" class="btn btn-danger btn-sm pull-left">Cancel</a>

                      <a href="index.php" class="btn btn-secondary btn-sm float-right">Go To Dashboard</a>

                  </form>
                 </div>
                    <div class="modal-footer order-footer w-100">
                            
                    </div>
                </div>
                </div>
              </div>
<!-- Custom Script -->
<script src="js/order.js"></script>
<?php include("common/footer.php"); ?>
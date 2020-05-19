<?php session_start();

if(!isset($_SESSION['LOGGEDIN'])){
    header("location:login.php?unauth=unauthorized access?");
}
?>
<?php include('common/top.php'); ?>
<body>
<?php include('common/navbar.php'); ?>
<div id="product-msg"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
            <div class="panel-heading">
            	<div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                    	<h3 class="panel-title">Product List</h3>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='right'>
                        <button type="button" name="add" id="add_button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#productModal">+Add Product</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div id="product-table" class="col-sm-12 table-responsive">
                        <!-- Table is comming from index.php -->
                    </div>
                 </div>
            </div>
        </div>
	</div>
<div id="productModal" class="modal fade">
    <div class="modal-dialog">
        <form method="POST" action="products/add.php" onsubmit="return false" id="product_form">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Select Category</label>
                            <select name="category_id" id="category_id"  class="form-control">
                            </select>
                            <small id="select_cat" class="pull-right"></small>
                        </div>
                        <div class="col-md-6">
                            <label>Select Brand</label>
                            <select name="brand_id" id="brand_id"   class="form-control">
                                <!-- <option value="">Select Brand</option> -->
                            </select>
                            <small id="select_brand" class="pull-right"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Enter Product Stock</label>
                            <input type="text" name="stock" id="stock" class="form-control"  pattern="[+-]?([0-9]*[.])?[0-9]+" /> 
                        </div>
                        <div class="col-md-6">
                            <label>Enter Product Price</label>
                        <input type="text" name="price" id="price" class="form-control" pattern="[+-]?([0-9]*[.])?[0-9]+" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter Product Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" ></textarea>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <input type="submit" name="product" id="product-btn" class="btn btn-info btn-sm" value="Add">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer add-modal">
                    
                </div>
            </div>
        </form>
    </div>
</div>

<!-- View Single Product  -->
<div id="Product-View-Modal" class="modal fade">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">View Product Details</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Product ID:</b><span id="pid" class="pull-right"></span></li>
                            <!-- <li class="list-group-item"><b>Main Category ID:</b><span id="mid" class="pull-right"></span></li>
                            <li class="list-group-item"><b>Category ID:</b><span id="cid" class="pull-right"></span></li> -->
                            <li class="list-group-item"><b>Brand Name:</b><span id="bn" class="pull-right"></span></li>
                            <li class="list-group-item"><b>Product Name:</b><span id="pn" class="pull-right"></span></li>
                            <li class="list-group-item"><b>Price:</b><span id="pr" class="pull-right"></span></li>
                            <li class="list-group-item"><b>Stock Available:</b><span id="qty" class="pull-right"></span></li>
                            <li class="list-group-item"><b>Status:</b><span id="st" class="pull-right"></span></li>
                            <li class="list-group-item"><b>Create at:</b><span id="dt" class="pull-right"></span></li>
                        </ul>
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div><br>
                    <!-- <div class="modal-footer">
                        
                    </div> -->
                 </div>
            </div>
        </div>

<!-- Update products -->
<div id="UpdateProductModal" class="modal fade">
    <div class="modal-dialog">
        <form method="POST" action="products/update.php" onsubmit="return false" id="update_form">
            <input type="hidden" name="upid" id="upid" value="">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Update Product</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Select Category</label>
                            <select name="update_category_id" id="update_category_id" class="form-control" required>
                                <!-- <option value="">Select Category</option> -->
                            </select>
                            <small><em>Click on to select</em></small>
                        </div>
                        <div class="col-md-6">
                            <label>Select Brand</label>
                            <select name="update_brand_id" id="update_brand_id" class="form-control" required>
                                <!-- <option value="">Select Brand</option> -->
                            </select>
                            <small><em>Click on to select</em></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter Product Name</label>
                        <input type="text" name="update_product_name" id="update_product_name" class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Enter Product Quantity</label>
                            <input type="text" name="update_stock" id="update_stock" class="form-control"pattern="[+-]?([0-9]*[.])?[0-9]+" /> 
                        </div>
                        <div class="col-md-6">
                            <label>Enter Product Price</label>
                        <input type="text" name="update_price" id="update_price" class="form-control" pattern="[+-]?([0-9]*[.])?[0-9]+" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter Product Description</label>
                        <textarea name="update_desc" id="update_desc" class="form-control" rows="3" ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Select Status</label>
                        <select name="update_status" id="update_status" class="form-control">
                            <!-- <option value="">Select Category</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <input type="submit" name="submit" id="product-btn" class="btn btn-info btn-sm" value="Add">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer update_modal">
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Update products -->
<div id="Stock-Modal" class="modal fade">
    <div class="modal-dialog">
        <form method="POST" action="products/addStock.php" onsubmit="return false" id="stock_form">
            <input type="hidden" name="sid" id="sid" value="">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">+Add Stock</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Product Name</label>
                            <input type="text" name="product-name-stock" id="product-name-stock" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Available Stock Qty</label>
                            <input type="text" name="inventory" id="inventory" class="form-control text-right" readonly> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Enter New Quantity</label>
                            <input type="text" name="stock" id="stock"  class="form-control text-right stock" pattern="[+-]?([0-9]*[.])?[0-9]+"> 
                        </div>
                        <div class="col-md-2">
                            <label>Total Qty</label>
                            <span class="form-control text-right" name="total-stock" id="total-stock"></span>
                            <!-- <input type="text" name="total-stock" id="total-stock"  readonly="">  -->
                        </div>
                        <div class="col-md-4">
                            <label>Sub Total Quantity</label>
                            <input type="text" class="form-control text-right sub-stock" name="sub-stock" id="sub-stock" readonly style="background: white;">
                            <!-- <input type="text" name="total-stock" id="total-stock"  readonly="">  -->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <input type="submit" name="submit" id="stock-btn" class="btn btn-info btn-sm" value="Add Stock">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer stock-modal">
                </div>
            </div>
        </form>
    </div>
</div>
<script src="js/product.js"></script>
<?php include("common/footer.php"); ?>

$(document).ready(function(){
		var domain = "http://localhost/imsapp/";
		fetch_category();
		function  fetch_category(){
			$.ajax({
				url:domain+"category/fetch.php",
				method:"POST",
				data:{fetch_category:1},
				// dataType:"json",
				success:function(data){			
					var select = '<option value="">Select Category</option>'
					$("#category_id").html(select+data);
					$("#update_category_id").html(data);

				}
			})
		}

// =============Fetch Brands
		fetch_brands();
		function  fetch_brands(){
			$.ajax({
				url:domain+"products/fetch.php",
				method:"POST",
				// dataType:"json",
				data:{fetch_brand:1},
				success:function(data){
					var select = '<option value="">Select Brand</option>'
					$("#brand_id").html(select+data);
					$("#update_brand_id").html(data);
				}
			})
		}
// Ftech all brands 
		fetch_all_products();
        function fetch_all_products(page){
        	$.ajax({
        		url:"products/index.php",
        		method:"POST",
        		data:{page:page},
        		success:function(data){
        			$("#product-table").html(data);
        			// console.log(data);
        		}
        	})
        }

        $(document).on("click",".page-no",function(){
        	var page = $(this).attr("id");
        	// alert(page);
        	fetch_all_products(page);
        })

        $(document).on("click",".prev",function(){
        	var prev_id= $(this).attr("prev-id");
        	fetch_all_products(prev_id);
        })
        $(document).on("click",".next",function(){
        	var next_id = $(this).attr("next-id");
        	fetch_all_products(next_id);

        })

// Fetch Single Product
		$(document).on("click",".view-btn", function(){
			var viewid = $(this).attr("view-id");
			// alert(viewid);
			$.ajax({
				url:"products/view.php",
				method:"POST",
				dataType:"JSON",
				data:{viewid:viewid},
				success:function(data){
					var pn = 
					$("#pid").html(data.pid);
					// $("#mid").html(data.main_cat);
					// $("#cid").html(data.cat_id);
					$("#pn").html('<span style="text-transform:capitalize;">'+data.product_name+'</span>');
					$("#bn").html('<span style="text-transform:capitalize;">'+data.brand_name+'</span>');
					$("#pr").html(data.price+'0.00');
					$("#qty").html(data.stock);
					if(data.p_status==1){
						$("#st").html('<span style="color:green;">Active</span>');
					}else{
						$("#st").html('<span style="color:red;">Inactive</span>');

					}
					
					$("#dt").html(data.created_at);

					
				}

			});
		})
		function selection_change(){
			$(document).on('click',function(){
				var category = $("#category_id").val();
				var brand = $("#brand_id").val();
				if(category==''){
			 		$("#select_cat").html('<span style="color:red;">You have not selected category name</span>');
			 		$("#category_id").css('border','2px solid red');
					
			   }else {
			   		$("#select_cat").html('<span style="color:green;">Selected <b> &#10004;</b></span>');
			 		$("#category_id").css('border','2px solid green');
			 		$(".modal-footer").html('');
			   }

			   if(brand==''){
			   		$("#select_brand").html('<span style="color:red;">You have not selected brand name</span>');
			 		$("#brand_id").css('border','2px solid red');
			 		
			   }else{	
			 		$("#select_brand").html('<span style="color:green;">Selected <b> &#10004;</b></span>');
			 		$("#brand_id").css('border','2px solid green');
			 		$(".modal-footer").html('');

			   }
			})
			
		}

		$("#product_form").on('submit',function(){
			   selection_change();
			   $form = $(this);
				if($("#category_id").val()==''){
			 		$("#category_id").css('border','2px solid red');
			 		$("#select_cat").html('<span style="color:red;">Please select category</span>');
			 		$(".modal-footer").html('<div class="alert alert-danger text-danger text-center">All the fields are required</div>');
				}else if($("#brand_id").val()==''){
			 		$("#brand_id").css('border','2px solid red');
			 		$("#select_brand").html('<span style="color:red;">Please select brand</span>');
			 		$(".modal-footer").html('<div class="alert alert-danger text-danger text-center">All the fields are required</div>');
				}else{

					$.ajax({
						url:$form.attr("action"),
						method:$form.attr("method"),
						dataType:"JSON",
						data:$form.serialize(),
						success:function(data){
							if(data.success){
							   $(".add-modal").html(data.message);
							   $("#product-msg").html(data.message);
							   $("#product_form")[0].reset();
							   $("#product_form").trigger('reset');
							   $("#productModal").modal('hide');
							   fetch_all_products();

							}else{
								$(".add-modal").html(data.message);
							}
							//console.log(data);
						}
					})
				}
		})
// Update products
		$(document).on("click",".edit-btn", function(){
			var pid = $(this).attr("edit-id");
			// alert(pid);
			$.ajax({
				url:"products/edit.php",
				method:"POST",
				dataType:"JSON",
				data:{pid:pid},
				success:function(data){

					$("#upid").val(data.pid);
					$("#update_category_id").val(data.cat_id);
					$('#update_category_id').css({'background': 'lightblue','color': 'black','font-weight': 'bolder'});
					$("#update_brand_id").val(data.brand_id);
					$('#update_brand_id').css({'background': 'lightblue','color': 'black','font-weight': 'bolder'});
					$("#update_product_name").val(data.product_name);
					$("#update_stock").val(data.stock);
					$("#update_price").val(data.price);
					$("#update_desc").val(data.description);
					if(data.p_status==1){
						$("#update_status").html('<option value="1">Active</option>'+'<option value="0">Inactive</option>');
					}else{
						$("#update_status").html('<option value="0">Inactive</option>'+'<option value="1">Active</option>');
					}

					// console.log(data.brand_id);
				}
				
			})
		})
		$("#update_form").on("submit",function(){
				$.ajax({
					url:"products/update.php",
					method:"POST",
					dataType:"JSON",
					data:$("#update_form").serialize(),
					success:function(data){
						if(data.success){
							$(".update_modal").html(data.message);
							$("#product-msg").html(data.message);
							$("#UpdateProductModal").trigger('reset');
							$("#UpdateProductModal").modal('hide');
							fetch_all_products();
						}else if(data.error){
							$(".modal-footer").html(data.message);

						}
						//console.log(data);
					}
					
				})
		})

	// Delete products
		$(document).on("click",".del-btn", function(){
			var pid = $(this).attr("del-id");
			if(confirm("Are you sure want to delete this ")){
			$.ajax({
				url:"products/delete.php",
				method:"POST",
				dataType:"JSON",
				data:{pid:pid},
				success:function(data){
					if(data.success){
						$("#product-msg").html(data.message);
						fetch_all_products();
					}else{
						$("#product-msg").html(data.message);

					}
				}
			})

		   }else{
		   	 alert(" No ");
		   }

		})

// Add stock 
		$(document).on("click",".stock-btn", function(){
			var sid = $(this).attr("stock-id");
			// alert(sid);
			$.ajax({
				url:"products/stock.php",
				method:"POST",
				dataType:"JSON",
				data:{sid:sid},
				success:function(data){
					$("#sid").val(sid);
					$("#product-name-stock").val(data.product_name);
					$("#inventory").val(data.stock);
					$(".stock").val(0);
					$("#total-stock").html(($("#inventory").val()-0) + ($(".stock").val()-0));
					// $(".sub-stock").val(($("#inventory").val()-0) + ($(".stock").val()-0));
				}

			});
		})

		$(".stock").click(function(){
			$(".stock").val('');
		})

		$(".stock").keyup(function(){
			var stock = $(this);
			if(isNaN(stock.val())){
				alert("Inavlid stock quantity ");
				stock.val(0);
			}else{
				$("#total-stock").html(($("#inventory").val()-0) + ($(".stock").val()-0));
				$(".sub-stock").val(($("#inventory").val()-0) + ($(".stock").val()-0));
			}
		});

		$("#stock_form").on("submit",function(){
				$.ajax({
					url:"products/addStock.php",
					method:"POST",
					dataType:"JSON",
					data:$("#stock_form").serialize(),
					success:function(data){
						if(data.success){
							$(".stock-modal").html(data.message);
							$("#product-msg").html(data.message);
							$("#stock_form")[0].reset();
							$("#stock_form").trigger('reset');
							$("#Stock-Modal").modal('hide');
							fetch_all_products();

						}else if(data.error){
							$(".stock-modal").html(data.message);

						}
						//console.log(data);
					}
					
				})
		})
		
	
})
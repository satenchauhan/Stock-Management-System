$(document).ready(function(){
	var domain = "http://localhost/imsapp/";
	add_new_row();
	$(document).on("click","#add", function(event){
		event.preventDefault();
		add_new_row();
	});

	function add_new_row(){
		$.ajax({
			url:"orders/fetch.php",
			method:"POST",
			// dataType:"JSON",
			data:{add_row:1},
			success:function(data){
				$("#invoice_item").append(data);
				// console.log(data);
				var n =1;
				$(".serial_no").each(function(){
					$(this).html(n++);
				})
			}
		})
	}

	$("#remove").click(function(event){
		event.preventDefault();
		$("#invoice_item").children('tr:last').remove();
		calculate(0,0);

	})

	$("#invoice_item").on("change",".pid", function(){
			var pid = $(this).val();
			var tr = $(this).parent().parent();
			$.ajax({
				url:"orders/fetch_single.php",
				method:"POST",
				dataType:"JSON",
				data:{pid:pid},
				success:function(data){
					if(data.stock==0){
						tr.find(".stock").css('border','2px solid red');
					    tr.find(".stock").val(data.stock);
					    alert("This product is out of stock");
					}else{
					    tr.find(".stock").val(data.stock);
					    tr.find(".stock").css('border','');
        				$(".modal-footer").html('');
					}
					tr.find(".order_qty").val(1);
					tr.find(".price").val(data.price);
					tr.find(".total_amount").html(tr.find(".order_qty").val() * tr.find(".price").val());
					tr.find(".product_name").val(data.product_name);
					calculate(0,0);
					// console.log(data);
				}

			})

	})

	$("#invoice_item").on("keyup",".order_qty", function(){
			var order_qty = $(this);
			var tr = $(this).parent().parent();
			if(isNaN(order_qty.val())){
				alert("This is not valid quantity");
				order_qty.val(1);
			}else{
				if((order_qty.val() -0) > (tr.find(".stock").val() -0)){
					alert("Sorry ! That much of quantity not available");
					order_qty.val(1);
				}else{
					tr.find(".total_amount").html(order_qty.val() * tr.find(".price").val());
					calculate(0,0)
				}
			}
	})


	function calculate(dis, paid){
		var subtotal  = 0;
		var gst       = 0;
		var net_total = 0;
		var discount  = dis;
		var paid_amt  = paid;
		var due       = 0;
		$(".total_amount").each(function(){
			subtotal = subtotal + ($(this).html() * 1);
			// alert(subtotal)
		});
		gst = Math.round(0.18 * subtotal);
	    net_total = gst + subtotal;
	    net_total = net_total - discount;
	    due = net_total - paid_amt;

		$("#subtotal").val(subtotal);
		$("#gst").val(gst);
		$("#discount").val(discount);
		$("#net_total").val(net_total)
		$("#paid").val(paid);
		$("#due").val(due);

	}

	$("#discount").click(function(){
		$("#discount").val('');
	});

	$("#discount").keyup(function(){
		// $("#discount").val(discount);
		var discount = $(this).val();
		if(isNaN(discount)){
			alert("Inavlid discount amount ");
			$("#discount").val(0);
		}else if(discount < 0){
			alert("Inavlid discount amount entered ? ");
			$("#discount").val(0);
			calculate(0,0);
		}else{
			//$("#net_total").val(net_total)
			calculate(discount,0);
		}

	})
	$("#paid").click(function(){
		$("#paid").val('');
	});

	$("#paid").keyup(function(){
		var paid = $(this).val();
		var net_total = $("#net_total").val();
		if(isNaN(paid)){
			alert("Inavlid paid amount entered");
			$("#paid").val(0);
		}else if(paid < 0){
			alert("Inavlid paid amount entered ?");
			$("#paid").val(0);
			calculate(0,0);
		}else if((paid-0) > (net_total-0)){
			alert("paid amount can not be more than net total amount ?");
			$("#paid").val(0);
			calculate(0,0);
		}else{
			var discount = $("#discount").val();
			calculate(discount,paid);
			// alert(discount);
		}
	})

	$("#order-form-data").on("submit", function(){
		var tr = $(this).parent().parent();
		if($("#customer_name").val()==''){
		   $("#customer_name").addClass("border-danger");

		}else if($("#address").val()==''){
		   $("#address").addClass("border-danger");
           $('#a_error').html("<span class='text-danger'>Please enter the address ? </span>");

		}else if($('#product').val()==''){
           $('#product').addClass("border-danger");
           alert("Please select product name ?");

        }else if($('#discount').val()==''){
           $('#discount').addClass("border-danger");
           $('#d_error').html("<span class='text-danger'>Please enter discount amount ? </span>");

        }else if($('#paid').val()==''){
           $('#paid').addClass("border-danger");
           $('#paid_error').html("<span class='text-danger'>Please enter paid amount ? </span>");

        }else{
        	//var name = $("#customer_name").val();
        	var $form = $("#order-form-data").serialize();
        	$.ajax({
        		url:"orders/add.php",
        		method:"POST",
        		dataType:"JSON",
        		data:$("#order-form-data").serialize(),
        		success:function(data){
        			if(data.success){
        				$(".modal-footer").html(data.message);
        				var id = data.invoice_no;
        				var name = data.name;
        				if(confirm("Do you want to print invoice ?")){
							$.ajax({
					    		url:"orders/invoice.php",
					    		method:"POST",
					    		data:$("#order-form-data").serialize() + "&id="+id,
					    		success:function(data){
									alert("The order invoice has been generated ! check your invoice folder");
									$("#order-msg").html('<div class="alert alert-success text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>The order invoice has been generated ! check your invoice folder</div>')
									window.location.href=domain+"Invoices/invoice_"+name+".pdf";   				  
									// console.log(data);
					    		}
				    		});

						}else{
							alert("No");
							window.location.href=domain+"order.php";
					    }
					$("#order-form-data").trigger("reset");
        			tr.find(".total_amount").html('0');				  

        			}else if(data.error){
        				$(".modal-footer").html(data.message);
        			}
        			//console.log(data.invoice_no);
        		}
        	})
        }

	})


// =======================================================
    fetch_all_the_orders();
    function  fetch_all_the_orders(page){
    	$.ajax({
    		url:"orders/index.php",
    		method:"POST",
    		// dataType:"JSON",
    		data:{page:page},
    		success:function(data){
    			$("#order-table").html(data)
    			// console.log(data);
    		}
    	})
    }

    $(document).on("click",".page_no", function(){
    	var page = $(this).attr("id");
    	// alert(page);
    	fetch_all_the_orders(page);
    })

    $(document).on("click",".prev", function(){
    	var prev = $(this).attr("prev-id");
    	fetch_all_the_orders(prev);

    })

    $(document).on("click",".next", function(){
    	var next = $(this).attr("next-id");
    	fetch_all_the_orders(next);

    })

    $(document).on("click",".view-btn", function(){
    	$("#Order-View-Modal").modal("show");
    	var view_id = $(this).attr("view-id");
    	// alert(view_id);
    	$.ajax({
    		url:"orders/view.php",
    		method:"POST",
    		dataType:"JSON",
    		data:{view_id:view_id},
    		success:function(data){
                if(data){
                	
                	var len = data.length;
                	var list = '';
                	if(len >0){
                		for(var x=0; x<len; x++){
                			$("#invcno").html(data[x].invoice_no);
                			$("#cn").html('<span style="text-transform:capitalize;">'+data[x].customer_name+'</span>');
    						$("#add").html('<span style="text-transform:capitalize;">'+data[x].address+'</span>');
    						$("#sbt").html(data[x].subtotal+'.00');
    						$("#gst").html(data[x].gst+'.00');
    						$("#dis").html(data[x].discount+'.00');
    						$("#ntt").html(data[x].net_total+'.00');
    						$("#pd").html(data[x].paid+'.00');
    						$("#due").html(data[x].due+'.00');
    						$("#pm").html(data[x].payment_method);
    						$("#od").html(data[x].order_date);
    						$(".total").html(data[x].net_total+'.00');
    						if(data[x].id){
                            	// list +='<li class="list-group-item"><b>Product '+(x+1)+':</b><span id="prod" class="pull-right">'+data[x].product_name+'</span></li>';
                            	list +='<tr><td>'+data[x].id+'</td><td>'+data[x].product_name+'</td><td class="text-center">'+data[x].order_qty+'</td><td class="text-right">'+data[x].price_per_item+'.00</td></tr>';
    							 
    						}
                		}
                		if(list!=''){
                			$(".mylist").append(list);
                		}
                	}
                }
    			
    		}
    	})
    })

    $(document).on("click",".pdf-btn", function(){
    		var pdf_id = $(this).attr("pdf-id");
    		var name = $(this).attr("name");
    		$.ajax({
    			url:"orders/generate_pdf.php",
    			method:"POST",
    			// dataType:"JSON",
    			data:{pdf_id:pdf_id},
    			success:function(data){
    				alert("The invoice jas been generated in pdf format");
    				window.location.href=domain+"Invoices/invoice_"+name+".pdf";
    				
    			}
    		})

    })

		
})


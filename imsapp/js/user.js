$(document).ready(function(){
     
    var domain = "http://localhost/imsapp/";
  	fetch_users_with_pagination();
	function fetch_users_with_pagination(page){
		$.ajax({
			url: "users/index.php",
			method: "POST",
			data:{page:page},
			success: function(data){
				if(data !=""){
					$("#table-data").html(data);
					// load_data_with_pagination(1);
				}else if(data=="No_Data_Found"){
					$("user-data").html('<tr><td class="text-center">No Data Found </td></tr>');
				}
				// console.log(data);
			}

		});
	}
//middle number of pagination	
	$(document).on('click','.pagination-link',function(){
		var page = $(this).attr("id");
		//alert(page);
		fetch_users_with_pagination(page);
	})
// For Previous buttion
	$(document).on('click','.prev-link',function(){
		var prev = $(this).attr("prev");
		fetch_users_with_pagination(prev);    
	})
// For Next buttion
	$(document).on('click','.next-link',function(){
	   var next = $(this).attr("next");
	   fetch_users_with_pagination(next);    
	})


  	$("#form").on('submit', function(event){
  		event.preventDefault();
  		$form = $(this);
	  		// console.log(this);
	  		//console.log($form);
	  	submitForm($form);

  	});

  	$("#edit-form").on("submit", function(event){
  		event.preventDefault();
  		$form = $(this);
  		submitForm($form);
  	})


	function submitForm($form){
		    $footer_loader = $('.modal-footer').html('<img src="./images/loader.gif" style="margin-right:250px;">');

			$.ajax({
				url: $form.attr('action'),
				method: $form.attr('method'),
				data: $form.serialize(),
				success: function(response){
					response = $.parseJSON(response);
					if(response.success){
						if(!response.logout){
							setTimeout(function(){
							  window.location = response.url;
						    }, 1000);
						}
						$footer_loader.html(response.message);
						$("#form")[0].reset();
						$("#userModal").modal('hide');
						$("#editModal").modal('hide');
						 fetch_users_with_pagination();
					}else if(response.error){

						$footer_loader.html(response.message);	
					}
					// console.log(response);
				}

	    });
	}

	// Delete User
	$(document).on('click','.del-btn', function(){
		var del_id = $(this).attr("del_id");
		// alert(del_id);
		if(confirm("Are you sure that you want to delete this user")){
			$.ajax({
				url:domain+"/users/delete.php",
				method:"POST",
				data:{id:del_id},
				success: function(response){
				    response= $.parseJSON(response);
				    if(response.success){
				   	  	$("#msg").html(response.message);
				   	  	fetch_users_with_pagination();
				    }else if(response.error){
				   	   $("#msg").html(response.message)
				    }
				  // console.log(response);
				}
			})
	   }else{
	   	    alert("No");
	   }

	})

	$(document).on("click",".edit-btn", function(){
			var edit_id = $(this).attr("edit_id");

			$.ajax({
				url: domain+"/users/edit.php",
				method: "POST",
				dataType: "json",
				data:{edit_id:edit_id},
				success:function(data){
 					$("#edit_id").val(data['id']);
 					$("#edit-name").val(data['name']);
 					$("#edit-email").val(data['email']);
 					$("#edit-country").val(data['country']);
				}

			});
			
	});

	$(document).on("click",".reset-btn", function(){
		var id = $(this).attr("reset-id");
		  $("#reset_id").val(id);
		
	})


})

  	
	







	

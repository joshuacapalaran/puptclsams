function alert_error(message){
	 Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: message,
		//   footer: '<a href>Why do I have this issue?</a>'
		});
}

function alert_success(message){
	 Swal.fire(
	  'Good job!',
	  message,
	  'success'
	);
}

function alert_login_success(message){
	 Swal.fire(
	  'Login Success!',
	  message,
	  'success'
	);
}

function confirmDelete(url, id)
{
	Swal.fire({
		  title: 'Are you sure?',
		  text: "Data will be archived",
		  icon: 'warning',
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: '#f0ad4e',
		  cancelButtonColor: '#3085d6',
		  confirmButtonText: 'Yes, Archive the data!',
		  closeOnConfirm: false,
          closeOnCancel: false
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
	             url: url + id,
	             type: 'DELETE',
	             error: function() {
	               Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Something went wrong!',
					  footer: '<a href>Why do I have this issue?</a>'
					});
	             },
	             success: function(data) {
	             	   Swal.fire(
						  'Archived!',
					      'Your file has been archived.',
					      'success'
						).then((resultAgain)=>{
							if (resultAgain.value)
							{
	                  			$("#"+id).remove();
	                  			location.reload(fast);
							}
						});
	             }
	          });
		  }
	})
}

function confirmUpdateStatus(url, id, status)
{
	Swal.fire({
		  title: 'Are you sure?',
		  text: (status == 'd') ? "Data will be update as deactive":"Data will be update as active",
		  icon: 'warning',
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: '#f0ad4e',
		  cancelButtonColor: '#3085d6',
		  confirmButtonText: (status == 'd') ? 'Yes, deactive the data!':'Yes, Active the data!',
		  closeOnConfirm: false,
          closeOnCancel: false
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
	             url: url + '/' + id,
	             type: 'GET',
	             error: function() {
					 Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Something went wrong!',
					  footer: '<a href>Why do I have this issue?</a>'
					});
	             },
	             success: function(data) {
	             	   Swal.fire(
						(status == 'd') ? 'Archived!':'Unarchived!',
					      (status == 'd') ? 'Your file has been archived.':'Your file has been unarchived.',
					      'success'
						).then((resultAgain)=>{
							if (resultAgain.value)
							{
	                  			$("#"+id).remove();
	                  			location.reload();
							}
						});
	             }
	          });
		  }
	})
}

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!-- DataTables CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" />
	<!-- Toast CSS -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

	<title>User Form</title>
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-5">
				<h1 class="text-center">Πίνακας χρηστών διαχειριστικού</h1>
				<hr styles="background-color: black; color:black; height: 1px; " />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 mt-2">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
					Καταχώρηση νέου χρήστη
				</button>

				<!-- Add Modal -->
				<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Καταχώρηση νέου χρήστη διαχειριστικού</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- Add Form -->
								<form action="" method="post" id="add_form">
									<div class="form-group col-md-5">
										<div class="form-check col-md-6">
											<input class="form-check-input" type="checkbox" value="1" id="is_active">
											<label class="form-check-label" for="is_active">
												Ενεργός
											</label>
										</div>
									</div>
									<div class="form-group col-md-10">
										<label for="name">Ονοματεπώνυμο:</label>
										<input type="text" class="form-control" id="name">
									</div>
									<div class="form-group col-md-10">
										<label for="usename">Όνομα χρήστη:</label>
										<input type="text" class="form-control" id="username">
									</div>
									<div class="form-group col-md-10">
										<label for="password">Κωδικός:</label>
										<input type="password" class="form-control" id="password">
									</div>
									<div class="form-group col-md-10">
										<label for="reset_password">Επανάληψη κωδικού:</label>
										<input type="password" class="form-control" id="reset_password">
									</div>
									<div class="form-group col-md-10">
										<label for="email">Email:</label>
										<input type="email" class="form-control" id="email">
									</div>
									<div class="form-group col-md-10">
										<p>Δικαιώματα:</p>
									</div>
									<div class="form-group col-md-10" id="div_roles_add">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Κλείσιμο</button>
								<button type="button" class="btn btn-primary" id="add_btn">Καταχώρηση</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 my-3">
				<table class="table disaply nowrap" id="records">
					<thead>
						<tr>
							<th>Id</th>
							<th>Όνομα</th>
							<th>Όνομα Χρήστη</th>
							<th>Δικαιώματα</th>
							<th>Ενεργός</th>
							<th>Διαγραφή</th>
							<th>Επεξεργασία</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>



	<!-- Edit Modal -->
	<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Επεξεργασία χρήστη</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- Edit Form -->
					<form action="" method="post" id="edit_form">
						<input type="hidden" id="edit_record_id" value="">
						<div class="form-group col-md-5">
							<div class="form-check col-md-6">
								<input class="form-check-input" type="checkbox" value="1" id="edit_is_active">
								<label class="form-check-label" for="edit_is_active">
									Ενεργός
								</label>
							</div>
						</div>
						<div class="form-group col-xl-10">
							<label for="name">Ονοματεπώνυμο:</label>
							<input type="text" class="form-control" id="edit_name">
						</div>
						<div class="form-group col-xl-10">
							<label for="usename">Όνομα χρήστη:</label>
							<input type="text" class="form-control" id="edit_username">
						</div>
						<div class="form-group col-xl-10">
							<label for="password">Κωδικός:</label>
							<input type="password" class="form-control" id="edit_password">
						</div>
						<div class="form-group col-xl-10">
							<label for="reset_password">Επανάληψη κωδικού:</label>
							<input type="password" class="form-control" id="edit_reset_password">
						</div>
						<div class="form-group col-xl-10">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="edit_email">
						</div>
						<div class="form-group col-xl-10">
							<p>Δικαιώματα:</p>
						</div>
						<div class="form-group col-xl-10" id="div_roles_edit">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Κλείσιμο</button>
					<button type="button" class="btn btn-primary" id="edit_btn">Επεξεργασία</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<!-- DataTables Script -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
	<!-- Toast Script-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<!-- Sweet Alert2 Script -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



	<script>
		// Add Record
		$(document).on('click', "#add_btn", function(e) {
			e.preventDefault();
			var name = $('#name').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var reset_password = $('#reset_password').val();
			var email = $('#email').val();
			var is_active = $('#is_active:checked').val();

			var i = 0;
			var user_has_role = [];
			$('.ckeck_roles:checked').each(function(i) {
				user_has_role[i] = $(this).val();
			});

			if (name == '' || username == '' || password == '' || reset_password == '' || email == '') {
				toastr["error"]('Please fill all the fields');
			} else {
				$.ajax({
					url: "<?php echo base_url(); ?>insert",
					type: 'post',
					dataType: 'json',
					data: {
						name: name,
						username: username,
						password: password,
						reset_password: reset_password,
						email: email,
						is_active: is_active,
						user_has_role: user_has_role
					},
					success: function(data) {
						if (data.response == "success") {
							$('#records').DataTable().destroy();
							fetch();
							$('#addModal').modal('hide');
							toastr["success"](data.message);
							$('#add_form')[0].reset();
						} else if (data.response == "error") {
							toastr["error"](data.message);
						}
					}
				});
			}
		});

		//Fetch Records
		function fetch() {

			$.ajax({
				url: '<?php echo base_url(); ?>fetch',
				type: 'post',
				dataType: 'json',
				success: function(data) {
					if (data.response == "success") {
						var i = '1';
						$('#records').DataTable({
							"data": data.result,
							responsive: true,
							rowReorder: {
								selector: 'td:nth-child(2)'
							},
							"columns": [{
									"data": function() {
										return a = i++;
									}
								},
								{
									"data": "name"
								},
								{
									"data": "username"
								},
								{

									"render": function(data, type, row, meta) {
										return user_ids = row.roles_name;
									}

								},
								{
									"data": 'is_active',
									"defaultContent": "0"
								},
								{
									"render": function(data, type, row, meta) {
										return a = `
									<a href="#" value="${row.user_id}" id="del" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt mr-1"></i>Delete</a>
					        `;

									}
								},
								{
									"render": function(data, type, row, meta) {
										return a = `
					                <a href="#" value="${row.user_id}" id="edit" class="btn btn-sm btn-outline-success"><i class="far fa-edit mr-1"></i>Edit</a>
					        `;

									}
								}
							]
						}, );

						var div_role = '';
						for (var i = 0; i < data.roles.length; i++) {
							div_role += `<div class="form-check col-xl-12">
								<input class="form-check-input ckeck_roles" type="checkbox" value="${data.roles[i].roles_id}" id="defaultCheck_${i}" name="roles[]" />
									<label class="form-check-label col-xl-12" for="defaultCheck_${i}">${data.roles[i].roles_name}</label>
							</div>`;
						}

						$("#div_roles_add").html(div_role);
					} else {
						toastr["error"](data.message);
					}
				}
			})
		}

		fetch();

		//Delete Record
		$(document).on('click', '#del', function(e) {
			e.preventDefault();

			var del_id = $(this).attr('value');

			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-success',
					cancelButton: 'btn btn-danger mr-2'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {

					$.ajax({
						url: '<?php echo base_url(); ?>delete',
						type: 'post',
						dataType: 'json',
						data: {
							del_id: del_id
						},
						success: function(data) {
							if (data.response == 'success') {
								$('#records').DataTable().destroy();
								fetch();

								swalWithBootstrapButtons.fire(
									'Deleted!',
									'Your record has been deleted.',
									'success'
								)
							} else {
								swalWithBootstrapButtons.fire(
									'Cancelled',
									'Your imaginary record is safe :)',
									'error'
								)
							}
						}
					});


				} else if (
					result.dismiss === Swal.DismissReason.cancel
				) {
					swalWithBootstrapButtons.fire(
						'Cancelled',
						'Your imaginary record is safe :)',
						'error'
					)
				}
			});
		});

		//Edit Record
		$(document).on('click', '#edit', function(e) {
			e.preventDefault();

			var edit_id = $(this).attr('value');

			$.ajax({
				url: '<?php echo base_url(); ?>edit',
				type: 'post',
				dataType: 'json',
				data: {
					edit_id: edit_id
				},
				success: function(data) {
					if (data.response == "success") {
						$('#editModal').modal('show');
						$("#edit_record_id").val(data.edit_user.user_id);
						$('#edit_name').val(data.edit_user.name);
						$('#edit_username').val(data.edit_user.username);
						$('#edit_password').val(data.edit_user.password);
						$('#edit_reset_password').val(data.edit_user.password);
						$('#edit_email').val(data.edit_user.email);
						if (data.edit_user.is_active == 1) {
							$('#edit_is_active').prop('checked', true);
						} else {
							$('#edit_is_active').prop('checked', false);
						}

						var div_edit_role = '';

						for (var i = 0; i < data.roles.length; i++) {
							div_edit_role += `<div class="form-check col-xl-12">`;
							//for (var j = 0; j < data.edit_roles_details.length; j++) {
							if (data.edit_roles_details.includes(data.roles[i].roles_id)) {
								div_edit_role += `
									<input class="form-check-input ckeck_edit_roles" type="checkbox" value="${data.roles[i].roles_id}" id="defaultCheck_${i}" name="roles[]" checked />
									`;
							} else {
								div_edit_role += `
									<input class="form-check-input ckeck_edit_roles" type="checkbox" value="${data.roles[i].roles_id}" id="defaultCheck_${i}" name="roles[]"  />
									`;
							}
							//}
							div_edit_role += `<label class="form-check-label col-xl-12" for="defaultCheck_${i}">${data.roles[i].roles_name}</label>`;
							div_edit_role += `</div>`;
						}

						$("#div_roles_edit").html(div_edit_role);
					} else {
						toastr["error"](data.message);
					}
				}
			});
		});

		//Update Record
		$(document).on('click', '#edit_btn', function(e) {
			e.preventDefault();

			var edit_record_id = $("#edit_record_id").val();
			var edit_name = $('#edit_name').val();
			var edit_username = $('#edit_username').val();
			var edit_password = $('#edit_password').val();
			var edit_reset_password = $('#edit_reset_password').val();
			var edit_email = $('#edit_email').val();

			if ($('#edit_is_active').is(':checked') == true) {
				var edit_is_active = $('#edit_is_active').val();
			}

			var i = 0;
			var user_has_edit_role = [];
			$('.ckeck_edit_roles:checked').each(function(i) {
				user_has_edit_role[i] = $(this).val();
			});


			if (edit_name == '' || edit_username == '' || edit_password == '' || edit_reset_password == '' || edit_email == '') {
				toastr["error"](data.message);
			} else {
				$.ajax({
					url: "<?php echo base_url(); ?>update",
					type: "post",
					dataType: "json",
					data: {
						edit_record_id: edit_record_id,
						edit_name: edit_name,
						edit_username: edit_username,
						edit_password: edit_password,
						edit_reset_password: edit_reset_password,
						edit_email: edit_email,
						edit_is_active: edit_is_active,
						user_has_edit_role: user_has_edit_role
					},
					success: function(data) {
						if (data.response == "success") {
							$('#records').DataTable().destroy();
							fetch();
							$('#editModal').modal('hide');
							toastr["success"](data.message);
						} else {
							toastr["error"](data.message);
						}
					}
				});
			}
		});
	</script>

</body>

</html>
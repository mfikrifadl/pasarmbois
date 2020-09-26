var codepage = $(".container-fluid").attr('data-codepage');
var pagetitle = $(".container-fluid").attr('data-pagetitle');
$(document).on("click",".read_notification",'click',function(){
	var url = $(this).attr('data-url');
	var id = $(this).attr('data-id');
	$.ajax({
		type:'POST',
		url: url,
		data:{id_notification:id},
		success: function(data){
			console.log(data);
		},
		error: function(data){
			console.log(data,'errr');
		}
	})
})

if (codepage == "addproduct" || codepage == "editProduct") {

	$('form#add_product').submit(function (e) {
		var dir = $(this).attr('data-dir');
		product.processQueue();
	    $.ajax({
	    type: 'POST',
	    url: dir,
	    data: $('#add_product').serialize(),
	    success:function(data) {
	      swal({title: "Tambah Produk Berhasil!", text: "Data telah tersimpan", type: "success"},
	        function(){
				location.reload();
	        });
			}
	    })
	    e.preventDefault();
	  });
	//end add product

	// bootstrap switch
	$(".bt-switch input[type='checkbox']").bootstrapSwitch();
	// End bootstrap switch

	// dropzone
	var url_upload = $('#myDropzone').attr('data-url');
	$('#myDropzone').empty();
	Dropzone.autoDiscover = false;
	var product = new Dropzone(".dropzone", {
		url: url_upload,
		maxFilesize: 20,
		method: "post",
		acceptedFiles: "image/*",
		paramName: "userfile",
		parallelUploads:100,
		dictInvalidFileType: "Type file ini tidak dizinkan",
		addRemoveLinks: true,
		autoProcessQueue:false
	});

	//Event ketika Memulai mengupload
	product.on("sending", function (a, b, c) {
		c.append("token", $('#token').val());
		c.append("tokenB", $('#tokenB').val());
	});
	// end dropzone
	//upload summernote
	// var url_summer = $('#productdescription').attr('data-url');
	// function sendFile(file, el) {
	// 	var form_data = new FormData();
	// 	form_data.append('file', file);

	// 	$.ajax({
	// 			data: form_data,
	// 			type: "POST",
	// 			url: url_summer,
	// 			cache: false,
	// 			contentType: false,
	// 			processData: false,
	// 			success: function(url) {
	// 				$(el).summernote('editor.insertImage', url);
	// 			}
	// 	});
	// }

	// $('.inline-editor').summernote({
	// 		airMode: true
	// });


}
else if (codepage == "dashboard_product") {
	// List Product
	var produk = $('#listProduct').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 3,
			targets: -3
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		produk.responsive.recalc();
	});
	// end List Produk
	// post product
	$('.post-product').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk mem-posting produk ini?",
			text: "Produk yang telah di-posting akan ditampilkan didaftar produk!",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Posting Berhasil!",
							text: "Produk Berhasil Di-posting.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end post product

	// ban product
	$('#listProduct').on("click",'.ban-product',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk mem-ban produk ini?",
			text: "Produk yang telah di-ban tidak akan ditampilkan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Ban Produk Berhasil!",
							text: "Produk Berhasil Di-ban.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end ban product

	// unban product
	$('#listProduct').on("click",'.unban-product',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk meng-unban produk ini?",
			text: "Produk yang telah di-unban akan ditampilkan kembali!",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Unban Berhasil!",
							text: "Produk Berhasil Di-unban.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end unban product

	// delete product
	$('#listProduct').on("click",'.del-product',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus produk ini?",
			text: "Anda tidak akan dapat memulihkan produk ini!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Berhasil!",
							text: "Data Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end delete product

} else if (codepage == "useradmin") {
	// ban member
	$('a.ban-admin').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk mem-ban member ini?",
			text: "Member yang telah di-ban tidak dapat mengakses!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Ban Member Berhasil!",
							text: "Member Berhasil Di-ban.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end ban member

	// unban member
	$('a.unban-admin').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk meng-unban member ini?",
			text: "Member yang telah di-unban dapat mengakses kembali!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Unban Member Berhasil!",
							text: "Member Berhasil Di-unban.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end unban member
	$('#checkEmail').change(function(e){
		var dirUrl =  $(".checkEmail").attr('data-url');
		console.log('data',dirUrl);
		var email= $('#checkEmail').val();
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			$('#alamat_email-valid').hide();
			$('#alamat_email-invalid').hide()
			$('#format-invalid').show();
			$(':input[type="submit"]').prop('disabled', true);
		} else {
			$.ajax({
				url: dirUrl,
				method: "POST",
				data: { email: email },
				dataType: "html",
				success:function(result) {
					var result = jQuery.parseJSON( result );
	
					console.log('result',result);
					if (result == 0) {
						$('#alamat_email-valid').show();
						$('#alamat_email-invalid').hide();
						$('#format-invalid').hide();
						$(':input[type="submit"]').prop('disabled', false);
					} else {
						$('#alamat_email-valid').hide();
						$('#alamat_email-invalid').show();
						$('#format-invalid').hide();
						$(':input[type="submit"]').prop('disabled', true);
					}
				},error:function(result) {
					console.log('error',result);
				}
			});
		}
	});
	$('#checkUsername').change(function(e){
		var dir_url =  $(".checkUsername").attr('data-url');
		var username= $('#checkUsername').val();
		$.ajax({
			url: dir_url,
			method: "POST",
			data: { username: username },
			dataType: "html",
			success:function(username) {
				console.log('result',username);
				var username = jQuery.parseJSON( username );
				if (username == 0) {
					$('#username-valid').show();
					$('#username-invalid').hide();
					$(':input[type="submit"]').prop('disabled', false);
				} else {
					$('#username-valid').hide();
					$('#username-invalid').show();
					$(':input[type="submit"]').prop('disabled', true);
				}
			},error:function(username) {
				console.log('error',username);
			}
		});
	});
} else if (codepage == "dashboard_member") {
	// listmember
	var member = $('#listMember').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 3,
			targets: -3
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		member.responsive.recalc();
	});
	// end member

	// ban member
	$('#listMember').on("click",'.ban-member',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk mem-ban member ini?",
			text: "Member yang telah di-ban tidak dapat mengakses!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Ban Member Berhasil!",
							text: "Member Berhasil Di-ban.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end ban member
} else if (codepage == "banned_member") {
	// listmember
	var member = $('#listMember').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 3,
			targets: -3
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		member.responsive.recalc();
	});
	// end member
	// unban member
	$('#listMember').on("click",'.unban-member',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk meng-unban member ini?",
			text: "Member yang telah di-unban dapat mengakses kembali!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Unban Member Berhasil!",
							text: "Member Berhasil Di-unban.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end unban member

} else if (codepage == "dashboard_transaction") {
	var page = $('#listTransaction').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		]
	});
	// approve transaction
	$('#listTransaction').on("click",'.approve-trans',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk meng-approve transaksi ini?",
			text: "Transaksi yang telah di-approve tidak dapat dihapus!",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Approve Transaksi Berhasil!",
							text: "Transaksi Berhasil Di-approve.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end approve transaction

	// delete transaction
	$('#listTransaction').on("click",'.del-trans',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus transaksi ini?",
			text: "Transaksi yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Transaksi Berhasil!",
							text: "Transaksi Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end approve transaction


	$('#listTransaction').on("click",'.upd-receipt',function () {
		console.log("receipt");
		var invoice = $(this).attr('data-invoice'); //console.log(invoice);
		var receipt = $(this).attr('data-receipt'); //console.log(receipt);
		var type = $(this).attr('data-type'); //console.log(type);

		$('input#invoice').val(invoice);
		$('input#type_invoice').val(type);
		$('input#receipt').val(receipt);
	});

} else if (codepage == "dashboard_page") {
	// list page
	var page = $('#listPage').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		page.responsive.recalc();
	});

	var listPageValue = $('#listPageValue').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		listPageValue.responsive.recalc();
	});
	// end page
	// delete transaction
	$('.del_page').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus halaman ini?",
			text: "Transaksi yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Halaman Berhasil!",
							text: "Halaman Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end approve transaction
} else if (codepage == "addpage") {
	$(document).ready(function () {
		// Basic
		$('.dropify').dropify();
		// Translated
		// Used events
		var drEvent = $('#input-file-events').dropify();
		drEvent.on('dropify.beforeClear', function (event, element) {
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});
		drEvent.on('dropify.afterClear', function (event, element) {
			alert('File deleted');
		});
		drEvent.on('dropify.errors', function (event, element) {
			console.log('Has Errors');
		});
		var drDestroy = $('#input-file-to-destroy').dropify();
		drDestroy = drDestroy.data('dropify')
	});
	// summernote addpage
	$('#pagecontent').summernote({
		placeholder: 'Silahkan isi berita',
		tabsize: 2,
		height: 250
	});
	$('.pagecontent').summernote({
		placeholder: 'Silahkan isi berita',
		tabsize: 2,
		height: 250
	});
	// end summernote addpage

	// bootstrap switch
	$(".bt-switch input[type='checkbox']").bootstrapSwitch();
	// End bootstrap switch

} else if (codepage == "dashboard_ticket") {
	// listticket
	var ticket = $('#listTicket').DataTable({
		responsive: true,
		columnDefs: [{
				responsivePriority: 1,
				targets: 0
			},
			{
				responsivePriority: 3,
				targets: -3
			}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		ticket.responsive.recalc();
	});
	// end ticket
	// delete delete Categori ticket
	$('#listTicket').on("click",'.del_type',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus halaman ini?",
			text: "Transaksi yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Halaman Berhasil!",
							text: "Halaman Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end approve Categori ticket
	// update pending
	$('.pending').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk pending ticket ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Pending Ticket  Berhasil!",
							text: "Ticket  Berhasil Dipending.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	$('.open').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk pending ticket ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Pending Ticket  Berhasil!",
							text: "Ticket  Berhasil Dipending.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	$('.close').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk mentup ticket ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Ticket  Berhasil Ditutup!",
							text: "Ticket  Berhasil Ditutup!",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	$('#listTicket').on("click",'.del_ticket',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus tiket ini?",
			text: "Tiket yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Tiket Berhasil!",
							text: "Tiket Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end update pending
} else if (codepage == "list_category") {
	$(document).ready(function () {
		// Basic
		$('.dropify').dropify();
		// Translated
		// Used events
		var drEvent = $('#input-file-events').dropify();
		drEvent.on('dropify.beforeClear', function (event, element) {
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});
		drEvent.on('dropify.afterClear', function (event, element) {
			alert('File deleted');
		});
		drEvent.on('dropify.errors', function (event, element) {
			console.log('Has Errors');
		});
		var drDestroy = $('#input-file-to-destroy').dropify();
		drDestroy = drDestroy.data('dropify')
	});
	// del_category
	$('.del_category').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus kategori ini?",
			text: "kategori yang telah di-hapus tidak akan ditampilkan kembali!",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Berhasil!",
							text: "Kategori Berhasil Di-hapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end del category
	$('.e_category').click(function () {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var base_url = $(this).attr('data-domain');
		$.ajax({
			type: "POST",
			data:{id:id},
			url: url,
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('input[name=title_category]').val(data.title_category);
				$('input[name=id_category]').val(data.id_category);
				$("#img-prev").attr("src",base_url+data.img_path);
			},
			error: function (data) {
				console.log(data);
			}
		})
	});

	$('form#form_edit_category').submit(function(e) {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		$.ajax({
			type: 'POST',
			url: url,
			data: $('#form_edit_category').serialize(),
			// dataType: 'json'
		}).success(function(data) {

			swal({title: "Edit Success!", text: "Data has been Edited", type: "success"},
				function(){ 
					location.reload();
				});
		});
		e.preventDefault();
	});
} else if (codepage == "setting") {
	$(document).ready(function () {
		// Basic
		$('.dropify').dropify();
		// Translated
		// Used events
		var drEvent = $('#input-file-events').dropify();
		drEvent.on('dropify.beforeClear', function (event, element) {
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});
		drEvent.on('dropify.afterClear', function (event, element) {
			alert('File deleted');
		});
		drEvent.on('dropify.errors', function (event, element) {
			console.log('Has Errors');
		});
		var drDestroy = $('#input-file-to-destroy').dropify();
		drDestroy = drDestroy.data('dropify')
	});
	$(document).ready(function() {
		$('[data-role="tags-input"]').tagsInput();
	});
} else if (codepage== "set-address" ){
	$(".select2").select2();
	$('.select-district').change(function(){
		var subdistrict=$(".select-district option:selected").text();
		$('input[name=subdistrict]').val(subdistrict);
	});

	$('.select-city').change(function(){
		var city=$(".select-city option:selected").text();
		$('input[name=city]').val(city);
		var id_city = $(".select-city").val();
		var url = $(this).attr('data-url');
        $.ajax({
            method: "POST",
            url: url,
            data: {
                id_city: id_city
            },
            success: function(data) {
                $('.select-district').html(data);
            }
        });
	});
	$('.select-province').change(function(){
		var province=$(".select-province option:selected").text();
		$('input[name=province').val(province);
		var id_province = $(".select-province").val();
		var url = $(".container-fluid").attr('data-url');
        $.ajax({
            method: "POST",
            url: url,
            data: {
                id_province: id_province
            },
            success: function(data) {
                $('.select-city').html(data);
            }
        });
	});
} else if(codepage == "slider"){
	var slider = $('#listSlider').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		slider.responsive.recalc();
	})
	$('#listSlider').on("click",'.del_slider',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus slider ini?",
			text: "slider yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus slider Berhasil!",
							text: "Slider Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	$(document).ready(function () {
		// Basic
		$('.dropify').dropify();
		// Translated
		// Used events
		var drEvent = $('#input-file-events').dropify();
		drEvent.on('dropify.beforeClear', function (event, element) {
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});
		drEvent.on('dropify.afterClear', function (event, element) {
			alert('File deleted');
		});
		drEvent.on('dropify.errors', function (event, element) {
			console.log('Has Errors');
		});
		var drDestroy = $('#input-file-to-destroy').dropify();
		drDestroy = drDestroy.data('dropify')
	});
	$('.detail-slider').click(function () {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var base_url = $(this).attr('data-domain');
		$.ajax({
			type: "POST",
			data:{id:id},
			url: url,
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('input[name=title]').val(data.title);
				$('input[name=link]').val(data.link);
				$('input[name=id_slider]').val(data.id_slider);
				$("#img-prev").attr("src",base_url+data.img_path);
			},
			error: function (data) {
				console.log(data);
			}
		})
	});
} else if (codepage == "add_qrcode") {
	$(".select2").select2();
	$('.select-district').change(function(){
		var district_name=$(".select-district option:selected").text();
		$('input[name=district_name]').val(district_name);
	});

	$('.select-city').change(function(){
		var city_name=$(".select-city option:selected").text();
		$('input[name=city_name]').val(city_name);
		var id_city = $(".select-city").val();
		var url = $(this).attr('data-url');
        $.ajax({
            method: "POST",
            url: url,
            data: {
                id_city: id_city
            },
            success: function(data) {
                $('.select-district').html(data);
            }
        });
	});

	$('.select-province').change(function(){
		var province_name=$(".select-province option:selected").text();
		$('input[name=province_name]').val(province_name);
		var id_province = $(".select-province").val();
		var url = $(".container-fluid").attr('data-url');
        $.ajax({
            method: "POST",
            url: url,
            data: {
                id_province: id_province
            },
            success: function(data) {
                $('.select-city').html(data);
                $('.select-district').html('<option value="">Pilih Kecamatan</option>');
            }
        });
	});

	// add qr code
	$('form#add_qrcode').submit(function (e) {
		var dir = $(this).attr('data-dir');

	    $.ajax({
		    type: 'POST',
		    url: dir,
		    data: $('#add_qrcode').serialize(),
		    success: function(data){
		    console.log(data,'success');
		      swal({title: "Tambah Qr Code Berhasil!", text: "Data telah tersimpan", type: "success"},
		        function(){
					location.reload();
		        });
			}
	    });
	    e.preventDefault();
  	});
	//end add qrcode

} else if (codepage == "dashboard_qrcode") { 
		// list page
		var qrcode = $('#listQrcode').DataTable({
			responsive: true,
			columnDefs: [{
				responsivePriority: 1,
				targets: 0
			},
			{
				responsivePriority: 2,
				targets: -2
			}
			]
		});
		$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
			qrcode.responsive.recalc();
		});
		// end page
	// ban qrcode
	$('#listQrcode').on("click",'.ban-qrcode',function () {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');

		swal({
			title: "Apakah Anda yakin untuk menon-aktifkan Qr Code ini?",
			text: "Qr Code yang telah dinon-aktifkan tidak akan aktif!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					data:{id:id},
					url: url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Proses non-aktif Qr Code Berhasil!",
							text: "Qr Code Berhasil dinon-aktifkan.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end ban qrcode

	// unban qrcode
	$('#listQrcode').on("click",'.unban-qrcode',function () {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		swal({
			title: "Apakah Anda yakin untuk mengaktifkan Qr Code ini?",
			text: "Qr Code yang telah aktif akan ditampilkan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					data:{id:id},
					url: url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Proses aktif Qr Code Berhasil!",
							text: "Qr Code Berhasil Diaktifkan.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end unban qrcode

	// delete qrcode
	$('#listQrcode').on("click",'.delete-qrcode',function () {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');

		swal({
			title: "Apakah Anda yakin untuk menghapus Qr Code ini?",
			text: "Qr Code yang telah dihapus tidak akan kembali!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					data:{id:id},
					url: url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Proses Hapus Qr Code Berhasil!",
							text: "Qr Code Berhasil dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end delete qrcode

	// detail qrcode
	$('#listQrcode').on("click",'.detail-qrcode',function () {
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var base_url = $(this).attr('data-domain');
		$.ajax({
			type: "POST",
			data:{id:id},
			url: url,
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('input[name=title_product]').val(data.title_product);
				$('input[name=title_qrcode]').val(data.title);
				$('input[name=province]').val(data.province);
				$('input[name=city]').val(data.city);
				$('input[name=district]').val(data.subdistrict);
				$('input[name=complete_address]').val(data.complete_address);
				$(".img_qrcode").attr("src",base_url+data.qrcode_path);
				$(".download_link").attr("href",base_url+data.qrcode_path);
			},
			error: function (data) {
				console.log(data);
			}
		})
	});
	// end detail qrcode
} else if (codepage == "detail_profile") { 
	// ban member
	$('.ban-profile').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk mem-ban member ini?",
			text: "Member yang telah di-ban tidak dapat mengakses!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Ban Member Berhasil!",
							text: "Member Berhasil Di-ban.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end ban member
	// unban member
	$('.unban-profile').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk meng-unban member ini?",
			text: "Member yang telah di-unban dapat mengakses kembali!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Unban Member Berhasil!",
							text: "Member Berhasil Di-unban.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end unban member
} else if (codepage == "order") {
	$('#transaction-failed').click(function(){
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var type = $(this).attr('data-type');

		swal({
			title: "Apakah Anda yakin untuk memgagalkan transaksi ini ?",
			text: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					data:{id:id,type:type},
					url: url,
					dataType: 'json',
					success: function (data) {
						console.log(data);
						swal({
							title: "Transaksi Berhasil Digagalkan!",
							text: "",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});

	$("#print").click(function() {
		var mode = 'iframe'; //popup
		var close = mode == "popup";
		var options = {
				mode: mode,
				popClose: close
		};
		$("div.printableArea").printArea(options);
});
}else if(codepage == "dashboard_earning"){ 
	var dash = $('#listEarningMonth').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		],
		order: [[ 1, 'asc' ]]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		dash.responsive.recalc();
	});
	var page = $('#listAlleraning').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		]
	});
}else if(codepage == "dashboard_index"){
	var dash = $('#listProductDash').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		],
		order: [[ 1, 'asc' ]]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		dash.responsive.recalc();
	});
	var page = $('#listTransaction').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		]
	});
	// approve transaction
	$('#listTransaction').on("click",'.approve-trans',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk meng-approve transaksi ini?",
			text: "Transaksi yang telah di-approve tidak dapat dihapus!",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Approve Transaksi Berhasil!",
							text: "Transaksi Berhasil Di-approve.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end approve transaction

	// delete transaction
	$('#listTransaction').on("click",'.del-trans',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus transaksi ini?",
			text: "Transaksi yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Transaksi Berhasil!",
							text: "Transaksi Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	// end approve transaction
}else if(codepage == "dashboard_contact"){
	$('#listContact').on("click",'.del_contact',function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus transaksi ini?",
			text: "Transaksi yang telah dihapus tidak dapat dikembalikan!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Transaksi Berhasil!",
							text: "Transaksi Berhasil Dihapus.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
	var contact = $('#listContact').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		],
		order: [[ 2, 'desc' ]]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		contact.responsive.recalc();
	});
}else if(codepage == "dashboard_affiliate"){ 
	var dash = $('#listSelling').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		],
		order: [[ 1, 'asc' ]]
	});
	$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
		dash.responsive.recalc();
	});
	var page = $('#listPayout').DataTable({
		responsive: true,
		columnDefs: [{
			responsivePriority: 1,
			targets: 0
		},
		{
			responsivePriority: 2,
			targets: -2
		}
		]
	});

//dashboard affiliate button profile
	$('.affiliate-profile').click(function () {
		var name = $(this).attr('data-name');
		var bank = $(this).attr('data-bank');

		swal({
			title: "Detil User Affiliate",
			text: "A.N. "+name+" / No. Rek: "+bank,
			type: "info"
		});
	});

	//bayar komisi
	$('.affiliate-payout').click(function () {
		var name = $(this).attr('data-name');
		var bank = $(this).attr('data-bank');
		var _url = $(this).attr('data-url');

		swal({
			title: "Pembayaran Komisi",
			text: "Apakah pembayaran komisi untuk "+name+" telah ditransfer ke "+bank+"?",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: "POST",
					//data:{id:id},
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Pembayaran Komisi Berhasil!",
							text: "Komisi Berhasil Ditransfer.",
							type: "success"
						},
							function () {
								location.reload();
							}
						);
					},
					error: function (data) {
						// console.log(data);
						swal("Error", "Server Error", "error");
					}
				})
			} else {
				swal("Cancelled", "", "error");
			}
		});
	});
}

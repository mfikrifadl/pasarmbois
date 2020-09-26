var codepage = $(".codepage").attr('data-codepage');
console.log(codepage);
$(document).on("click",".read_notification",'click',function(e){
	var url = $(this).attr('data-url');
	var id = $(this).attr('data-id');
	var href_url=$(this).attr('data-href');
	console.log(href_url);
	$.ajax({
		type:'POST',
		url: url,
		data:{id_notification:id},
		success: function(data){
			console.log(data);
			window.location.href = href_url;
		},
		error: function(data){
			console.log(data,'errr');
		}
	})
});
//add to cart
$('.add-cart').click(function(){
	var id = $(this).attr('data-id'); 
	var _url = $(this).attr('data-url');
	var qty = ($('input[name=qty]').val())? $('input[name=qty]').val() : 1;
	var type = $(this).attr('data-cart');
	
	if (type=="add") {
		console.log('add');
		add_cart(id,qty,_url,0);
	}
	else if (type=="remove") {
		console.log("remove");
		remove_cart_icon(id,_url);
	}
});
// end add cart

if(codepage == "search"){
		// pagination-filter
		var url_search	= $('#url_fil').attr('data-search');
		var url_filter	= $('#url_fil').attr('data-url'); 
		var data_filter	= $('#url_fil').attr('data-filter') == '' ? null : JSON.parse($('#url_fil').attr('data-filter'));
	
		console.log("filter", data_filter);
		if(data_filter != null){
			$('select[name=SortBy]').val(data_filter.SortBy);
			$('#star-rating').attr('data-score', data_filter.score);
			// console.log("filter", data_filter);
		} 	

		// Price Range Slider
		if ($('#price-range-fil').length) {
			var a, b;
			if(data_filter != null){ 
				a = data_filter.min;
				b = data_filter.max;
			}
			else{
				a = 0; b = 10000000; 
			}
			var priceRange = document.getElementById('price-range-fil');
			noUiSlider.create(priceRange, {
				start: [a, b],
				step: 1000,
				connect: true,
				tooltips: [true, true],
				range: {
					'min': 0,
					'max': 10000000
				}
			});
		}
	
		priceRange.noUiSlider.on('update', function(values, handle) {
			var updates = priceRange.noUiSlider.get();
			$('input[name=min]').val(parseInt(updates[0]));
			$('input[name=max]').val(parseInt(updates[1]));
		});

		$('a.page-link[href]').each(function(){ 
			var url = $(this).attr('href') + url_search + url_filter;
			$(this).attr('href', url);
			// console.log($(this).html(), $(this).attr('href'));
		});
		// end pagination-filter

		$('#reset').click(function () {
			window.location.href= $(this).attr("data-url")+"?search=a&isHeader=1";
		});

		//wishlist
	$('.wishlist').on('click', function() { console.log("wishlist");
		var _url = $(this).attr('data-url');
		var id_wishlist=$(this).attr('data-id');
		var id_product=$(this).attr('data-product');
		var type_wishlist=$(this).attr('data-wishlist');
		var _this = $(this);
		console.log('tes');
		$.ajax({
			method: "POST",
			url: _url,
			data: {
				id_wishlist	: id_wishlist,
				id_product	: id_product,
				type				: type_wishlist
			},
			success: function(data) {
				console.log(data); 
				if (type_wishlist=="add") {
					var json=jQuery.parseJSON(data);
					console.log(json,'json');
					_this.addClass("active");
					_this.attr('data-id',json.id_wishlist);
					_this.attr('data-wishlist','remove');
				} else if (type_wishlist=="remove") {
					_this.removeClass("active");
					_this.removeAttr('data-id');
					_this.attr('data-wishlist','add');
				}
			}
		});
	});
	//end wishlist

		
}else if(codepage == "category"){
	// pagination-filter
	var url_filter	= $('#url_fil').attr('data-url'); //console.log(url_filter); 
	var data_filter	= $('#url_fil').attr('data-filter') == '' ? null : JSON.parse($('#url_fil').attr('data-filter'));

	console.log("filter", data_filter);
	if(data_filter != null){
		$('select[name=SortBy]').val(data_filter.SortBy);
		$('#star-rating').attr('data-score', data_filter.score);
		console.log("filter", data_filter);
	} 	
	
	// Price Range Slider
	if ($('#price-range-fil').length) {
		var a, b;
		if(data_filter != null){ 
			a = data_filter.min;
			b = data_filter.max;
		}
		else{
			a = 0; b = 10000000; 
		}
    var priceRange = document.getElementById('price-range-fil');
    noUiSlider.create(priceRange, {
      start: [a, b],
      step: 1000,
      connect: true,
      tooltips: [true, true],
      range: {
        'min': 0,
        'max': 10000000
      }
    });
	}

  priceRange.noUiSlider.on('update', function(values, handle) {
    var updates = priceRange.noUiSlider.get();
    $('input[name=min]').val(parseInt(updates[0]));
    $('input[name=max]').val(parseInt(updates[1]));
  });

	$('a.page-link[href]').each(function(){ 
		var url = $(this).attr('href') + url_filter;
		$(this).attr('href', url);
		// console.log($(this).html(), $(this).attr('href'));
	});
	// end pagination-filter

	// clear 
	$('#reset').click(function () {
		window.location.href= $(this).attr("data-url")+"?search=a&isHeader=1";
	});

	//wishlist
	$('.wishlist').on('click', function() {
		var _url = $(this).attr('data-url');
		var id_wishlist=$(this).attr('data-id');
		var id_product=$(this).attr('data-product');
		var type_wishlist=$(this).attr('data-wishlist');
		var _this = $(this);
		console.log('tes');
		$.ajax({
			method: "POST",
			url: _url,
			data: {
				id_wishlist: id_wishlist,
				id_product:id_product,
				type:type_wishlist
			},
			success: function(data) {
				console.log(data);
				if (type_wishlist=="add") {
					var json=jQuery.parseJSON(data);
					console.log(json,'json');
					_this.addClass("active");
					_this.attr('data-id',json.id_wishlist);
					_this.attr('data-wishlist','remove');
				} else if (type_wishlist=="remove") {
					_this.removeClass("active");
					_this.removeAttr('data-id');
					_this.attr('data-wishlist','add');
				}
			}
		});
	})
	//end wishlist

	//add cart
	//add to cart
	$('.add-cart').click(function(){
		//var affiliate = $(this).attr('data-affiliate'); //console.log(affiliate);
		var id = $(this).attr('data-id');
		var _url = $(this).attr('data-url');
		var qty = ($('input[name=qty]').val())? $('input[name=qty]').val() : 1;
		add_cart(id,qty,_url,0);
	});
	//end cart
	// end add cart

	$('#reset').click(function () {
		window.location.href= $(this).attr("data-url");
	});

}else if (codepage == "detail_produk") {
	//copy link
	$(document).ready(function(){
		new Clipboard('#copy-button');
	});
	
	// Show large image on hover
	$('.img-detail-list a').mouseenter(function () {
		var src = $(this).find('img').data('large-src');
		var dataIndex = $(this).find('img').data('index');
		$('#img-detail').attr('src', src);;
		$('#img-detail').data('index', dataIndex);;
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
	});
	$('.img-detail-list a').click(function (event) {
		event.preventDefault();
	});

	// Photoswipe
	var parseThumbnailElements = function () {
		var items = [];
		$('.img-detail-list img').each(function () {
			item = {
				src: $(this).data('large-src'),
				w: 1000,
				h: 850
			};
			items.push(item);
		});
		return items;
	}
	var openPhotoSwipe = function (activeIndex) {
		activeIndex = typeof activeIndex !== 'undefined' ? activeIndex : 0;
		var pswpElement = document.querySelectorAll('.pswp')[0];
		var items = parseThumbnailElements();
		var options = {
			index: activeIndex
		};
		var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
		gallery.init();
	}
	$('#img-detail').click(function () {
		openPhotoSwipe($(this).data('index'));
	});

	// Spinner for quantity input
	$('#inputQty').each(function () {
		var input = $(this).find('input[type="number"]'),
			min = parseInt(input.attr('min')),
			max = parseInt(input.attr('max')),
			btnIncrease = $(this).find('.btn:first-child'),
			btnDecrease = $(this).find('.btn:last-child');
		btnIncrease.click(function () {
			if (input.val() < max) {
				input.val(parseInt(input.val()) + 1).trigger('change');
			}
		});
		btnDecrease.click(function () {
			if (input.val() > min) {
				input.val(parseInt(input.val()) - 1).trigger('change');
			}
		});
	});
	var rbtn = $(".rbtn").attr('data-rbtn');
	var fbtn = $(".fbtn").attr('data-fbtn');
	$(".reply").click(function () {
		var form_id=$(this).attr('data-form');
		console.log(form_id);
		$(".formreply[data-form="+form_id+"]").toggle();
	});

	$('#checkout-now').click(function(){
		var id = $(this).attr('data-id');
		var affiliate = $(this).attr('data-affiliate'); console.log(affiliate);
		var _url = $(this).attr('data-url');
		var href= $(this).attr('data-href');
		var qty = ($('input[name=qty]').val())? $('input[name=qty]').val() : 1;
		$.ajax({
			type: "POST",
			data:{
				id_product:id,
				qty:qty,
				affiliate:affiliate
			},
			url: _url,
			success: function (url) {
				window.location.href = href;
			},
			error: function (data) {
				console.log(data);
			}
		})
	});

	$('#add-cart').click(function(){
		var affiliate = $(this).attr('data-affiliate'); console.log(affiliate);
		var id = $(this).attr('data-id');
		var _url = $(this).attr('data-url');
		var qty = ($('input[name=qty]').val())? $('input[name=qty]').val() : 1;
		add_cart(id,qty,_url,affiliate);
	});

	//wishlist
	$('#wishlist').on('click', function() {
		console.log('tes wishlist');
		var _url = $(this).attr('data-url');
		var id_wishlist=$(this).attr('data-id');
		var id_product=$(this).attr('data-product');
		var type_wishlist=$(this).attr('data-wishlist');
		var affiliate=$(this).attr('data-affiliate');  
		var _this = $(this);
		$.ajax({
			method: "POST",
			url: _url,
			data: {
				id_wishlist: id_wishlist,
				id_product:id_product,
				type:type_wishlist,
				affiliate:affiliate
			},
			success: function(data) {
				console.log(data);
				$('#wishlist').hide();				
			},
			error: function(data) {
				console.log('data',data);				
			}
		});
	})
	$('.wishlist').on('click', function() { console.log("wishlist");
		var _url = $(this).attr('data-url');
		var id_wishlist=$(this).attr('data-id');
		var id_product=$(this).attr('data-product');
		var type_wishlist=$(this).attr('data-wishlist');
		var _this = $(this);
		console.log('tes');
		$.ajax({
			method: "POST",
			url: _url,
			data: {
				id_wishlist: id_wishlist,
				id_product:id_product,
				type:type_wishlist
			},
			success: function(data) {
				console.log(data);
				if (type_wishlist=="add") {
					var json=jQuery.parseJSON(data);
					console.log(json,'json');
					_this.addClass("active");
					_this.attr('data-id',json.id_wishlist);
					_this.attr('data-wishlist','remove');
				} else if (type_wishlist=="remove") {
					_this.removeClass("active");
					_this.removeAttr('data-id');
					_this.attr('data-wishlist','add');
				}
			}
		});
	});
	//end wishlist

	//generate link
	$('#btn-gen-link').on('click', function() {
		var _url = $(this).attr('data-url');
		var id_product = $(this).attr('data-id');
		var link = $(this).attr('data-link'); //console.log(link);

		$.ajax({
			method: "POST",
			url: _url,
			data: {id_product:id_product, link:link},
			success: function(data) {
				location.reload();
			}
		});
	});

}else if (codepage == "profile") {
	$(".submit").click(function(){
		var _url = $(this).attr('data-dir');
		var data = $('.add_cart').serialize();
		$.ajax({
			type: 'POST',
			url: _url,
			data: data,
			success: function() {
				// $('.tampildata').load("tampil.php");
			}
		});
	});
	$('.set-primary').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk Menjadikan alamat utama?",
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
							title: "Berhasil Menjadi Alamat Utama!",
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
				console.log(data);
				$('.select-district').html(data);
			}
		});
	});

	$('.select-province').change(function(){
		var province_name=$(".select-province option:selected").text();
		$('input[name=province_name]').val(province_name);
		var id_province = $(".select-province").val();
		var url = $(".codepage").attr('data-url');
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
	// delete address
	$('.del_address').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus alamat  ini?",
			text: "Alamat yang telah dihapus tidak dapat dikembalikan!",
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
	// end address
	// delete wishlist
	$('.wishlist').click(function () {
		var id = $(this).attr('data-id');
		var dir = $(this).attr('data-dir');
		var _url = dir + id;
		console.log("U", _url);

		swal({
			title: "Apakah Anda yakin untuk menghapus produk  ini pada wishlist?",
			text: "Alamat yang telah dihapus tidak dapat dikembalikan!",
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
							title: "Hapus wishlist Berhasil!",
							text: "wishlist Berhasil Dihapus.",
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
	// endwishlist

	// edit profile
	$('#editProfile').click(function(event){
		$('#profileUserName').attr('readonly', false);
		$('#profileEmail').attr('readonly', false);
		$('#profileFirstName').attr('readonly', false);
		$('#profileLastName').attr('readonly', false);
		$('#profileGenderR').attr('hidden', true);
		$('#profileGenderW').attr('hidden', false);
		$('#profilePhone').attr('readonly', false);
		$('#bankAccount').attr('readonly', false);
		$('#profileLine').attr('readonly', false);
		$('#profileWa').attr('readonly', false);
		$('#profileTelegram').attr('readonly', false);
		$('#updateProfile').attr('hidden', false);
		$(this).attr('hidden', true);
		event.preventDefault();
	});

	// save profile
	$('form#user-profile').submit(function(event){
		var url = $(this).attr('data-url');
		
		$.ajax({
			type: 'POST',
			url: url,
			data: $('#user-profile').serialize(),
			success:function(data) {
				swal({title: "Ubah Berhasil!", text: "Data telah tersimpan", type: "success"},
				function(){
					location.reload();
				});
			}
		})
		event.preventDefault();
	});

	// end edit profile
} else if(codepage=="home") {
	//wishlist
	$('.wishlist').on('click', function() {
		var _url = $(this).attr('data-url');
		var id_wishlist=$(this).attr('data-id');
		var id_product=$(this).attr('data-product');
		var type_wishlist=$(this).attr('data-wishlist');
		var _this = $(this);
		console.log('tes');
		$.ajax({
			method: "POST",
			url: _url,
			data: {
				id_wishlist: id_wishlist,
				id_product:id_product,
				type:type_wishlist
			},
			success: function(data) {
				console.log(data);
				if (type_wishlist=="add") {
					var json=jQuery.parseJSON(data);
					console.log(json,'json');
					_this.addClass("active");
					_this.attr('data-id',json.id_wishlist);
					_this.attr('data-wishlist','remove');
				} else if (type_wishlist=="remove") {
					_this.removeClass("active");
					_this.removeAttr('data-id');
					_this.attr('data-wishlist','add');
				}
			}
		});
	})
	//end wishlist
} else if(codepage=="cart") {
	//dynamic price qty
	$('input[name=qty]').change(function(){
		var qty=parseInt($(this).val());
		var price=$(this).attr('data-price');
		var id_cart=$(this).attr('data-id');
		var total_price=qty*price;
		var _url = $(this).attr('data-url');
		var max=parseInt($(this).attr('max'));
		
		console.log(typeof(max),'max');
		if (qty<=max) {
			$('#price_'+id_cart).html("Rp "+formatMoney(total_price,0));
			$('#price_'+id_cart).attr('data-subprice',total_price);
			var sum = 0;
			$('.product_price').each(function(){
				sum += parseFloat($(this).attr('data-subprice'));
				console.log(sum);  
			});


			$('#subtotal').html("Rp "+formatMoney(sum,0));
			update_cart(id_cart,qty,_url);
		}
		
	});
	//end dynamic price qty
} else if(codepage=="checkout"){
	$('.transfer').hide();
	$('.select-district').change(function(){
		var district_name=$(".select-district option:selected").text();
		$('input[name=district_name]').val(district_name);
	});

	$('.select-city').change(function(){
		var city_name=$(".select-city option:selected").text();
		$('input[name=city_name]').val(city_name);
		var id_city = $(".select-city").val();
		console.log(id_city);
		var url = $(this).attr('data-url');
		$.ajax({
			method: "POST",
			url: url,
			data: {
				id_city: id_city
			},
			success: function(data) {
				console.log(data);
				$('.select-district').html(data);
			}
		});
	});

	$('.select-province').change(function(){
		var province_name=$(".select-province option:selected").text();
		$('input[name=province_name]').val(province_name);
		var id_province = $(".select-province").val();
		var url = $(".codepage").attr('data-url');
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

	$('.payment_method').change(function(){
		var payment_method=$(".payment_method option:selected").val();
		console.log(payment_method);
		if (payment_method==0) {
			$('.transfer').hide(500);
			$('#shipping_price').html("Rp "+formatMoney(0,0));
			$('input[name=delivery_fee]').val(0);
			$('input[name=kurir]').prop('required',false);
			// $('.bank').prop('required',false);
		} else if(payment_method==1) {
			$('.transfer').show(500);
			$('.shipping-type').html("");
			// $('.bank').prop('required',true);
			$('input[name=kurir]').prop('required',true);
		}
		var total_price=parseInt($('input[name=total_price]').val())+parseInt($('input[name=price_unique]').val());
		$('#total_price').html("Rp "+formatMoney(total_price,0));
	});

	$('input[name=kurir]').change(function(){
		$('.shipping-type').html("");
		var courier = $('input[name=kurir]:checked').val();
		var weight = $('input[name=weight]').val();
		var destination = parseInt(($(".id_district").val()));
		console.log(destination);
		var url = $(".choseshipping").attr('data-url');
		if (destination) {
			$('.loader').show();
			$.ajax({
				method: "POST",
				url: url,
				data: {
					destination: destination,
					weight: weight,
					courier: courier,
				},
				success: function(data) {
					$('.loader').hide();
					$('.shipping-type').html(data);
					var _this = $('input[name=courier_service]:checked');
					var price = _this.attr('data-price');
					$('#shipping_price').html("Rp "+formatMoney(price,0));
					var total_price=parseInt($('#total_price').attr('data-totalprice'))+parseInt(price);
					$('#total_price').html("Rp "+formatMoney(total_price,0));
					$('input[name=delivery_fee]').val(price);
				}
			});
		} else {
			swal("Harap Lengkapi Provinsi dan Kota!");
		}
	});
	$('.alert_address').click(function(){
		swal("Harap Tambahkan Alamat Terlebih Dahulu!");
	});

	$(document).on("change",".courier_service", function () {
		var service_name=$('input[name=courier_service]:checked').val();
		var price=$(this).attr('data-price');
		$('#shipping_price').html("Rp "+formatMoney(price,0));
		var total_price=parseInt($('#total_price').attr('data-totalprice'))+parseInt(price);
		$('#total_price').html("Rp "+formatMoney(total_price,0));
		$('input[name=delivery_fee]').val(price);
	})

	$('form#formCheckout').submit(function (e) {
		var url = $(this).attr('data-url');
		$.ajax({
			type: 'POST',
			url: url,
			data: $('#formCheckout').serialize(),
			dataType:'json',
			success: function(data){
				console.log(data);
				if (data.status==false) {
					var status=data.data;
					if (status.length>0) {
						var product="Produk ";
						for (var i = 0; i < status.length; i++) {
							if (i==status.length-1) {
								product+= status[i].title_product+' ';
							} else {
								product+= status[i].title_product+', ';
							}
						}
						product+=" melebihi stok";
						swal("Harap Check jumlah produk anda pada keranjang", product);
					}
				} else {
					window.location.href = data.url;
				}
			},
			error: function(data){
				console.log(data,'err');
			}
		})
		e.preventDefault();
	});

	$('form#formAddress').submit(function (e) {
		var url = $(this).attr('data-url');
		$.ajax({
			type: 'POST',
			url: url,
			data: $('#formAddress').serialize(),
			dataType:'json',
			success: function(data){
				console.log(data);
				location.reload();
			},
			error: function(data){
				console.log(data,'err');
			}
		})
		e.preventDefault();
	});
} else if(codepage == "search"){
	// pagination-filter
	var url_filter	= $('#url_fil').attr('data-url'); //console.log(url_filter); 
	var data_filter	= $('#url_fil').attr('data-filter') == '' ? null : JSON.parse($('#url_fil').attr('data-filter'));

	console.log("filter", data_filter);
	if(data_filter != null){
		$('select[name=SortBy]').val(data_filter.SortBy);
		$('#star-rating').attr('data-score', data_filter.score);
		console.log("filter", data_filter);
	} 	
	
	// Price Range Slider
	if ($('#price-range-fil').length) {
		var a, b;
		if(data_filter != null){ 
			a = data_filter.min;
			b = data_filter.max;
		}
		else{
			a = 0; b = 10000000; 
		}
    var priceRange = document.getElementById('price-range-fil');
    noUiSlider.create(priceRange, {
      start: [a, b],
      step: 1000,
      connect: true,
      tooltips: [true, true],
      range: {
        'min': 0,
        'max': 10000000
      }
    });
	}
	
	// Rating Range Slider
  if ($('#star-rating-fil').length) {
    $('#star-rating-fil').raty({
      half: true,
      score: function() {
        return $(this).attr('data-score');
      }
    });
  }

  priceRange.noUiSlider.on('update', function(values, handle) {
    var updates = priceRange.noUiSlider.get();
    $('input[name=min]').val(parseInt(updates[0]));
    $('input[name=max]').val(parseInt(updates[1]));
  });

	$('a.page-link[href]').each(function(){ 
		var url = $(this).attr('href') + url_filter;
		$(this).attr('href', url);
		// console.log($(this).html(), $(this).attr('href'));
	});
	// end pagination-filter

	//wishlist
	$('.wishlist').on('click', function() {
		var _url = $(this).attr('data-url');
		var id_wishlist=$(this).attr('data-id');
		var id_product=$(this).attr('data-product');
		var type_wishlist=$(this).attr('data-wishlist');
		var _this = $(this);
		console.log('tes');
		$.ajax({
			method: "POST",
			url: _url,
			data: {
				id_wishlist: id_wishlist,
				id_product:id_product,
				type:type_wishlist
			},
			success: function(data) {
				console.log(data);
				if (type_wishlist=="add") {
					var json=jQuery.parseJSON(data);
					console.log(json,'json');
					_this.addClass("active");
					_this.attr('data-id',json.id_wishlist);
					_this.attr('data-wishlist','remove');
				} else if (type_wishlist=="remove") {
					_this.removeClass("active");
					_this.removeAttr('data-id');
					_this.attr('data-wishlist','add');
				}
			}
		});
	})
	//end wishlist
} else if(codepage == "replayTicket" || codepage == "addTicket"){
	$('.summernote').summernote({
		height: 250, // set editor height
		minHeight: null, // set minimum height of editor
		maxHeight: null, // set maximum height of editor
		focus: false // set focus to editable area after initializing summernote
	});
	// end summernote
} else if(codepage=="contact") {
	$('form#formContact').submit(function (e) {
		console.log('tes');
		var url = $(this).attr('data-url');
		$.ajax({
			type: 'POST',
			url: url,
			data: $('#formContact').serialize(),
			dataType:'json',
			success: function(data){
				console.log(data);
				swal("Pesan Berhasil Terkirim","","success"); 
			},
			error: function(data){
				console.log(data,'err');
			}
		})
		e.preventDefault();
	});
} else if(codepage=="affiliate-user"){
	//copy link
	$(document).ready(function(){
			new Clipboard('#copy-button');
	});

	//delete link
	$('.del-link').click(function () {
		var _url = $(this).attr('data-url');
		var id = $(this).attr('data-id');

		swal({
			title: "Hapus Tautan Affiliasi",
			text: "Apakah anda ingin menghapus tautan berikut?",
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
					url: _url,
					//dataType: 'json',
					success: function (data) {
						swal({
							title: "Hapus Tautan Berhasil!",
							text: "Tautan telah dihapus.",
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

	//tarik komisi
	$('#btn-comission').click(function () {
		var _url = $(this).attr('data-url');
		// var bank = $(this).attr('data-bank');

		swal({
			title: "Penarikan Komisi",
			text: "Apakah anda ingin menarik komisi affiliasi bulan ini?",
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
							title: "Penarikan Komisi Berhasil!",
							text: "Permintaan anda akan segera diproses oleh admin.",
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

	//peringatantarik komisi
	$('#warn-comission').click(function () {
		// var _url = $(this).attr('data-url');
		// var bank = $(this).attr('data-bank');
		swal({
			title: "Peringtan Penarikan Komisi!",
			text: "Maaf anda telah melakukan penarikan komisi pada bulan ini atau saldo anda belum mencukupi.",
			type: "error"
		});

	});
}

//activate affiliate
$('#activate-affiliate').click(function () {
	var _url = $(this).attr('data-url');
	var _goto = $(this).attr('data-goto');
	var _affiliate = $(this).attr('data-affiliate');

	if (_affiliate == 1) {
		window.location.href = _goto;
	} else {
		swal({
			title: "Aktifkan Mode Affiliasi",
			text: "Apakah anda ingin aktifkan mode affiliasi?",
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
							title: "Aktivasi Mode Affiliasi Berhasil!",
							text: "Mode Affiliasi Telah Aktif.",
							type: "success"
						},
							function () {
								window.location.href = _goto;
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

	}
	
});

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
		// $(':input[type="submit"]').prop('disabled', true);
		$('#regBtn').prop('disabled', true);
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
					// $(':input[type="submit"]').prop('disabled', false);
					$('#regBtn').prop('disabled', false);
				} else {
					$('#alamat_email-valid').hide();
					$('#alamat_email-invalid').show();
					$('#format-invalid').hide();
					// $(':input[type="submit"]').prop('disabled', true);
					$('#regBtn').prop('disabled', true);
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
				// $(':input[type="submit"]').prop('disabled', false);
				$('#regBtn').prop('disabled', false);
			} else {
				$('#username-valid').hide();
				$('#username-invalid').show();
				// $(':input[type="submit"]').prop('disabled', true);
				$('#regBtn').prop('disabled', true);
			}
		},error:function(username) {
			console.log('error',username);
		}
	});
});
$('#userEmail').change(function(e){
	var forgotUrl =  $(".userEmail").attr('data-url');
	var email= $('#userEmail').val();
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
		$('#alamat_email-valid').hide();
		$('#alamat_email-invalid').hide()
		$('#format-invalid').show();
		// $(':input[type="submit"]').prop('disabled', true);
		$('#forgBtn').prop('disabled', true);
	} else {
		$.ajax({
			url: forgotUrl,
			method: "POST",
			data: { email: email },
			dataType: "html",
			success:function(forgotpwd) {
				var forgotpwd = jQuery.parseJSON( forgotpwd );
				if (forgotpwd == 0) {
					$('#forgot-valid').hide();
					$('#forgot-pwd-invalid').show();
					$('#format-pwd-invalid').hide();
					// $(':input[type="submit"]').prop('disabled', true);
					$('#forgBtn').prop('disabled', true);
				} else {
					$('#forgot-valid').show();
					$('#forgot-pwd-invalid').hide();
					$('#format-pwd-invalid').hide();
					// $(':input[type="submit"]').prop('disabled', false);
					$('#forgBtn').prop('disabled', false);
				}
			},error:function(forgotpwd) {
				console.log('error',forgotpwd);
			}
		});
	}
});
$('#checkPhone').change(function(e){
	var dir_url =  $(".checkPhone").attr('data-url');
	var phone= $('#checkPhone').val();
	$.ajax({
		url: dir_url,
		method: "POST",
		data: { phone: phone },
		dataType: "html",
		success:function(phone) {
			console.log('result',phone);
			var phone = jQuery.parseJSON( phone );
			if (phone == 0) {
				$('#phone-valid').show();
				$('#phone-invalid').hide();
				// $(':input[type="submit"]').prop('disabled', false);
				$('#regBtn').prop('disabled', false);
			} else {
				$('#phone-valid').hide();
				$('#phone-invalid').show();
				// $(':input[type="submit"]').prop('disabled', true);
				$('#regBtn').prop('disabled', true);
			}
		},error:function(phone) {
			console.log('error',phone);
		}
	});
});

	//remove to cart
	$('.remove-cart').click(function(){
		var id = $(this).attr('data-id');
		var _url = $(this).attr('data-url');
		remove_cart(id,_url);
	});
	//end remove to cart
	//dynamic price qty
	$('input[name=qty_cart]').change(function(){
		var qty=parseInt($(this).val());
		var id_cart=$(this).attr('data-id');
		var _url = $(this).attr('data-url');
		var max=parseInt($(this).attr('max'));
		var sum = 0;
		$('.cart_product_price').each(function(){
			sum += parseFloat($(this).attr('data-price')*$(this).val()); 
		});

		
		if (qty<=max) {
			$('.side_subtotal').html("Rp "+formatMoney(sum,0));
			update_cart(id_cart,qty,_url);
		}
		
	});

	//end dynamic price qty
	function add_cart(id_product,qty,_url,affiliate){
		$.ajax({
			type: "POST",
			data:{
				id_product:id_product,
				qty:qty,
				affiliate:affiliate
			},
			url: _url,
			success: function (url) {
				location.reload();
			},
			error: function (data) {
				console.log(data);
			}
		})
	}

	function remove_cart_icon(id_cart,_url){
		$.ajax({
			type: "POST",
			data:{
				id_cart:id_cart
			},
			url: _url,
			success: function (url) {
				location.reload();
			},
			error: function (data) {
				console.log(data);
			}
		})
	}

	function update_cart(id_cart,qty,_url){
		$.ajax({
			type: "POST",
			data:{
				id_cart:id_cart,
				qty:qty
			},
			url: _url,
			success: function (data) {
				console.log(data);
			// window.location.href = url;
		},
		error: function (data) {
			console.log(data);
		}
	})
	}

	function remove_cart(id_cart,_url){
		swal({
			title: "Apakah Anda yakin untuk menghapus produk ini dari keranjang?",
		// text: "Anda tidak akan dapat memulihkan produk ini!",
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
				data:{
					id_cart:id_cart
				},
				url: _url,
				success: function (data) {
					swal({
						title:"Hapus Berhasil!",
						text: "Produk Berhasil Dihapus dari keranjang.",
						type: "success"
					},
					function () {
						location.reload();
					});
				},
				error: function (data) {
					swal("Error", "Server Error", "error");
				}
			})
		} else {
			swal("Cancelled", "", "error");
		}
	});
	}
	function formatMoney(n, c, d, t) {
		var c = isNaN(c = Math.abs(c)) ? 2 : c,
		d = d == undefined ? "." : d,
		t = t == undefined ? "." : t,
		s = n < 0 ? "-" : "",
		i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
		j = (j = i.length) > 3 ? j % 3 : 0;

		return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};
	

$('.play').click(function(){
	var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
	var arg = {
		resultFunction: function(result) {
			console.log(result.code,'qrcode');
			var url=$('.url_scan_qr').attr('data-url');
			var qrcode=result.code;
			$.ajax({
				type:'POST',
				url: url,
				data:{qrcode:qrcode},
				success: function(data){
					console.log(data,'success');
					if (data==1) {
						window.location.href = qrcode;
					} else {
						swal("QR Code Invalid");
					}
				}
			})
		}
	};
	new WebCodeCamJS("canvas").init(arg).play();
})
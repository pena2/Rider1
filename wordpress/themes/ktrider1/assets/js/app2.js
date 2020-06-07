
$(document).ready(function(){


	$('.btn_infoitem_search_submit').click(function(){
		var cats= $('.input_infoitem_search_cat').serializeArray();
		var tdata= {'cats':cats};
		$.ajax({
			'url': '/wp-json/booth2/search_infoitems', data: tdata, method: 'get',
			success: function(resp){
				console.log('btn_infoitem_search_submit SUCCESS',resp);
			},
			error: function(a,b,c){
				console.log('btn_infoitem_search_submit ERROR',a,b,c);
			},
		});
	});


	$('.a_terms').click(function(){
		$('.div_terms').toggle();
		return false;
	});


});

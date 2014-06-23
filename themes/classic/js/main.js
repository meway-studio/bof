var offset = 0;

function startTime(id,simbol){
	var today = new Date();
	var h     = today.getHours();
	var m     = today.getMinutes();
	m         = (m<10) ? "0"+m : m;
	simbol    = (simbol!=':') ? ':' : ' ';
	var date = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear()+' '+h+simbol+m;
	document.getElementById(id).innerHTML=date;
	setTimeout(function(){startTime(id,simbol)},1000);
}

$(document).ready(function(){
	
	startTime('clock');

	$(".cartAdd").click(function(){
		
		$.post( $(this).data('url') ,{ tips_id: $(this).data('id') }, function(data){
			
			$("#cart-count").text(data.count);
			$().toastmessage('showNoticeToast', data.message);

		},'json');

		return false;
	});
	
	$("#show7moretips").click(function(){
		offset  = offset+7;
		var url = $(this).attr('href')+'/offset/'+offset;
		$.get(url, function(html){
			
			$(html).find('table tr.rows').each(function(k,v){
			
			if(v.outerHTML!==undefined)
				$(".last-tips table").append(v.outerHTML);
			});
		});
		
		return false;
	});

	var banner = $('.banner');
	if (banner.length) {
		setTimeout(function(){
			banner.fadeIn(1000);
		}, 6000);
	}
});

$(document).scroll(function(){

	var offset = 590;
	
	if(scrollY > (offset) ){
		$(".guidline-left, .about-left").css({"margin-top": (scrollY-offset)});
	}else{
		$(".guidline-left, .about-left").css({"margin-top":0});
	}
	
	if(scrollY > 90){

		$(".menu").css({
			"position": "fixed",
			"top": "0px",
			"left": "0px",
			"right": "0px",
			"z-index": "500"
		});
		$("#header").css({"margin-bottom": "60px"});
	}else{
		$(".menu").css({"position": "static"});
		$("#header").css({"margin-bottom": "0px"});
	}
});
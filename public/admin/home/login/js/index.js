jQuery(document).ready(function($) {

	// If firefox
	if(navigator.userAgent.toLowerCase().match(/firefox/)) {
		$('.browser-warning').removeClass('hidden');
		setTimeout(function() {
			$('.browser-warning').addClass('hidden');
		}, 6*1000);
	}

	// Display window (and start animation) when document is ready
	// This mininizes the risk of firefox messing up
	$('#window').attr('style', '');

	// initAnimation();
	$(document).on('click', '#submit', initAnimation);
	$(document).on('click', '.trigger-anim-replay', resetAnimation);


	
	
	//登录按钮
	function initAnimation() {
		var username = $('#username').val();
		var password = $('#password ').val();
		var token = $('[name=csrf-token]').val();
		if(username == '' || password == '')
		{
			layer.alert('用户名或密码不能为空!',{
                icon:3,
                time:1000,
                skin:'layer-ext-yourskin'
        	}); 
       		return;
		}
		$.ajax({
		    type:"post",
		    data:{
		    	'username':username,
		    	'password':password,
		    	'_token':token,
		    },
		    url:"/admin/login",
		    dataType:'json',
		    success:function(res){
		        if(res.status == 200)
		        {
		        	$('#submit').addClass('loading');
					$('#submit').addClass('done').closest('#window').addClass('flip');
					countTime();
		        }else{
					layer.alert(res.msg,{
			                icon:2,
			                time:1000,
			                skin:'layer-ext-yourskin'
			        }); 
					return false;
		        }
		    }
		});
		
	}

	var num = 10;
	function countTime(){ 
	    num--;
	    $('.number').html(num);
	     if(num <= 0){//这里就是时间到了之后应该执行的动作了，这里只是弹了一个警告框 
			$('.number').html(num);
			location.href = "/admin/index/index";
	        return; 
	    } 
	    setTimeout(function(){
	    	countTime();
	    },1000); 
	} 



	//重播按钮
	function resetAnimation() {
		var win = $('#window');
		win.stop().fadeOut(500, function() {

			// Reset things
			win.attr('style', '');
			win.find('input[type=text], input[type=password]').val('');
			win.find('.load-btn.loading').removeClass('loading done');

			// Clone and re-create window element to trigger animation restart
			win.removeClass('flip');
			win.before(win.clone(true)).remove();

			// Restart animation
			initAnimation();
		});
	}

});
$(document).ready(function(){
	$('.sidebar_city_list_href span').click(function(){
		$('.sidebar_city_list_form').slideDown(500);
		$(this).hide();
	});
	$('.content_company_list_add span').click(function(){
		$('.content_company_list_form').slideDown(500);
		$(this).hide();
	});
	/*------------------------добавление ссылок при клике----------------------*/
	$('.out_link').click(function(){
		var url = $(this).data('url');
		$(this).attr('href', url);
		return true;
	});
	$('.out_link.__kredit').click(function(){
		var url = 'http://credit.beregu.ru/?_ctr=SbFd6jM';
		$(this).attr('href', url);
		return true;
	});
	/*------------------------страница компании скролл к разделам----------------------*/
	$('.sidebar_company_view_news').click(function(){
		$("body,html").animate({ scrollTop: $('.content_company_news').offset().top - 20 }, 300);
	});
	$('.sidebar_company_view_review').click(function(){
		$("body,html").animate({ scrollTop: $('.content_company_review').offset().top - 20 }, 300);
	});
	$('.sidebar_company_view_service').click(function(){
		$("body,html").animate({ scrollTop: $('.content_company_service').offset().top - 20 }, 300);
	});
	/*------------------------добавление отзывов----------------------*/
	$('.review_add_button').click(function(){
		if ($(this).hasClass('__active'))
		{
			$(this).parent().find('.review_form').slideUp(400, function(){
				$('.review_add_button').removeClass('__active');
			});
		}
		else
		{
			$(this).addClass('__active');
			$(this).parent().find('.review_form').slideDown();
		}
	});
	$('.review_submit').click(function(){
		var name = $('#name').val();
		var company = $('#company').val();
		var mark = $('#mark').val();
		var message = $('#message').val();
		var error;
		if (!name)
		{
			error = $('#name');
			error.siblings('.review_field_input_error').fadeIn();
			error.siblings('.review_field_input_error').fadeOut(2000);
		}
		if (company == -100)
		{
			error = $('#company');
			error.siblings('.review_field_input_error').fadeIn();
			error.siblings('.review_field_input_error').fadeOut(2000);
		}
		if (!mark)
		{
			error = $('#mark');
			error.siblings('.review_field_input_error').fadeIn();
			error.siblings('.review_field_input_error').fadeOut(2000);
		}
		if (!message)
		{
			error = $('#message');
			error.siblings('.review_field_input_error').fadeIn();
			error.siblings('.review_field_input_error').fadeOut(2000);
		}
		if (!error)
		{
			$(this).addClass('__loader');
			var currentDom = this;
			$.post(
				'/review/ajaxcreate/',
				{
					name : name, 
					company : company, 
					mark : mark, 
					message : message
				},
				function (data){
					$('.popup_out').show();
					if (data.error)
						$('.review_create_fail').show();
					else
					{
						$('.content_review_list').prepend(data.html);
						$('.review_create_success').show();
						$('.content_review_list_empty').hide();
						$('#name').val('');
						$('#company').val(-100);
						$('#mark').val(0);
						$('#message').val('');
						$('.review_add_button').removeClass('__active');
						$('.review_form').hide();
					}
					$(currentDom).removeClass('__loader');
				},
				'json'
			);
		}
	});
	$('.review_create_success_button').click(function(){
		$('.review_create_success').hide();
		$('.popup_out').hide();
	});
	$('.review_create_fail_button').click(function(){
		$('.review_create_fail').hide();
		$('.popup_out').hide();
	});
	$('.popup_out').click(function(){
		$('.review_create_fail').hide();
		$('.review_create_success').hide();
		$('.popup_out').hide();
	});
	/*-----------------------------------------------------------------*/
	/*------------------------отправка сообщения----------------------*/
	$('.footer_feedback').click(function(){
		$('.popup_out_feedback').show();
	});
	$('.feedback_form').click(function(){
		return false;
	});
	$('.feedback_form_close').click(function(){
		$('.feedback_form').show();
		$('.feedback_create_success').hide();
		$('.popup_out_feedback').hide();
	});
	$('.popup_out_feedback').click(function(){
		$('.feedback_form').show();
		$('.feedback_create_success').hide();
		$('.popup_out_feedback').hide();
	});
	$('.review_create_success_button').click(function(){
		$('.feedback_form').show();
		$('.feedback_create_success').hide();
		$('.popup_out_feedback').hide();
	});
	$('.feedback_submit').click(function(){
		var feedback_name = $('#feedback_name').val();
		var feedback_email = $('#feedback_email').val();
		var feedback_message = $('#feedback_message').val();
		var error;
		if (!feedback_name)
		{
			error = $('#feedback_name');
			error.siblings('.feedback_field_input_error').fadeIn();
			error.siblings('.feedback_field_input_error').fadeOut(2000);
		}
		if (!feedback_email)
		{
			error = $('#feedback_email');
			error.siblings('.feedback_field_input_error').fadeIn();
			error.siblings('.feedback_field_input_error').fadeOut(2000);
		}
		if (!feedback_message)
		{
			error = $('#feedback_message');
			error.siblings('.feedback_field_input_error').fadeIn();
			error.siblings('.feedback_field_input_error').fadeOut(2000);
		}
		if (!error)
		{
			$(this).addClass('__loader');
			var currentDom = this;
			$.post(
				'/site/ajaxfeedback/',
				{
					feedback_name : feedback_name, 
					feedback_email : feedback_email, 
					feedback_message : feedback_message,
					url: window.location.href
				},
				function (data){
					$('.feedback_create_success').show();
					$('.feedback_form').hide();
					$('#feedback_name').val('');
					$('#feedback_email').val('');
					$('#feedback_message').val('');
					$(currentDom).removeClass('__loader');
				}
			);
		}
	});
	/*-----------------------------------------------------------------*/
	/*------------------------------ выбор города ---------------------*/
	$('.city_check').click(function(){
		$('.popup_out_city').show();
		$('.popup_city').show();
		$('.popup_city').addClass('__loading');
		$.post('/city/ajaxlist/', {}, function(data){
			$('.popup_city_column').html(data);
			$('.popup_city').removeClass('__loading');
		});
	});
	$('.popup_city_close').click(function(){
		$('.popup_out_city').hide();
		$('.popup_city').hide();
	});
	$('.popup_out_city').click(function(){
		$('.popup_out_city').hide();
		$('.popup_city').hide();
	});
	/*-----------------------------------------------------------------*/
	/*-------------------------- мобильная версия ---------------------*/
	$('.mob-menu-open__buger').click(function(){
		$('.menu').toggle(300);
	});

	if ($(window).width() <= 769) {
		$('.sidebar').insertAfter($('.content'));
	}
	/*-----------------------------------------------------------------*/
	setTimeout(afterLoad, 500);
});

function afterLoad()
{
	if ($('.main_banner').length > 0)
	{
		$('.main_banner span').html('<iframe scrolling="no" width="845" height="120" frameborder="0" src="http://093.ru/!green/"></iframe>');
	}
	/*$('a.menu_remont').each(function(key, item){
		$(item).attr('href', 'http://remont.beregu.ru/?_ctr=SZ7zMXC');
	});
	$('a.__kredit').each(function(key, item){
		$(item).attr('href', 'http://credit.beregu.ru/?_ctr=SbFd6jM');
	});*/
};
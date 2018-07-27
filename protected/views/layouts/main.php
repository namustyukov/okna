<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width">
	<meta name="format-detection" content="telephone=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300&amp;subset=latin,cyrillic" media="screen" rel="stylesheet" type="text/css" >
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700&amp;subset=cyrillic-ext,latin-ext" media="screen" rel="stylesheet" type="text/css" >
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<title><?php echo $this->pageTitle?></title>
	<meta name="keywords" content="<?php echo $this->meta_k?>" />
	<meta name="description" content="<?php echo $this->meta_d?>" />
	<?if (Yii::app()->user->isGuest):?>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
	<?endif?>
</head>
<body>
<?if (!Yii::app()->user->isGuest):?>
	<style>
	#menu_top ul{
		list-style: none;
	}
	#menu_top li{
		display:inline-block;
		padding-right: 20px;
	}
	.portlet{
		margin-top:15px;
	}
	</style>
	<div id="menu_top">
	<?php $this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			array('label'=>'Home', 'url'=>array('/site/index')),
			array('label'=>'Города', 'url'=>array('/city/admin'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Компании', 'url'=>array('/company/admin'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Компании от пользователей', 'url'=>array('/companyNew/admin'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Массовое согласование', 'url'=>array('/companyNew/acceptall'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Статьи', 'url'=>array('/page/admin'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Новости', 'url'=>array('/news/admin'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Отзывы', 'url'=>array('/review/admin'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Сообщения', 'url'=>array('/feedback/admin'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Цены', 'url'=>array('/pricecity/admin'), 'visible'=>!Yii::app()->user->isGuest),
			/*array('label'=>'Парсинг URL', 'url'=>array('/companyParse/url'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Парсинг компаний', 'url'=>array('/companyParse/company'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Парсинг - перевод в базу', 'url'=>array('/companyParse/transfer'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Парсинг - цен', 'url'=>array('/companyParse/price'), 'visible'=>!Yii::app()->user->isGuest),*/
			array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
		),
	)); ?>
	</div>
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
<?endif?>
<div class="background_body">
	<div class="wrapper">
		<div class="header">
			<div class="header_top">
				<div class="city_check">
					<span>Выбор города</span>
					<a><?=$this->city->gorod?></a>
				</div>
				<div class="logo">
					<a href="/"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" width="354" height="73" alt="ОКНАОРГ - портал о пластиковых окнах в России" /></a>
				</div>
			</div>
			<div class="menu">
				<ul>
					<li class="<?=(Yii::app()->controller->action->id == 'index_gorod' ? 'active' : '')?>">
						<a href="/<?=$this->city->simbol_name?>"><?=$this->city->gorod?></a>
					</li>
					<li class="<?=(Yii::app()->controller->id == 'company' && Yii::app()->controller->action->id != 'prices' && Yii::app()->controller->action->id != 'promo' ? 'active' : '')?>">
						<a href="/<?=$this->city->simbol_name?>/company/list">КОМПАНИИ</a>
					</li>
					<li class="<?=(Yii::app()->controller->id == 'news' ? 'active' : '')?>">
						<a href="/<?=$this->city->simbol_name?>/news/list">НОВОСТИ</a>
					</li>
					<li class="<?=(Yii::app()->controller->id == 'company' && Yii::app()->controller->action->id == 'prices' ? 'active' : '')?>">
						<a href="/<?=$this->city->simbol_name?>/prices/list">ЦЕНЫ</a>
					</li>
					<li class="<?=(Yii::app()->controller->id == 'company' && Yii::app()->controller->action->id == 'promo' ? 'active' : '')?>">
						<a href="/<?=$this->city->simbol_name?>/promo/list">АКЦИИ И СКИДКИ</a>
					</li>
					<li class="<?=(Yii::app()->controller->id == 'review' ? 'active' : '')?>">
						<a href="/<?=$this->city->simbol_name?>/review/list">ОТЗЫВЫ</a>
					</li>
					<li>
						<a href="/page/list">ПОЛЕЗНЫЕ СОВЕТЫ</a>
					</li>
				</ul>
			</div>
			<?php
				if (0) {
					echo '<div class="top_banner_img">
						<a target="_blank" class="out_link" data-url="http://окнапремиум56.рф/" ref="nofollow">
							<img src="/images/okna-premium-banner.gif" alt="Окна Премиум - Каждое второе и последующее окно со скидкой - 500 рублей!" />
						</a>
					</div>';
				}
			?>
		</div>
		<?php echo $content; ?>
	</div>
	<? if (Yii::app()->controller->action->id != 'help' && Yii::app()->controller->action->id != 'success') { ?>
	<div class="footer_market_tiz __gg">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- oknaorg 336x280 -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:336px;height:280px"
		     data-ad-client="ca-pub-9040033498726551"
		     data-ad-slot="7117672828"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<? } ?>
	<? if ($this->show_market && Yii::app()->controller->action->id != 'help' && Yii::app()->controller->action->id != 'success' && 0) { ?>
	<div class="footer_market_tiz">
		<script>(function(e){var t="DIV_DA_"+e+"_"+parseInt(Math.random()*1e3); document.write('<div id="'+t+'" class="directadvert-block directadvert-block-'+e+'"></div>'); if("undefined"===typeof loaded_blocks_directadvert){loaded_blocks_directadvert=[]; function n(){var e=loaded_blocks_directadvert.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.directadvert.ru/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&loaded_blocks_directadvert.length){n(); clearInterval(o)}},50)} setTimeout(n)}loaded_blocks_directadvert.push({adp_id:e,div:t})})(536442)</script>
	</div>
	<? } ?>
	<div class="footer">
		<div class="footer_left">
			<div class="footer_left_text">
				Сообщить другу
			</div>
			<div class="footer_left_buttons">
				<script type="text/javascript">(function() {
				  if (window.pluso)if (typeof window.pluso.start == "function") return;
				  if (window.ifpluso==undefined) { window.ifpluso = 1;
				    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
				    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
				    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
				    var h=d[g]('body')[0];
				    h.appendChild(s);
				  }})();
				</script>
				<div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>
			</div>
		</div>
		<div class="footer_middle">
			<div class="footer_add">
				<a href="/companyNew/create">Добавить компанию</a>
			</div>
			<div class="footer_map">
				<a href="/map">Карта сайта</a>
			</div>
			<div class="footer_help">
				<a href="/help">Поддержать проект</a>
			</div>
		</div>
		<div class="footer_middle __add">
			<div class="footer_feedback">
				<span>Обратная связь</span> oknaorg@mail.ru
			</div>
		</div>
		<div class="footer_right">
			<!--LiveInternet counter--><script type="text/javascript"><!--
			document.write("<a href='//www.liveinternet.ru/click' "+
			"target=_blank><img src='//counter.yadro.ru/hit?t14.14;r"+
			escape(document.referrer)+((typeof(screen)=="undefined")?"":
			";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
			screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
			";"+Math.random()+
			"' alt='' title='LiveInternet: показано число просмотров за 24"+
			" часа, посетителей за 24 часа и за сегодня' "+
			"border='0' width='88' height='31'><\/a>")
			//--></script><!--/LiveInternet-->
		</div>
	</div>
</div>

<div class="popup_out_feedback __hidden">
	<div class="feedback_form">
		<div class="feedback_form_close"></div>
		<div class="feedback_field">
			<div class="feedback_field_title">
				Ваше имя
			</div>
			<div class="feedback_field_input">
				<input type="text" name="feedback_name" id="feedback_name" />
				<div class="feedback_field_input_error">Ошибка</div>
			</div>
		</div>
		<div class="feedback_field">
			<div class="feedback_field_title">
				E-mail
			</div>
			<div class="feedback_field_input">
				<input type="text" name="feedback_email" id="feedback_email" />
				<div class="feedback_field_input_error">Ошибка</div>
			</div>
		</div>
		<div class="feedback_field">
			<div class="feedback_field_title">
				Сообщение
			</div>
			<div class="feedback_field_input">
				<textarea name="feedback_message" id="feedback_message"></textarea>
				<div class="feedback_field_input_error">Ошибка</div>
			</div>
		</div>
		<div class="feedback_submit">
			<span>Отправить</span>
		</div>
	</div>
	<div class="feedback_create_success __hidden">
		<p>Сообщение успешно отправлено</p>
		<div class="feedback_create_success_button">
			Закрыть
		</div>
	</div>
</div>

<div class="popup_out_city __hidden"></div>
<div class="popup_city __hidden">
	<div class="popup_city_close"></div>
	<div class="popup_city_column">
	</div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter30822246 = new Ya.Metrika({id:30822246,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/30822246" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
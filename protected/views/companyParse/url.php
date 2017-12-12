<div class="company_parse_form">
	<form action="/companyParse/url" method="post">
		<div class="company_parse_form_row">
			<span>Начальная страница</span><input type="text" name="beg" id="beg">
		</div>
		<div class="company_parse_form_row">
			<span>Конечная страница</span><input type="text" name="end" id="end">
		</div>
		<div class="company_parse_form_row">
			<input type="submit" value="Парсить ссылки">
		</div>
		<div class="company_parse_form_row">
			<?
				if ($accept)
					echo '<font color="green">Парсинг успешно завершен.</font>';
				else
					echo '<font color="red">Парсинг не произведен.</font>';
			?>
			<span>Общее количество адресов: <?=$urls_count?></span>
		</div>
		<div class="company_parse_form_row">
			<?=$str?>
		</div>
	</form>
</div>
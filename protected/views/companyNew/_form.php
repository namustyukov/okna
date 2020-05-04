<?php
/* @var $this CompanyNewController */
/* @var $model CompanyNew */
/* @var $form CActiveForm */
?>

<div class="form company_new_form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-new-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php
		$city_id = isset($model->city_id) && $model->city_id ? $model->city_id : $this->city->id;
	?>
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'city_id',
					CHtml::listData(City::model()->findAll(array('order'=>'gorod')), 'id', 'gorod'),
                    array(
                      'options' => array(
                            $city_id=>array('selected'=>true),
                      ))
                    );
                ?> <div class="field-examle">Москва</div>
		<?php echo $form->error($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?> <div class="field-examle">Окнатест</div>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'full_name'); ?>
		<div class="field-desc">Вместе с наименованием компании указывается так же тип (ООО, ЗАО и т.д.)</div>
		<?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>300)); ?> <div class="field-examle">ООО Окнатест</div>
		<?php echo $form->error($model,'full_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<div class="field-desc">Ограничение 300 символов. Город в адресе не указывается. Если адресов несколько, то они нумеруются, между номерами ставится точка с запятой: 1) ...; 2) ...</div>
		<?php echo $form->textArea($model,'address',array('rows'=>3, 'cols'=>50)); ?> <div class="field-examle">1) ул. Салмышская д.24; 2) Шарлыкское шоссе, 1</div>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<div class="field-desc">Ограничение 300 символов. Телефоны отделять запятой. Если адресов несколько, то нумерация телефонов соответствует нумерации адресов: 1) ...; 2) ...</div>
		<?php echo $form->textArea($model,'phone',array('rows'=>3, 'cols'=>50)); ?> <div class="field-examle">1) +7 (924) 44-65-78; 2) +7 (977) 12-77-65</div>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?> <div class="field-examle">example@mail.ru</div>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>100)); ?> <div class="field-examle">http://mysite.ru/</div>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'worktime'); ?>
		<div class="field-desc">Ограничение 100 символов. Время указывается в 24 часовом формате.</div>
		<?php echo $form->textField($model,'worktime',array('size'=>60,'maxlength'=>100)); ?> <div class="field-examle">8:00 - 18:00. Сб., Вс. - выходной</div>
		<?php echo $form->error($model,'worktime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'online'); ?>
		<?php echo CHtml::activeDropDownList($model, 'online',
			array(
				'' => 'Не возможен',
				'Возможен' => 'Возможен',
		)) ?>
		<?php echo $form->error($model,'online'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_found'); ?>
		<div class="field-desc">Слово "год" необходимо указать, как представлено в примере.</div>
		<?php echo $form->textField($model,'date_found',array('size'=>60,'maxlength'=>100)); ?> <div class="field-examle">2016 год</div>
		<?php echo $form->error($model,'date_found'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'certificate'); ?>
		<?php echo CHtml::activeDropDownList($model,'certificate',
			array(
				'' => 'Не имеются',
				'Имеются' => 'Имеются',
		)); ?>
		<?php echo $form->error($model,'certificate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guarantee'); ?>
		<div class="field-desc">Слово "год" или "лет" необходимо указать, как представлено в примере.</div>
		<?php echo $form->textField($model,'guarantee',array('size'=>60,'maxlength'=>300)); ?> <div class="field-examle">5 лет</div>
		<?php echo $form->error($model,'guarantee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment'); ?>
		<div class="field-desc">Перечислите через запятую доступные способы оплаты: Наличный / Безналичный / Рассрочка / Кредит</div>
		<?php echo $form->textField($model,'payment',array('size'=>60,'maxlength'=>300)); ?> <div class="field-examle">Наличный, Рассрочка</div>
		<?php echo $form->error($model,'payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<div class="field-desc">Ограничение 300 символов. Минимальная стоимость двустворчатого окна, либо за 1м2, должна быть указана точная цифра: от ... рублей за ...</div>
		<div class="field-desc">Слово "рублей" необходимо указать, так же указывается за что именно представлена цена (за 1м2, за двустворчатое окно и т.д.), как указано в примере.</div>
		<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>500)); ?> <div class="field-examle">от 5600 рублей за 1м2</div>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'promo'); ?>
		<div class="field-desc">Ограничение 300 символов. Указывается наименование акции и скидка (либо бонусы). Если акций много, то указывается максимальная скидка: Скидка до 50%.</div>
		<?php echo $form->textArea($model,'promo',array('rows'=>3, 'cols'=>50)); ?> <div class="field-examle">Скидка до 50%, подробнее на сайте компании</div>
		<?php echo $form->error($model,'promo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'production_way'); ?>
		<div class="field-desc">Ограничение 300 символов. Перечисляются используемые профили. Формат записи представлен в примере.</div>
		<?php echo $form->textField($model,'production_way',array('size'=>60,'maxlength'=>300)); ?> <div class="field-examle">Используются профили Rehau, VEKA</div>
		<?php echo $form->error($model,'production_way'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<div class="field-desc">Общая информация о компании (ограничений на текст нет)</div>
		<?php echo $form->textArea($model,'about',array('rows'=>15, 'cols'=>50)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row row--img">
		<?php echo CHtml::activeLabelEx($model,'logo'); ?><br />
		<?php echo CHtml::activeFileField($model,'logo'); ?>
		<?php echo CHtml::error($model,'logo'); ?>
		<?
			if ($model->logo)
			{
				echo "<h4>Текущая картинка</h4>";
				echo '<img src="'.Yii::app()->request->baseUrl.'/img/'.$model->logo.'">';
			}
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<div class="field-desc">На данный email будет отправлено уведомление, после размещения компании на сайте.</div>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>300)); ?> <div class="field-examle">my@mail.ru</div>
		<?php echo $form->error($model,'user_email'); ?>
	</div>

	<?php if (CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div class="field-desc">Введите код с картинки. Буквы не чувствительны к регистру</div>
		<div class="captcha-widget">
			<?php $this->widget('CCaptcha'); ?>
		</div>
		<div>
			<?php echo $form->textField($model,'verifyCode',array('size'=>60,'maxlength'=>300)); ?>
		</div>
	</div>
	<?php endif; ?>

	<?php if (!Yii::app()->user->isGuest && !$model->isNewRecord) { ?>
	<div class="row">
		<?php if ($model->is_accept) { ?>
			<div class="is_accept_block">
				<p>Компания размещена</p>
				<p><a href="/company/view?id=<?=$model->donor_site?>">Страница компании на сайте</a></p>
			</div>
		<?php }else{ ?>
			<div class="is_accept_block">
				<p>Компания не размещена</p>
				<p><a href="/companyNew/accept?id=<?=$model->id?>">Разместить</a></p>
			</div>
		<?php } ?>
	</div>
	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
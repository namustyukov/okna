<?php
include_once('parse/simple_html_dom.php');

class CompanyParseController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('company','url','transfer', 'img', 'removeother', 'price'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			)
		);
	}

	public function actionRemoveother()
	{
		/*$company = Company::model()->findAll(array(
			'condition'=>'koord_x is NULL'
		));
		echo count($company);
		foreach ($company as $item) {
			$html_item = new simple_html_dom();
			$html_item->load_file($item->donor_site);
			// logo
			$name = $html_item->find('table#table339 tr', 3)->find('td', 1)->plaintext;
			$country_name = trim(iconv('windows-1251','utf-8',$name));

			if ($country_name != 'Россия')
			{
				if ($item->city)
					$item->city->delete();
				$item->delete();
			}
			else
			{
				$item->koord_x = 1;
				$item->save();
			}
			echo $item->id.'<br>';

			$html_item->clear();
			unset($html_item);
		}*/
	}

	public function actionPrice()
	{
		$html = file_get_contents('http://www.oknamedia.ru/spage-price/section-list.html');
		$html = trim(iconv('windows-1251','utf-8',$html));
		if (preg_match('/var series_nark_up = (.*?), chart/is', $html, $find_arr))
		{
			$text = str_replace("	", " ", $find_arr[1]);
			$text = str_replace("\n", "", $text);
			$text = str_replace("\r", "", $text);
			$json_arr = explode(", series_total = ", $text);
			$price_arr = CJSON::decode($json_arr[0]);
			$price_key_arr = CJSON::decode($json_arr[1]);

			$regions = Region::model()->findAll();
			$rezult = array();
			foreach($regions as $reg)
			{
				$item_data = NULL;
				foreach ($price_arr as $price)
				{
					if ($price['name'] == $reg->name)
					{
						$item_data = $price['data'];
						break;
					}
				}
				for ($i = count($item_data) - 1; $i >= 0; $i--)
				{
					$arr_item = array('y' => $item_data[$i]['y'], 'diff' => $item_data[$i]['diff']);
					$rezult[$reg->id][($item_data[$i]['x']/1000)] = $arr_item;
				}
				$item_key_data = NULL;
				foreach ($price_key_arr as $price)
				{
					if ($price['name'] == $reg->name)
					{
						$item_key_data = $price['data'];
						break;
					}
				}
				for ($i = count($item_key_data) - 1; $i >= 0; $i--)
				{
					$arr_item = array('y_key' => $item_key_data[$i]['y'], 'diff_key' => $item_key_data[$i]['diff']);
					$rezult[$reg->id][($item_key_data[$i]['x']/1000)] = array_merge($rezult[$reg->id][($item_key_data[$i]['x']/1000)], $arr_item);
				}
			}
			if (count($rezult[1]) > 0)
			{
				$command = Yii::app()->db->createCommand();
				$command->truncateTable('pricecity');
				foreach ($rezult as $reg_id => $reg)
				{
					foreach ($reg as $key => $val)
					{
						$model = new Pricecity;
						$model->date_create = $key;
						$model->price = $val['y'];
						$model->diff = $val['diff'];
						$model->price_key = $val['y_key'];
						$model->diff_key = $val['diff_key'];
						$model->region_id = $reg_id;
						$model->save();
						echo 'id='.$model->id.' region='.$model->region_id.' price='.$model->price.' diff='.$model->diff.'<br>';
					}
				}
				echo 'good';
			}
		}
		else
			echo 'error';
	}

	public function actionImg()
	{
		$company = Company::model()->findAll();
		foreach ($company as $item) {
			if ($item->logo)
			{
				$name = '';
				if (strpos($item->logo, '.jp'))
				{
					$name = 'image_'.$item->id.'.jpg';
					copy ( $item->logo, 'img/'.$name );
				}
				else
				{
					$name = 'image_'.$item->id.'.png';
					copy ( $item->logo, 'img/'.$name );
				}
				if ($name)
				{
					$item->logo = $name;
					$item->save();
					echo "<br>".$name;
				}
			}
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionTransfer()
	{
		$parse = CompanyParse::model()->findAll(array(
			'condition'=>'company_id is NULL'
		));
		echo count($parse);
		foreach ($parse as $row)
		{
			$city_name = trim($row->city);
			$city = City::model()->find('gorod=:gorod', array(':gorod' => $city_name));
			if (!$city)
			{
				$city = new City;
				$city->gorod = trim($city_name);
				$city->save();
			}
			if ($city->id)
			{
				$model = new Company;
				$model->name = $row->name;
				$model->logo = $row->logo;
				$model->city_id = $city->id;
				$model->address = $row->address;
				$model->phone = $row->phone;
				$model->site = $row->site;
				$model->about = $row->description;
				$model->donor_site = $row->donor;
				$model->save();
			}
			foreach ($row->products as $item)
			{
				$category = ServiceType::model()->find('text=:text', array(':text' => $item->category));
				if (!$category)
				{
					$category = new ServiceType;
					$category->text = trim($item->category);
					$category->save();
				}
				$company_service = CompanyService::model()->find('company_id=:company_id and service_id=:service_id', array(':service_id' => $category->id, ':company_id' => $model->id));
				if (!$company_service)
				{
					$company_service = new CompanyService;
					$company_service->service_id = $category->id;
					$company_service->company_id = $model->id;
					$company_service->save();
				}
				$product = new CompanyProducts;
				$product->text = $item->product;
				$product->c_s_id = $company_service->id;
				$product->save();

				$mas_range = explode("<br>", $item->range);
				foreach ($mas_range as $range_item)
				{
					$range_clear = trim(strip_tags($range_item));
					if ($range_clear)
					{
						$range = new CompanyRange;
						$range->text = $range_clear;
						$range->c_p_id = $product->id;
						$range->save();
					}
				}
			}
			$row->company_id = $model->id;
			$row->save();
			echo "<br>".$model->id." ".$model->name;
		}
	}

	public function actionCompany()
	{
		$urls = UrlParse::model()->findAll(array(
			'condition'=>'company_id is NULL'
		));
		echo count($urls);
		foreach ($urls as $item)
		{
			$html_item = new simple_html_dom();
			$html_item->load_file($item->url);
			// logo
			$logo = $html_item->find('table#table339 img[itemprop=logo]', 0);
			$url_img = 'http://www.oknamedia.ru/'.$logo->src;
			//$folder = Yii::app()->request->baseUrl.'/img/'.$item->id.'.jpg';
			//file_put_contents($folder, file_get_contents($url_img));
			$company_logo = iconv('windows-1251','utf-8',$url_img);
			// company
			$name = $html_item->find('table#table339 tr', 2)->find('td', 1)->plaintext;
			$company_name = trim(iconv('windows-1251','utf-8',$name));
			// city
			$city = $html_item->find('table#table339 tr', 5)->find('td', 1)->plaintext;
			$company_city = trim(iconv('windows-1251','utf-8',$city));
			// address
			$address = $html_item->find('table#table339 tr', 6)->find('td', 1)->plaintext;
			$company_address = trim(iconv('windows-1251','utf-8',$address));
			// phone
			$phone = $html_item->find('table#table339 tr', 7)->find('td', 1)->plaintext;
			$company_phone = trim(iconv('windows-1251','utf-8',$phone));
			// site
			$site = $html_item->find('table#table339 tr', 8)->find('td', 1)->plaintext;
			$company_site = trim(iconv('windows-1251','utf-8',$site));
			// donor
			$company_donor = $item->url;
			// description
			$description = $html_item->find('table#table332 tr td span[itemprop=description]', 0)->innertext;
			$company_description = trim(iconv('windows-1251','utf-8',$description));
		
			$model = new CompanyParse;
			$model->name = $company_name;
			$model->logo = $company_logo;
			$model->city = $company_city;
			$model->address = $company_address;
			$model->phone = $company_phone;
			$model->site = $company_site;
			$model->description = $company_description;
			$model->save();
		
			// category
			$table = $html_item->find('table#table340', 0);
			$trs_main = $table->find('tr');
			$category_row = array();
			foreach ($trs_main as $key => $value)
			{
				if ($value->find('td.table[colspan="2"]', 0))
				{
					if ($category_row['category'] && $category_row['products'])
					{
						$model_cat = new CategoryParse;
						$model_cat->category = $category_row['category'];
						$model_cat->product = $category_row['products'];
						$model_cat->range = $category_row['range'];
						$model_cat->company_id = $model->id;
						$model_cat->save();

						$category_row['category'] = false;
						$category_row['products'] = false;
						$category_row['range'] = false;
					}
					$category = $value->find('td.table[colspan="2"]', 0)->plaintext;
					$category_row['category'] = trim(iconv('windows-1251','utf-8',$category));
					continue;
				}
				if (trim(iconv('windows-1251','utf-8',$value->find('td.table', 0)->plaintext)) == 'Продукция:')
				{
					if ($category_row['category'] && $category_row['products'])
					{
						$model_cat = new CategoryParse;
						$model_cat->category = $category_row['category'];
						$model_cat->product = $category_row['products'];
						$model_cat->range = $category_row['range'];
						$model_cat->company_id = $model->id;
						$model_cat->save();

						$category_row['products'] = false;
						$category_row['range'] = false;
					}
					$products = $value->find('td', 1)->plaintext;
					$category_row['products'] = trim(iconv('windows-1251','utf-8',$products));
					continue;
				}
				if (trim(iconv('windows-1251','utf-8',$value->find('td.table', 0)->plaintext)) == 'Ассортимент:')
				{
					$range = $value->find('td', 1)->innertext;
					$category_row['range'] = trim(iconv('windows-1251','utf-8',$range));
					continue;
				}
				//echo ' none str <br />';
			}
			if ($category_row['category'] && $category_row['products'])
			{
				$model_cat = new CategoryParse;
				$model_cat->category = $category_row['category'];
				$model_cat->product = $category_row['products'];
				$model_cat->range = $category_row['range'];
				$model_cat->company_id = $model->id;
				$model_cat->save();

				$category_row['category'] = false;
				$category_row['products'] = false;
				$category_row['range'] = false;
			}

			$model->donor = $company_donor;
			$model->save();
			$item->company_id = $model->id;
			$item->save();

			echo '<br />'.$company_donor.' - '.$model->name;
		
			$html_item->clear();
			unset($html_item);
		}

		$this->render('company',array(
		));
	}

	public function actionUrl()
	{
		if ($_POST['beg'] && $_POST['end'])
		{
			$str = '';
			for ($i = $_POST['beg']; $i <= $_POST['end']; $i++)
			{
				$html = new simple_html_dom();
				$html->load_file('http://www.oknamedia.ru/spage-company/section-list/tc-135/page_num-'.$i.'.html');
				$items = $html->find('table#table332 tr td a');
				$categories = array();
				foreach ($items as $row)
				{
					$model = new UrlParse;
					$url_company = 'http://www.oknamedia.ru/'.$row->href;
					$model->url = $url_company;
					$model->save();
				}
				$html->clear();
				unset($html);
				$str .= $i.' ';
			}
			$accept = true;
		}

		$urls_count = UrlParse::model()->count();

		$this->render('url',array(
			'accept' => $accept,
			'urls_count' => $urls_count,
			'str' => $str
		));
	}
}

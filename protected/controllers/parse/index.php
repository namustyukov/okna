<?php
  include_once('simple_html_dom.php');

  $html = new simple_html_dom();
  $html->load_file('http://www.oknamedia.ru/spage-company/section-list/tc-135/page_num-2.html');
  $items = $html->find('table#table332 tr td a');
  $categories = array();
  foreach ($items as $row)
  {
    $url_company = 'http://www.oknamedia.ru/'.$row->href;
    //echo $url_company.'<br />';
    $html_item = new simple_html_dom();
    $html_item->load_file($url_company);


    $logo = $html_item->find('table#table339 img[itemprop=logo]', 0);
    //echo 'http://www.oknamedia.ru/'.$logo->src.'<br />';

    $name = $html_item->find('table#table339 tr', 2)->find('td', 1)->plaintext;
    echo trim($name).'<br />';

    $city = $html_item->find('table#table339 tr', 5)->find('td', 1)->plaintext;
    //echo trim($city).'<br />';

    $address = $html_item->find('table#table339 tr', 6)->find('td', 1)->plaintext;
    //echo trim($address).'<br />';

    $phone = $html_item->find('table#table339 tr', 7)->find('td', 1)->plaintext;
    //echo trim($phone).'<br />';

    $site = $html_item->find('table#table339 tr', 8)->find('td', 1)->plaintext;
    //echo trim($site).'<br />';

    $description = $html_item->find('table#table332 tr td span[itemprop=description]', 0)->innertext;
    //echo trim($description).'<br />';

    $table = $html_item->find('table#table340', 0);
    $trs_main = $table->find('tr');
    foreach ($trs_main as $key => $value) {
      if ($value->find('td.table[colspan="2"]', 0))
      {
        //echo 'main:'.$value->find('td.table[colspan="2"]', 0)->plaintext.'<br />';
        $category = $value->find('td.table[colspan="2"]', 0)->plaintext;
        if (!in_array($category, $category))
          $categories[] = $category;
        continue;
      }
      if ($value->find('td.table', 0)->plaintext == 'Продукция:')
      {
        //echo 'products:'.$value->find('td', 1)->plaintext.'<br />';
        continue;
      }
      if ($value->find('td.table', 0)->plaintext == 'Ассортимент:')
      {
        //echo 'products:'.$value->find('td', 1)->plaintext.'<br />';
        continue;
      }
      //echo ' none str <br />';
    }

    $html_item->clear();
    unset($html_item);

    //break;
  }

  echo '----------------------------------------';
  foreach ($categories as $category)
      echo $category.'<br>';
  
  $html->clear();
  unset($html);
?>
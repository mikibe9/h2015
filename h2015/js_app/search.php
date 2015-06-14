<?php
    /*$products = array(
        'products' => array(
            array(
              'id' => 1,
              'name' => 'laptop 1',
              'pret' => '20'
            ),
            array(
                'id' => 2,
                'name' => 'laptop 2',
                'pret' => '22'
            ),
            array(
                'id' => 3,
                'name' => 'laptop 3',
                'pret' => '23'
            ),
        )
    );*/

    for ($i = 1; $i <= 1000; $i++) {
        $pName = 'laptop ' . $i;
        $products['products'][] = array(
            'id' => $i,
            'name' => $pName,
            'price' => $i * 10,
            ''
        );
    }
    //var_dump($_REQUEST);die;
    if(isset($_REQUEST['s'])) {
        //var_dump($products['products'][79]);die;
        //var_dump($products['products']);
        $productsFound = array();
        foreach ($products['products'] as $k => $v) {
            $key = array_search($_REQUEST['s'], $v); // $key = 2;

            if($key !== false){
                $productsFound[] = $v;
            }
        }
        if(count($productsFound) > 0)
        {
            $products['products'] =   $productsFound;
        }
    }

    $products['num_rows'] = count($products['products']);
    //var_dump($_REQUEST);
    if($_REQUEST['page']) {
        $s = 0;
        $l = $_REQUEST['limit'];

        if($_REQUEST['page'] > 1) {
            $s = -((($_REQUEST['page'] - 1) * $_REQUEST['limit'])-1);
            $s = ($_REQUEST['page']-1) * $l;
        }
        //echo $s; die;
        $products['products'] = array_slice($products['products'], $s, $l);
    }
    //echo 'callback(' . json_encode($products) . ');';
    //var_dump($products);
    $isJsonP = isset($_REQUEST['callback']);

    $data = $products;
    if ($isJsonP) {
        echo $_REQUEST['callback'] . '(';
    }

    echo json_encode($data);

    if ($isJsonP) {
        echo ');';
    }
    die;
?>
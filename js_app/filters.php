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

    for ($i = 1; $i <= 10; $i++) {
        $pName = 'Filter ' . $i;
        $products['filters'][] = array(
            'id' => $i,
            'name' => $pName
        );
    }
    //var_dump($_REQUEST);die;
    if(isset($_REQUEST['s'])) {
        //var_dump($products['products'][79]);die;
        //var_dump($products['products']);
        $productsFound = array();
        foreach ($products['filters'] as $k => $v) {
            $key = array_search($_REQUEST['f'], $v); // $key = 2;

            if($key !== false){
                $productsFound[] = $v;
            }
        }
        if(count($productsFound) > 0)
        {
            $products['filters'] =   $productsFound;
        }
    }

    $products['total'] = count($products['filters']);
    //var_dump($_REQUEST);
    if($_REQUEST['page']) {
        $s = 0;
        $l = $_REQUEST['limit'];

        if($_REQUEST['page'] > 1) {
            $s = -((($_REQUEST['page'] - 1) * $_REQUEST['limit'])-1);
            $s = ($_REQUEST['page']-1) * $l;
        }
        //echo $s; die;
        $products['filters'] = array_slice($products['filters'], $s, $l);
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
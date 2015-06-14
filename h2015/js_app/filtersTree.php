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
        $fName = 'Filter ' . $i;
        $filters['items'][] = array(
            'id' => $i,
            'name' => $fName
        );

        $productsNo = rand(2,10);

        for($j = 1; $j <= $productsNo; $j++){
            $pName = 'Product ' . $j;
            $filters['items'][$i-1]['items'][] = array(
                'id' => $j,
                'name' => $pName,
                'leaf' => true
            );
        }
    }


    //$filters['total'] = count($filters['filters']);
    //var_dump($_REQUEST);
    /*if($_REQUEST['page']) {
        $s = 0;
        $l = $_REQUEST['limit'];

        if($_REQUEST['page'] > 1) {
            $s = -((($_REQUEST['page'] - 1) * $_REQUEST['limit'])-1);
            $s = ($_REQUEST['page']-1) * $l;
        }
        //echo $s; die;
        $filters['filters'] = array_slice($filters['filters'], $s, $l);
    }*/
    //echo 'callback(' . json_encode($filters) . ');';
    //var_dump($filters);
    $isJsonP = isset($_REQUEST['callback']);

    $data = $filters;
    if ($isJsonP) {
        echo $_REQUEST['callback'] . '(';
    }

    echo json_encode($data);

    if ($isJsonP) {
        echo ');';
    }
    die;
?>
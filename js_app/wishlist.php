<?php
    /*$wishlist = array(
        'wishlist' => array(
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
        $wishlist['wishlist'][] = array(
            'id' => $i,
            'name' => $pName,
            'price' => $i * 10,
            ''
        );
    }
    //var_dump($_REQUEST);die;
    if(isset($_REQUEST['s'])) {
        //var_dump($wishlist['wishlist'][79]);die;
        //var_dump($wishlist['wishlist']);
        $wishlistFound = array();
        foreach ($wishlist['wishlist'] as $k => $v) {
            $key = array_search($_REQUEST['s'], $v); // $key = 2;

            if($key !== false){
                $wishlistFound[] = $v;
            }
        }
        if(count($wishlistFound) > 0)
        {
            $wishlist['wishlist'] =   $wishlistFound;
        }
    }

    $wishlist['num_rows'] = count($wishlist['wishlist']);
    //var_dump($_REQUEST);
    if($_REQUEST['page']) {
        $s = 0;
        $l = $_REQUEST['limit'];

        if($_REQUEST['page'] > 1) {
            $s = -((($_REQUEST['page'] - 1) * $_REQUEST['limit'])-1);
            $s = ($_REQUEST['page']-1) * $l;
        }
        //echo $s; die;
        $wishlist['wishlist'] = array_slice($wishlist['wishlist'], $s, $l);
    }
    //echo 'callback(' . json_encode($wishlist) . ');';
    //var_dump($wishlist);
    $isJsonP = isset($_REQUEST['callback']);

    $data = $wishlist;
    if ($isJsonP) {
        echo $_REQUEST['callback'] . '(';
    }

    echo json_encode($data);

    if ($isJsonP) {
        echo ');';
    }
    die;
?>
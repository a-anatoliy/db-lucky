<?php
return array(
    'site' => array(
        'url'     => 'http://lucky-dress.eu/',
    	'defLang' => 'pl',
        'imgIndex' => '/data/imgIndex.csv',
     // how many articles do we have to show on the blog initial page
        'famsCount' => 2,   // famous art count
        'dresCount' => 2,   // dresses
        'blogCount' => 2,   // blogs
    ),
    'stat' => array(
        'OK_mail'   => '/data/ok_requests.txt',
        'FAIL_mail' => '/data/bad_requests.txt',
        'hits'      => '/data/hitcount.txt',
    ),
    'mediaDirs' => array(
            "other"=>"_other",
             "misc"=>"_design",
              "g18"=>"2018",
              "g17"=>"2017"),
);

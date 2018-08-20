<?php
$client_id    = '5e792d2ebd9c4ddf83025e86206caa73';
$access_token = '5839170089.5e792d2.9b812c5852d645f6ac56e90ac8a06a0c';
$user_id      = '5839170089'; // Цифры идущие до первой точки в ACCESS_TOKEN

$res = file_get_contents('https://api.instagram.com/v1/users/' . $user_id . '/media/recent/?client_id=
' . $client_id . '&access_token=' . $access_token . '&count=5');

$res = json_decode($res, true);
if (!empty($res['data'])) {
    //var_dump($res['data']);

    foreach($res['data'] as $row) {
        // Можно вывести фото на странице:
        echo '<img src="' . $row['images']['standard_resolution']['url'] . '">';

// Или сохранить файл на сервере:
/*
        $url = $row['images']['standard_resolution']['url'];
        $url = explode('?', $url);
        $ext = mb_strtolower(mb_substr(mb_strrchr($url[0], '.'), 1));
        $file = $row['id'] . '.' . $ext;
        copy($row['images']['standard_resolution']['url'], __DIR__ . '/instagram/' . $file);
*/
    }
}

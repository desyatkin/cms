<?
/*
|-------------------------------------------------------------------------------
| Получение и вывод ссылок сапы
|-------------------------------------------------------------------------------
*/

// Sape-магия начало....
$host = "polishnews.ru";
//$charset = "windows-1251";
$charset = "utf-8";

$params = "&check1=".urlencode($_SERVER['HTTP_USER_AGENT'])."&check2=".urlencode($_SERVER['REMOTE_ADDR']);
if(function_exists('curl_init'))
{
  if($ch = @curl_init()) {
    @curl_setopt($ch, CURLOPT_URL, "http://slinks.su/get_links.php?url=".urlencode($_SERVER['REQUEST_URI']).$params."&host=$host&charset=$charset");
    @curl_setopt($ch, CURLOPT_HEADER, false);
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    if ($data = @curl_exec($ch)) {
      $sapeLinks = $data;
    }
    @curl_close($ch);
  }
} else {
  $timeout = ini_get('default_socket_timeout');
  ini_set('default_socket_timeout', 3);
  $sapeLinks = @file_get_contents("http://slinks.su/get_links.php?url=".urlencode($_SERVER['REQUEST_URI']).$params."&host=$host&charset=$charset");
  ini_set('default_socket_timeout', $timeout);
}
// Конец колдунства.

// Выводим, что наколдовали.
echo '<div class="sape">';
echo '<h2>Реклама:</h2>' . $sapeLinks . '<br><br>';
echo '</div>';
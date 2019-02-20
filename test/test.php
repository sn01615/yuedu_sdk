<?php
use Yuedu\Book\Client;

include './vendor/autoload.php';

$client = new Client(false);
$client->setConsumerKey('??');
$client->setConsumerSecret('??');

/* print_r($client->add([
 'categoryId' => 16,
 'bookKey' => 123456,
 'title' => '哈哈哈',
 'url' => 'http://www.baidu.com/',
 'keyName' => '耽美,同人',
 'vipPrice' => null,
 'payType' => 0,
 'price' => 6,
 'coverPic' => file_get_contents('http://php.net/images/logos/php-logo.svg'),
 'coverUrl' => 'https://bdimg.baidu.com/logo.png',
 'author' => '豆腐',
 'publisher' => '',
 'authorDesc' => '',
 'isbn' => '',
 'status' => 0,
 'publishTime'
 ])); */
/* print_r($client->update([
 # 'bookId' => 'ts_6644bf088ff34889bd67a3132c65ff5e_4',
 'bookKey' => 123456,
 'categoryId' => 16,
 'title' => '哈哈哈',
 'description' => '哈哈哈22',
 'url' => 'http://www.baidu.com/',
 'keyName' => '耽美,同人',
 'vipPrice' => null,
 'payType' => 0,
 'price' => 6,
 'coverPic' => file_get_contents('http://php.net/images/logos/php-logo.svg'),
 'coverUrl' => 'https://bdimg.baidu.com/logo.png',
 'author' => '豆腐',
 'publisher' => '',
 'authorDesc' => '',
 'isbn' => '',
 'status' => 0,
 'publishTime' => microtime(true)
 ])); */
print_r($client->getList([]));
/* print_r($client->info([
 'bookKey' => 123456
 ])); */
/* print_r($client->sections([
 'bookKey' => 123456
 ])); */
/* print_r($client->content([
 'bookKey' => 123456
 ])); */
// print_r($client->chapterAdd([]));
// print_r($client->chapterUpdate([]));
// print_r($client->chapterDelete([]));
// print_r($client->sectionAdd([]));
// print_r($client->sectionUpdate([]));
// print_r($client->sectionDelete([]));




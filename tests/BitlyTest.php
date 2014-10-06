<?php

use Pep\Bitly\BitlyClient;
use Pep\Bitly\BitlyRequest\BitlyLinks;
use Pep\Bitly\BitlyRequest\BitlyData;



class BitlyTest extends PHPUnit_Framework_TestCase {

  public function testGetResourceToken() {
    if (file_exists(__DIR__ . '/testuser.php')) {
      $testUser = require_once(__DIR__ . '/testuser.php');
    } else {
      throw new Exception('No testUser');
    }
    $bitly = new BitlyClient($testUser['client_id'], $testUser['client_secret']);

    $accessToken = $bitly->getAccessTokenViaResourceOwner($testUser['username'], $testUser['password']);

    $this->assertEquals(strlen($accessToken), 40);

    return $accessToken;
  }

  public function testGetBasicToken() {
    if (file_exists(__DIR__ . '/testuser.php')) {
      $testUser = require_once(__DIR__ . '/testuser.php');
    } else {
      throw new Exception('No testUser');
    }
    $bitly = new BitlyClient($testUser['client_id'], $testUser['client_secret']);

    $accessToken = $bitly->getAccessTokenViaBasicAuth($testUser['username'], $testUser['password']);

    $this->assertEquals(strlen($accessToken), 40);
  }

  public function testHighValue() {
    $data = BitlyData::getHighValue([
      'access_token' => '7ef2c4e3aa8b746389a676970f068c6001cdc61e',
      'limit' => 10,
    ]);

    $this->assertEquals($data->params->limit, 10);
  }

  public function testSearch() {
    $data = BitlyData::search([
      'access_token' => '7ef2c4e3aa8b746389a676970f068c6001cdc61e',
      'limit' => 10,
      'query' => 'aap',
    ]);
  }

  public function testBurstingPhrases() {
    $data = BitlyData::getRealtimeBurstingPhrases([
      'access_token' => '7ef2c4e3aa8b746389a676970f068c6001cdc61e',
    ]);
  }

  public function testHotPhrases() {
    $data = BitlyData::getRealtimeHotPhrases([
      'access_token' => '7ef2c4e3aa8b746389a676970f068c6001cdc61e',
    ]);
  }

  public function testClickRate() {
    $data = BitlyData::getRealtimeClickRate([
      'access_token' => '7ef2c4e3aa8b746389a676970f068c6001cdc61e',
      'phrase' => 'obama',
    ]);
  }

  public function testLinkInfo() {
    $data = BitlyData::getLinkInfo([
      'access_token' => '7ef2c4e3aa8b746389a676970f068c6001cdc61e',
      'link' => 'http://bit.ly/1puqiok',
    ]);
  }

  public function testExpand() {
    $data = BitlyLinks::expand([
      'access_token' => '7ef2c4e3aa8b746389a676970f068c6001cdc61e',
      'hash' => '1vGYRM8',
    ]);
  }

  public function testShorten() {
    $data = BitlyLinks::shorten([
      'access_token' => '7ef2c4e3aa8b746389a676970f068c6001cdc61e',
      'longUrl' => 'http://bekokstooft.nl?test',
      'domain' => 'j.mp',
    ]);
  }

}
<?php

use Pep\Bitly\BitlyClient;
use Pep\Bitly\BitlyRequest\BitlyLinks;
use Pep\Bitly\BitlyRequest\BitlyData;

class BitlyTest extends PHPUnit_Framework_TestCase {

  private $testUser = [
    'client_id' => 'bde6ac738d68e1c3dee7a41369c313250c7046c3',
    'client_secret' => '37891aa1b46b56b2179a1fda8d3d9af9274f016c',
    'redirect_uri' => 'http://honor.np-shared.nl/bitly_callback',
    'username' => 'noprotocol1',
    'password' => 'XyfqVKmCqynl',
  ];

  public function testGetResourceToken() {
    $bitly = new BitlyClient($this->testUser['client_id'], $this->testUser['client_secret']);

    $accessToken = $bitly->getAccessTokenViaResourceOwner($this->testUser['username'], $this->testUser['password']);

    $this->assertEquals(strlen($accessToken), 40);

    var_dump($accessToken);die;

    return $accessToken;
  }

  public function testGetBasicToken() {
    $bitly = new BitlyClient($this->testUser['client_id'], $this->testUser['client_secret']);

    $accessToken = $bitly->getAccessTokenViaBasicAuth($this->testUser['username'], $this->testUser['password']);

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
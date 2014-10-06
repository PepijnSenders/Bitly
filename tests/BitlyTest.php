<?php

use Pep\Bitly;

class BitlyTest extends PHPUnit_Framework_TestCase {

  private $testUser = [
    'client_id' => 'bde6ac738d68e1c3dee7a41369c313250c7046c3',
    'client_secret' => '37891aa1b46b56b2179a1fda8d3d9af9274f016c',
    'redirect_uri' => 'http://honor.np-shared.nl/bitly_callback',
    'username' => 'noprotocol1',
    'password' => 'XyfqVKmCqynl',
  ];

  public function testGetResourceToken() {
    $bitly = new Bitly($this->testUser['client_id'], $this->testUser['client_secret']);

    $this->assertInstanceOf($bitly, );
  }

}
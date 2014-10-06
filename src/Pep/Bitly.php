<?php

namespace Pep;

use Guzzle\Http\Client;

class Bitly {

  const SECURE_API = 'https://api-ssl.bit.ly';
  const API = 'http://api.bit.ly';

  private $clientId;
  private $clientSecret;
  private $redirectUri;

  private $client;

  public function __construct($clientId, $clientSecret, $redirectUri = "") {
    $this->clientId;
    $this->clientSecret;
    $this->redirectUri;
  }

  private function getSecureClient() {
    $client = new Client(self::SECURE_API);

    return $client;
  }

  private function getClient() {
    $client = new Client(self::API);

    return $client;
  }

  public function getAccessTokenResourceOwner($username, $password) {
    $client = $this->getSecureClient();

    $authorization = base64_encode("$username:$password");

    $request = $client->post('/oauth/access_token', [
      'headers' => [
        'Authorization' => "Basic {$authorization}",
      ],
      'body' => [
        'client_id' => $this->clientId,
        'client_secret' => $this->clientSecret,
      ],
    ]);

    $response->send();

    return $response;
  }

}
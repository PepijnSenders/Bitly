<?php

namespace Pep\Bitly;

use Guzzle\Http\Client;

use Pep\Bitly\BitlyRequest\BitlyRequest;

class BitlyClient {

  const SECURE_API = 'https://api-ssl.bit.ly';
  const API = 'http://api.bit.ly';
  const VERSION = 'v3';

  private $clientId;
  private $clientSecret;
  private $redirectUri;

  public function __construct($clientId, $clientSecret, $redirectUri = "") {
    $this->clientId = $clientId;
    $this->clientSecret = $clientSecret;
    $this->redirectUri = $redirectUri;
  }

  public static function getSecureClient() {
    $client = new Client(self::SECURE_API);

    return $client;
  }

  public static function getClient() {
    $client = new Client(self::API);

    return $client;
  }

  public function getAccessTokenViaBasicAuth($username, $password) {
    $client = self::getSecureClient();

    $authorization = base64_encode("{$username}:{$password}");

    $request = $client->post('/oauth/access_token')
                      ->addHeader('Authorization', "Basic {$authorization}")
                      ->addHeader('Content-Type', 'application/x-www-form-urlencoded')
                      ->setBody("client_id={$this->clientId}&client_secret={$this->clientSecret}");

    $response = $request->send();
    $jsonString = (string) $response->getBody();

    $body = json_decode($jsonString);

    if ($body && property_exists($body, 'status_txt')) {
      BitlyRequest::throwBitlyError($body->status_txt);
    }

    return $jsonString;
  }

  public function getAccessTokenViaResourceOwner($username, $password) {
    $client = self::getSecureClient();

    $authorization = base64_encode("{$this->clientId}:{$this->clientSecret}");

    $request = $client->post('/oauth/access_token')
                      ->addHeader('Authorization', "Basic {$authorization}")
                      ->addHeader('Content-Type', 'application/x-www-form-urlencoded')
                      ->setBody("grant_type=password&username={$username}&password={$password}");

    $response = $request->send();
    $jsonString = (string) $response->getBody();

    $body = json_decode($jsonString);

    if (property_exists($body, 'status_txt')) {
      BitlyRequest::throwBitlyError($body->status_txt);
    }

    if (property_exists($body, 'access_token')) {
      return $body->access_token;
    } else {
      throw new BitlyRequestException('Invalid request.');
    }
  }

}
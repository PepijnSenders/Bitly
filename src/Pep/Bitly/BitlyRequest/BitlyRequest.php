<?php

namespace Pep\Bitly\BitlyRequest;

use Pep\Bitly\BitlyClient;

class BitlyRequest {

  public static function throwBitlyError($errorCode) {
    switch ($errorCode) {
      case 'INVALID_CLIENT_ID':
        throw new BitlyRequestException("Client ID, $this->clientId, is invalid.");
      case 'INVALID_CLIENT_SECRET':
        throw new BitlyRequestException("Client secret, $this->clientSecret, is invalid.");
      case 'INVALID_LOGIN':
        throw new BitlyRequestException('Login with given credentials has failed.');
      case 'RATE_LIMIT_EXCEEDED':
        throw new BitlyRequestException('Rate limit exceeded');
      case 'MISSING_ARG_LIMIT':
        throw new BitlyRequestException('Missing argument Limit');
      case 'MISSING_ARG_PHRASE':
        throw new BitlyRequestException('Missing argument Phrase');
      case 'MISSING_ARG_LINK':
        throw new BitlyRequestException('Missing argument Link');
      case 'MISSING_ARG_SHORTURL_OR_HASH':
        throw new BitlyRequestException('Missing argument Short Url or Hash');
      case 'MISSING_ARG_URI':
        throw new BitlyRequestException('Missing argument URI');
      case 'INVALID_URI':
        throw new BitlyRequestException('Invalid URI');
      case 'OK':
        break;
      default:
        throw new BitlyRequestException("Invalid request: $errorCode");
    }
  }

  public static function bitlyGet($url, array $params) {
    $client = BitlyClient::getSecureClient();

    $request = $client->get("/v3/$url");

    $query = $request->getQuery();

    foreach ($params as $key => $value) {
      $query->set($key, $value);
    }

    $response = $request->send();
    $jsonString = (string) $response->getBody();

    $body = json_decode($jsonString);

    if ($body && property_exists($body, 'status_txt')) {
      self::throwBitlyError($body->status_txt);
    }

    if ($body && property_exists($body, 'data')) {
      return $body->data;
    } else {
      throw new BitlyRequestException('Invalid request.');
    }
  }

}
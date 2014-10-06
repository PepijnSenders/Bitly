<?php

namespace Pep\Bitly\BitlyRequest;

class BitlyLinks extends BitlyRequest {

  public static function expand(array $options) {
    $data = self::bitlyGet('/expand', $options);

    return $data;
  }

  public static function shorten(array $options) {
    $data = self::bitlyGet('/shorten', $options);

    return $data;
  }

}
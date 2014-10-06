<?php

namespace Pep\Bitly\BitlyRequest;

class BitlyData extends BitlyRequest {

  public static function getHighValue(array $options) {
    $data = self::bitlyGet('/highvalue', $options);

    return $data;
  }

  public static function search(array $options) {
    $data = self::bitlyGet('/search', $options);

    return $data;
  }

  public static function getRealtimeBurstingPhrases(array $options) {
    $data = self::bitlyGet('/realtime/bursting_phrases', $options);

    return $data;
  }

  public static function getRealtimeHotPhrases(array $options) {
    $data = self::bitlyGet('/realtime/hot_phrases', $options);

    return $data;
  }

  public static function getRealtimeClickRate(array $options) {
    $data = self::bitlyGet('/realtime/clickrate', $options);

    return $data;
  }

  public static function getLinkInfo(array $options) {
    $data = self::bitlyGet('/link/info', $options);

    return $data;
  }

}
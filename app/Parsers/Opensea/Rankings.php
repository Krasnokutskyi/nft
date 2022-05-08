<?php

namespace App\Parsers\Opensea;

class Rankings
{

  private string $url = 'https://opensea.io/rankings';

  private string $header = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36';

  private array $content = [];
  
  function __construct()
  {
    $this->content = $this->parse();
  }

  public function parse(): array
  {
    $context = stream_context_create([
      'http' => ['header' => $this->header],
    ]);

    $rankings_page = file_get_contents($this->url, false, $context);

    if (is_string($rankings_page)) {

      $json_string = mb_substr($rankings_page, mb_strpos($rankings_page, 'window.__wired__=') + mb_strlen('window.__wired__='));
      $json_string = substr($json_string, 0, strpos($json_string, "</script>"));

      $content = json_decode(trim($json_string), true);
      if (is_array($content)) {
        return array_shift($content);
      }
    }

    return [];
  }

  public function reestablish($array)
  {
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $array[$key] = $this->reestablish($value);
      } else {
        if ($key === '__ref' and array_key_exists($value, $this->content)) {
          if (is_array($this->content[$value])) {
            return $this->reestablish($this->content[$value]);
          } else {
            return $this->content[$value];
          }
        } else {

          $array[$key] = $value;
        } 
      }
    }

    return $array;
  }

  public function get(int $max_row = 1): array
  {
    $collection = [];

    foreach ($this->content as $key => $value) {

      if (is_array($value)) {
        if (array_key_exists('name', $value) and array_key_exists('id', $value)) {
          $collection[$key] = $this->reestablish($value);
        }
      }
    }

    return array_slice($collection, 0, $max_row);
  }
}

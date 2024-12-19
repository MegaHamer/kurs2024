<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\BaseJson;

class RequestPutComponent extends Component
{
  public function getAll()
  {
    if (Yii::$app->request->method != "PUT") {
      return [];
    }

    $raw_data = file_get_contents('php://input');
    // if (\yii\helpers\BaseJson::isJson($raw_data))
    try{
      $json = BaseJson::decode($raw_data);
      return $json;
    }catch(\Exception $e){
    }
    
    if (empty($raw_data)) {
      return [];
    }

    $boundary = substr($raw_data, 0, strpos($raw_data, "\r\n"));
    // Fetch each part
    // var_dump($raw_data);
    // return;
    $parts = array_slice(explode($boundary, $raw_data), 1);
    $data = array();

    foreach ($parts as $part) {
      // If this is the last part, break
      if ($part == "--\r\n")
        break;

      // Separate content from headers
      $part = ltrim($part, "\r\n");
      list($raw_headers, $body) = explode("\r\n\r\n", $part, 2);

      // Parse the headers list
      $raw_headers = explode("\r\n", $raw_headers);
      $headers = array();
      foreach ($raw_headers as $header) {
        list($name, $value) = explode(':', $header);
        $headers[strtolower($name)] = ltrim($value, ' ');
      }

      // Parse the Content-Disposition to get the field name, etc.
      if (isset($headers['content-disposition'])) {
        $filename = null;
        preg_match(
          '/^(.+); *name="([^"]+)"(; *filename="([^"]+)")?/',
          $headers['content-disposition'],
          $matches
        );
        list(, $type, $name) = $matches;
        isset($matches[4]) and $filename = $matches[4];

        // if file
        $ctype = @$headers['content-type'];
        if ($ctype) {

          // $image = array();
          // $image["name"] = basename($filename);
          // $image["full_path"] = $filename;
          // $image["type"] = $ctype;
          // $file = new TmpFile($body, false);
          // $image["tmp_name"] = ($file)->getFilename();
          // $image["size"] = filesize($image["tmp_name"]);
          // $image["error"] = 0;

          $data[$name] = new TmpFile($filename, $body);
        } else {
          $data[$name] = substr($body, 0, strlen($body) - 2);
        }

      }

    }
    return $data;
    // var_dump($data);
  }

  public function getParams($names = null)
  {
    $all = self::getAll();
    $variables = array_filter($all, function ($val) {
      return !is_array($val);
    });
    if (is_null($names)) {
      return $variables;
    } elseif (is_string($names)) {
      return $variables[$names];
    } elseif (is_array($names)) {
      foreach ($variables as $key => $value) {
        if (!in_array($key, $names)) {
          unset($variables[$key]);
        }
      }
      return $variables;
    }
    return [];
  }
  public function getFiles($names = null)
  {
    $all = self::getAll();
    $files = array_filter($all, function ($val) {
      return is_array($val) || is_object($val);
    });
    if (is_null($names)) {
      return $files;
    } elseif (is_string($names)) {
      return $files[$names];
    } elseif (is_array($names)) {
      foreach ($files as $key => $value) {
        if (!in_array($key, $names)) {
          unset($files[$key]);
        }
      }
      return $files;
    }
    return [];
  }
}
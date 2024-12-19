<?php
namespace app\components;

use ArrayAccess;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class TmpFile extends Component implements ArrayAccess
{
    private string $filename;
    private \Closure $handler;

    public $name, $tmp_name, $type,
    $size, $error, $full_path;

    public function __construct($name, $body)
    {
        $this->filename = tempnam(sys_get_temp_dir(), 'php');

        if (false === $this->filename) {
            throw new Exception("tempnam() couldn't create a temp file.");
        }

        $this->handler = static function (string $filename): void {
            if (file_exists($filename)) {
                unlink($filename);
            }
        };

        if (!is_null($body)) {
            $handle = fopen($this->filename, "w");
            fwrite($handle, $body);
            fclose($handle);
        }

        $filepath = $this->filename;
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);

        // $image["name"] = basename($name);
        // $image["full_path"] = $name;
        // $image["type"] = $ctype;
        // $file = new TmpFile($body, false);
        // $image["tmp_name"] = ($file)->getFilename();
        // $image["size"] = filesize($filepath);
        // $image["error"] = 0;

        $this->name = basename($name);
        $this->full_path = $name;
        $this->type = $filetype;
        $this->tmp_name = $filepath;
        $this->size = filesize($filepath);
        $this->error = 0;

        register_shutdown_function($this->handler, $this->filename);
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function __toString(): string
    {
        return $this->filename;
    }

    public function __destruct()
    {
        ($this->handler)($this->filename);
    }

    public static function destroy($tmp_name)
    {
        if (file_exists($tmp_name)) {
            return unlink($tmp_name);
        }
        return false;
    }

    public function saveAs($file)
    {
        $targetFile = Yii::getAlias($file);

        return copy($this->filename, $targetFile);
    }

    public function __debugInfo()
    {
        return [
            'name' => $this->name,
            'full_path' => $this->full_path,
            'type' => $this->type,
            'tmp_name' => $this->tmp_name,
            'size' => $this->size,
            'error' => $this->error,
        ];
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
        } else {
            $this->{$offset} = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->{$offset});
    }

    public function offsetUnset($offset): void
    {
        unset($this->{$offset});
    }

    public function offsetGet($offset): mixed
    {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }

}
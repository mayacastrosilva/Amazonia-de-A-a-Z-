<?php

namespace Eva\Core\Configure;

use Eva\Core\Configure\Exceptions\BadContentException;
use Eva\Core\Configure\Exceptions\FileNotFoundException;
use Eva\Core\Configure\Exceptions\InvalidArgumentException;
use Eva\Core\Configure\Exceptions\InvalidPathException;
use Eva\Core\Configure\Exceptions\KeyNotFoundException;


class Config {
    /**
     * Configuration file name
     *
     * @var string
     */
    private $file = 'app.php';

    /**
     * Configuration directory path
     *
     * @var string
     */
    private $directory;

    /**
     * Configuration file content
     *
     * @var array
     */
    private $content;


    private $path;


    public function __construct($path)
    {
        $this->directory = $_SERVER['DOCUMENT_ROOT'] . '/' . 'config';
        $this->path = $path;
    }

    /**
     * Get (fetch) data from configuration file
     * Parameters are optional
     *
     * @return array|string : specified value or array of values
     *
     * @throws \Eva\Core\Configure\Exceptions\KeyNotFoundException
     */
    public function get()
    {

        $this->load();
        $r = $this->content;
        /*foreach (func_get_args() as $arg) {
            if (isset($r[$arg])) {
                $r = $r[$arg];
            } else {
                throw new KeyNotFoundException();
            }
        }*/
        if(!is_null($this->path))
        {
            $paths = explode('.', $this->path);
            if(count($paths) > 1)
            {
                $a = $r;
                foreach ($paths as $path) {
                    $value = $a[$path];
                    $a = $value;
                }
                return $value;
            } else {
                return $r[$this->path];
            }

        } else {
            return $r;
        }

    }

    /**
     * Load config file
     *
     * @throws BadContentException
     * @throws FileNotFoundException
     */
    private function load() {
        if (!is_array($this->content)) {
            $file = $this->directory . DIRECTORY_SEPARATOR . $this->file;
            if (!file_exists($file) || is_dir($file)) {
                throw new FileNotFoundException();
            }
            /** @noinspection PhpIncludeInspection */
            $content = include $file;
            if (!is_array($content)) {
                throw new BadContentException();
            }
            $this->content = $content;
        }
    }

    /**
     * @return string
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @param string $file
     *
     * @throws InvalidArgumentException
     */
    public function setFile($file) {
        if (!isset($file) || !is_string($file)) {
            throw new InvalidArgumentException("File must be a string value");
        }
        $this->file = $file;
    }

    /**
     * Set and get the config file path
     *
     * @param null|string $path : Configuration file path
     *
     * @return bool|string : path (string) or success (bool)
     * @throws InvalidPathException
     */
    public function path($path = null) {
        if (!is_null($path)) {
            if (!is_string($path)) {
                throw new InvalidArgumentException("Path must be a string value");
            }
            if (!file_exists($path) || is_dir($path)) {
                throw new InvalidPathException("Path must be a real file path");
            }
            $this->setDirectory(dirname($path));
            $this->setFile(basename($path));
            return true;
        } else {
            if (is_null($this->directory) && is_null($this->file)) {
                return null;
            }
            $path = "";
            if (!is_null($this->directory)) {
                $path .= $this->directory . DIRECTORY_SEPARATOR;
            }
            if (!is_null($this->file)) {
                $path .= $this->file;
            }
            return $path;
        }
    }

    /**
     * @return string
     */
    public function getDirectory() {
        return $this->directory;
    }

    /**
     * @param string $directory
     *
     * @throws InvalidArgumentException
     */
    public function setDirectory($directory) {
        if (!isset($directory) || !is_string($directory)) {
            throw new InvalidArgumentException("Directory must be a string value");
        }
        $this->directory = $directory;
    }

}
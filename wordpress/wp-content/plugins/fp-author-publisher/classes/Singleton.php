<?php

namespace BooksPlugin;

/**
 * SIngleton
 */
abstract class Singleton {

    /**
     * @var static $instance
     */
    protected static $instance;

    /**
     *
     */
    abstract protected function __construct();

    /**
     * @return void to make sure not to clone
     */
    private function __clone()
    {

    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (!static::$instance) {


            static::$instance = new static();

        }

        return static::$instance;

    }

}
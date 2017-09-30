<?php

function ideothemo_less_cache_init()
{
    $GLOBALS['ideo_less_cache'] = new IdeoThemo_Less_Cache();
}

function ideothemo_less_cache_get()
{
    global $ideo_less_cache;

    return $ideo_less_cache->get();
}

function ideothemo_less_cache_add($less)
{
    global $ideo_less_cache;

    return $ideo_less_cache->add($less);
}

class IdeoThemo_Less_Cache
{

    private $less_string = array();
    private $less_files = array();

    public function add($less)
    {
        if ($less != '') $this->less_string[] = $less;
        return true;
    }

    public function addFile($file)
    {
        $this->less_files[] = $file;
    }

    public function get($less)
    {
        return $this->less_string;
    }
}

ideothemo_less_cache_init();
<?php

function ideothemo_global_vars_init()
{
    $GLOBALS['ideo_global_vars'] = new IdeoThemo_Global_Vars();
}

function ideothemo_global_vars_get($key)
{
    global $ideo_global_vars;

    return $ideo_global_vars->get($key);
}

function ideothemo_global_vars_add($key, $value)
{
    global $ideo_global_vars;

    return $ideo_global_vars->add($key, $value);
}

function ideothemo_timestart($id)
{
    global $ideo_global_vars;

    return $ideo_global_vars->add('time_start_' . $id, microtime(true));
}

function ideothemo_timeend($id, $echo = true, $addtotal = true)
{
    global $ideo_global_vars;

    $time_end = microtime(true);
    $time = $time_end - $ideo_global_vars->get('time_start_' . $id);

    $time_ends = is_array($ideo_global_vars->get('time_ends')) ? $ideo_global_vars->get('time_ends') : array();

    $time_ends[] = '<li>' . $id . ': <strong style="' . ($time > 0.01 ? 'color:red;' : '') . '">' . $time . '</strong></li>';

    $ideo_global_vars->add('time_ends', $time_ends);

    if ($addtotal) $ideo_global_vars->add('total_time', $ideo_global_vars->get('total_time') + $time);

    if ($echo && $time > 0.01) echo '<span class="dev" style="display:inline !important; position:relative !important;"><span style="display:inline !important; position:absolute !important; font-size:10px; z-index:2;background:#eee;">' . $id . ': <strong style="' . ($time > 0.1 ? 'color:red;' : '') . '">' . $time . '</strong></span></span>';
}

class IdeoThemo_Global_Vars
{

    private $global_vars = array();


    public function add($key, $value)
    {
        $this->global_vars[$key] = $value;
        return true;
    }

    public function get($key = '')
    {
        if (isset($this->global_vars[$key])) {
            return $this->global_vars[$key];
        } else {
            return 0;
        }

    }
}

ideothemo_global_vars_init();
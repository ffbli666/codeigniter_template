<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class API_Controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

    }

    protected function _error($msg, $result = "")
    {
        $ret = array('status' => 'ERROR', 'msg' => $msg);
        if ($result)
        {
            $ret['result'] = $result;
        }
        return json_encode($ret);
    }

    protected function _success($msg, $result = "")
    {
        $ret = array('status' => 'OK', 'msg' => $msg);
        if ($result)
        {
            $ret['result'] = $result;
        }
        return json_encode($ret);
    }
}

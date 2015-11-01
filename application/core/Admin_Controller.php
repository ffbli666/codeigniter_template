<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

    protected $user = null;
    protected $data = array ( 'sidebar' => array( 'dashboard' => '',
                                                  'group'     => '',
                                                  'user'      => '',
                                                  'system'    => ''
                                              ),
                              'html_breadcrumb' => '',
                              'html_js'         => ''
                            );
    protected $pre_url = "";
    public function __construct()
    {
        parent::__construct();
        $this->user = $this->auth_model->is_login();
        if (!$this->user)
        {
            redirect('/login');
        }
        $this->data['account'] = $this->user['account'];
        $this->pre_url = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
    }

    protected function _set_sidebar($active)
    {
        $this->data['sidebar'][$active] = 'active';
    }

    protected function _set_breadcrumb($list=null)
    {
        if (!$list)
        {
            return;
        }
        $html = "<ol class='breadcrumb'>";
        $count = count($list);
        for ($i = 0; $i < $count; $i++)
        {
            $item = $list[$i];
            if ($i == ($count - 1))
            {
                $html .= "<li class='active'>{$item['title']}</li>";
            }
            else
            {
                $html .= "<li><a href='{$item['url']}'>{$item['title']}</a></li>";
            }
        }
        $html .= "</ol>" ;
        $this->data['html_breadcrumb'] = $html;
    }
}

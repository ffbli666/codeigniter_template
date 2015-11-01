<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Pagination {
    private function _get_limit($page, $page_num)
    {
        $page = ($page <= 0) ? 0 : $page;
        $start = ($page >= 1) ? ($page - 1) * $page_num : 0;
        return "LIMIT $start, $page_num";
    }

    public function sql_execute($db, $sql = '', $data = null, $page = 1, $page_num = 10)
    {
        $find_select = stripos($sql, "select");
        if (preg_match('/^select/i', $sql) <= 0)
            return null;
        $new_sql = "SELECT SQL_CALC_FOUND_ROWS " . substr($sql, 6) . " " . $this->_get_limit($page, $page_num);
        $query = $db->prepare($new_sql);
        if ($data)
        {
            $query->execute($data);
        }
        else
        {
            $query->execute();
        }
        $result = $query->fetchAll();
        $total_rows = $db->query('SELECT FOUND_ROWS()')->fetchColumn();
        return array ("data" => ($result) ? $result : null,
                      "total_rows" => $total_rows);
    }

    public function html($url = '', $page = 1, $page_num = 10, $total_rows = 0)
    {
        if ($total_rows <= $page_num)
        {
            return '';
        }
        $page = ($page < 1) ? 1 : $page;
        $start = (($page - 2) < 1) ? 1 : ($page - 2);
        $end_page = ceil($total_rows / $page_num);
        $end = (($page + 2) > $end_page) ? $end_page : ($page + 2);

        $purl = strpos($url, '?') ? $url . '&' : $url . '?';
        $p = '';
        for($i = $start ; $i <= $end ; $i++)
        {
            if ($i == $page)
            {
                $class = 'active';
                $href = '#';
            }
            else
            {
                $class = '';
                $href = $purl . "page=$i";
            }
            $p .= "<li class='$class' ><a href='$href'>$i</a></li>";
        }

        $first_url = $url;
        $pre = (($page - 1) < 1) ? 1 : ($page - 1);
        $pre_url = $purl . "page=$pre";
        $next = (($page + 1) > $end_page) ? $end_page : ($page + 1);
        $next_url = $purl . "page=$next";
        $last_url = $purl . "page=$end_page";
        $html = "
<nav>
  <ul class='pagination'>
    <li title='First' ><a href='$first_url'><span aria-hidden='true'>&laquo;</span></a></li>
    <li title='Previous'><a href='$pre_url'><span aria-hidden='true'>&lsaquo;</span></a></li>
    $p
    <li title='Next'><a href='$next_url'><span aria-hidden='true'>&rsaquo;</span></a></li>
    <li title='Last'><a href='$last_url'><span aria-hidden='true'>&raquo;</span></a></li>
  </ul>
</nav>
";
        return $html;
    }
}
/* End of file Someclass.php */
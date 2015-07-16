<?php
/**
 * Обработка запроса при клике на ссылку всплывающей рекламы
 *
 */

if (!defined('DIAFAN')) {
    $path = __FILE__; $i = 0;
    while (!file_exists($path.'/includes/404.php'))	{
        if ($i == 10) exit; $i++;
        $path = dirname($path);
    }
    include $path.'/includes/404.php';
}

/**
 * Pbs_action
 */
class Pbs_action extends Action
{
    /**
     * Обрабатывает полученные данные из формы
     *
     * @return void
     */
    public function init()
    {
        if (!empty($_POST['pbs_id'])) {
            $row = DB::query_fetch_array("SELECT * FROM {pbs} WHERE id=%d LIMIT 1", $_POST['pbs_id']);
            if (!$row) {
                return;
            }
            if ($row['check_click'] && $row['show_click']) {
                DB::query("UPDATE {pbs} SET click=click+1, show_click=show_click-1 WHERE id=%d", $row['id']);
            } else {
                DB::query("UPDATE {pbs} SET click=click+1 WHERE id=%d", $row['id']);
            }
            $this->result["result"] = "success";
        }
    }
}

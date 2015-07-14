<?php
/**
 * Модель
 *
 */

if (!defined('DIAFAN')) {
    $path = __FILE__; $i = 0;
    while (!file_exists($path.'/includes/404.php'))	{
        if($i == 10) exit; $i++;
        $path = dirname($path);
    }
    include $path.'/includes/404.php';
}

/**
 * Pbs_model
 */
class Pbs_model extends Model
{
    /**
     * Генерирует данные для шаблонной функции: всплывающая реклама
     *
     * @param integer $id идентификатор баннера
     * @return array
     */
    public function show_block($id)
    {
        $time = mktime(date("H"), date("m"), 0);
        if (!empty($id)) {
            $result["rows"] = DB::query_fetch_all("SELECT e.id, e.[name], e.[text], e.time_start, e.start_count"
                    ." FROM {pbs} AS e"
                    ." WHERE e.[act]='1' AND e.trash='0'"
                    ." AND e.id=%d LIMIT 1",
                    $id);
        }
        return $result;
    }
}

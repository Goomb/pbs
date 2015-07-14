<?php
/**
 * Контроллер
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
 * Pbs
 */
class Pbs extends Controller
{
	/**
	 * Шаблонная функция: выводит всплывающую рекламу
	 *
	 * @param array $attributes атрибуты шаблонного тега
	 * id - идентификатор всплывающей рекламы
	 * @return void
	 */
	public function show_block($attributes)
	{
        $attributes = $this->get_attributes($attributes, 'id');
        $id   = intval($attributes["id"]);
        $result = $this->model->show_block($id);
        echo $this->diafan->_tpl->get('show_block', 'pbs', $result["rows"]);
	}
}

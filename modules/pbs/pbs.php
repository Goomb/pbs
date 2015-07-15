<?php
/**
 * Контроллер
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
 * Pbs
 */
class Pbs extends Controller
{
	/**
	 * Шаблонная функция: выводит всплывающую рекламу
	 *
	 * @param array $attributes атрибуты шаблонного тега
	 * count - количество выводимых всплывающих реклам. По умолчанию 1. Значение **all** выведет все всплывающие рекламы
	 * id - идентификатор всплывающей рекламы, если задан, атрибут **count** игнорируется
	 * sort - сортировка всплывающей рекламы: по умолчанию как в панели администрирования, **date** – по дате, **rand** – в случайном порядке
	 * cat_id - категория всплывающей рекламы, если в настройках модуля отмечено «Использовать категории»
	 * template - шаблон тега (файл modules/pbs/views/pbs.view.show_block_**template**.php; по умолчанию шаблон modules/pbs/views/pbs.view.show_block.php)
	 *
	 * @return void
	 */
	public function show_block($attributes)
	{
        $attributes = $this->get_attributes($attributes, 'count', 'id', 'sort', 'cat_id', 'template');

        $id = intval($attributes["id"]);
        $sort = (in_array($attributes["sort"], array("date", "rand")) ? $attributes["sort"] : '');
        if ($attributes["count"] === "all") {
            $count = "all";
        } else {
            $count = (intval($attributes["count"]) < 1 ? 1 : intval($attributes["count"]));
        }
        $cat_id = intval($attributes["cat_id"]);

        $result = $this->model->show_block($id, $count, $sort, $cat_id);
        $result["attributes"] = $attributes;

        echo $this->diafan->_tpl->get('show_block', 'pbs', $result["rows"], $attributes["template"]);
	}
}

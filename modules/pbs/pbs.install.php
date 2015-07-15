<?php
/**
 * Установка модуля
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

class Pbs_install extends Install
{
	/**
	 * @var string название
	 */
	public $title = "Всплывающая реклама";

	/**
	 * @var array таблицы в базе данных
	 */
	public $tables = array(
		array(
			"name" => "pbs",
			"comment" => "Всплывающая реклама",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
					"comment" => "идентификатор",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"comment" => "название",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "TEXT NOT NULL",
					"comment" => "описание",
					"multilang" => true,
				),
				array(
					"name" => "alt",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"comment" => "атрибут alt для рекламы-изображения",
					"multilang" => true,
				),
				array(
					"name" => "title",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"comment" => "атрибут title для рекламы-изображения",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "показывать на сайте: 0 - нет, 1 - да",
					"multilang" => true,
				),
				array(
					"name" => "type",
					"type" => "ENUM('1','2','3') NOT NULL DEFAULT '1'",
					"comment" => "тип: 1 - изображение, 2 - флэш, 3 - HTML",
				),
				array(
					"name" => "file",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"comment" => "имя файла, загруженного в папку userfiles/pbs",
				),
				array(
					"name" => "html",
					"type" => "TEXT NOT NULL",
					"comment" => "HTML код рекламы-блока",
				),
				array(
					"name" => "link",
					"type" => "TEXT NOT NULL",
					"comment" => "ссылка на рекламы-изображение или рекламы-флэш",
				),
				array(
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "идентификатор категории из таблицы {pbs_category}",
				),
				array(
					"name" => "check_number",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "ограничить количество показов: 0 - нет, 1 - да",
				),
				array(
					"name" => "check_click",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "ограничить по количеству кликов: 0 - нет, 1 - да",
				),
				array(
					"name" => "show_click",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "ограничить по количеству кликов: осталось кликов",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "дата создания",
				),
				array(
					"name" => "date_start",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "дата начала показа",
				),
				array(
					"name" => "date_finish",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "дата окончания показа",
				),
				array(
					"name" => "show_number",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "ограничить количество показов: осталось показов",
				),
				array(
					"name" => "click",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "всего кликов",
				),
				array(
					"name" => "width",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "ширина флэш-рекламы",
				),
				array(
					"name" => "height",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "высота флэш-рекламы",
				),
				array(
					"name" => "check_user",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "ограничить количество показов посетителю в сутки: 0 - нет, 1 - да",
				),
				array(
					"name" => "show_user",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "количество показов посетителю в сутки",
				),
				array(
					"name" => "count_view",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "всего показов",
				),
				array(
					"name" => "target_blank",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "открывать ссылку в новом окне",
				),
                array(
                    "name" => "sort",
                    "type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
                    "comment" => "подрядковый номер для сортировки",
                ),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "запись удалена в корзину: 0 - нет, 1 - да",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "pbs_category",
			"comment" => "Категории всплывающей рекламы",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
					"comment" => "идентификатор",
				),
				array(
					"name" => "name",
					"type" => "TEXT NOT NULL",
					"comment" => "название",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "показывать на сайте: 0 - нет, 1 - да",
				),
                array(
                    "name" => "sort",
                    "type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
                    "comment" => "подрядковый номер для сортировки",
                ),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "запись удалена в корзину: 0 - нет, 1 - да",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "pbs_site_rel",
			"comment" => "Данные о том, на каких страницах сайта выводятся всплывающие рекламы",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
					"comment" => "идентификатор",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "идентификатор рекламы из таблицы {pbs_category}",
				),
				array(
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
					"comment" => "идентификатор страницы сайта из таблицы {site}",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"comment" => "запись удалена в корзину: 0 - нет, 1 - да",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
	);

	/**
	 * @var array записи в таблице {modules}
	 */
	public $modules = array(
		array(
			"name" => "pbs",
			"admin" => true,
			"site" => true,
		),
	);

	/**
	 * @var array меню административной части
	 */
	public $admin = array(
		array(
			"name" => "Всплывающая реклама",
			"rewrite" => "pbs",
			"group_id" => "1",
			"sort" => 47,
			"act" => true,
			"docs" => "",
			"children" => array(
				array(
					"name" => "Всплывающая реклама",
					"rewrite" => "pbs",
					"act" => true,
				),
				array(
					"name" => "Категории",
					"rewrite" => "pbs/category",
					"act" => true,
				),
				array(
					"name" => "Настройка",
					"rewrite" => "pbs/config",
				),
			)
		),
	);

	/**
	 * @var array настройки
	 */
	public $config = array(
		array(
			"name" => "cat",
			"value" => 1,
		),
	);
}

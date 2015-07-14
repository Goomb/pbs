<?php
/**
 * Редактирование всплывающей рекламы
 *
 */

if (!defined('DIAFAN')) {
    $path = __FILE__; $i = 0;
    while (!file_exists($path.'/includes/404.php')) {
        if($i == 10) exit; $i++;
        $path = dirname($path);
    }
    include $path.'/includes/404.php';
}

/**
 * Pbs_admin
 */
class Pbs_admin extends Frame_admin
{
    /**
     * @var string таблица в базе данных
     */
    public $table = 'pbs';

    /**
     * @var array поля в базе данных для редактирования
     */
    public $variables = array (
            'main' => array (
                'name' => array(
                    'type' => 'text',
                    'name' => 'Название',
                    'multilang' => true,
                    ),
                'time_start' => array(
                    'type' => 'numtext',
                    'name' => 'Задержка перед показом',
                    ),
                'start_count' => array(
                    'type' => 'numtext',
                    'name' => 'Количество показов для пользователя',
                    ),
                'text' => array(
                    'type' => 'editor',
                    'name' => 'Описание',
                    'multilang' => true,
                    ),
                'act' => array(
                    'type' => 'checkbox',
                    'name' => 'Опубликовать на сайте',
                    'default' => true,
                    'multilang' => true,
                    ),
                'hr3' => 'hr',
                'number' => array(
                        'type' => 'function',
                        'name' => 'Номер',
                        'help' => 'Номер элемента в БД (веб-мастеру и программисту).',
                        'no_save' => true,
                        ),
                'sort' => array(
                        'type' => 'function',
                        'name' => 'Сортировка: установить перед',
                        'help' => 'Редактирование порядка следования всплывающей рекламы в списке. Поле доступно для редактирования только для всплывающих реклам, отображаемых на сайте.',
                        ),
                ),
                );

    /**
     * @var array настройки модуля
     */
    public $config = array (
            'act', // показать/скрыть
            'del', // удалить
            'search_name', // искать по названию
            'trash', // использовать корзину
            'order', // сортируется
            'order_desc', // сортируется от нового к старому
            );

    /**
     * Выводит ссылку на добавление
     * @return void
     */
    public function show_add()
    {
        $this->diafan->addnew_init('Добавить всплывающую рекламу');
    }

    /**
     * Выводит список всплывающих реклам
     * @return void
     */
    public function show()
    {
        $this->diafan->list_row();
    }
}


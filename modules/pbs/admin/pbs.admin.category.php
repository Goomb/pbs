<?php
/**
 * Редактирование категорий всплывающей рекламы
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
 * Pbs_admin_category
 */
class Pbs_admin_category extends Frame_admin
{
    /**
     * @var string таблица в базе данных
     */
    public $table = 'pbs_category';

    /**
     * @var array поля в базе данных для редактирования
     */
    public $variables = array (
            'main' => array (
                'name' => array(
                    'type' => 'text',
                    'name' => 'Название',
                    ),
                'act' => array(
                    'type' => 'checkbox',
                    'name' => 'Опубликовать на сайте',
                    'default' => true,
                    ),
                'number' => array(
                    'type' => 'function',
                    'name' => 'Номер',
                    'help' => 'Номер элемента в БД (веб-мастеру и программисту).',
                    'no_save' => true,
                    ),
                'sort' => array(
                    'type' => 'function',
                    'name' => 'Сортировка: установить перед',
                    'help' => 'Редактирование порядка следования категории в списке. Поле доступно для редактирования только для категорий, отображаемых на сайте.',
                    ),
                ),
                );

    /**
     * @var array настройки модуля
     */
    public $config = array (
            'act', // показать/скрыть
            'del', // удалить
            'category', // часть модуля - категории
            'trash', // использовать корзину
            'order', // сортируется
            );

    /**
     * Выводит ссылку на добавление
     * @return void
     */
    public function show_add()
    {
        $this->diafan->addnew_init('Добавить категорию');
    }

    /**
     * Выводит список категорий
     * @return void
     */
    public function show()
    {
        if (!$this->diafan->configmodules("cat")) {
            echo '<div class="error">'.$this->diafan->_('Подключите опцию «Использовать категории» в настройках модуля.').'</div>';
        }
        $this->diafan->list_row();
    }
}

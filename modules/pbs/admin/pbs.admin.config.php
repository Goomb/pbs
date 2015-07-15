<?php
/**
 * Настройки модуля
 *
 */

if (!defined('DIAFAN')) {
    $path = __FILE__; $i = 0;
    while (!file_exists($path.'/includes/404.php')) {
        if ($i == 10) exit; $i++;
        $path = dirname($path);
    }
    include $path.'/includes/404.php';
}

/**
 * Pbs_admin_config
 */
class Pbs_admin_config extends Frame_admin
{
    /**
     * @var array поля в базе данных для редактирования
     */
    public $variables = array (
            'config' => array (
                'cat' => array(
                    'type' => 'checkbox',
                    'name' => 'Использовать категории',
                    'help' => 'Позволяет включить/отключить категории всплывающей рекламы.',
                    ),
                ),
            );

    /**
     * @var array настройки модуля
     */
    public $config = array (
            'config', // файл настроек модуля
            );
}

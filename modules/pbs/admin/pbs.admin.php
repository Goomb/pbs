<?php
/**
 * Редактирование всплывающей рекламы
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
                'text' => array(
                    'type' => 'textarea',
                    'name' => 'Описание',
                    'multilang' => true,
                    ),
			'created' => array(
				'type' => 'date',
				'name' => 'Дата',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм. Если указать дату позже текущей даты, то всплывающая реклама начнет отображаться на сайте, начиная с указанной даты.',
			),
                'act' => array(
                    'type' => 'checkbox',
                    'name' => 'Опубликовать на сайте',
                    'default' => true,
                    'multilang' => true,
                    ),
			'count_view' => array(
				'type' => 'numtext',
				'name' => 'Всего показов',
				'help' => 'Статистика прошедших показов баннера.',
				'disabled' => true,
			),
			'click' => array(
				'type' => 'numtext',
				'name' => 'Всего кликов',
				'help' => 'Статистика прошедших кликов по баннеру.',
				'disabled' => true,
			),
                'time_start' => array(
                    'type' => 'numtext',
                    'name' => 'Задержка перед показом',
                    ),
                'start_count' => array(
                    'type' => 'numtext',
                    'name' => 'Количество показов для пользователя',
                    ),
			'hr1' => 'hr',
			'file' => array(
				'type' => 'function',
				'name' => 'Вид баннера',
				'help' => 'Изображение, флэш, HTML.',
			),
                'link' => array(
                    'type' => 'text',
                    'name' => 'Ссылка',
                    ),
                'target_blank' => array(
                    'type' => 'checkbox',
                    'name' => 'Открывать ссылку на новой странице',
                    ),
                'html' => array(
                    'type' => 'textarea',
                    'name' => 'Содержимое всплывающего окна',
                    ),
			'hr2' => 'hr',
			'date_start' => array(
				'type' => 'datetime',
				'name' => 'Период показа',
				'help' => 'Время, в течение которого будет показываться всплывающая реклама.',
			),
			'date_finish' => array(
				'type' => 'datetime',
				'hide' => true,
			),
			'check_number' => array(
				'type' => 'checkbox',
				'name' => 'Ограничить количество показов',
				'help' => 'Ограничение показа до заданного количества.',
			),
			'show_number' => array(
				'type' => 'numtext',
				'name' => 'Осталось показов',
				'help' => 'Укажите число, сколько раз должена показываться всплывающая реклама. С каждым показом цифра в этом поле будет уменьшаться, пока не станет 0 (или пустое поле).',
			),
			'check_click' => array(
				'type' => 'checkbox',
				'name' => 'Ограничить количество показов по кликам',
				'help' => 'Ограничение показа до заданного количества.',
			),
			'show_click' => array(
				'type' => 'numtext',
				'name' => 'Осталось кликов',
				'help' => 'Укажите число, обозначающее, через какое количество кликов скрыть отображение всплывающей рекламы. С каждым кликом цифра в этом поле будет уменьшаться, пока не станет 0 (или пустое поле).',
			),
			'check_user' => array(
				'type' => 'checkbox',
				'name' => 'Ограничить количество показов посетителю в сутки',
				'help' => 'Ограничение показа всплывающей рекламы посетителю.',
			),
			'show_user' => array(
				'type' => 'numtext',
				'name' => 'Количество показов посетителю в сутки',
				'help' => 'Сколько раз показывать всплывающую рекламу одному пользователю (счетчик сохраняется в сессии).',
			),
                'hr3' => 'hr',
                'site_ids' => array(
                        'type' => 'function',
                        'name' => 'Раздел сайта',
                        'help' => 'Выбор раздела, в котором будет видна всплывающая реклама.',
                        ),
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория',
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
            'element', // используются группы
            'search_name', // искать по названию
            'trash', // использовать корзину
            'category_flat', // категории не содержат вложенности
            'category_no_multilang', // название категории не переводиться
            'order', // сортируется
            'order_desc', // сортируется от нового к старому
            );

    /**
     * @var array зависимости между полями
     */
    public $show_tr_click_checkbox = array(
            'check_user' => array(
                'show_user',
                ),
            'check_number' => array(
                'show_number',
                ),
            'check_click' => array(
                'show_click',
                ),
            );

    /**
     * @var array выводить в списке содержание полей:
     */
    public $config_other_row = array (
            'count_view' => 'function',
            'show_number' => 'function',
            'click' => 'function',
            'show_click' => 'function',
            'check_number' => 'function',
            'check_click' => 'function',
            );

    /**
     * Подготавливает конфигурацию модуля
     * @return void
     */
    public function prepare_config()
    {
        if (!$this->diafan->configmodules("cat", "pbs", $this->diafan->_route->site)) {
            $this->diafan->config("element", false);
        }
    }

    /**
     * Выводит ссылку на добавление
     * @return void
     */
    public function show_add()
    {
        if ($this->diafan->config('element') && ! $this->diafan->not_empty_categories) {
            echo '<div class="error">'.sprintf($this->diafan->_('В %sнастройках%s модуля подключены категории, чтобы начать добавлять всплывающую рекламу создайте хотя бы одну %sкатегорию%s.'), '<a href="'.BASE_PATH_HREF.'pbs/config/">', '</a>','<a href="'.BASE_PATH_HREF.'pbs/category/'.($this->diafan->_route->site ? 'site'.$this->diafan->_route->site.'/' : '').'">', '</a>').'</div>';
        } else {
            $this->diafan->addnew_init('Добавить всплывающую рекламу');
        }
    }

    /**
     * Выводит список всплывающих реклам
     * @return void
     */
    public function show()
    {
        $this->diafan->list_row();
    }

    /**
     * Выводит количество просмотров всплывающей рекламы
     *
     * @return string
     */
    public function other_row_count_view($row)
    {
        return '<td width="10%">'.$this->diafan->_('всего показов').': '.$row["count_view"].'</td>';
    }

    /**
     * Выводит количество оставшихся просмотров всплывающей рекламы
     *
     * @return string
     */
    public function other_row_show_number($row)
    {
        $text = '<td width="10%">';
        if ($row["check_number"]) {
            $text .= $this->diafan->_('осталось показов').': '.$row["show_number"];
        }
        $text .= '</td>';
        return $text;
    }

    /**
     * Выводит количество кликов всплывающей рекламы
     *
     * @return string
     */
    public function other_row_click($row)
    {
        return '<td width="10%">'.$this->diafan->_('кликов').': '.$row["click"].'</td>';
    }

    /**
     * Выводит количество оставшихся кликов всплывающей рекламы
     *
     * @return string
     */
    public function other_row_show_click($row)
    {
        $text = '<td width="10%">';
        if ($row["check_click"]) {
            $text .= $this->diafan->_('осталось кликов').': '.$row["show_click"];
        }
        $text .= '</td>';
        return $text;
    }

    /**
     * Редактирование поля "Файл"
     * @return boolean true
     */
    public function edit_variable_file()
    {
        echo '
            <tr>
            <td align="right">'.$this->diafan->_('Вид всплывающей рекламы').'</td>
            <td>';
        echo '
            <input type="radio" name="type" value="1"'.(! $this->diafan->values("type") || $this->diafan->values("type") == 1 ? ' checked' : '').'> '.$this->diafan->_('Изображение').'
            <input type="radio" name="type" value="2"'.($this->diafan->values("type") == 2 ? ' checked' : '').'> '.$this->diafan->_('Флэш').'
            <input type="radio" name="type" value="3"'.($this->diafan->values("type") == 3 ? ' checked' : '').'> HTML

            <div class="type1'.(! $this->diafan->values("type") || $this->diafan->values("type") == 1 ? '' : ' hide').'">
            <input type="file" name="attachment_img">
            <br>';
        if ($this->diafan->values("file")) {
            echo '<a href="'.BASE_PATH.USERFILES.'/pbs/'.$this->diafan->values("file").'" target="_blank"><img src="'.BASE_PATH.USERFILES.'/pbs/'.$this->diafan->values("file").'" style="max-width:450px; max-height:150px;"></a>';
        }
        echo '
            <div style="padding: 8px 0 0 0;">
            <input type="text" name="alt" size="10" value="'.$this->diafan->values("alt"._LANG).'">
            alt
            </div>
            <div style="padding: 8px 0 0 0;">
            <input type="text" name="title" size="10" value="'.$this->diafan->values("title"._LANG).'">
            title
            </div>
            </div>

            <div class="type2'.($this->diafan->values("type") == 2 ? '' : ' hide').'">
            <input type="file" name="attachment_swf">
            <br>
            '.$this->diafan->values("file").'
            <div style="padding: 8px 0 0 0;">
            <input type="number" name="width" size="3" value="'.$this->diafan->values("width").'">
            x <input type="number" name="height" size="3" value="'.$this->diafan->values("height").'">
            ('.$this->diafan->_('Ширина').' x '.$this->diafan->_('Высота').')
            </div>
            </div>

            <div class="type3'.($this->diafan->values("type") == 3 ? '' : ' hide').'">
            <textarea rows="5" cols="60" name="html">'.$this->diafan->values("html").'</textarea>
            </div>
            </td>
            </tr>';
    }

    /**
     * Сохранение поля "Файл"
     * @return void
     */
    public function save_variable_file()
    {
        if ($_POST['type'] == 1) {
            if (!empty($_FILES["attachment_img"]['name'])) {
                $extension_array = array('jpg', 'jpeg', 'gif','png');

                $new_name = strtolower($this->diafan->translit($_FILES["attachment_img"]['name']));
                $extension = substr(strrchr($new_name, '.'), 1);
                if (!in_array($extension, $extension_array)) {
                    throw new Exception('Не удалось загрузить файл. Возможно, закрыт доступ к папке или файл превышает максимально допустимый размер');
                }

                $new_name = substr($new_name, 0, - (strlen($extension) + 1)).'_'.$this->diafan->id.'.'.$extension;

                $file_name = DB::query_result("SELECT file FROM {bs} WHERE id=%d LIMIT 1", $this->diafan->id);

                if (!empty($file_name)) {
                    File::delete_file(USERFILES.'/'.$this->diafan->table.'/'.$file_name);
                }

                File::upload_file($_FILES["attachment_img"]['tmp_name'], USERFILES."/pbs/".$new_name);

                $this->diafan->set_query("file='%s'");
                $this->diafan->set_value($new_name);

                $this->diafan->set_query("html='%s'");
                $this->diafan->set_value('');

                $this->diafan->set_query("width='%d'");
                $this->diafan->set_value('');

                $this->diafan->set_query("height='%d'");
                $this->diafan->set_value('');
            }

            $this->diafan->set_query("type=%d");
            $this->diafan->set_value(1);

            $this->diafan->set_query("alt"._LANG."='%s'");
            $this->diafan->set_value($_POST['alt']);

            $this->diafan->set_query("title"._LANG."='%s'");
            $this->diafan->set_value($_POST['title']);
        }

        if ($_POST['type'] == 2) {
            if (!empty($_FILES["attachment_swf"]['name'])) {
                $extension_array = array('swf');
                $new_name = strtolower($this->diafan->translit($_FILES["attachment_swf"]['name']));
                $extension = substr(strrchr($new_name, '.'), 1);
                if (! in_array($extension, $extension_array)) {
                    throw new Exception($this->diafan->_('Не удалось загрузить файл. Возможно, закрыт доступ к папке или файл превышает максимально допустимый размер'));
                }

                $new_name = substr($new_name, 0, - (strlen($extension) + 1)).'_'.$this->diafan->id.'.'.$extension;

                $file_name = DB::query_result("SELECT file FROM {bs} WHERE id=%d LIMIT 1", $this->diafan->id);

                if (! empty($file_name)) {
                    File::delete_file(USERFILES.'/'.$this->diafan->table.'/'.$file_name);
                }

                File::upload_file($_FILES["attachment_swf"]['tmp_name'], USERFILES."/".$this->diafan->table.'/'.$new_name);

                $this->diafan->set_query("file='%s'");
                $this->diafan->set_value($new_name);

                $this->diafan->set_query("html='%s'");
                $this->diafan->set_value('');

                $this->diafan->set_query("alt"._LANG."='%s'");
                $this->diafan->set_value('');

                $this->diafan->set_query("title"._LANG."='%s'");
                $this->diafan->set_value('');
            }

            $this->diafan->set_query("type='%d'");
            $this->diafan->set_value(2);

            $this->diafan->set_query("width='%d'");
            $this->diafan->set_value($_POST['width']);

            $this->diafan->set_query("height='%d'");
            $this->diafan->set_value($_POST['height']);
        }

        if ($_POST['type'] == 3) {
            if (! empty($_POST['html'])) {
                $file_name = DB::query_result("SELECT file FROM {bs} WHERE id=%d LIMIT 1", $this->diafan->id);

                if (! empty($file_name)) {
                    File::delete_file(USERFILES.'/'.$this->diafan->table.'/'.$file_name);
                }

                $this->diafan->set_query("html='%s'");
                $this->diafan->set_value($_POST['html']);

                $this->diafan->set_query("file='%s'");
                $this->diafan->set_value('');

                $this->diafan->set_query("alt"._LANG."='%s'");
                $this->diafan->set_value('');

                $this->diafan->set_query("title"._LANG."='%s'");
                $this->diafan->set_value('');

                $this->diafan->set_query("width='%d'");
                $this->diafan->set_value('');

                $this->diafan->set_query("height='%d'");
                $this->diafan->set_value('');
            }

            $this->diafan->set_query("type='%d'");
            $this->diafan->set_value(3);
        }
    }

    /**
     * Сопутствующие действия при удалении элемента модуля
     * @return void
     */
    public function delete($del_id, $trash_id)
    {
        $this->diafan->del_or_trash_where("pbs_site_rel", "element_id=".$del_id, $trash_id);
    }
}


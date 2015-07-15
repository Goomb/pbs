<?php
/**
 * Шаблон блока всплывающей рекламы
 *
 * Шаблонный тег <insert name="show_block" module="bs" [count="all|количество"]
 * [cat_id="категория"] [id="номер_всплывающей_рекламы"] [template="шаблон"]>:
 * блок всплывающей рекламы
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

if (empty($result)) {
	return false;
}

if (!isset($GLOBALS['include_pbs_js'])) {
	$GLOBALS['include_pbs_js'] = true;
	// скрытая форма для отправки статистики по кликам
	echo '<form method="POST" enctype="multipart/form-data" action="" class="ajax js_pbs_form pbs_form">
	<input type="hidden" name="module" value="pbs">
	<input type="hidden" name="action" value="click">
	<input type="hidden" name="pbs_id" value="0">
	</form>';
}
echo '<div id="trigger" href="#pbs_lean_overlay"></div>';
echo '<div id="pbs_lean_overlay">';
foreach ($result as $row) {
    $content = '';
    $content .= '<input type="hidden" name="time_start" value="'.(!empty($row["time_start"]) ? $row["time_start"] : 0).'">';
    $content .= '<input type="hidden" name="start_count" value="'.(!empty($row["start_count"]) ? $row["start_count"] : 0).'">';

	//вывод баннера в виде html разметки
	if (!empty($row['html'])) {
        $content .= $row['html'];
	}

	//вывод всплывающей рекламы в виде изображения
	if (!empty($row['image']))	{
		$content .= '<img src="'.BASE_PATH.USERFILES.'/pbs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
	}

	//вывод всплывающей рекламы в виде flash
	if (!empty($row['swf'])) {
			$content .= '<object type="application/x-shockwave-flash"
			data="'.BASE_PATH.USERFILES.'/pbs/'.$row['swf'].'"
			width="'.$row['width'].'" height="'.$row['height'].'">
			<param name="movie" value="'.BASE_PATH.USERFILES.'/pbs/'.$row['swf'].'" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="play" value="true" />
			<param name="loop" value="true" />
			<param name="wmode" value="opaque">
			<param name="scale" value="showall" />
			<param name="menu" value="true" />
			<param name="devicefont" value="false" />
			<param name="salign" value="" />
			<param name="allowScriptAccess" value="sameDomain" />
		</object>';
	}

	if (!empty($row['link'])) {
        $content = '<a href="'.$row['link']. '" class="js_pbs_counter pbs_counter" rel="'.$row['id'].'" '.(!empty($row['target_blank']) ? 'target="_blank"' : '').'>'.$content.'</a>';
	}

    echo '<div class="pbs_lean_overlay">'.$content.'</div>';
}
echo '</div>';

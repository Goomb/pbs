<?php
/**
 * Шаблон блока всплывающей рекламы
 * Шаблонный тег <insert name="show_block" module="bs" [id="номер_баннера"]>
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

if (empty($result)) {
	return false;
}

echo '<div id="pbs_lean_overlay">';
foreach ($result as $row) {
    echo '<div class="pbs_lean_overlay">';
    echo '<input type="hidden" name="time_start" value="'.(!empty($row["time_start"]) ? $row["time_start"] : 0).'">';
    echo '<input type="hidden" name="start_count" value="'.(!empty($row["start_count"]) ? $row["start_count"] : 0).'">';
    echo $row["name"] . ' text = ' . $row["text"];
    echo '</div>';
}
echo '</div>';

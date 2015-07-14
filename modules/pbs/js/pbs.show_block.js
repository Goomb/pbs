/**
 * JS-сценарий всплывающей рекламы
 *
 */

$('#trigger').leanModal();

var time_start = $('.pbs_lean_overlay input[name=time_start]').val();
var start_count = $('.pbs_lean_overlay input[name=start_count]').val();

setTimeout(function(){$('#trigger').click();}, time_start);

/**
 * JS-сценарий всплывающей рекламы
 *
 */

var pbs_current = false;
$('.js_pbs_counter, .pbs_counter').click(function() {
    pbs_current = $(this);
    $("input[name='pbs_id']", '.js_pbs_form, .pbs_form').val(pbs_current.attr('rel'));
    $('.js_pbs_form, .pbs_form').submit();
    return false;
});

diafan_ajax.success['pbs_click'] = function(form, response) {
    if (pbs_current.attr('target') == '_blank') {
        window.open(pbs_current.attr('href'), '_blank');
    } else {
        window.location = pbs_current.attr('href');
    }
    return false;
}

$('#trigger').leanModal();

var time_start = $('.pbs_lean_overlay input[name=time_start]').val();
var start_count = $('.pbs_lean_overlay input[name=start_count]').val();

setTimeout(function() {
    $('#trigger').click();
}, time_start);

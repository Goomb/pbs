/**
 * Редактирование всплывающей рекламы, JS-сценарий
 *
 */

$('input[name=type]').change(function() {
    $('.type1').hide();
    $('.type2').hide();
    $('.type3').hide();
    $('.type' + $(this).val()).show();
});

/**
 * Редактирование всплывающей рекламы, JS-сценарий
 *
 */

$('input[name=type]').change(function() {
    $('.type1, .type2, .type3').hide();
    $('.type' + $(this).val()).show();
});

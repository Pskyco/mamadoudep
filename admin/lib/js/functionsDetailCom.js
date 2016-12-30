$(document).ready(function () {

    $('#confirm_com').hide();
    $('#submit_duree').remove();
    $('#choix_duree').change(function () {
        var param = $(this).attr('name');
        var val = $(this).val();
        var param2 = $(this).parent().find("#id_fest").attr('name');
        var val2 = $(this).parent().find("#id_fest").val();
        var url = 'index.php?' + param + '=' + val + '&' + param2 + '=' + val2 + '&submit_duree=1';
        $('.description-ticket').show();
        location.href = url;
    });
});
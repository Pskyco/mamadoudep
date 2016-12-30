$(document).ready(function () {
    $('#submit_categories').remove();
    $('#choix_categories').change(function () {
        var param = $(this).attr('name');
        var val = $(this).val();
        var url = 'index.php?' + param + '=' + val + '&submit_categories=1';
        location.href = url;
    });
});
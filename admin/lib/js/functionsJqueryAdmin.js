/**
 * Created by Romain on 12-12-16.
 */
$('document').ready(function () {
    $("#email2_com").blur(function () {
        var email1 = $("#email1_com").val();
        var email2 = $("#email2_com").val();
        if ($.trim(email1) == $.trim(email2)) {
            recherche = "email=" + email1;
            $.ajax({

                type: "GET",
                data: recherche,
                dataType: "json",
                url: './admin/lib/php/ajax/AjaxRechercheClient.php',
                success: function (data) {
                    $("#nom_com").val(data[0].nom);
                    $("#prenom_com").val(data[0].prenom);
                    $("#pays_com").val(data[0].pays);
                    $("#adresse_com").val(data[0].adresse);
                    $("#telephone_com").val(data[0].telephone);
                    $("#id_cli").val(data[0].id_cli);
                    $("#password_com2").val(data[0].password);
                    $("#detail_confirm_com").remove();
                    $("#password_com2").hide();  
                    $("#confirm_com").show();


                    console.log(data[0].nom);
                }

            });
        }
    });

});
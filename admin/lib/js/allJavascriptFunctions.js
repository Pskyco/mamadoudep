//fonction ajax pour l'auto-complétion des adresses mails déjà enregistrées dans la DB
$('document').ready(function () {
    $("#mail_admin").blur(function () {
        var email = $("#mail_admin").val();
        recherche = "email=" + email;
        $.ajax({
            type: "GET",
            data: recherche,
            dataType: "json",
            url: './lib/php/ajax/ajaxAutocompleteClients.php',
            success: function (data) {
                $("#nom_admin").val(data[0].nom);
                $("#nom_admin").removeAttr('disabled');
                $("#prenom_admin").val(data[0].prenom);
                $("#prenom_admin").removeAttr('disabled');
                $("#mail_admin").val(data[0].mail);
                $("#mail_admin").removeAttr('disabled');
                $("#rue_admin").val(data[0].rue);
                $("#rue_admin").removeAttr('disabled');
                $("#ville_admin").val(data[0].ville);
                $("#ville_admin").removeAttr('disabled');
                $("#tel_admin").val(data[0].tel);
                $("#tel_admin").removeAttr('disabled');
                $("#id_admin").val(data[0].id_utilisateur); 
                $("#admin_admin").val(+data[0].admin); 
                $("#admin_admin").removeAttr('disabled');
                $("#pwd_admin").val(data[0].pwd);
                $("#pwd_admin").removeAttr('disabled');
                $("#submitUpdateProfile").removeAttr('disabled');
            }
        });
    });
});

//fonction qui auto-update la boutique avec la catégorie sélectionnée
//utilisation : boutique.php
$(document).ready(function () {
    $('#submit_categories').remove();
    $('#choix_categories').change(function () {
        var param = $(this).attr('name');
        var val = $(this).val();
        var url = 'index.php?' + param + '=' + val + '&submit_categories=1';
        location.href = url;
    });
});

//fonction qui vérifie les insertions effectuées dans les formulaires
//affichage d'un message d'erreur et bloquage de l'envoi du form
//utilisations : inscription.php, profile.php, gestion_utilisateurs_profile.php
$(document).ready(function () {
    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Le numéro de téléphone doit être au format +32 498 82 21 01");


    $("#form_inscription").validate({
        rules: {
            nom: "required",
            prenom: "required",
            email: "required email",
            ville: "required",
            rue: "required",
            pwd: {
                required: true,
                minlength: 7
            },
            pwd2: {
                required: true,
                equalTo: "#pwd"
            },
            tel: {
                required: true,
                regex: /^\+[34][123][0-9]{8,9}$/
            },
            submitHandler: function (form) {
                form.submit();
            }
        }
    });

    $("#form_update_profile").validate({
        rules: {
            nom: "required",
            prenom: "required",
            email: "required email",
            ville: "required",
            rue: "required",
            pwd: {
                required: true,
                minlength: 7
            },
            pwd2: {
                required: true,
                equalTo: "#pwd"
            },
            tel: {
                required: true,
                regex: /^\+[34][123][0-9]{8,9}$/
            },
            submitHandler: function (form) {
                form.submit();
            }
        }
    });

    $("#form_admin_update_profile").validate({
        rules: {
            nom: "required",
            prenom: "required",
            email: "required email",
            ville: "required",
            rue: "required",
            pwd: {
                required: true,
                minlength: 7
            },
            pwd2: {
                required: true,
                equalTo: "#pwd"
            },
            tel: {
                required: true,
                regex: /^\+[34][123][0-9]{8,9}$/
            },
            admin: {
                required: true,
                range: [0, 1]
            },
            submitHandler: function (form) {
                form.submit();
            }
        }
    });
});

//messages personalisés pour l'affichage des erreurs lors du form de validation
$(document).ready(function($) {
    $.extend($.validator.messages, {
        email: "Veuillez renseigner un email valide",
        nom: "Veuillez renseigner un nom",
        prenom: "Veuillez renseigner votre prénom",
        url: "Veuillez renseigner une URL valide",
        date: "Veuillez renseigner une date valide",
        number: "Veuillez ne renseigner que des chiffres",
        digits: "Veuillez ne renseigner que des chiffres",
        equalTo: "Les valeurs doivent etre identiques",
        pwd: {
            required: "Veuillez renseigner un mot de passe",
            minlength: "Votre mot de passe doit être d'au moins 7 caractères."
        },
        pwd2: {
            required: "Il est obligatoire de confirmer son mot de passe",
            equalto: "Vos mots de passes doivent être identiques !"
        },
        tel: {
            required: "Il est obligatoire d'indiquer un numéro de téléphone",
            regex: "Votre numéro de téléphone doit être valide, au format +32 498 82 21 01"
        },
        required: "Veuillez renseigner tous les champs",
        maxlength: $.validator.format("Saisissez {0} caract&egrave;res maximum."),
        minlength: $.validator.format("Saisissez au minimum {0} caract&egrave;res"),
        rangelength: $.validator.format("Entr&eacute;e entre {0} and {1} caract&egrave;res."),
        range: $.validator.format("Entrez une valeur entre {0} et {1}."),
        max: $.validator.format("Valeur maximum : {0}."),
        min: $.validator.format("Valeur minimum : {0}."),
    });
});
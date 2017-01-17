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
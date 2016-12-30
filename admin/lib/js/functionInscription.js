$(document).ready(function () {
    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Le numéro de téléphone doit être au format +32 498 82 21 01");


    $("#form_inscription").validate({
        rules: {
            nom: "required",
            prenom: "required",
            email: "required",
			password: "required",
			password2: {
				required: true,
                equalTo: "#password"
            },
            telephone: {
                required: true,
                regex: /^\+[34][123][0-9]{8,9}$/
            },
            submitHandler: function (form) {
                form.submit();
            }
        }
    });

    $("#form_commande").validate({
        rules: {
            email1_com: {
                required: true,
                email: true
            },
            email2_com: {
                equalTo: "#email1_com",
                email: true
            },
            nom_com: "required",
            prenom_com: "required",
            pays_com: "required",
            adresse_com: "required",
            telephone_com: {
                required: true,
                regex: /^\+[34][123][0-9]{8,9}$/
            },
            password_com: "required",
            password_com2: "required",
            submitHandler: function (form) {
                form.submit();
            }
        }
    });

});

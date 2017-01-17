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

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
});

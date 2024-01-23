'use strict';

/**
 * Script de vérification de l'enregistrement des utilisateurs
 */
$('#registerUser').click(function(){
    //récup des valeurs du champ du form:
    const firstname = $('#firstname').val();
    const lastname = $('#lastname').val();
    const email = $('#email').val();
    const psw = $('#password').val();
    const confirmPsw = $('#passwordConfirm').val();
    const pswLength = psw.length;
    const terms = $('#agreeTerms');


    if(firstname != "" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(firstname)) {
        $('#firstname').removeClass('is-invalid');
        $('#firstname').addClass('is-valid');
        $('#errorRegisterFirstName').text("");

        if(lastname != "" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(lastname)) {
            $('#lastname').removeClass('is-invalid');
            $('#lastname').addClass('is-valid');
            $('#errorRegisterLastName').text("");

            if(email != "" && /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)) {
                $('#email').removeClass('is-invalid');
                $('#email').addClass('is-valid');
                $('#errorRegisterEmail').text("");

                if(pswLength >= 8) {
                    $('#psw').removeClass('is-invalid');
                    $('#psw').addClass('is-valid');
                    $('#errorRegisterPassword').text("");

                    if(confirmPsw === psw) {
                        $('#passwordConfirm').removeClass('is-invalid');
                        $('#passwordConfirm').addClass('is-valid');
                        $('#errorRegisterPasswordConfirm').text("");

                        if(terms.is(':checked')) {
                            $('#agreeTerms').removeClass('is-invalid');
                            $('#errorRegisterAgreeTerms').text("");

                            //Envoie du form:
                            //alert("data sended !");

                            const res = emailExistJS (email);

                            (res !="exist") ? $('#form-register').submit() : $('#email').addClass('is-invalid');
                                 $('#email').removeClass('is-valid');
                                 $('#errorRegisterEmail').text("This adress email is already used !");


                        } else {
                            $('#agreeTerms').addClass('is-invalid');
                            $('#errorRegisterAgreeTerms').text("You should be agree to our terms and conditions !");
                        }
                    } else {
                        $('#passwordConfirm').addClass('is-invalid');
                        $('#passwordConfirm').removeClass('is-valid');
                        $('#errorRegisterPasswordConfirm').text("Password must be identical");
                    }
                } else {
                    $('#psw').addClass('is-invalid');
                    $('#psw').removeClass('is-valid');
                    $('#errorRegisterPassword').text("Password is not valid");
                }
            } else {
                $('#email').addClass('is-invalid');
                $('#email').removeClass('is-valid');
                $('#errorRegisterEmail').text("Email is not valid");
            }
        } else {
            $('#lastname').addClass('is-invalid');
            $('#lastname').removeClass('is-valid');
            $('#errorRegisterLastName').text("Last name is not valid");
        }
    } else {
        $('#firstname').addClass('is-invalid');
        $('#firstname').removeClass('is-valid');
        $('#errorRegisterFirstName').text("First name is not valid");
    }
});

//Evènement pour valider les termes/conditions:
$('#agreeterms').change(function(){
    const agreeTerms = $('agreeTerms');

    if(agreeTerms.is(':checked')) {
        $('#agreeTerms').removeClass('is-invalid');
        $('#errorRegisterAgreeTerms').text("");
    } else {
        $('#agreeTerms').addClass('is-invalid');
        $('#errorRegisterAgreeTerms').text("You should be agree to our terms and conditions !");
    }
});


function emailExistJS (email)
{
    //Je récupère l'url se trouvant dans le fichier web.php via l'id email qui contient le chemin, (id email du fichier register.blade.php):
    const url = $('#email').attr('url_emailExist');
    const token = $('#email').attr('token');
    const res = "";

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            '_token': token,
            email: email,
        },
        success:function(result) {
            res = result.response;
        },
        async: false
    });

    return res;

}



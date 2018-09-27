
$(document).ready(function(){
    $("#form-update").submit(function(){
        var numbers = /[0-9]/;
        var numbers1 = /^[0-9]{8,12}$/;
        var letter = /[A-Za-z0-9]/;
        var letterupper = /[A-Z]/;
        var sepecialcharacter = /({|@|}|#|&|:|à|,|!|\(|\)|\?|\+|\-|\*|\/|è|\^|é|\.|;|~|<|>)/g
        if (($("#name1").val()).length<3) {
        	alert("Nom  doit contenir au minimum 3 caractères ! ");
          	return false;
        }
        if (($("#name1").val()).length>20) {
            alert("Nom  doit contenir au maximum 20 caractères !");
            return false;
        }
        if (($("#firts_name").val()).length<3) {
            alert("Prénom  doit contenir au minimum 3 caractères ! ");
            return false;
        }
        if (($("#firts_name").val()).length>20) {
            alert("Prénom  doit contenir au maximum 20 caractères !");
            return false;
        }
        if (($("#date_birth").val())=="") {
            alert("Veuillez entrer votre date de naissance !");
            return false;
        }
        if (($("#pseudo").val())=="") {
            alert("Veuillez entrer votre Pseudo !");
            return false;
        }

        if (($("#pseudo").val()).match(numbers)) {
            true;
        }
        else{
            alert("Pseudo doit contenir au moin un chiffre ! ");
            return false;
        }

        if (($("#pseudo").val()).match(letter)) {
            true;
        }
        else{
            alert("Pseudo doit contenir au moin une lettre ! ");
            return false;
        }

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(($("#email").val())))
        {
            true;
        }
        else
        {
            alert("Email non valid ! ")
                    return false;
        }
        if (($("#phone").val()).match(numbers1)) {
            true;
        }
        else{
            alert("Numéros téléphone doit contenir que des chiffres ! ");
            return false;
        }
        if (($("#password").val()).length<6) {
            alert("Mot de passe doit contenir au minimum six caractères ! ");
            return false;
        }
        if (($("#password").val()).match(numbers)) {
            true;
        }
        else{
            alert("Mot de passe doit contenir au moin un chiffre ! ");
            return false;
        }
        if (($("#password").val()).match(letterupper)) {
            true;
        }
        else{
            alert("Mot de passe doit contenir au moin une lettre  majuscule ! ");
            return false;
        }
        if (($("#password").val()).match(sepecialcharacter)) {
            true;
        }
        else{
            alert("Mot de doit contenir au  moin un Caractère spécial ! ");
            return false;
        }
        if (($("#password").val())!==($("#password-confirmation").val())) {
            alert ( "Les mots de passe ne sont pas identique !  " );
            return false;
        }

    });

});

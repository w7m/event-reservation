
$(document).ready(function(){
    $("#form-registration-event").submit(function(){

        var numbers1 = /^[0-9]$/;

        if (($("#name").val()).length<3) {
        	alert("Nom  doit contenir au minimum 3 caractères ! ");
          	return false;
        }
        if (($("#name").val()).length>20) {
            alert("Nom  doit contenir au maximum 20 caractères !");
            return false;
        }
        if (($("#date_begin").val())=="") {
            alert("Veuillez entrer la date du début !");
            return false;
        }
        if (($("#date_end").val())=="") {
            alert("Veuillez entrer la date du fin !");
            return false;
        }
        if (($("#number_place").val())=="") {
            alert("Veuillez entrer les nombres des places");
            return false;
        }
        if (($("#number_place").val())<0) {
            alert("Veuillez entrer les nombres des places");
            return false;
        }
        if (($("#position").val()).length<10) {
            alert("Position  doit contenir au minimum 10 caractères ! ");
            return false;
        }
        if (($("#position").val()).length>200) {
            alert("Position doit contenir au maximum 200 caractères !");
            return false;
        }


    });

});

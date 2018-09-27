$(document).ready(function () 
{
        $('.modal').modal('show');
        setTimeout(
            function()
            {
                $('.modal').modal('hide');
            }, 4000);
    $(".dropdown-toggle-js").click(function(){
        $(this).css({"background-color": "#1dd800","color" :"white"});
    });
    $(".dropdown-toggle-js").hover(function(){
        $(this).css({"background-color": "#1dd800","color":"white"});
    }, function(){
        $(this).css({"background-color": "white","color":"#1dd800"});
    });
	$(".button-navbar-responsive").hover(function(){
	    $(this).css("background-color","white");
	    $(this).css("border","1px #1dd800 solid");
	    $(".navbar .navbar-header > .button-navbar-responsive > span").css("background-color","#1dd800");
	    }, function(){
	    $(this).css("background-color", "#1dd800");
	    $(".navbar .navbar-header > .button-navbar-responsive > span").css("background-color", "white");
	});
});



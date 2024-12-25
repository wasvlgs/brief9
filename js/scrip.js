









$(document).ready(function() {


    $("#burgerButton").click(function(){
        $(".menu").css("display","flex");
    })
    $(".closeMenu").click(function(){
        $(".menu").css("display","none");
    })
    
    
    $(".reserve").click(function(){
        $(".reserveSection").css("display","none");
        let getFather = $(this).parent().parent().parent();
        let getElement = $(getFather).find(".reserveSection");
        $(getElement).css("display","flex")
    })
    
    $(".closeReserve").click(function(){
        $(".reserveSection").css("display","none");
    })
    
    $("#bar").click(function(){
        $("aside").css("width","100%");
        $("aside").css("max-width","300px");
    })

    $("#closeMenu").click(function(){
        $("aside").css("width","0%");
        $("aside").css("max-width","300px");
    })

   
});



$(document).ready(function (){
    $("#t").toggle(
        function (){                     //点击菜单，子菜单弹出
            $("#q").animate({
                top:"-200px",
                left:"0px",
                opacity:"1"
            },300);
            $("#w").animate({
                top:"-170px",
                left:"-80px",
                opacity:"1"
            },300);
            $("#e").animate({
                top:"-95px",
                left:"-160px",
                opacity:"1"
            },300);
            $("#r").animate({
                top:"0px",
                left:"-200px",
                opacity:"1"
            },300);
        },
        function (){                          //再次点击菜单，子菜单收回
            $("#q").animate({
                top:"0px",
                left:"0px",
                opacity:"0"
            },300);
            $("#w").animate({
                top:"0px",
                left:"0px",
                opacity:"0"
            },300);
            $("#e").animate({
                top:"0px",
                left:"0px",
                opacity:"0"
            },300);
            $("#r").animate({
                top:"0px",
                left:"0px",
                opacity:"0"
            },300);
        }
    );
});



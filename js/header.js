$(document).ready(function(){
    $('#open_menu').click(function(){
        $('.menu').animate({'right': '0'}, 300);

        mask_menu.render();

        $('.mask_menu').click(function(){
            $('.menu').animate({'right': '-250px'}, 300);

            mask_menu.hide();
        });
    });

    if(window.localStorage.getItem('bookmark')!=null){
        $('.menu ul').append("<li><a href='" + window.localStorage.getItem('bookmark') + "'><i class='fa fa-bookmark-o'>&nbsp;&nbsp;Go to bookmark</i></a></li>");
    }
});
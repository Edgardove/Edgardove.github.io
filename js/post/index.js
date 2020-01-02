$(document).ready(function(){
    if(window.location.hash==''){
        window.location.hash=0;
    }

    let current_idx=parseInt(window.location.hash.replace(/#/,'')), 
        prev_page=document.referrer;

    sliding(current_idx, false);

    let mask_menu={
        mask: document.createElement('div'),
        render: function () {
            this.mask.classList.add('mask_menu');

            document.body.insertBefore(this.mask, document.body.firstChild);
        },
        hide: function () {
            document.body.removeChild(this.mask);
        }
    }

    let mask_load={
        mask: document.createElement('div'),
        render: function () {
            this.mask.classList.add('mask_load');

            document.body.insertBefore(this.mask, document.body.firstChild);
        },
        hide: function () {
            document.body.removeChild(this.mask);
        }
    }

    mask_load.render();

    function changeMenu(elem, idx_exclude){
        elem.css({'opacity':'0.4'});

        elem.eq(idx_exclude).css({'opacity':'1'});
    }

    $('#back_url').click(function(){
        if(prev_page.length>0){
            window.location.href=prev_page;
        }
        else{
            let back_home=confirm('It seems that there is no previous page. Do you want to go to the home page?');

            if(back_home){
                window.location.href='../../';
            }
        }
    });

    $('#menu').click(function(){
        $('.menu_slide').removeClass('menu_invisible').addClass('menu_visible');

        mask_menu.render();

        $('.mask_menu').click(function(){
            $('.menu_slide').removeClass('menu_visible').addClass('menu_invisible');
            mask_menu.hide();
        });
    });
    
    $('.slide').each(function(idx){
        let title=$(this).find('h1').text();

        $('.menu_slide').append('<div class="menu-index" data-index="' + idx + '">' + title + '</div>')
    });

    $('.menu-index').click(function(){
        let index=parseInt($(this).data('index'));

        window.location.hash=index;

        changeMenu($('.menu-index', index));
    });
    
    $('.menu-index').eq(current_idx).css({'opacity': '1'});

    if(window.location.hash=='#0'){
        $('#back').css({'display':'none'})
    }
    else{
        $('#back').css({'display':'block'})   
    }

    window.addEventListener('hashchange', function(){
        let page_n=parseInt(window.location.hash.replace(/#/,''));

        sliding(page_n, true);

        changeMenu($('.menu-index'), page_n);
    });

    function sliding(index, animation){
            
        let max_length=$('.slide').length-1;
            
        if(index==0){
            $('#back').css({'display':'none'});
        }
        else
            $('#back').css({'display':'block'});
        
        if(index==max_length){
            $('#next').html('&#10003;').css({'pointer-events': 'none', 'opacity':'0.7'});
        }
        else{
            $('#next').html('&gt;').css({'pointer-events': 'auto', 'opacity':'1'});

        }
        if(animation==true)
            $('.slides').animate({'left': -index*100+'%'}, 400);

        else
            $('.slides').css({'left': -index*100+'%'});

        $('.slide').eq(index).scrollTop(0);
    }

    $('#next').click(function(){
        let index=parseInt(window.location.hash.replace(/#/,''))+1;

        window.location.hash=index;

        changeMenu($('.menu-index'), index);
    });
    
    $('#back').click(function(){
        let index=parseInt(window.location.hash.replace(/#/,''))-1

        window.location.hash=index;

        changeMenu($('.menu-index'), index);
    });

    function elapsing_time(start, end){
        let elapsed=end-start, txt;

        if(elapsed/60 < 1){ // seconds
            txt='edited ' + elapsed + ' seconds ago';
        }
        else if(elapsed/60 >= 1 && elapsed/60 < 60){ // minutes
            txt='edited ' + Math.floor(elapsed/60) + ' minute/s ago';
        }
        else if(elapsed/60 >= 60 && elapsed/60 < 1440){ // hours
            txt='edited ' + Math.floor(elapsed/60/60) + ' hour/s ago';
        }
        else if(elapsed/60 >= 1440 && elapsed/86400 < 30){ // days
            txt='edited ' + Math.floor(elapsed/86400) + ' day/s ago';
        }
        else if(elapsed/86400 >= 30 && Math.floor(elapsed/86400/30) < 12){ // months
            txt='edited ' + Math.floor(elapsed/86400/30) + ' month/s ago';
        }
        else if(elapsed/86400 >= 30 && Math.floor(elapsed/86400/30) >= 12){ // years
            txt='edited ' + Math.floor(elapsed/86400/30/12) + ' year/s ago';
        }

        return txt;
    }

    $('.date_text').text(elapsing_time(start_time, Math.round(Date.now()/1000)));

    $('#bookmark').click(function(){
        if(window.localStorage.getItem('bookmark')==null){
            window.localStorage.setItem('bookmark', window.location.href);
    
            $(this).css({'color': 'rgb(155, 255, 171)'});
        }
        else{
            window.localStorage.removeItem('bookmark');
    
            $(this).css({'color': 'rgb(255, 255, 255)'});
        }
    });

    if(window.localStorage.getItem('bookmark')!=null){
        $('#bookmark').css({'color': 'rgb(155, 255, 171)'});
    }
})
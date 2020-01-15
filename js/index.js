$(document).ready(()=>{
    var inputArr = $('input[type=text], input[type=email]');
    inputArr.each(function(){
        if($(this).val() != ""){
            $(this).parent().find('small.required-message').addClass('required-message-none');
            $(this).parent().find('label').css({
                'top': '-25px',
                'left': '0',
                'color': '#000'
            })
        }
    })


    $('input[type=text], input[type=email]').focus( function(){
        $(this).parent().find('label').css({
            'top': '-25px',
            'left': '0',
            'color': '#000'
        })
    })
    $('input[type=text], input[type=email]').blur(function(e){
        if($(this).val() != ""){
            $(this).parent().find('label').css({
                'top': '-25px',
                'left': '0',
                'color': '#000'
            })
        }else{
            $(this).parent().find('label').css({
                'top': '10px',
                'left': '10px',
                'color': 'rgb(133, 133, 133)'
            })
        }      
    })
    $('input').keyup(function(){
        if($(this).val() != ""){
            $(this).parent().find('small.required-message').addClass('required-message-none');
        }else{
            $(this).parent().find('small.required-message').removeClass('required-message-none');
        }
    })

    $('.registration-switch').click(function(){
        $.each($('.switch'), function(){
            $(this).removeClass('active-switch')
        })
        $(this).addClass('active-switch');
        $('.registration-wrapper').css('display', 'block')
        $('.login-wrapper').css('display', 'none');
    })

    $('.login-switch').click( function(){
        $.each($('.switch'), function(){
                $(this).removeClass('active-switch')
        })
        $(this).addClass('active-switch');
        $('.login-wrapper').css('display', 'block')
        $('.registration-wrapper').css('display', 'none');
    })
})
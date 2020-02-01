$(document).ready(()=>{
    var inputArr = $('input[type=text], input[type=email], input[type=password]');
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


    $('input[type=text], input[type=email], input[type=password]').focus( function(){
        $(this).parent().find('label').css({
            'top': '-25px',
            'left': '0',
            'color': '#000'
        })
    })
    $('input[type=text], input[type=email], input[type=password]').blur(function(e){
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

    //Status change
    $('.bio-edit').click((e)=>{
        //Text
        $(e.target).css({'display':'none'});
        $('.status').css({'display':'none'});
        $('.bio-input').css({'display':'block'});
        $('.bio-back').attr('style','display: block !important');
        $('.bio-save').attr('style','display: block !important');

        //Image
        $('.profileLabel').css({'display':'block'});
        $('.profileImageText').css({'display':'block'});
        $('.profileImageBlack').css({'display':'block'});

    })

    $('.bio-back').click((e)=>{
        //Text
        $(e.target).css({'display':'none'});
        $('.bio-edit').css({'display':'block'});
        $('.status').css({'display':'block'});
        $('.bio-input').css({'display':'none'});
        $('.bio-save').attr('style','display: none !important');

        //Image
        $('.profileLabel').css({'display':'none'});
        $('.profileImageText').css({'display':'none'});
        $('.profileImageBlack').css({'display':'none'});
    })
})


function handlePreview(e){
    var reader = new FileReader();
    reader.onload = function(e){
        document.querySelector('.upload-image').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
}

function handlePreviewProfile(e){
    var reader = new FileReader();
    reader.onload = function(e){
        document.querySelector('.upload-image-profile').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
}
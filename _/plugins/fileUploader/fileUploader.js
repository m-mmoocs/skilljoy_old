
$.fn.fileUploader = function(funct){
    if ( window.FileReader ) return this.each(function(){
        if(!$(this).parents('form').hasClass('fileUploadered')){
            $(this).parents('form').submit(function(e){
                $(this).find('.fUploadedImage').each(showLoader);
            }).addClass('fileUploadered');
            $('body').append('<div class="ajax-loader-preloader"><div class="ajax-loader"></div></div>');
        }
        $(this).wrap('<div class="fUploadBox">');
        $(this).wrap('<div class="fuCol1">');
        $(this).parent('.fuCol1').after('<div class="fuCol2 img-attribs">');
        
        // if file has attribute data-old-filepath insert image and attrib fields
        if(typeof $(this).attr('data-old-filepath')==='string'){
//            alert($(this).attr('data-old-filepath'));
            $(this).prevUpload();
        }
        
        $(this).change(function(){
            var elem = $(this);
            var box = elem.parents('.fUploadBox');
            // remove old info
            box.find('.img-attribs').empty();
            box.find('.fUploadErrors, .fUploadedImage').remove();
            
            var errs = fileErrors(this.files[0]);
            if(!errs){    
                reader = new FileReader();
                reader.onloadend = function(e){
                    elem.fileUploaderFinished(e,funct);
                };
                reader.readAsDataURL(this.files[0]);
            }else{
                for(i in errs)
                    elem.before('<p class="fUploadErrors">'+errs[i]+'</p>');
            }            
        });
    });
    else {
        alert ('Browser does not support FileReader option.');
    }
};

$.fn.fileUploaderFinished = function(e,callback){
    var box = $(this).parents('.fUploadBox');
    
    // show image
    var img = $('<img class="fUploadedImage" >');
    img.attr('src',e.target.result);
    $(this).before(img);
    
    var fileName = $(this).attr('name');
    // add inputs for alt and title text
    box.find('.img-attribs').append('<label for="fu_'+fileName+'[fuAlt]">Alt Text:</label><input type="text" name="fu_'+fileName+'[fuAlt]" >');
    box.find('.img-attribs').append('<label for="fu_'+fileName+'[fuTitle]">Title Text:</label><input type="text" name="fu_'+fileName+'[fuTitle]" >');
    
    if(!$(this).hasClass('prevUpload') && !$(this).hasClass('uploadFinished') && typeof callback !== 'undefined') callback(box);
    $(this).addClass('uploadFinished');
};

function fileErrors(file){
    if (!(file.type==='image/gif'||
    file.type==='image/jpeg'||
    file.type==='image/jpg'||
    file.type==='image/pjpeg'||
    file.type==='image/png'||
    file.type==='image/x-png')){    
        return { "type":file.name+" is not of valid type."};
    }
    return false;
}

$.fn.prevUpload = function(){
    var fPath = $(this).attr('data-old-filepath');
    var fAlt = $(this).attr('data-old-alt');
    var fTitle = $(this).attr('data-old-title');
    $(this).addClass('prevUpload');
    var box = $(this).parents('.fUploadBox');
    var img = $('<img class="fUploadedImage" >');
    img.attr('src',fPath);
    $(this).before(img);
    var fileName = $(this).attr('name');
    // add inputs for alt and title text
    box.find('.img-attribs').append('<label for="fu_'+fileName+'[fuAlt]">Alt Text:</label><input type="text" name="fu_'+fileName+'[fuAlt]" value="'+fAlt+'" >');
    box.find('.img-attribs').append('<label for="fu_'+fileName+'[fuTitle]">Title Text:</label><input type="text" name="fu_'+fileName+'[fuTitle]" value="'+fTitle+'" >');
    box.find('.img-attribs').append('<input type="hidden" name="prev_'+fileName+'" value="'+fPath+'" class="prevUploadedImage">');
};

function showLoader(){
    $(this).after("<div class='ajax-loader'>").remove();
}
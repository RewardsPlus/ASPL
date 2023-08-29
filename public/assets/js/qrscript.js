let applyBg = 0;
$(function () {
    var color1 = document.querySelector(".color1");
    var color2 = document.querySelector(".color2");
    var background1 = document.querySelector(".background1");
    var body = document.querySelector(".brand-banner-container");

    function changeGradient() {
        if(applyBg == 0){
            body.style.background = background1.value;
        }else{
            body.style.background =
            "linear-gradient(to right, "
            + color1.value + ", "
            + color2.value + ")";
        }
    }

    background1.addEventListener("input", changeGradient);
    color1.addEventListener("input", changeGradient);
    color2.addEventListener("input", changeGradient);

    document.getElementById('brand-title').addEventListener("keyup", function(){
        let brandTitle = document.getElementById('brand-title').value;
        if(brandTitle.length > 0){
            document.getElementById('brand-name').innerHTML = brandTitle
        }else{
            document.getElementById('brand-name').innerHTML = 'Circle Food';
        }
    });
    
    document.getElementById('brand-subline').addEventListener("keyup", function(){
        let brandSubline = document.getElementById('brand-subline').value;
        if(brandSubline.length > 0){
            document.getElementById('brand-subtext').innerHTML = brandSubline
        }else{
            document.getElementById('brand-subtext').innerHTML = 'Feel the real taste of india';
        }
    });

    setImage();
    setShop();

    let allSocial = document.querySelectorAll('.social-buttons-wrapper .btn-item');
    for(let social of allSocial){
        social.addEventListener('click', function(){
            let iconClass = social.children[0].getAttribute('class');
            let iconName = social.getAttribute('title');
            console.log(iconName);
            addMoreSocial(iconClass, iconName);
        });
    }

    document.getElementById('full-logo-clear').addEventListener("click", function(){
        document.getElementById('full-logo').setAttribute('src','image-24.png');
        document.getElementById('added-logo-rectangle').setAttribute('src','image-24.png');
    });

    document.getElementById('logo-icon-clear').addEventListener("click", function(){
        document.getElementById('logo-icon').setAttribute('src','Ellipse-51.png');
        document.getElementById('added-logo-icon').setAttribute('src','Ellipse-51.png');
    });
});

function selectColorOpt(typ){
    applyBg = typ;
}

function jsonWebupload(input,imageType,imageTypeDisplay){
	if (input.files){
		var filesAmount = input.files.length;

		for (i = 0; i < filesAmount; i++) {
			var reader = new FileReader();
			reader.onload = function(event) {
				var image = new Image();
				image.onload = function (imageEvent) {			    
					var height_f = '';
					var	width_f = '';
						
					// Resize image
					var canvas = document.createElement('canvas'),
						max_size = 600,
						width = image.width,
						height = image.height;
					if (width > height) {
						if (width > max_size) {
							height_f = height * (max_size / width);
							width_f = max_size;
						} else {
							height_f = height;
							width_f = width;
						}
					} else {
						max_size = 800;
						if (height > max_size) {
							width_f = width * (max_size / height);
							height_f = max_size;
						} else {
							width_f = width;
							height_f = height;
						}
					}
					canvas.width = width_f;
					canvas.height = height_f;
					
					var ctx = canvas.getContext("2d");
					ctx.fillStyle = 'white';
					ctx.beginPath();
					ctx.fillStyle = 'white';
					ctx.moveTo(0,0);
					ctx.lineTo(width_f,0);
					ctx.lineTo(width_f,height_f);
					ctx.lineTo(0,height_f);
					ctx.lineTo(0,0);
					ctx.stroke();
					ctx.fill();						
					
					ctx.drawImage(image, 0, 0, width, height, 0, 0, width_f, height_f);
					var imgData  = canvas.toDataURL('image/jpeg'); // 600 400
                    
                    document.getElementById(imageType).setAttribute('src',imgData);
                    document.getElementById(imageTypeDisplay).setAttribute('src',imgData);
				}
				
				image.src = event.target.result;
			}
			reader.readAsDataURL(input.files[i]);
		}
	}
	// Clear files
	event.target.value = '';
}

function removeShopBrand(id,shop){
    $('#'+id).remove();
    $('#'+shop).remove();
    let count = 1;
    $('#muti-brand-boxes .brand-shop-links').each(function(){
        $(this).attr('id',"brand-shop-box-"+count);
        $(this).find('.circled-logo').attr('id',"shop-brand-icon-"+count);
        $(this).find('.added-brand-text').attr('id',"brand-shop-label-"+count);
        count++;
    });
    count = 1;
    $('#all-shop-inputs .social-block-outer').each(function(){
        $(this).attr('id',"shop-input-box-"+count);
        $(this).find('.qr-close-circle').attr('onclick',"removeShopBrand('shop-input-box-"+count+"','brand-shop-box-"+count+"');");
        $(this).find('.brand-title-text').attr('id',"brand-shop-label-"+count);
        $(this).find('.brand-title-text').attr('name',"brand-shop-label-"+count);
        $(this).find('.brand-title-text').attr('data-target',"brand-shop-label-"+count);
        $(this).find('.brand-title-url').attr('id',"brand-title-url-"+count);
        $(this).find('.brand-title-url').attr('name',"brand-title-url-"+count);
        $(this).find('.brand-title-url').attr('data-target-link',"brand-title-url-"+count);
        $(this).find('.circled-logo').attr('id',"shop-logo-icon-"+count);
        $(this).find('.upload-logo-btn').attr('id',"logo-icon-btn-"+count);
        $(this).find('.upload-logo-btn').attr('data-image',"shop-brand-icon-"+count);
        $(this).find('.upload-logo-btn').attr('data-image-display',"shop-logo-icon-"+count);
        count++;
    });
}

function addMoreShops(){
    let shopCount = $('#muti-brand-boxes .brand-shop-links').length + parseInt(1);
    let addBrandShop = `<div class="d-flex social-block-outer mb-3 col-12 position-relative" id="shop-input-box-${shopCount}">
        <i class="close-btn qr-close-circle position-absolute d-inline-flex align-items-center justify-content-center" onclick="removeShopBrand('shop-input-box-${shopCount}','brand-shop-box-${shopCount}');"></i>
        <div class="social-block-inner flex-shrink-0 col-md-7">
            <span class="col-md-12 d-inline-block ps-4" for="social_logo">Custom URL</span>
            <div class="social-block col-12 d-inline-flex flex-column">
                <div class="d-flex align-items-center gap-2">
                    <i class="qr-url social-icon-url"></i>
                    <input  id="brand-title-text-${shopCount}" maxlength="50"
                        class="form-control ml-1 brand-shop-input brand-title-text" data-target="brand-shop-label-${shopCount}" type="text" placeholder="Title" name='custom_url[${shopCount}][name]' />
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="qr-url social-icon-url"></i>
                    <input  id="brand-title-url-${shopCount}"
                        class="form-control ml-1 brand-shop-input brand-title-url" data-target-link="brand-shop-box-${shopCount}" type="url" placeholder="URL" name='custom_url[${shopCount}][url]' />
                </div>
            </div>
        </div>
        <div class="d-inline-flex align-items-center col-md-5">
            <div class="circle-logo-box d-inline-flex align-items-center justify-content-center">
                <img src="" id="shop-logo-icon-${shopCount}" class="circled-logo" />
            </div>
            <div class="logo-upload-btns d-inline-flex align-items-center ms-auto">
                <span
                    class="upload-btn d-inline-flex align-items-center justify-content-center position-relative">Upload
                    <input type="file" name="custom_url_${shopCount}" class="position-absolute opactiy-0 upload-logo-btn" accept="image/*" id="logo-icon-btn-${shopCount}" data-image="shop-brand-icon-${shopCount}" data-image-display="shop-logo-icon-${shopCount}"/>
                </span>
            </div>
        </div>
    </div>`;

    $('#all-shop-inputs').append(addBrandShop);

    let brandShopBox = `<a class="brand-shop-links align-items-center d-inline-flex col-12 text-decoration-none position-relative" id="brand-shop-box-${shopCount}" href="">
        <span class="added-brand-icon d-inline-flex align-items-center justify-content-center">
            <img src="" id="shop-brand-icon-${shopCount}"/>
        </span>
        <span class="added-brand-text d-inline-flex" id="brand-shop-label-${shopCount}">Visit our web store</span>
        <span class="goLink-arrow position-absolute d-inline-flex align-items-center">
            <svg width="9" height="18" viewBox="0 0 9 18" fill="none">
                <path d="M1 1L7.5 9L1 17" stroke="#2C67FF" stroke-width="2"/>
            </svg>
        </span>
    </a>`;

    $('#muti-brand-boxes').append(brandShopBox);
    setImage();
    setShop();
}

function setImage(){
    let allUploadBtn = document.querySelectorAll('.upload-logo-btn');
    for(let uploadBtn of allUploadBtn){
        let imageType = uploadBtn.getAttribute('data-image');
        let imageTypeDisplay = uploadBtn.getAttribute('data-image-display');
        uploadBtn.addEventListener('change', function(){
            // jsonWebupload(uploadBtn,imageType,imageTypeDisplay);
        });
    }
}

function setShop(){
    let allShopInput = document.querySelectorAll('.brand-shop-input');
    for(let shopInput of allShopInput){
        let elemTarget = shopInput.getAttribute('data-target');
        let elemTargetLnk = shopInput.getAttribute('data-target-link');
        shopInput.addEventListener('keyup', function(){
            if(elemTarget){
                let brandSubline = shopInput.value;
                if(brandSubline.length > 0){
                    document.getElementById(elemTarget).innerHTML = brandSubline
                }else{
                    document.getElementById(elemTarget).innerHTML = 'Visit our web store';
                }
            }
            if(elemTargetLnk){
                let brandSubline = shopInput.value;
                if(brandSubline.length > 0){
                    document.getElementById(elemTargetLnk).setAttribute('href',brandSubline);
                }else{
                    document.getElementById(elemTargetLnk).setAttribute('href','javascript:void(0);');
                }
            }
        });
    }
}

function setSocial(){
    let allShopInput = document.querySelectorAll('.social-title-text');
    for(let shopInput of allShopInput){
        let elemTargetLnk = shopInput.getAttribute('data-target-link');
        shopInput.addEventListener('keyup', function(){
            if(elemTargetLnk){
                let brandSubline = shopInput.value;
                if(brandSubline.length > 0){
                    document.getElementById(elemTargetLnk).setAttribute('href',brandSubline);
                }else{
                    document.getElementById(elemTargetLnk).removeAttribute('href');
                }
            }
        });
    }
}

function addMoreSocial(iconClass, iconName){
    let shopCount = '';
    if(!$('#all-social-inputs .social-block-outer').length){
        shopCount = 1;
    }else{
        shopCount = $('#all-social-inputs .social-block-outer').length + parseInt(1);
    }
    let addedSocialInput = `<div class="d-flex social-block-outer drag position-relative col-12" id="social-block-${shopCount}">
        <i class="close-btn qr-close-circle position-absolute d-inline-flex align-items-center justify-content-center" onclick="removeSocialBrand('social-block-${shopCount}','added-social-${shopCount}');"></i>
        <div class="social-block-inner flex-shrink-0 col-md-7">
            <span class="col-md-12 d-inline-block ps-4" for="social_logo">Custom URL</span>
            <div class="social-block col-12 d-inline-flex flex-column">
                <div class="d-flex align-items-center gap-2">
                    <i class="${iconClass} social-icon-url"></i>
                    <input name="social[${shopCount}][url]${shopCount}" data-target-link="added-social-${shopCount}" id="social-title-text-${shopCount}" maxlength="50" data-name="${iconName}" class="form-control social-title-text ml-1" type="url" placeholder="URL" />

                    <input name="social[${shopCount}][name]${shopCount}" data-target-link="added-social-${shopCount}" id="social-title-text-${shopCount}" maxlength="50"  class="form-control" type="hidden" placeholder="URL"  value="${iconClass}"/>
                </div>
            </div> 
        </div>
    </div>`;
    $('#all-social-inputs').append(addedSocialInput);

    let addedSocialMedia = `<a id="added-social-${shopCount}" class="added-social-box d-inline-flex align-items-center justify-content-center text-decoration-none"><i class="${iconClass}"></i></a>`;
    $('#added-social-icons').append(addedSocialMedia);
    
    $('.social-shop-container').removeClass('d-none');
    $('.social-shop-container').addClass('d-inline-block');
    
    setSocial();
}

function removeSocialBrand(id,shop){
    $('#'+id).remove();
    $('#'+shop).remove();
    let socialIcon = $('#added-social-icons .added-social-box').length;
    if(socialIcon === 0 || socialIcon == undefined || socialIcon == null){
        $('.social-shop-container').addClass('d-none');
        $('.social-shop-container').removeClass('d-inline-block');
    }
    let count = 1;
    $('#added-social-icons .added-social-box').each(function(){
        $(this).attr('id',"added-social-"+count);
        count++;
    });
    count = 1;
    $('#all-social-inputs .social-block-outer').each(function(){
        $(this).attr('id',"social-block-"+count);
        $(this).find('.qr-close-circle').attr('onclick',"removeSocialBrand('social-block-"+count+"','added-social-"+count+"');");
        $(this).find('.social-title-text').attr('id',"brand-title-text-"+count);
        $(this).find('.social-title-text').attr('name',"brand-title-text-"+count);
        $(this).find('.social-title-text').attr('data-target-link',"added-social-"+count);
        count++;
    });
}
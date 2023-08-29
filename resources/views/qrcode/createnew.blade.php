@extends('admin-panel.layout.one')
@section('title', 'QRCode New')
@section('bread-crumb')
@endsection
@section('content-area')
     <div class="col-12 d-inline-block">
        <div class="container">
            <div class="col-12 d-inline-block">
                <div class="col-md-7 creater-part-scroll position-sticky float-left">
                    <div class="col-12 d-inline-flex flex-column">
                        <div class="step-creation-box col-12 d-inline-block">
                            <h4 class="col-12 d-inline-flex align-items-center"><span
                                    class="title-step-box d-inline-flex align-items-center">Step 1.</span> Branding</h4>
                            <div class="d-inline-flex align-items-center col-12 p-2 mb-4">
                                <h6 class="d-inline-flex brand-title col-md-4 m-0">Brand Logo</h6>
                                <div class="col-md-8 d-inline-flex align-items-center">
                                    <label class="logo-type-title d-inline-block">Logo Circle</label>
                                    <div class="circle-logo-box d-inline-flex flex-column">
                                        <img src="Ellipse-51.png" id="logo-icon" class="circled-logo" />
                                        <small class="logo-note d-inline-block col-12 text-center">Size should be 100 x 100</small>
                                    </div>
                                    <div class="logo-upload-btns ms-auto d-inline-flex flex-column">
                                        <span
                                            class="upload-btn d-inline-flex align-items-center justify-content-center position-relative">Upload
                                            <input type="file" class="position-absolute opactiy-0 upload-logo-btn" accept="image/*" id="logo-icon-btn" data-image="added-logo-icon" data-image-display="logo-icon"/>
                                        </span>
                                        <span
                                            class="clear-btn d-inline-flex align-items-center justify-content-center" id="logo-icon-clear">Clear</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-inline-flex align-items-center col-12 p-2 mb-2">
                                <h6 class="d-inline-flex brand-title col-md-4 m-0">Brand Logo</h6>
                                <div class="col-md-8 d-inline-flex align-items-center">
                                    <label class="logo-type-title d-inline-block">Logo Rectangle</label>
                                    <div class="circle-logo-box d-inline-flex flex-column">
                                        <img src="image-24.png" id="full-logo" class="full-logo" />
                                        <small class="logo-note d-inline-block col-12 text-center">Size should be 180 x
                                            60</small>
                                    </div>
                                    <div class="logo-upload-btns ms-auto d-inline-flex flex-column">
                                        <span
                                            class="upload-btn d-inline-flex align-items-center justify-content-center position-relative">Upload
                                            <input type="file" class="position-absolute opactiy-0 upload-logo-btn" accept="image/*" id="full-logo-btn" data-image="added-logo-rectangle" data-image-display="full-logo"/>
                                        </span>
                                        <span
                                            class="clear-btn d-inline-flex align-items-center justify-content-center" id="full-logo-clear">Clear</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-inline-block mb-3">
                                <label class="logo-input-title col-12 d-inline-block">Brand Title Name</label>
                                <input type="text" placeholder="Brand Title Name" id="brand-title"
                                    class="col-12 d-inline-block brand-tilte-input" />
                            </div>
                            <div class="col-12 d-inline-block mb-3">
                                <label class="logo-input-title col-12 d-inline-block">Brand Title SubLine</label>
                                <input type="text" placeholder="Brand Title SubLine" id="brand-subline"
                                    class="col-12 d-inline-block brand-tilte-input" />
                            </div>
                            <div class="col-12 d-inline-block mb-3">
                                <label class="logo-input-title col-12 d-inline-block mb-2">Background Color</label>
                                <div class="col-12 d-inline-flex justify-content-between">
                                    <div class="d-inline-flex align-items-center ms-3">
                                        <span class="d-inline-flex align-items-center" onclick="selectColorOpt('0');">
                                            <input type="radio" checked name="background" id="solidColor" />
                                            <label class="radio-color-text" for="solidColor">Solid</label>
                                        </span>
                                        <input class="background1" type="color" value="#0000ff" />
                                    </div>
                                    <div class="d-inline-flex align-items-center me-4">
                                        <span class="d-inline-flex align-items-center" onclick="selectColorOpt('1');">
                                            <input type="radio" name="background" id="gradientColor" />
                                            <label class="radio-color-text" for="gradientColor">Gradient</label>
                                        </span>
                                        <input class="color1" type="color" value="#0000ff" />&nbsp;&nbsp;
                                        <input class="color2" type="color" value="#add8e6" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step-creation-box col-12 d-inline-block">
                            <h4 class="col-12 d-inline-flex align-items-center"><span
                                    class="title-step-box d-inline-flex align-items-center">Step 2.</span> Step Multi
                                URL QR</h4>
                            <div class="col-12 d-inline-block mb-3">
                                <div class="col-12 d-inline-block all-shop-inputs" id="all-shop-inputs">
                                    <div class="d-flex social-block-outer mb-3 col-12 position-relative" id="shop-input-box-1">
                                        <div class="social-block-inner flex-shrink-0 col-md-7">
                                            <span class="col-md-12 d-inline-block ps-4" for="social_logo">Custom URL</span>
                                            <div class="social-block col-12 d-inline-flex flex-column">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="qr-url social-icon-url"></i>
                                                    <input name="brand-title-text-1" data-target="brand-shop-label-1" id="brand-title-text-1" maxlength="50"
                                                        class="form-control brand-shop-input ml-1" type="text" placeholder="Title" />
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="qr-url social-icon-url"></i>
                                                    <input name="brand-title-url-1" id="brand-title-url-1" class="form-control brand-shop-input ml-1" type="url" placeholder="URL" data-target-link="brand-shop-box-1"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-inline-flex align-items-center col-md-5">
                                            <div class="circle-logo-box flex-wrap d-inline-flex align-items-center justify-content-center">
                                                <img src="image-29.png" id="shop-logo-icon-1" class="circled-logo" />
                                                <small class="logo-note d-inline-block col-12 text-center">Size should be 100 x 100</small>
                                            </div>
                                            <div class="logo-upload-btns d-inline-flex align-items-center ms-auto">
                                                <span
                                                    class="upload-btn d-inline-flex align-items-center justify-content-center position-relative">Upload
                                                    <input type="file" class="position-absolute opactiy-0 upload-logo-btn" accept="image/*" id="logo-icon-btn-1" data-image="shop-brand-icon-1" data-image-display="shop-logo-icon-1"/>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span
                                    class="add-multi-brands-btn ms-auto d-inline-flex align-items-center justify-content-center" onclick="addMoreShops();">Add
                                    Brands</span>
                            </div>
                        </div>

                        <div class="step-creation-box col-12 d-inline-block">
                            <h4 class="col-12 d-inline-flex align-items-center">
                                <span class="title-step-box d-inline-flex align-items-center">Step 3.</span> Step Social Media</h4>
                            <div class="add-social col-12 d-inline-block">
                                <label class="add-social-label d-inline-flex align-items-center mb-2"><i class="qr-exclamation-circle mr-1"></i>&nbsp;Add Social Media</label>
                                <div class="buttons-wrapper col-12 d-inline-block">
                                    <div class="social-buttons-wrapper col-12 d-inline-flex flex-wrap">
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Facebook page URL"><i class="qr-facebook"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Instagram URL"><i class="qr-instagram"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Twitter handle"><i class="qr-twitter"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Youtube page URL"><i
                                                class="qr-youtube font-weight-bold"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Linkedin page URL"><i class="qr-linkedin"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Pinterest URL"><i
                                                class="qr-pinterest font-weight-bold"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Wechat ID"><i class="qr-wechat-main"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Custom URL"><i class="qr-url font-weight-bold"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Contact on Whatsapp"><i class="qr-whatsapp"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-line"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Tumblr link"><i class="qr-tumblr"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Skype username"><i class="qr-skype"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-snapchat"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-reddit"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Meetup"><i class="qr-meetup"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Quora profile"><i class="qr-quora"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-yelp"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Medium profile"><i class="qr-medium"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="QQ number"><i class="qr-qq"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-tiktok"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Email"><i class="qr-email1"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Contact by phone"><i class="qr-phone-call"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-twitch"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Contact on Telegram"><i class="qr-telegram"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Contact on Signal"><i class="qr-high-signal"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-viber"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Contact on Kakao Talk"><i
                                                class="qr-kakao-talk"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Contact on Doordash"><i class="qr-doordash"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-grubhub"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Follow us on Patreon"><i class="qr-patreon"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-soundcloud"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Connect on Streamlabs"><i
                                                class="qr-streamlabs"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-ubereats"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-podcast"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Connect on Postmates"><i class="qr-postmates"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-deliveroo"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Connect on Glovo"><i class="qr-glovo"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Connect on Just Eat"><i class="qr-justeat"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-swiggy"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-zomato"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-menulog"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-rakuten"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Connect on Yogiyo Food"><i class="qr-yogiyo"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Connect on FoodPanda"><i class="qr-foodpanda"></i>
                                        </div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center"><i class="qr-shopify"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Connect on Etsy"><i class="qr-etsy"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Shop on Ebay"><i class="qr-ebay"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Listen on Apple music"><i class="qr-applemusic"></i></div>
                                        <div class="btn-item d-inline-flex align-items-center justify-content-center" title="Shop on Amazon"><i class="qr-amazon"></i></div>
                                    </div>
                                </div>
                                <div class="icon-social-search-box position-relative col-12 mt-4 mb-5 d-inline-block">
                                    <i class="qr-search position-absolute"></i>
                                    <input name="social-search" class="icon-social-search d-inline-block col-12" type="text" placeholder="Search"/>
                                </div>
                            </div>
                            <div class="col-12 d-inline-block mb-3">
                                <div class="col-12 d-inline-flex all-social-inputs flex-column" id="all-social-inputs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-inline-flex justify-content-center mt-5 float-left">
                    <div class="col-md-9 d-inline-block phone-screen-box">
                        <div class="brand-banner-container col-12 position-relative d-inline-block">
                            <div class="col-12 d-inline-flex align-items-center justify-content-start header-logo-row mb-5">
                                <span class="logo-circle-box overflow-hidden d-inline-flex align-items-center justify-content-center">
                                    <img src="Ellipse-51.png" id="added-logo-icon"/>
                                </span>
                                <span class="logo-rectangle-box d-inline-flex align-items-center justify-content-center">
                                    <img src="image-24.png" id="added-logo-rectangle"/>
                                </span>
                            </div>
                            <div class="brand-text-container d-inline-block col-12 mb-3">
                                <h3 class="brand-shop-title col-12 text-left" id="brand-name">Circle Food</h3>
                                <h6 class="brand-sub-title col-12 text-left" id="brand-subtext">Feel the real taste of india</h6>
                            </div>
                        </div>
                        <div class="brand-shop-container position-relative col-12 d-inline-flex flex-column mb-3" id="muti-brand-boxes">
                            <a class="brand-shop-links align-items-center d-inline-flex col-12 text-decoration-none position-relative" id="brand-shop-box-1" href="javascript:void(0);">
                                <span class="added-brand-icon d-inline-flex align-items-center justify-content-center">
                                    <img src="image-29.png" id="shop-brand-icon-1"/>
                                </span>
                                <span class="added-brand-text d-inline-flex" id="brand-shop-label-1">Visit our web store</span>
                                <span class="goLink-arrow position-absolute d-inline-flex align-items-center">
                                    <svg width="9" height="18" viewBox="0 0 9 18" fill="none">
                                        <path d="M1 1L7.5 9L1 17" stroke="#2C67FF" stroke-width="2"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <div class="social-shop-container col-12 d-none mb-3">
                            <div class="added-social-shop-icons col-12 d-inline-flex justify-content-center flex-column">
                                <h4 class="shop-social-title mt-0 mb-1 col-12 text-left">We are on social media</h4>
                                <p class="shop-social-desc mt-0 mb-3 col-12 text-left">Shop via social media</p>
                                <div class="col-12 d-inline-flex flex-wrap added-social-icons-Box" id="added-social-icons"></div>
                            </div>
                        </div>
                        <div class="download-brochure-btn-box p-3 col-12">
                            <button class="download-brochure-btn col-12 d-inline-flex align-items-center justify-content-center">Download our Catalogue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
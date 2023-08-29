<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RewardsPlus :: QRCode</title>
    @include('admin-panel.include.head')
    <link id="color" rel="stylesheet" href="{{asset('assets/css/qrstyles.css')}}">

</head>
@php
@endphp
<body>
    <div class="page-wrapper null compact-wrapper" id="pageWrapper">
        <div class="page-body-wrapper d-flex justify-content-center m-5">
            <div class="col-md-4 d-inline-flex justify-content-center  float-left">
                <div class="col-md-12 d-inline-block phone-screen-box">
                    <div class="brand-banner-container col-12 position-relative d-inline-block" style="background:{{ $qRCode->background_color}};">
                        <div class="col-12 d-inline-flex align-items-center justify-content-start header-logo-row mb-5">
                            <span class="logo-circle-box overflow-hidden d-inline-flex align-items-center justify-content-center">
                                <img src="{{ asset('uploads').'/'.$qRCode->brand_logo_circle ?? '' }}" id="added-logo-icon"/>
                            </span>
                            <span class="logo-rectangle-box d-inline-flex align-items-center justify-content-center">
                                <img src="{{ asset('uploads').'/'.$qRCode->brand_logo_rectangle ?? '' }}" id="added-logo-rectangle"/>
                            </span>
                        </div>
                        <div class="brand-text-container d-inline-block col-12 mb-3">
                            <h3 class="brand-shop-title col-12 text-left" id="brand-name">{{ $qRCode->brand_name ?? ''  }}</h3>
                            <h6 class="brand-sub-title col-12 text-left" id="brand-subtext">{{ $qRCode->brand_title ?? ''  }}</h6>
                        </div>
                    </div>
                    <div class="brand-shop-container position-relative col-12 d-inline-flex flex-column mb-3" id="muti-brand-boxes">
                        @php
                            $customURL = json_decode($qRCode['custom_url'],true) ?? [];
                        @endphp
                        @foreach($customURL as $key => $value)
                            @php
                                $filePath = isset($value['file_name']) ? $value['file_name'] : '';
                                $fileName = isset($value['name']) ? $value['name'] : '';
                                $fileUrl = isset($value['url']) ? $value['url'] : '';
                                
                            @endphp
                            <a class="brand-shop-links align-items-center d-inline-flex col-12 text-decoration-none position-relative" id="brand-shop-box-1" href="{{$fileUrl}}">
                                <span class="added-brand-icon d-inline-flex align-items-center justify-content-center">
                                    <img src="{{ asset('uploads').'/'.$filePath}}" id="shop-brand-icon-1"/>
                                </span>
                                <span class="added-brand-text d-inline-flex" id="brand-shop-label-1">{{ $fileName  }}</span>
                                <span class="goLink-arrow position-absolute d-inline-flex align-items-center">
                                    <svg width="9" height="18" viewBox="0 0 9 18" fill="none">
                                        <path d="M1 1L7.5 9L1 17" stroke="#2C67FF" stroke-width="2"/>
                                    </svg>
                                </span>
                            </a>
                        @endforeach
                    </div>
                    <div class="social-shop-container col-12  mb-3">
                        <div class="added-social-shop-icons col-12 d-inline-flex justify-content-center flex-column">
                            <h4 class="shop-social-title mt-0 mb-1 col-12 text-left">We are on social media</h4>
                            <p class="shop-social-desc mt-0 mb-3 col-12 text-left">Shop via social media</p>
                            <div class="col-12 d-inline-flex flex-wrap added-social-icons-Box" id="added-social-icons">
                                {{-- social --}}
                                @if(is_array($qRCode['social']) )
                                    @foreach($qRCode['social'] as $key => $value)
                                        <a id="added-social-1" href="{{$value['url']}}" class="added-social-box d-inline-flex align-items-center justify-content-center text-decoration-none">
                                            <i class="{{$value['name']}}"></i>
                                        </a>
                                        
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="download-brochure-btn-box p-3 col-12">
                        <button class="download-brochure-btn col-12 d-inline-flex align-items-center justify-content-center">Download our Catalogue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

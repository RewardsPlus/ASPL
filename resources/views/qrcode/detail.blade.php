@extends('admin-panel.layout.one')
@section('title', 'QRCode')
@section('bread-crumb')
@endsection
@section('content-area')
<div class="card">
    <div class="card-header pb-0">
        <div class="row d-flex">
            <div class="col-6">
                <h5>QR Code </h5>
            </div>
            <div class="col-6">
            </div>
        </div>
    </div>

        <div class="card-body">
            <div class="row pb-1">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-3">
                            {!!Form::label('Brand Name')!!}
                        </div>
                        <div class="col-9">
                            {{$qRCode->brand_name ?? ''}}
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row d-flex">
                        <div class="col-12">
                            <svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" class="float-end">
                                <image href="{{asset('qr_codes/'.$qRCode->id.'.svg')}}" height="200" width="200" />
                            </svg>                            
                        </div>
                    </div>
                </div>

                <span class="pt-2"><b>Preview</b></span>
                <hr>

                <div class="container w-50 text-center">
                    <div class="row flex-column">
                        <div class="col-6">
                            <img src="{{asset('uploads').'/'.$qRCode->logo}}" alt="Logo" height="100" width="100" style="border-radius:100px;">
                        </div>
                        <div class="col-6 pt-3">
                            {{$qRCode->name?? ''}}
                        </div>
                    </div>
                    <div class="row flex-column">
                        <div class="col-6">
                            {{$qRCode->description?? ''}}
                        </div>
                    </div>
                    <div class="row pt-4 flex-column">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4">
                                    @php
                                        $linkLogo = $qRCode->link_logo ?? '';
                                    @endphp
                                    <image src="{{asset('uploads/'.$linkLogo)}}" height="100" width="100" style="border-radius:100px;" />        
                                </div>
                                <div class="col-8">
                                    {{$qRCode->link_text ?? ''}}
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-4">
                            
                            </div>
                            <div class="col-8">
                                
                            </div>
                        </div>

                    </div>
                    <div class="row pt-4 float-start">
                        <div class="social-icons">
                            <a href="#" class="icon"><img src="{{asset('images/icons8-facebook.svg')}}" alt="Facebook"></a>
                            <a href="#" class="icon"><img src="{{asset('images/icons8-instagram.svg')}}" alt="Instagram"></a>
                            <a href="#" class="icon"><img src="{{asset('images/icons8-whatsapp.svg')}}" alt="WhatsApp"></a>
                            <a href="#" class="icon"><img src="{{asset('images/icons8-linkedin.svg')}}" alt="LinkedIn"></a>
                            <a href="#" class="icon"><img src="{{asset('images/icons8-youtube.svg')}}" alt="YouTube"></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div>
@endsection
@extends('admin-panel.layout.one')
@section('title', 'QRCode')
@section('bread-crumb')
@endsection
@section('content-area')
<div class="card">
    {!!Form::model($qRCode,['route'=>['qrcodes.update',$qRCode], 'files' => true,'method'=>'put'])!!}
    <div class="card-header pb-0">
        <div class="row d-flex">
            <div class="col-6">
                <h5>QR Code </h5>
            </div>
            <div class="col-6">
                {!!Form::button('Update',['class'=>'btn btn-primary float-end','type'=>'submit'])!!}
            </div>
        </div>
    </div>

        <div class="card-body">
            <div class="row pb-1">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-3">
                            {!!Form::label('name')!!}
                        </div>
                        <div class="col-9">
                            {!!Form::text('name',null,['class'=>'form-control'])!!}
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-3">
                            {!!Form::label('title')!!}
                        </div>
                        <div class="col-9">
                            {!!Form::text('title',null,['class'=>'form-control'])!!}
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="row pb-2">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-3">
                            {!!Form::label('description')!!}
                        </div>
                        <div class="col-9">
                            {!!Form::textarea('description',null,['class'=>'form-control','rows'=>4])!!}
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-3">
                            {!!Form::label('logo')!!}
                        </div>
                        <div class="col-9">
                            {!!Form::file('logo',null,['class'=>'form-control'])!!}
                            
                        </div>
                    </div>
                </div>

            </div>

            <span><b>Links</b></span>
            <hr>

            <div class="row pb-2">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-3">
                            {!!Form::label('logo')!!}
                        </div>
                        <div class="col-9">
                            {!!Form::file('link_logo',null,['class'=>'form-control'])!!}
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-3">
                            {!!Form::label('link text')!!}
                        </div>
                        <div class="col-9">
                            {!!Form::text('link_text',null,['class'=>'form-control','rows'=>4])!!}
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-3">
                            {!!Form::label('URL')!!}
                        </div>
                        <div class="col-9">
                            {!!Form::url('link_url',null,['class'=>'form-control'])!!}
                            
                        </div>
                    </div>
                </div>

            </div>

            <span class="pt-2"><b>Social Networks</b></span>
            <hr>

            <div class="row pb-2">
                <div class="col-md-4">
                    {!!Form::label('WhatsApp')!!}
                </div>
                <div class="col-md-8">
                    {!!Form::url('Whatsapp',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4">
                    {!!Form::label('Facebook')!!}
                </div>
                <div class="col-md-8">
                    {!!Form::url('facebook',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4">
                    {!!Form::label('YouTube')!!}
                </div>
                <div class="col-md-8">
                    {!!Form::url('youtube',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4">
                    {!!Form::label('instagram')!!}
                </div>
                <div class="col-md-8">
                    {!!Form::url('instagram',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4">
                    {!!Form::label('LinkedIn')!!}
                </div>
                <div class="col-md-8">
                    {!!Form::url('linkedin',null,['class'=>'form-control'])!!}
                </div>
            </div>
        </div>
    {!!Form::close()!!}
</div>
@endsection
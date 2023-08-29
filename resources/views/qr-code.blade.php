@extends('admin-panel.layout.one')
@section('title', 'QRCode')
@section('bread-crumb')

    {{QrCode::size(200)->generate('Hello!');}}

@endsection
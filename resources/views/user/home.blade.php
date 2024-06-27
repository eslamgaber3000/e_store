@extends('user.layout')

@section("latest")
    @include("user.best_fetcher")
@endsection

@section("best_product")

@include('user.latest_product')
@endsection

@section('banner')
@include('user.BannerItems')
@endsection

@section('title')
Home
@endsection

@extends('layouts.app')

@section('title', 'Energy Solutions')

@section('content')
    @include('sections.slider')
    @include('sections.about')
    @include('sections.services-grid')
    @include('sections.slogan1')
    @include('sections.gallery-feature')
    @include('sections.slogan2')
    @include('sections.stats')
    @include('sections.complaint-form')
    @include('sections.order-form')
    @include('sections.testimonials')
    @include('sections.partners')
    @include('sections.blog')
    @include('sections.future-services')
@endsection

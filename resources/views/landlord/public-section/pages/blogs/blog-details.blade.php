@extends('landlord.public-section.layouts.master')
@section('public-title','Blog Details')

@section('public-content')

    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center mb-5">
                    <h1 class="mt-3 text-center">{{$blog->title}}</h1>
                </div>
                <div class="col-md-6 offset-md-3 mb-5">
                    <img class="mb-5" src="{{asset('landlord/images/blog/'.$blog->image)}}" alt="{{$blog->title}}"/>
                    	{!! htmlspecialchars_decode($blog->description) !!}
                </div>
            </div>
        </div>
    </section>

@endsection

@extends('admin')

@section('content')
<div class="main__title">
    <img src="{{ asset('assets/hello.svg') }}" alt="" />
    <div class="main__greeting">
      <h1>Hello</h1>
      <p>Welcome to your admin dashboard</p>
    </div>
  </div>

  <!-- MAIN TITLE ENDS HERE -->

  <!-- MAIN CARDS STARTS HERE -->          
  <div class="main__cards">

    <div class="card">
      <i
        class="fa fa-user-o fa-2x text-lightblue"
        aria-hidden="true"
      ></i>
      <div class="card_inner">
        <p class="text-primary-p">Number of Subscribers</p>
        <span class="font-bold text-title">578</span>
      </div>
    </div>

    <div class="card">
      <i class="fa fa-calendar fa-2x text-red" aria-hidden="true"></i>
      <div class="card_inner">
        <p class="text-primary-p">Times of Watching</p>
        <span class="font-bold text-title">2467</span>
      </div>
    </div>

    <div class="card">
      <i
        class="fa fa-video-camera fa-2x text-yellow"
        aria-hidden="true"
      ></i>
      <div class="card_inner">
        <p class="text-primary-p">Number of Videos</p>
        <span class="font-bold text-title">340</span>
      </div>
    </div>

    <div class="card">
      <i
        class="fa fa-thumbs-up fa-2x text-green"
        aria-hidden="true"
      ></i>
      <div class="card_inner">
        <p class="text-primary-p">Number of Likes</p>
        <span class="font-bold text-title">645</span>
      </div>
    </div>
  </div>
@endsection

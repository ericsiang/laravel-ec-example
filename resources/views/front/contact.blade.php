@extends('front.extends.layout')


@section('title','Namira | Home')

@section('content')

@php
if(session()->has('msg')){
    echo '<script>alert("'.session()->get("msg").'");</script>';
}
@endphp


 <!-- Contact -->
 <section class="section-wrap pb-40">
    <div class="container">
      <div class="row">

        <div class="col-lg-12">
          <h2 class="uppercase">drop us a line</h2>
          <p>This is my first laravel EC project </p>

          <!-- Contact Form -->
          <form  class="contact-form mt-30 mb-30" method="post" action="/contact">
            @csrf
            <div class="contact-name">
              <label for="name">Name <abbr title="required" class="required">*</abbr></label>
              <div style='color:#FF0000;'>{{ $errors->first('name') }}</div>
              <input name="name" id="name" type="text" value="{{ old('name') ?? "" }}">
            </div>
            <div class="contact-email">
              <label for="email">Email <abbr title="required" class="required">*</abbr></label>
              <div style='color:#FF0000;'>{{ $errors->first('email') }}</div>
              <input name="email" id="email" value="{{ old('email') ?? "" }}">
              
            </div>
            <div class="contact-subject">
              <label for="email">Subject</label>
              <input name="subject" id="subject" type="text" value="{{ old('subject') ?? "" }}">
            </div>
            <div class="contact-message">
              <label for="message">Message <abbr title="required" class="required">*</abbr></label>
              <div style='color:#FF0000;'>{{ $errors->first('message') }}</div>
              <textarea id="message" name="message" rows="7" >{{ old('message') ?? "" }}</textarea>
            </div>

            <input type="submit" class="btn btn-lg btn-color btn-button" value="Send Message" >
            <div id="msg" class="message"></div>
          </form>
        </div> <!-- end col -->
        <!--
        <div class="col-lg-4">
          <div class="contact-info">
            <ul>
              <li class="contact-info__item">
                <h4 class="contact-info__title uppercase">Address</h4>
                <h6 class="contact-info__store-title">Philippines Store</h6>
                <address class="address">Philippines, PO Box 620067, Talay st. 66, A-ha inc.</address>
                <h6 class="contact-info__store-title">Canada Store</h6>
                <address class="address">A-ha inc, 10-123 Main st. NW, Montreal QC, H3Z2Y7</address>
              </li>
              <li class="contact-info__item">
                <h4 class="contact-info__title uppercase">Contact Info</h4>
                <ul>
                  <li><span>Phone: </span><a href="tel:+1-888-1554-456-123">+ 1-888-1554-456-123</a></li>
                  <li><span>Email: </span><a href="mailto:themesupport@gmail.com">themesupport@gmail.com</a></li>
                  <li><span>Skype: </span><a href="#">ahasupport</a></li>
                </ul>
              </li>
              <li class="contact-info__item">
                <h4 class="contact-info__title uppercase">Business Hours</h4>
                <ul>
                  <li>Monday – Friday: 9am to 20 pm</li>
                  <li>Saturday: 9am to 17 pm</li>
                  <li>Sunday: closed</li>
                </ul>
              </li>
            </ul>
            
          </div>
        </div>-->

      </div>
    </div>
  </section> <!-- end contact -->

@endsection
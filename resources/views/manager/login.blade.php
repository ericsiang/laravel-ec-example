<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | Login</title>

    @include('manager.inc.head')
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      @if(session()->has('msg'))
      <script>alert('{{ session()->get("msg") }}');</script>
      @endif

      @if(session()->has('login_msg'))
      <script>alert('{{ session()->get("login_msg") }}');</script>
      @endif

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action='/manager/login' method='POST'>
              @csrf
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="account" value="{{ old('account') }}" />
                <div style='color:#FF0000;float:right;'>{{ $errors->first('account') }}</div>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password"  name="password" />
                <div style='color:#FF0000;float:right;'>{{ $errors->first('password') }}</div>
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>

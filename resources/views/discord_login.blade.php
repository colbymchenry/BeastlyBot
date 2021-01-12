@extends('layouts.app-zero')

@section('title', 'Login')

@section('content')

<!-- Page -->
<div class="page vertical-align text-center draw-grad" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
      <!--<h2 class="grey-100">Discord Bot <sup><small>VIP</small></sup></h2>-->
      <div class="pb-5">
        <h2 class="mb-0" style="color:#151516"><i class="icon icon-discord" aria-hidden="true"></i></h2>
        <h2 class="grey-200 mt-10">BeastlyBot</h2>
        <p><i>The beastly subscription bot for communities.</i></p>
      </div>
        <!--<form method="post" role="form">
          <div class="input-group">
            <input type="password" class="form-control last" id="inputPassword" name="password"
              placeholder="Enter password">
            <span class="input-group-append">
              <button type="submit" class="btn btn-primary"><i class="icon wb-unlock" aria-hidden="true"></i>
                <span class="sr-only">unLock</span>
              </button>
            </span>
          </div>
        </form>-->
        <form>
        <button type="button" class="btn btn-lg btn-tagged social-discord ladda-button" data-style="slide-up" data-plugin="ladda"
        onclick="window.location.href='{{ env('DISCORD_OAUTH_URL') }}'">
            <span class="btn-tag"><i class="icon icon-discord" aria-hidden="true"></i></span>
            <span class="ladda-label">Login with Discord</span>
            <span class="ladda-spinner"></span>
        </button>
        </form>
        <p class="p-30"><a href="/" class="blue-grey-600">Or visit our home page</a></p>

       <!--- <footer class="page-copyright page-copyright-inverse">
          <p>WEBSITE BY Subscription Bot</p>
          <p>© 2019. All RIGHT RESERVED.</p>
          <div class="social">
            <a href="javascript:void(0)">
          <i class="icon bd-twitter" aria-hidden="true"></i>
        </a>
            <a href="javascript:void(0)">
          <i class="icon bd-facebook" aria-hidden="true"></i>
        </a>
            <a href="javascript:void(0)">
          <i class="icon bd-dribbble" aria-hidden="true"></i>
        </a>
          </div>
        </footer>-->
      </div>
    </div>
    <!-- End Page -->

@endsection

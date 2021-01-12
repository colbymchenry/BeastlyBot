    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© {{ date('Y') }} <a href="https://beastlybot.com">BeastlyBot</a></div>
     <!-- <div class="site-footer-right">
        Crafted with <i class="red-600 wb wb-heart"></i> by <a href="https://robs.studio" target="_blank">Robs Studio</a>
      </div>-->
    </footer>
@section('help-button')
  <div class="site-helptools" data-step="1" data-position="left" data-intro="If you need help check here!">
      <div class="site-helptools-inner">
          <div class="site-helptools-toggle" data-toggle="site-sidebar" title="Help" data-url="/slide-help-titles">
            <i class="icon wb-help-circle"></i>
          </div>
      </div>
  </div>
  <button class="btn d-none slide-button-ultimate" style="visiblity:hidden" data-toggle="site-sidebar" data-url="/slide-help-ultimate-shop-guide">slide
  </button>
@endsection
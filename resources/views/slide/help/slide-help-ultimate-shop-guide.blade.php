<header class="slidePanel-header dual bg-blue-600">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close d-none" id="slide-close"
      aria-hidden="true"></button>
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left" id="slide-back"
      aria-hidden="true" data-url="/slide-help-titles" data-toggle="site-sidebar"></button>
  </div>
  </div>
  <h1>Help</h1>
  <p>Ultimate Shop Guide</p>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-help">
        <div>
            <div>
                <div>
                {{--@if(!auth()->user()->getStripeHelper()->isExpressUser())
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action flex-column align-items-start text-center pulse" href="{{ 'https://connect.stripe.com/express/oauth/authorize?redirect_uri=' . env('APP_URL') . '&client_id=' . env('STRIPE_CLIENT_ID')  }}">
                            <h4 class="list-group-item-heading mt-0 mb-5">Connect Stripe</h4>
                            <p class="mb-0">@lang('lang.connect_stripe')</p>
                            <p><button type="button" class="btn btn-primary btn-block mt-2 ladda-button"
                                    onclick="window.location.href = '{{ 'https://connect.stripe.com/express/oauth/authorize?redirect_uri=' . env('APP_URL') . '&client_id=' . env('STRIPE_CLIENT_ID')  }}';"
                                    data-style="slide-up" data-plugin="ladda">
                                    <i class="icon-stripe ladda-label" aria-hidden="true"></i>
                                    <br>
                                    <span class="ladda-label">Connect Stripe</span>
                                    <span class="ladda-spinner"></span>
                                </button>
                            </p>
                        </a>
                    </div>
                @endif --}}
                    <p>The <mark>Ultimate Shop Guide</mark>, follow this guide to setup shop!</p>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start active" href="#step1">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step1">1. Add a Server</h4>
                            <p class="mb-0">Add Beastly Bot to your server and start your shop.</p>
                            </a>
                            <a class="list-group-item flex-column align-items-start active" href="#step2">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step2">2. Create a Product</h4>
                            <p class="mb-0">Selecting roles to enable and set subscription prices.</p>
                            </a>
                            <a class="list-group-item flex-column align-items-start active" href="#step3">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step3">3. Store Settings</h4>
                            <p class="mb-0">Finalize store looks and checkout images.</p>
                            </a>
                            <a class="list-group-item flex-column align-items-start active" href="#step4">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step4">4. Going Live</h4>
                            <p class="mb-0">Make your store public and start selling roles with Go Live.</p>
                            </a>
                        </div>
                </div>
                <ul class="timeline timeline-icon">
                {{--@if(auth()->user()->getStripeHelper()->isExpressUser())--}}
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step1">Step 1</span>
                    @include('help/block/adding-a-server')
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step2">Step 2</span>
                    @include('help/block/creating-a-product')
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step3">Step 3</span>
                    @include('help/block/setting-server-settings')
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step4">Step 4</span>
                    @include('help/block/go-live')
                {{--@endif--}}
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    if(window.location.href.includes('auto-open')) {
        $("#slide-close").removeClass('d-none')
        $("#slide-back").addClass('d-none')
    };
    if(window.location.href.includes('server?')) {
        $("#go-to-step2").click();
    }
    if(window.location.href.includes('dashboard')) {
        setTimeout(function(){
            if( $('#servers-block').length ) {
                var guid = '#guide-ultimate=true';
                var slash = '/servers';
                var clickfirst = '?click-first=true';
                $('#servers-block').attr('href',slash + clickfirst + guid);
            }
        }, 100)
    };
    if(window.location.href.includes('servers')) {
        setTimeout(function(){
            $("#go-to-step1").click();
            $('#step1-icon-shop').toggleClass('icon-shop icon-check');
            location.hash = "guide-opened";
        },1000)
    };
    if((window.location.href.includes('server') && !window.location.href.includes('servers')) && !(jQuery("#roles_table:contains('Active')").length)) {
        setTimeout(function(){
            $("#go-to-step2").click();
            $('#step1-icon-shop').toggleClass('icon-shop icon-check');
            location.hash = "guide-opened";
        },1000)
    }else{
        setTimeout(function(){
        location.hash = "guide-opened";
        },1000)
    };
</script>

@include('partials/clear_script')

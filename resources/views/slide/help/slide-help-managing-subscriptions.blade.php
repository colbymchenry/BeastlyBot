<header class="slidePanel-header dual bg-blue-600">
<div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close d-none" id="slide-close"
      aria-hidden="true"></button>
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left" id="slide-back"
      aria-hidden="true" data-url="/slide-help-titles" data-toggle="site-sidebar"></button>
  </div>
  <h1>Help</h1>
  <p>Managing Subscriptions</p>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-help">
        <div>
            <div>
                <div>
                    <p><mark>Managing Subscriptions</mark>, follow this guide to</p>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start active" href="#step1">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step1">1. My Subscriptions</h4>
                            <p class="mb-0">See all active and inactive subscriptions.</p>
                            </a>
                            <a class="list-group-item flex-column align-items-start active" href="#step1">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step2">2. Subscription Details</h4>
                            <p class="mb-0">View subscription details and end date.</p>
                            </a>
                            <a class="list-group-item flex-column align-items-start active" href="#step1">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step3">3. How to Unsubscribe</h4>
                            <p class="mb-0">How to unsubscribe from a subscription.</p>
                            </a>             
                        </div>
                </div>
                <ul class="timeline timeline-icon">
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step1">Step 1</span>
                    @include('help/block/my-subscriptions')
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step2">Step 2</span>
                    @include('help/block/my-subscriptions-details')
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step3">Step 3</span>
                    @include('help/block/my-subscriptions-unsubscribe')
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    if(window.location.href.includes('#auto-open')) {
        $("#slide-close").removeClass('d-none')
        $("#slide-back").addClass('d-none')
    };
    if(window.location.href.includes('dashboard')) {
        setTimeout(function(){
            if( $('#servers-block').length ) {
                var guid = '#guide-ultimate=true';
                var slash = '/servers';
                var clickfirst = '?click-first=true';
                $('#servers-block').attr('href',slash + clickfirst + guid);
            }
        }, 200)
    };
    if(window.location.href.includes('subscriptions')) {
        $("#go-to-step2").click();
    };
    if(window.location.href.includes('subscriptions?')) {
        setTimeout(function(){
            $("#go-to-step1").click();
            $('#step1-icon-star').toggleClass('icon-star icon-check');
            
        },400)
    };
</script>

@include('partials/clear_script')
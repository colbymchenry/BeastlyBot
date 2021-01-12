<header class="slidePanel-header dual bg-blue-600">
<div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close d-none" id="slide-close"
      aria-hidden="true"></button>
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left" id="slide-back"
      aria-hidden="true" data-url="/slide-help-titles" data-toggle="site-sidebar"></button>
  </div>
  <h1>Help</h1>
  <p>Creating a Promotion Code</p>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-help">
        <div>
            <div>
                <div>
                    <p>How to <mark>Create a Promotion Code</mark>, and increase subscriptions.</p>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start active" href="#step1">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step1">1. Add a Coupon</h4>
                            <p class="mb-0">Create sales and discounts for your shop!</p>
                            </a>            
                        </div>
                </div>
                <ul class="timeline timeline-icon">
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step1">Step 1</span>
                    @include('help/block/add-promotion')
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
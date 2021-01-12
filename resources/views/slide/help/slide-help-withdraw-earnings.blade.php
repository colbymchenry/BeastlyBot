<header class="slidePanel-header dual bg-blue-600">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close d-none" id="slide-close"
      aria-hidden="true"></button>
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left" id="slide-back"
      aria-hidden="true" data-url="/slide-help-titles" data-toggle="site-sidebar"></button>
  </div>
  </div>
  <h1>Help</h1>
  <p>Withdrawing Earnings</p>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-help">
        <div>
            <div>
                <div>
                    <p>How to <mark>Withdraw Earnings</mark> from your shop!</p>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start active" href="#step1">
                            <h4 class="list-group-item-heading mt-0 mb-5" id="go-to-step1">Withdrawing Earnings</h4>
                            <p class="mb-0">It's super easy and actually automatic.</p>
                            </a>
                        </div>
                </div>
                <ul class="timeline timeline-icon">
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step1">Step 1</span>
                    @include('help/block/withdraw-earnings')
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
</script>

@include('partials/clear_script')
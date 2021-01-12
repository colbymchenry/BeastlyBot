<header class="slidePanel-header dual bg-blue-600">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close d-none" id="slide-close"
      aria-hidden="true"></button>
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left" id="slide-back"
      aria-hidden="true" data-url="/slide-help-titles" data-toggle="site-sidebar"></button>
  </div>
  </div>
  <h1>Help</h1>
  <p>Removing our Bot</p>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-help">
        <div>
            <div>
                <ul class="timeline timeline-icon">
                    <span class="badge badge-lg badge-primary bg-purple-600" id="step1">Step 1</span>
                    <li class="timeline-period">You're cool no matter what.</li>
                    <li class="timeline-item">
                        <div class="timeline-dot bg-purple-500">
                        <i class="icon icon-shop" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-info pr-15">
                        Go to <a class="btn btn-dark btn-link ml-10" href="https://discordapp.com" target="_blank"><i class="icon icon-discord"></i> Discord</a>
                        </div>
                        <div class="timeline-content">
                            <div class="card card-article card-shadow">
                                <div class="card-block">
                                    <p>Head over to your server, find BeastlyBot and left click to kick him out. Poof, beastly is out of your life (and server), until you add 'em back!</p>
                                    <p class="card-text">
                                        <small>Remember if your <a href="/servers?click-first=true">shop</a> is live, to switch from Live to Test or orders will fail.</small>
                                    </p>                  
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-period">We'll miss you though :')</li>
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
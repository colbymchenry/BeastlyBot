
<header class="slidePanel-header bg-grey-4">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true" id="back-btn"></button>
    </div>
    <h1>Account Settings</h1>
</header>
<ul class="site-sidebar-nav nav nav-tabs nav-tabs-line" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#sidebar-settings-user" role="tab">
            <i class="icon wb-user" aria-hidden="true"></i>
            <h5>User</h5>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sidebar-settings-payments" role="tab">
            <i class="icon wb-order" aria-hidden="true"></i>
            <h5>Payments</h5>
        </a>
    </li>
    @if(auth()->user()->getStripeHelper()->isExpressUser())
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sidebar-settings-stripe" role="tab">
            <i class="icon icon-stripe" aria-hidden="true"></i>
            <h5>Payouts</h5>
        </a>
    </li>
    @endif
</ul>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-settings-user">
        <div>
            @include('partials/settings/settings_user')
        </div>
    </div>
    <div class="tab-pane fade" id="sidebar-settings-payments">
        <div>

            <div class="list-group list-group-dividered">
                <div class="h-only-xs-250 mb-20 mb-md-0" style="overflow:hidden">
                @include('partials/payments/payments_foreach')
                </div>
                <a href="/account/payments" class="btn btn-block btn-dark">View All</a>

            </div>

        </div>
    </div>
    @if(auth()->user()->getStripeHelper()->isExpressUser())
    <div class="tab-pane fade" id="sidebar-settings-stripe">
        <div>
            @include('partials/settings/settings_stripe')
        </div>
    </div>
    @endif

</div>

@include('partials/settings/settings_scripts')

@include('partials/clear_script')
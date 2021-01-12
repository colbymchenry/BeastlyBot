<header class="slidePanel-header bg-indigo-600">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true" id="back-btn"></button>
    </div>
    <h1>Promotions</h1>
</header>

    <div class="page-header my-10">

        <div class="page-header-actions">
            <a class="btn btn-primary btn-round bg-indigo-600 white" id="ABbtn"
            data-url="slide-promotions-add-coupon" data-toggle="slidePanel">
                <i class="icon wb-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">Add Coupon</span>
            </a>
            <a class="btn btn-primary btn-outline btn-round d-none" id="RBbtn" href="/promotions">
                <i class="icon wb-refresh" aria-hidden="true"></i>
                <span class="hidden-sm-down">Refresh</span>
            </a>
        </div>
    </div>

    <div class="page-content-table app-beast">

        <div class="page-main text-center">

            @include('partials/promotions/promotions_table')

        </div>
    </div>

@include('partials/clear_script')
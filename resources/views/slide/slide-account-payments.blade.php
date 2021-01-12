
<header class="slidePanel-header bg-grey-4">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true" id="back-btn"></button>
    </div>
    <h1>Payments</h1>
</header>

    <div class="row">

        <div class="col-md-12">
            <div class="card">

                <div class="card-body mt-md-10 payments">
                    <div class="list-group list-group-dividered">
                        @include('partials/payments/payments_foreach')                    
                    </div>
                </div>

            </div>
        </div>
        
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
        });
    </script>

@include('partials/clear_script')
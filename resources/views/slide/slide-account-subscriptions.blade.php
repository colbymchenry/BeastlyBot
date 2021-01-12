<header class="slidePanel-header bg-grey-4">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true" id="back-btn"></button>
    </div>
    <h1>Subscriptions</h1>
</header>

    <div class="page-content-table app-beast">
        <div class="page-main">

            <table class="table table-hover" id="SubscriptionTable" data-plugin="animateList" data-animate="fade"
                   data-child="tr">
                <tbody id="rolesTable">



                </tbody>
            </table>
            <!-- pagination -->


        </div>

    </div>

    @include('partials/subscriptions/subscriptions_script')

    <script>
        $('#rolesTable tr').each(function() {
            $(this).first().attr('data-step', '2');
            $(this).first().attr('data-intro', 'Now lets open this');
        });
    </script>
    <script>
        setTimeout(function(){
        if (RegExp('multipage', 'gi').test(window.location.search)) {
            introJs().setOption('disableInteraction','false').start();
            $('#rolesTable tr').each(function(){
                $(this).attr('data-url', $(this).data('url') + '?multipage=true');
            })
        }}, 1000);
    </script>

@include('partials/clear_script')
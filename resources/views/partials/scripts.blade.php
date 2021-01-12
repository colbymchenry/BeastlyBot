<!-- Core  -->
<script src="{{ asset('global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
<script src="{{ asset('global/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('global/vendor/popper-js/umd/popper.min.js') }}"></script>
<script src="{{ asset('global/vendor/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('global/vendor/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('global/vendor/animsition/animsition.js') }}"></script>
<script src="{{ asset('global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
<script src="{{ asset('global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
<script src="{{ asset('global/vendor/ashoverscroll/jquery-asHoverScroll.js') }}"></script>
<!-- Plugins -->
<script src="{{ asset('global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('global/vendor/intro-js/intro.js') }}"></script>
<script src="{{ asset('global/vendor/screenfull/screenfull.js') }}"></script>
<script src="{{ asset('global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
<script src="{{ asset('global/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
<script src="{{ asset('global/vendor/bootstrap-markdown/bootstrap-markdown.js') }}"></script>
<script src="{{ asset('global/vendor/marked/marked.js') }}"></script>
<script src="{{ asset('global/vendor/to-markdown/to-markdown.js') }}"></script>
<script src="{{ asset('global/vendor/bootbox/bootbox.js') }}"></script>
<script src="{{ asset('global/vendor/ladda/spin.min.js') }}"></script>
<script src="{{ asset('global/vendor/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('global/vendor/jquery-selective/jquery-selective.min.js') }}"></script>
<script src="{{ asset('global/vendor/matchheight/jquery.matchHeight-min.js') }}"></script>
<script src="{{ asset('global/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('global/vendor/jquery-labelauty/jquery-labelauty.js') }}"></script>
<script src="{{ asset('global/vendor/webui-popover/jquery.webui-popover.min.js') }}"></script>
<script src="{{ asset('global/vendor/slick-carousel/slick.js') }}"></script>
<script src="{{ asset('global/vendor/chartist/chartist.min.js') }}"></script>
<script src="{{ asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js') }}"></script>
<!-- Scripts -->
<script src="{{ asset('global/js/Component.js') }}"></script>
<script src="{{ asset('global/js/Plugin.js') }}"></script>
<script src="{{ asset('global/js/Base.js') }}"></script>
<script src="{{ asset('global/js/Config.js') }}"></script>

<script src="{{ asset('js-base/Section/Menubar.js') }}"></script>
<script src="{{ asset('js-base/Section/Sidebar.js') }}"></script>
<script src="{{ asset('js-base/Section/PageAside.js') }}"></script>
<script src="{{ asset('js-base/Plugin/menu.js') }}"></script>
<script src="{{ asset('js-base/config/tour.js') }}"></script>
<!-- Page -->
<script src="{{ asset('js/Site.js') }}"></script>
<script src="{{ asset('js/plugin.min.js') }}"></script>
<script src="{{ asset('global/js/Plugin/panel.js') }}"></script>
<script src="{{ asset('js-base/BaseApp.js') }}"></script>
<script src="{{ asset('js/App/Beast.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{ asset('examples/js/apps/beast.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>

@auth
    <script type="text/javascript">
        let stripe = Stripe('{{ \App\StripeHelper::getStripePublic() }}');

        function timeDiff( tstart, tend ) {
            var diff = Math.floor((tend - tstart) / 1000), units = [
                { d: 60, l: "seconds" },
                { d: 60, l: "minutes" },
                { d: 24, l: "hours" },
                { d: 7, l: "days" }
            ];

            var data = [];

            for (var i = 0; i < units.length; ++i) {
                data[units[i].l] = (diff % units[i].d);
                diff = Math.floor(diff / units[i].d);
            }

            return data;
        }

        function timeDiffStr(tstart, tend) {
            var timeDiffArray = timeDiff(tstart, tend);
            var timeDiffVal = timeDiffArray['days'];

            if (timeDiffVal == 1) {
                var timeDiffStr =  timeDiffVal + ' day ago';
            }else{
            var timeDiffStr = timeDiffVal + ' days ago';
            }

            if(timeDiffVal < 1) {
                timeDiffVal = timeDiffArray['hours'];
                if (timeDiffVal == 1) {
                        timeDiffStr = timeDiffVal + ' hour ago';
                }else{
                        timeDiffStr = timeDiffVal + ' hours ago';
                }
                if(timeDiffVal < 1) {
                    timeDiffVal = timeDiffArray['minutes'];
                    if (timeDiffVal == 1) {
                        timeDiffStr = timeDiffVal + ' minute ago';
                    }else{
                        timeDiffStr = timeDiffVal + ' minutes ago';
                    }
                    if(timeDiffVal < 1) {
                        timeDiffVal = timeDiffArray['seconds'];
                        if (timeDiffVal == 1) {
                            timeDiffStr = timeDiffVal + ' second ago';
                        }else{
                            timeDiffStr = timeDiffVal + ' seconds ago';
                        }
                    }
                }
            }

            return timeDiffStr;
        }
    </script>
{{--

  <!-- @include('partials.notifications_script') -->
    @if(!str_contains(url()->current(), '/account/notifications'))
        @include('partials.notifications_script')
    @endif
--}}
    <script>
        $('.site-helptools-toggle').on( "click", function() {
            location.hash = "?help";
        });
    </script>

@endauth

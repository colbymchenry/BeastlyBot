@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

    <div class="page-header">
        <h4 class="font-weight-100"><span id="notification_count_1-pg">0</span> New Notifications</h4>
    </div>

    <div class="row">


        <div class="col-lg-10 offset-lg-1">
            <div class="card">

                <div class="card-body pt-0 mt-md-10 payments">
                    <div class="list-group list-group-dividered">
                       

                        <div class="list-group">
                            <div data-role="container">
                                <div data-role="content" id="notifications-dropdown">
                                </div>
                            </div>
                        </div>


                    </div>
                  </div>

            </div>
        </div>

    </div>

@endsection

@section('scripts')


    {{-- <script type="text/javascript">
    $(document).ready(function () {
        fetchNotifications();

        setInterval(function(e){
            $('*[id*=not1fication_]').each(function() {
                $.ajax({
                    url: '/bknd00/mark-notification-read/' + $(this).prop('id').split('_')[1],
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                }).done(function (msg) {

                });
            });
        },5000);

        function fetchNotifications() {
        $.ajax({
            url: '/bknd00/get_notifications',
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            //$('#notification_count_1').addClass('badge-default').removeClass('badge-primary');
            $('#notification_count_1-pg').text(msg['unread_count']);

            msg['notifications'].forEach(notification => {
                if($('#not1fication_' + notification['id']).length) {
                } else {
                    var color = 'blue';

                    if(notification['type'] == 'success') {
                        color = 'green';
                    } else if(notification['type'] == 'warning') {
                        color = 'yellow';
                    } else if(notification['type'] == 'error') {
                        color = 'red';
                    }

                    var timeDiff = timeDiffStr(new Date(notification['created_at'] * 1000).getTime(), (new Date()).getTime());

                    var html = `
                        <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem" id="not1fication_${notification['id']}">
                            <div class="media">
                                <div class="pr-10">
                                    <i class="icon wb-order bg-${color}-600 white icon-circle"
                                    aria-hidden="true"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading">${notification['message']}</h6>
                                    <time class="media-meta" >${timeDiff}</time>
                                </div>
                            </div>
                        </a>
                    `;

                    $('#notifications-dropdown').append(html);
                }
            });
        });
    }

    setInterval(fetchNotifications, 2000);
    });
</script> --}}

@endsection

{{-- <script type="text/javascript">
    $(document).ready(function () {
        fetchNotifications();

        function fetchNotifications() {
            $.ajax({
                url: '/bknd00/get_notifications',
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
            }).done(function (msg) {
                $('#notification_count_1').addClass('badge-default').removeClass('badge-primary');
                $('#notification_count_1').text(msg['unread_count']);

                if(msg['unread_count'] > 0) {
                    $('#notification_count_2').show();
                    $('#notification_count_2').text('New ' + msg['unread_count']);
                } else {
                    $('#notification_count_2').hide();
                }
            });
        };
    });
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

</script> --}}

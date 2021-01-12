@extends('layouts.app-zero')

@section('title', 'Affiliate Request')

@section('content')

<div class="page-header h-300 draw-grad-up" >
    <div class="text-center blue-grey-800 m-0 mt-50">
        <a class="avatar avatar-xxl" href="javascript:void(0)">
            <img id="guild_icon"
                src="https://via.placeholder.com/200x200"
                alt="...">
        </a>
        <div class="font-size-50 mb-15 blue-grey-100" id="guild_name">...Loading</div>
        <ul class="list-inline font-size-14" style="text-align: center;">
            <li class="list-inline-item blue-grey-100" style="text-align: center;">
                <i class="icon wb-heart mr-5" aria-hidden="true"></i> <span id="member_count">...</span> Members
            </li>
        </ul>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-xl-2 col-lg-1 col-md-12 order-1 order-lg-2">
            <div class="d-flex justify-content-center pt-sm-60">
                <div class="xx banner-image">
                    <div class="xx-head"></div>
                    <div class="xx-body"></div>
                    <div class="xx-hand"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 order-2 order-lg-1">

                <div class="row pt-30">
                    <div class="col-md-12">
                        <div class="container">

                            <div class="text-center">
                                <h1><i class="icon-discord grey-2"></i></h1>
                                <h4 class="text-white">Congrats <span style="color: #7289da">{{ auth()->user()->getDiscordUsername() }}</span>! You have been requested to be an affiliate of the
                                    <span id="guild_name_desc">Guild Name</span> server.</h4>
                                <p class="text-white pb-20">Earn <span style="font-weight: bold; color: dodgerblue;">{{ $invite->commission }}%</span> from any sale made with your
                                    special link!</p>

                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-3">
                                        <div class="d-block pb-20"><a href="#" class="btn btn-success"
                                                                      onclick="acceptOffer()">Accept Offer</a>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-block pb-20"><a href="#" class="btn btn-danger"
                                                                      onclick="rejectOffer()">Reject Offer</a>
                                        </div>
                                    </div>
                                </div>

                                <i><a class="grey-500" href="help/guilds/invalid-guild">Find out more</a></i>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>

</div>
    <!-- redirect user to the /account/affiliate -->


@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            socket.emit('get_guild_data', [socket_id, '{{ $invite->guild_id  }}']);
            socket.on('res_guild_data_' + socket_id, function(message) {
               $('#guild_name').text(message['name']);
               $('#guild_name_desc').text(message['name']);
               $('#guild_icon').attr('src', message['iconURL']);
               $('#member_count').text(message['memberCount']);
            });
        });

        function acceptOffer() {
            $.ajax({
                url: '/accept-affiliate-invite/{{ $invite->id }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
            }).done(function (msg) {
                if (msg['success']) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'You are now an affiliate!',
                        type: 'success',
                        showCancelButton: false,
                        target: document.body
                    }).then((result) => {
                        document.location = '/account/affiliate';
                    });
                } else {
                    Swal.fire({
                        title: 'Oops!',
                        text: msg['msg'],
                        type: 'warning',
                        showCancelButton: false,
                        target: document.body
                    });
                }
            });
        }

        function rejectOffer() {
            $.ajax({
                url: '/deny-affiliate-invite/{{ $invite->id }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
            }).done(function (msg) {
                if (msg['success']) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'You rejected the request!',
                        type: 'success',
                        showCancelButton: false,
                        target: document.body
                    }).then((result) => {
                        document.location = '/account/affiliate';
                    });
                } else {
                    Swal.fire({
                        title: 'Oops!',
                        text: msg['msg'],
                        type: 'warning',
                        showCancelButton: false,
                        target: document.body
                    });
                }
            });
        }
    </script>
@endsection

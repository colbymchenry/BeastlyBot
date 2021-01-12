<header class="slidePanel-header">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left"
      aria-hidden="true" data-url="/slide-server-member/{{ $guild_id }}/{{ $useruser()->DiscordOAuth->discord_id }}" id="back-btn" data-toggle="slidePanel"></button>
  </div>
  <h1>Role Add</h1>
</header>
<div class="put-long" id="slider-div">

<!-- nav-tabs --><!--
<ul class="site-sidebar-nav nav nav-tabs nav-tabs-line" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#sidebar-user" role="tab">
            <i class="icon wb-more-vertical" aria-hidden="true"></i>
            <h5>Roles</h5>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sidebar-payments" role="tab">
            <i class="icon wb-order" aria-hidden="true"></i>
            <h5>Payments</h5>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sidebar-details" role="tab">
            <i class="icon wb-user-circle" aria-hidden="true"></i>
            <h5>Info</h5>
        </a>
    </li>
</ul>-->

  <div class="site-sidebar-tab-content put-short tab-content">
    <div class="tab-pane fade active show" id="sidebar-user">

        <div>
        <div class="p-15">
          <p>You can give courtesy roles to users on your server in the form of a free trial. The subscription plan must be available for the role/duration, and have the user log into beastlybot.com at least once.
          
          *** do not set price to 0 (TODO: will fix before launch)</p>
        </div>

        <div class="p-15 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="d-block d-flex flex-row flex-wrap align-items-center justify-content-between">
                <div>
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                        <h5 class="pr-15 mx-auto">User</h5>

                        <div class="d-block w-200 pl-15 pr-30 mx-auto">

                          <div class="input-group">
                              <select class="form-control" id="users_list">
                              <!-- maybe reload slide if new user selected -->
                              <option value="{{ $user()->DiscordOAuth->discord_id }}" id="{{ $useruser()->DiscordOAuth->discord_id }}">{{ auth()->user()->getDiscordHelper()->getUsername() }}</option>
                              </select>
                          </div>

                        </div>

                    </div>
                </div>
                <div>
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                        <h5 class="pr-15 mx-auto">Role</h5>

                        <div class="d-block w-200 pl-15 mx-auto">

                          <div class="input-group">
                              <select class="form-control" id="roles_list">
                              </select>
                          </div>

                        </div>

                    </div>
                </div>
            </div>
          </div>


          <div class="p-15 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="d-block d-flex flex-row flex-wrap align-items-center justify-content-between">
                <div>
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                        <h5 class="mx-auto">Duration</h5>

                        <div class="d-block px-15 mx-auto">

                          <div class="input-group" id="group-expiry-date">
                              <select class="form-control" id="duration_list">
                              <!-- we'll ajax these later -->
                                <option value="1">1 Month</option>
                                <option value="3">3 Months</option>
                                <option value="6">6 Months</option>
                                <option value="12">12 Months</option>
                              </select>
                          </div>

                        </div>

                    </div>
                </div>
                
                <div>
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                      <h5 class="px-15 mx-auto">Price</h5>

                        <div class="input-group w-120 ml-auto">
                          <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" id="amount" name="amount" value="" />
                        </div>
                    </div>
                </div>

            </div>
          </div>


          <div class="p-15 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="d-block d-flex flex-row flex-wrap align-items-center justify-content-between">
                <div>
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">

                        <h5 class="pr-15 mx-auto">First Duration Free?</h5>

                        <div class="d-block pl-15 w-100 mx-auto">

                          <div class="checkbox-custom checkbox-primary">
                              <input type="checkbox" id="free_trial" checked/>
                              <label for="free_trial"></label>
                          </div>

                        </div>

                    </div>
                </div>

            </div>
          </div>


          <button type="button" class="btn put-bottom btn-primary" onclick="memberRoleAdd()">Add Role</button>

        </div>

    </div>     
  </div>


</div>


<script type="text/javascript">
    function memberRoleAdd() {
       // var add_role_id = '626970497275658251';
        var add_role_id = $('#roles_list').val();
        var add_role_name = $('#roles_list').find(':selected').attr('data-id_role_name')
        var add_duration = $('#duration_list').val();
        var add_amount = $('#amount').val();
        if($("#free-trial").is(':checked')) {
            var add_trial = "1";
        }else{
            var add_trial = "0";
        }

        //var show_check = $('#duration');
        //var show_error = $('#duration');
        $.ajax({
            url: '/server-member-role-add',
            type: 'POST',
            data: {
                'discord_id': '{{ $useruser()->DiscordOAuth->discord_id }}',
                'role_id': add_role_id,
                'role_name': add_role_name,
                'guild_id': '{{ $guild_id }}',
                'duration': add_duration,
                'amount': add_amount,
                'trial': add_trial,
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if (msg['success']) {
                Swal.fire({
                    title: 'Success!',
                    text: msg['msg'],
                    type: 'success',
                    showCancelButton: false,
                    target: document.getElementById('slider-div')
                }).then(function (result) {
                    $('#back-btn').click();
                    //window.location.reload(true);
                });
                return true;
            } else {
                Swal.fire({
                    title: 'Oops!',
                    text: msg['msg'],
                    type: 'warning',
                    showCancelButton: false,
                    target: document.getElementById('slider-div')
                });

                return false;
            }
        });
    }
</script>

<script>


var roles = {};
    var guild_id = '{{ $guild_id }}';


    $(document).ready(function () {
        var socket_id = '{{ uniqid() }}';

        socket.emit('get_guild_data', [socket_id, '{{ $guild_id }}']);

        socket.emit('get_roles', [socket_id, '{{ $guild_id }}']);

            socket.on('res_roles_' + socket_id, function (message) {
           
                Object.keys(message).forEach(function (key) {
                    var role_id = key;
                    var color = message[key]['color'];
                    var name = message[key]['name'];
                    var is_not_enabled = "hidden d-none";
                    var role_active = {};

                    $('#roles_list').append(getHTML2(is_not_enabled, role_id, color, name));

                    socket.emit('get_role_for_sale', [socket_id, guild_id, key]);
                });

                $.ajax({
                        url: '/get-status-roles',
                        type: 'POST',
                        data: {
                            'roles': message,
                            //'guild_id': guild_id,
                            _token: '{{ csrf_token() }}'
                        },
                }).done(function (msg) {
                    //console.log(msg)
                    //var prod_enabled = false;
                    Object.keys(msg).forEach(function (role) {
                        //console.log(msg[role]['product']);

                        if(msg[role]['active']){

                            role_id = msg[role]['product'];
                            $("#" + role_id).show();
                            
                        }
                    })

                })
            });

            function getHTML2(is_not_enabled, role_id, color, name) {
                return `
                  <option value="${role_id}" id="${role_id}" data-id_role_name="${name}" style="display:none">${name}</option>
                    `;
            }
          });
</script>

@include('partials/clear_script')
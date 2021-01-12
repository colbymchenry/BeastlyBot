
<div class="{{ Request::is('account/settings') ? 'col-xxl-3 col-lg-12' : 'col-12 col-lg-8 offset-lg-2' }} order-2 order-md-1 mx-auto">
    <!-- basic user settings -->
    <div class="p-30 text-center">
        <a class="avatar avatar-xxl" href="javascript:void(0)">
            <img
                 src="{{ auth()->user()->getDiscordHelper()->getAvatar() }}"
                 alt="...">
        </a>
        <h5>{{ auth()->user()->getDiscordHelper()->getUsername() }}</h5>
        <!--<button type="button" class="btn btn-block btn-dark" id="dark-day" onClick="changeNightMode();">Dark/Day</button>-->
        <button type="button" class="btn btn-block btn-dark" onclick="window.location.href = '/logout';">Log out</button>
    </div>
</div>




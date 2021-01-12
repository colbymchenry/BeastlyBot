<header class="slidePanel-header dual dark">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button id="back-btn" type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left"
      aria-hidden="true" data-url="/slide-roles-settings/{{ $guild_id }}/{{ $role_id }}" data-toggle="slidePanel"></button>
  </div>
  <h1>Take Payments</h1>
  <p>Step 2</p>
</header>

<div class="site-sidebar-tab-content put-long tab-content">
  <div class="tab-pane fade active show">
  
   <form autocomplete="off">
      <div class="row">
        <h4>Connect your PayPal account to start accepting payments.</h4>
      </div>
     <div class="row">
       <div class="form-group col-md-6" style="text-align: center;">
         <span id="cwppButton"></span>
       </div>
     </div>
   </form>
                    
  </div>
</div>

<script>
  $(document).ready(function() {
    paypal.use(['login'], function (login) {
      login.render({
        "appid": "AQWy4zTmdkwAaytmtDuj3dXHETsK31oPVH2qRNxuBVn7mEMxLhFw08o75n_U7IdlYLycR3HWPhAR1dq-",
        "authend": "sandbox",
        "scopes": "openid profile email",
        "containerid": "cwppButton",
        "locale": "en-us",
        "buttonType": "CWP",
        "buttonSize": "lg",
        "returnurl": "http://localhost:8000/paypal/connect"
      });
    });
  });

  var guild_id = '{{ $guild_id }}';
  var role_id = '{{ $role_id }}';

  channel.bind('paypal-connect', function(data) {
      if(data.success) {
          $('#back-btn').click();
      }
  });
</script>
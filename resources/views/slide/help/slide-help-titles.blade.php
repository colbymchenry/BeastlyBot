    
  <header class="slidePanel-header bg-primary-600">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
        aria-hidden="true"></button>
        <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chat mr-30" id="slide-tickets"
      aria-hidden="true" data-url="/slide-tickets-list" data-toggle="site-sidebar"></button>
    </div>
    <h1>Help</h1>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-help">
        <div>
            <div class="form-group pb-0 mb-5">
              <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">?</span>
                </div>
                <input type="text" class="form-control" id="helpInput" onkeyup="helpSearch()" placeholder="Search for help..">
              </div>
            </div>
         
          <div class="list-group no-select pt-0" id="helpList">
          @for ($i = 0; $i < 1; $i++)
              <a class="list-group-item flex-column align-items-start px-10 py-10" data-toggle="site-sidebar" data-url="/slide-help-managing-subscriptions">
                <h4 class="list-group-item-heading mt-0 mb-5">Managing Subscriptions<span class="d-none">How to Cancel Refund Remove Delete</span></h4>
                <p class="mb-0">How to view and manage your subscription.</p>
              </a>
              <a class="list-group-item list-group-item-action flex-column align-items-start px-10 py-10 {{ $i }}" id="help-guide-ultimate" data-toggle="site-sidebar" data-url="/slide-help-ultimate-shop-guide">
                <h4 class="list-group-item-heading mt-0 mb-5">Ultimate Shop Guide<span class="d-none">How to Shop Store URL Tutorial Open Money Create Product Live Bot Add Build</span></h4>
                <p class="mb-0">Adding a bot, creating a product and going live.</p>
              </a>
              <a class="list-group-item flex-column align-items-start px-10 py-10" href="javascript:void(0)" data-toggle="site-sidebar" data-url="/slide-help-withdraw-earnings">
                <h4 class="list-group-item-heading mt-0 mb-5">Withdrawing Earnings<span class="d-none">How to Shop Withdrawal Stripe Bank</span></h4>
                <p class="mb-0">Withdrawing earnings from Stripe to your bank.</p>
              </a>
              <a class="list-group-item flex-column align-items-start px-10 py-10" href="javascript:void(0)" data-toggle="site-sidebar" data-url="/slide-help-creating-a-promotion">
                <h4 class="list-group-item-heading mt-0 mb-5">Creating a Promotion<span class="d-none">How to Shop Tutorial Promo Code Coupon Create</span></h4>
                <p class="mb-0">How to create a new promotion code for your store.</p>
              </a>   
              <a class="list-group-item flex-column align-items-start px-10 py-10" href="javascript:void(0)" data-toggle="site-sidebar" data-url="/slide-help-remove-bot">
                <h4 class="list-group-item-heading mt-0 mb-5">Removing your Bot<span class="d-none">How to Remove BeastlyBot Beastly Bot from my server kick</span></h4>
                <p class="mb-0">Kicking out our beastly bot from your server.</p>
              </a>                 
              <a class="list-group-item flex-column align-items-start px-10 py-10" href="javascript:void(0)" data-toggle="site-sidebar" data-url="/slide-help-requesting-a-refund">
                <h4 class="list-group-item-heading mt-0 mb-5">Requesting a Refund<span class="d-none">How to Get Refund Cancel Delete Deactivate Money</span></h4>
                <p class="mb-0">We take great pride in excellent customer service.</p>
              </a>                
          @endfor
           
          <button type="button" class="btn btn-block btn-dark btn-lg" data-toggle="slidePanel" data-url="/slide-ticket-create" id="c-support" style="display:none">Contact Support</button>
          </div>
      </div>

    </div>

</div>

<script>

    if((!window.location.href.includes('guide-opened')) && window.location.href.includes('/server')) {
        setTimeout(function(){
            $("#help-guide-ultimate").click();
        },100)
    };

</script>

<script>
function helpSearch() {
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('helpInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("helpList");
  li = ul.getElementsByTagName('a');

  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("h4")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
      document.getElementById("c-support").style.display = "none";
    } else {
      li[i].style.display = "none";
      document.getElementById("c-support").style.display = "";
    }
  }
}
</script>
<script>
$(document).on('slidePanel::beforeHide', function (e) {
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('help')){
        params = searchParams.delete('help');
        window.history.replaceState({}, '', `${location.pathname}`);
    }
});

</script>
@include('partials/clear_script')
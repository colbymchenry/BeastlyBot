<header class="slidePanel-header dual bg-purple-500">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
      aria-hidden="true"></button>
  </div>
  <h1>Affiliate</h1>
  <p>User#8080</p>
</header>

<div class="site-sidebar-tab-content put-long tab-content">
    <div class="tab-pane fade active show">
        <div class="row">
            <div class="col-md-12">
                @include('block/affiliate-stats')
            </div>


          <!--  <div class="col-md-8">
                <h5>Assigned Coupons</h5>

                    <table id="assignedCouponsTable" class="table table-hover" data-plugin="animateList" data-animate="fade"
                        data-child="tr">
                        <tbody>

                                <tr>
                                            <td class="cell-50">
                                                <div class="checkbox-custom checkbox-primary">
                                                    <input type="checkbox" id="coupon-remove-assigned" />
                                                    <label for="coupon-remove-assigned"></label>
                                                </div>
                                            </td>
                                            <td class="cell-100">
                                                <h5>COUPON2019</h5>
                                            </td>              
                                                
                                            <td class="cell-150 pr-15 text-right">
                                                <div class="time">20% Comission</div>
                                                <div class="identity">34 Uses</div>
                                            </td>
                                                    
                                            
                                        </tr>  
                

                        </tbody>
                    </table>
                    <button class="btn btn-dark btn-block mt-10 disabled" data-url="/slide-promotions-affiliate" data-toggle="slidePanel">Unassign Coupon</button>
            </div>-->
            <div class="col-md-4 mx-auto">
                <div class="text-center">
                    <h5>Comission</h5>
                    <div class="w-100 mx-auto">
                        <div class="input-group">
                            <input id="affiliate-percentage" type="textbox" class="form-control" value="20">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <button class="btn btn-success btn-block w-100 mt-10" data-url="/slide-promotions-affiliate" data-toggle="slidePanel">Update</button>
                    </div>
                </div>            
            </div>


        </div>
            <!-- pagination -->

                    <div class="put-bottom">
                        <div class="row">
                            <div class="col-md-12 pt-10">
                                <button class="btn btn-dark btn-block">Remove Affiliate</button>
                            </div>                                                  
                        </div>               
                    </div>

        </div>
    </div>


                    <!--<div class="put-bottomm">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-default btn-block" data-url="/slide-promotions-affiliates-coupon" data-toggle="slidePanel">Save & View Affiliates</button>
                                </div>                                
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block slidePanel-close">Save & Close</button>
                                </div>                              
                            </div>               
                        </div>-->
                
<div class="modal-body">
    <div class="text-center">
        <h4>Tax Information</h4>
    </div>

    <div class="container">
        <!-- Example Basic Form Without Label -->
        <div class="example-wrap">
            <h4 class="example-title">Information</h4>
            <div class="example">
                <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="name" placeholder="Name" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="business_name" placeholder="Business Name"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <select class="form-control" name="business_type">
                                <option value="sole_proprietor" selected>Individual/sole proprietor</option>
                                <option value="c_corp">C Corporation</option>
                                <option value="s_corp">S Corporation</option>
                                <option value="partnership">Partnership</option>
                                <option value="trust_estate">Trust/estate single-member LLC</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <select class="form-control" name="llc_tax_classification">
                                <option value="c">C Corporation</option>
                                <option value="s">S Corporation</option>
                                <option value="p">Partnership</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="address" placeholder="Address"
                                   autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="city" placeholder="City"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="state" placeholder="State" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="zip_code" placeholder="Zip"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="ssn" placeholder="SSN" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="ein" placeholder="EIN"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-custom checkbox-default">
                            <input type="checkbox" id="inputCheckboxAgree" name="inputCheckboxesAgree" checked=""
                                   autocomplete="off">
                            <label for="inputCheckboxAgree">Agree Policy</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group btn-group-justified pb-10">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-dark" id="ABbtn">
                                    <i class="icon-right-big" aria-hidden="true"></i>
                                    <br>
                                    <span>Finish</span>
                                </button>
                            </div>
                          
                                <div class="btn-group d-none" id="RBbtn" role="group">
                                    <button type="button" class="btn btn-primary"
                                            onclick="window.location.href = 'https://dashboard.stripe.com/express/oauth/authorize?response_type=code&client_id=ca_Fm0KaKiRMrz8QMhnKfTvM0p9x1484RzG&scope=read_write';">
                                        <i class="icon-stripe" aria-hidden="true"></i>
                                        <br>
                                        <span>Connect</span>
                                    </button>
                                </div>
                          
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Example Basic Form Without Label -->
    </div>
</div>

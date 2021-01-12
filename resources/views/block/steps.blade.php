            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="row no-space text-center">
                      <div class="col-4 col-md-3">
                        <div class="card border-0 vertical-align">
                          <div class="vertical-align-middle font-size-16">
                            <div class="mb-10 d-none">STEP 1</div>
                            <i class="wb-check font-size-24 mb-10 green-600"></i>
                            <div>
                              <span class="font-size-12">Stripe</span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-4 col-md-3">
                        <div class="card border-0 vertical-align">
                          <div class="vertical-align-middle font-size-16">
                            <div class="mb-10 d-none">STEP 2</div>
                            <i class="wb-check font-size-24 mb-10 green-600"></i>
                            <div>
                              <span class="font-size-12">Add Bot</span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-4 col-md-3 hidden-sm-down">
                        <div class="card border-0 vertical-align">
                          <div class="vertical-align-middle font-size-16">
                            <div class="mb-10 d-none">STEP 3</div>
                            <i class="wb-check font-size-24 mb-10 green-600"></i>
                            <div>
                              <span class="font-size-12">Shop</span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-4 col-md-3">
                        <div class="card border-0 vertical-align">
                          <div class="vertical-align-middle font-size-16">
                            <div class="mb-10 d-none">STEP 4</div>
                            <i class="wb-check font-size-24 mb-10"></i>
                            <div>
                              <span class="font-size-12 @if(auth()->user()->stripe_express_id != null) pulse @endif">Go <span class="badge font-size-12 badge-sm badge-dark bg-grey-600 mr-1">Live</span></span>
                            </div>
                          </div>
                        </div>
                      </div>



                    </div>
                  </div>
            </div>

		<!--call-to-action start-->
		<div class="cta-area bg-3dca9a">
			<div class="container">
				<div class="row height-380 align-items-center">
					<div class="col-lg-12 text-center">
						<div class="cta-text">
							<div class="wow fadeInUp" data-wow-delay=".3s" style="visibility:hidden">
								<h3>Start your Discord Shop</h3>
							</div>
							<div class="wow fadeInUp" data-wow-delay=".4s" style="visibility:hidden">
								<p class="mt-25">Auto Role | Subscriptions | Dashboard</p>
							</div>
						</div>
                        @auth
                            <div class="cta-btn-2 mt-45 wow fadeInUp" data-wow-delay=".5s" style="visibility:hidden">
                                <a href="/dashboard" class="btn-common br-type">Dashboard</a>
                            </div>
                        @elseauth
                            <div class="cta-btn-2 mt-45 wow fadeInUp" data-wow-delay=".5s" style="visibility:hidden">
                                <a href="#" class="btn-common br-type">Open Shop</a>
                            </div>
                        @endauth

					</div>
				</div>
			</div>
		</div>
		<!--call-to-action end-->

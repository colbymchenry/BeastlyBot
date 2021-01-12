@extends('layouts.site')

@section('title', 'FAQs')
@section('metadata')
<meta name="description" content="Questions and answers for the beast.">
<meta name="keywords" content="BeastlyBot, Beastly Bot, Discord, Subscription, Payments, Roles">
<meta name="author" content="BeastlyBot">
@endsection
@section('content')
<!--page-title starts-->
<div class="page-title-area bg-grey-2">
			<div class="container">
				<div class="row height-300 pt-70 align-items-center">
					<div class="col-lg-12">
						<div class="page-title section-title text-center">
							<h1><span class="text-white">The FAQ?</span></h1>
							<div class="site-breadcrumb">
								<nav aria-label="breadcrumb">
								  <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">FAQs</li>
								  </ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--page-title ends-->
		
		<!--faq-area start-->
		<div class="faq-area pt-95 pt-sm-77 pb-75">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h3><span>Frequently Asked Questions</span></h3>
						</div>
					</div>
				</div>
				<div class="row bb-ebeb pb-55 mt-40">
					<div class="col-lg-12">
						<div id="accordion">
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading" id="headingOne">
									<h5 class="mb-0">
										<a href="#collapseOne" class="btn btn-link" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
										What is the point of BeastlyBot?
											<i class="fa fa-plus pull-right" aria-hidden="true"></i>
											<i class="fa fa-minus pull-right" aria-hidden="true"></i>
										</a>
									</h5>
								</div>
								<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="card-body">
										<p>It's the first of its kind. You can create your own Discord store easily and link people to it, to subscribe to roles and earn money!</p>
									</div>
								</div>
							</div>
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading" id="headingOneTwo">
									<h5 class="mb-0">
										<a href="#collapseOneTwo" class="btn btn-link" data-toggle="collapse" data-target="#collapseOneTwo" aria-expanded="false" aria-controls="collapseOneTwo">
										What are the fees to be a shop owner?
											<i class="fa fa-plus pull-right" aria-hidden="true"></i>
											<i class="fa fa-minus pull-right" aria-hidden="true"></i>
										</a>
									</h5>
								</div>
								<div id="collapseOneTwo" class="collapse" aria-labelledby="headingOneTwo" data-parent="#accordion">
									<div class="card-body">
								
										<p>After your 30-day free trial keeping a store Live is $25/month which you should easily make from us. Fees are as low as 5% per transaction, starting at 15% until 10 active subscribers - and we pay Stripe fees ;) You are rewarded with efforts in being a fantastic business owner!</p>
									</div>
								</div>
							</div>
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading" id="headingTwo">
									<h5 class="mb-0">
										<a href="#collapseTwo" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										Are subscriptions automatically added to my account?
											<i class="fa fa-plus pull-right" aria-hidden="true"></i>
											<i class="fa fa-minus pull-right" aria-hidden="true"></i>
										</a>
									</h5>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
									<div class="card-body">
										<p>After checkout a subscription role is automatically (and instantly) added to your discord account. You'll get a nice reminder email when it's time to renew.</p>
									</div>
								</div>
							</div>
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading" id="headingThree">
									<h5 class="mb-0">
										<a href="#collapseThree" class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Can Subscibers request a refund if anything goes wrong?
											<i class="fa fa-plus pull-right" aria-hidden="true"></i>
											<i class="fa fa-minus pull-right" aria-hidden="true"></i>
										</a>
									</h5>
								</div>
								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
									<div class="card-body">
										<p>We allow server store owners to setup refund policies and subscribers can easily request or cancel their subscription. Reach out to us with any questions.</p>
									</div>
								</div>
							</div>
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading" id="headingFour">
									<h5 class="mb-0">
										<a href="#collapseFour" class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
										Can I remove the bot easily?
											<i class="fa fa-plus pull-right" aria-hidden="true"></i>
											<i class="fa fa-minus pull-right" aria-hidden="true"></i>
										</a>
									</h5>
								</div>
								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
									<div class="card-body">
										<p>Easily and instantly you can remove beastlybot bot from your server. Just kick him!</p>
									</div>
								</div>
							</div>
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading" id="headingFive">
									<h5 class="mb-0">
										<a href="#collapseFive" class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
										How much money will I make?
											<i class="fa fa-plus pull-right" aria-hidden="true"></i>
											<i class="fa fa-minus pull-right" aria-hidden="true"></i>
										</a>
									</h5>
								</div>
								<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
									<div class="card-body">
										<p>That really depends on the server size and subscription prices! You can sell access to a role for any price per month, 3 months, 6 months and a year.</p>
									</div>
								</div>
							</div>
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading" id="headingSix">
									<h5 class="mb-0">
										<a href="#collapseSix" class="btn btn-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
										Can anyone create a store for Discord?
											<i class="fa fa-plus pull-right" aria-hidden="true"></i>
											<i class="fa fa-minus pull-right" aria-hidden="true"></i>
										</a>
									</h5>
								</div>
								<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
									<div class="card-body">
										<p>Yes, anyone can create a store with beastlybot for their discord server! No matter the member size you can give it a shot.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-70">
					<div class="col-lg-12">
						<div id="accordionTwo">
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading style-2" id="headingSeven">
									<h5 class="mb-0">
										<a href="#collapseSeven" class="btn btn-link" data-toggle="collapse" aria-expanded="true" aria-controls="collapseSeven">
										<span>Do I have to file my income?</span>
										</a>
									</h5>
								</div>
								<div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordionTwo">
									<div class="card-body">
										<p>Yes you do have to file for taxes with ay earnings, all invoices and transactions are easily found on your Stripe Express account.</p>
									</div>
								</div>
							</div>
							<!--faq-single-->
							<div class="card single-faq">
								<div class="card-header faq-heading style-2" id="headingEight">
									<h5 class="mb-0">
										<a href="#collapseEight" class="btn btn-link" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
										<span>Can I join the team?</span>
										</a>
									</h5>
								</div>
								<div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionTwo">
									<div class="card-body">
										<p>We are always looking for new developers and support staff, let us know if you want to join this exciting company!</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--faq-area end-->

        		
		@include('site/blocks/cta-bottom')



@endsection
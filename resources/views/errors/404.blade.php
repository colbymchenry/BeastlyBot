@extends('layouts.site')

@section('title', '404 oops!')
@section('metadata')
<meta name="description" content="Hmm the beast can't find that page!">
<meta name="keywords" content="404">
<meta name="author" content="BeastlyBot">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta name="robots" content="noindex" />
@endsection
@section('content')

        <!--coming-area start-->
        <div class="coming-soon-area display-table pt-60 pb-60">
			<div class="vertical-middle">
				<div class="container">
                    <div class="row">
                        <div class="col-md-6">
							<div class="coming-soon-msg text-center mt-100 pt-sm-50">
								<h1>404</h1>
                                <p class="mb-0">Beep Boop. Bop. Page not found, go <a href="javascript:history.back()">back</a>.</p>
							</div>
						</div>                       
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center align-items-center pt-sm-15">
                                <div class="xx banner-image">
                                    <div class="xx-head"></div>
                                    <div class="xx-body"></div>
                                    <div class="xx-hand"></div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
        <!--coming-area end-->
        
@endsection
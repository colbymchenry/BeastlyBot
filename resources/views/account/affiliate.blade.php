@extends('layouts.app')

@section('title', 'Affiliate')

@section('content')

    <div class="page-header">
        <ol class="breadcrumb">
            <h4>Affiliate</h4>
        </ol>
    </div>

    <div class="page-content-table">


        <div class="page-main text-center">
            <!-- maybe have the same total thing as payments page here -->

                <table id="rolesTable" class="table" data-plugin="animateList" data-animate="fade" data-child="tr">
                    <thead>
                    <tr>
                       <!-- <th class="cell-150">User</th>-->
                        <th class="cell-120">Aff ID</th>
                        <th class="cell-80">Uses</th>                       
                        <th class="cell-150">Commission</th>
                        <th class="responsive-hide">Revenue</th>  
                        <th class="cell-200 text-left pr-30">Guild</th>              
                        <th class="cell-100 text-right pr-30">Link</th>
                    </tr>
                    </thead>
                
                    <tbody>
        
                        <tr id="role_settings_1">                             
                            <td class="bg-purple-500" data-url="slide-affiliate-linkstats" data-toggle="slidePanel">
                                <h5 class="text-white">#49343</h5>
                            </td> 
                            <td data-url="slide-affiliate-linkstats" data-toggle="slidePanel">            
                                <div class="time pl-30">3</div>      
                            </td>                                            
                            <td data-url="slide-affiliate-linkstats" data-toggle="slidePanel">            
                                <div class="time pl-30">25%</div>      
                            </td>   
                            <td class="responsive-hide" data-url="slide-affiliate-linkstats" data-toggle="slidePanel">
                                <div class="time">$3,000.00</div>
                            </td>  
                            <td class="">            
                                <div class="time"><span class="badge badge-dark badge-lg">Guild Name</span></div>      
                            </td>                                    
                            <td class="bg-green-500 text-center" data-toggle="modal" data-target="#affiliateLinkModal">
                                <span class="text-white h3"><i class="wb wb-link"></i></span>
                            </td>                           
                        </tr>    
                                                            
                    </tbody>
                </table>

            <!-- pagination -->
            <!--  <ul data-plugin="paginator" data-total="50" data-skin="pagination-gap"></ul> -->
        </div>
    </div>



<div class="modal fade" id="affiliateLinkModal" tabindex="-1" role="dialog" aria-labelledby="affiliateLinkModal" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-center" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <h5 class="modal-title pb-15 pt-15">Affiliate Link</h5>Use this link to refer people and gain commission on sales.</h5>
        <h4><code>https://discordbeast.com/?aff123</code></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection

<header class="slidePanel-header">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
      aria-hidden="true"></button>
  </div>
  <h1>Blog Settings</h1>
</header>

<!-- nav-tabs -->
<ul class="site-sidebar-nav nav nav-tabs nav-tabs-line" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#tab_blog_categories" role="tab">
      <i class="icon wb-more-vertical" aria-hidden="true"></i>
      <h4>Categories</h4>
    </a>
  </li>
</ul>

<div class="site-sidebar-tab-content tab-content">
  <div class="tab-pane fade active show" id="tab_blog_categories">
    <div>
        <div class="row">
            <div class="col-md-9">
                <input class="form-control w-300" name="tags" data-plugin="tagsinput" value="Category1, Category2, Category3"/>
                <!-- add and remove categories here i think easiest-->
            </div>
            <div class="col-md-3">
                <button class="btn btn-success btn-sm btn-block" data-url="/admin/slide_blog_settings" data-toggle="slidePanel">Update</button>
            </div>
        </div>
      
       <table id="blogCategoriesTable" class="table mt-50" data-plugin="animateList" data-animate="fade"
            data-child="tr">
            <tbody>

              <tr id="mid_2">
                <td>
                  <div class="content">
                    <div class="title">Category Name</div>
                  </div>
                </td>
                <td class="cell-130">
                  <div class="time">80 Posts</div>
                </td>
              </tr>

              
            </tbody>
          </table>
          <!-- pagination -->

    </div>
  </div><!-- end tab -->
  
</div>

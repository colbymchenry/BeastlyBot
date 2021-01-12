@extends('layouts.app')

@section('title', 'Admin - Blog')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Blog Posts</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
          <li class="breadcrumb-item active">Blog</li>
        </ol>
        <div class="page-header-actions">
            <a class="btn btn-sm btn-primary btn-outline btn-round" href="/admin/blog_create">
                <i class="icon wb-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">Create Blog</span>
            </a>
            <a class="btn btn-sm btn-success btn-outline btn-round" data-url="/admin/slide_blog_settings" data-toggle="slidePanel">
                <i class="icon wb-settings green-600" aria-hidden="true"></i>
                <span class="hidden-sm-down green-600">Settings</span>
            </a>
        </div>
      </div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row">
                <div class="col-12">
                

                <table id="blogTable" class="table mb-50" data-plugin="animateList" data-animate="fade" data-child="tr">
                    <tbody id="blogs_table">
                        <tr id="blogs_table_id" href="/admin/blog_edit/blogname"><!-- idk if href will work here btw -->
                            <td class="cell-30 pl-15 text-right">
                                <h6>1</h6>
                            </td>
                            <td class="pl-15">
                                <div class="content text-left">
                                    <h4>Blog Title</h4>
                                </div>
                            </td>
                            <td class="cell-150 pr-15 text-right">
                                <div class="time">Published</div>
                                <div class="identity">Username</div>
                            </td>
                            <td class="cell-120 text-center bg-blue-500">
                                <a href="/admin/blog_edit" class="btn-sm btn-icon btn-pure btn-default pr-5 text-white" data-toggle="tooltip" data-original-title="Edit"><i class="icon wb-more-horizontal" aria-hidden="true"></i><div class="responsive-hide">Edit</div></a>
                            </td>
                        </tr>
                    </tbody>
                </table>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Help - Article Title')

@section('content')    
<div class="app-documents">
    <div class="page-header">
        <h1 class="page-title mb-10">Document Article</h1>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/help">Home</a></li>
        <li class="breadcrumb-item"><a href="/help/categories">Categories</a></li>
        <li class="breadcrumb-item"><a href="/help/category-name">Getting Started</a></li>
         <li class="breadcrumb-item active">Article Name</li>       
        </ol>
      </div>
      <div class="page-content">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <select data-plugin="selectpicker" data-style="btn-inverse">
                <option>Getting started</option>
                <option>Configuration</option>
                <option>Partner Tutorial</option>
                <option>About Us</option>
              </select>
            </div>
            <button type="submit" class="input-search-btn">
              <i class="icon md-search" aria-hidden="true"></i>
            </button>
            <input type="text" class="form-control" placeholder="Search the knowledge base...">
          </div>
        </div>
        <div class="documents-wrap article">
          <div class="article-sidebar sticky" id="articleSticky">
            <ul class="list-group list-group-hover nav">
              <li class="list-group-item nav-item">
                <a class="nav-link active" href="#section-1">Article section one.</a>
              </li>
              <li class="list-group-item nav-item">
                <a class="nav-link" href="#section-2">Article section two.</a>
              </li>
              <li class="list-group-item nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#section-3">Article section three.</a>
                <div class="list-group dropdown-menu" id="subList-3">
                  <a class="dropdown-item" href="#section-3-1">Article section three-one.</a>
                  <a class="dropdown-item" href="#section-3-2">Article section three-two.</a>
                  <a class="dropdown-item" href="#section-3-3">Article section three-three.</a>
                  <a class="dropdown-item" href="#section-3-4">Article section three-four.</a>
                </div>
              </li>
              <li class="list-group-item nav-item">
                <a class="nav-link" href="#section-4">Article section four.</a>
              </li>
            </ul>
          </div>
          <div class="article-content">
            <section>
              <h4 id="section-1">Article section one.</h4>
              <p>Article content here</p>
            </section>
    
            <section>
              <h4 id="section-2">Article section two.</h4>
              <p>Article content here</p>
            </section>

            <div class="article-footer mt-40">
              <div class="article-footer-actions">
                <button type="button" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-primary">No</button>
              </div>
              Was this article helpful to you ?
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
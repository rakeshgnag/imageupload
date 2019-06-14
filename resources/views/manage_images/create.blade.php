@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
       <!-- Display Validation Errors -->
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/images">Manage Images</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create new </li>
        </ol>
      </nav>

      <div class="border p-4">
        <form method="post" action="/images"  enctype="multipart/form-data">
          @csrf
          @include('common.errors')       
          <div class="form-group form-row" >
            <label for="title" class="col-sm-1">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control col-sm-8" name="title" id="title" aria-describedby="title" placeholder="Enter Image Title" value="{{ old('title') }}" required maxlength="100">
          </div>


          <div class="form-group form-row">
            <label for="title" class="col-sm-1">Category <span class="text-danger">*</span></label>
            <select class="categories col-sm-8" name="categories_array[]" multiple="multiple" >
                <option value="nature">Nature</option>
                <option value="plants">Plants</option>
                <option value="animals">Animals</option>
            </select>
          </div>


           <div class="form-group">
           <label for="image"> Image <span class="text-danger">*</span></label>
            <input type="file" name="photo"><br>
            <small>width:1920 px , height: 540 px</small>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection



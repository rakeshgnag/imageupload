@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            
        <div class="col-md-12">
                     
            <a href="/images/create" class="btn btn-default btn-primary"> <i class="fa fa-btn fa-plus"></i> Add Image </a><br /><br />
            <div class="card card-default">
                <div class="card-heading">
                Current  - Page {{ $images->currentPage() }} of about {{ $images->total() }} results 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        @if(count($images))
                        <thead>
                            <th>Id</th>
                            <th>Titale</th>
                            <th>Crop Image</th>
                            <th>Original Image</th>
                            <th>Categories</th>
                        </thead>
                        @foreach($images as $customer)
                        <tbody>
                            <tr><td>{{ $customer->id }}</td>
                            <td>{{ $customer->title }}</td>
                            <td><img src="/storage/images/crop_images/{{ $customer->image_uri_cropped }}" width="100" height="100">  </td>
                            
                            <td><img src="/storage/images/original_image/{{ $customer->image_uri_original }}" width="100" height="100">  </td>
                            
                            <td>{{ $customer->categories }}  </td>


                            </tr>
                            @endforeach
                            <tr><td colspan="9"> {{ $images->links() }}</td></tr>
                            @else
                            <tr>
                              No data to display.
                            </tr>
                            @endif
                        
                        
                        </tbody>
                    </table>
                </div><!-- End card Body -->
            </div> <!-- End card -->
        </div><!-- End Column -->
    </div>  <!-- End Row -->
</div><!-- End Container -->
@endsection
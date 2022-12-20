@extends('heads-layout.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Overtime Information</h6>
      </div>
    </div>
  </div>


  <div class="row">

    <div class="col-12 col-xl-4">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-8 d-flex align-items-center">
              <h6 class="mb-0">Other Information</h6>
            </div>
            <div class="col-md-4 text-end">
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <p class="text-sm">
            {{$data[0]->other_info}}
          </p>

          <p class="text-sm">
            <h6>Task</h6>
            {{$data[0]->task}}
          </p>
          <hr class="horizontal gray-light my-4">
            <span class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> {{$data[0]->name}}&nbsp; </span>
            <span class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; {{$data[0]->phone}}</span>
            <span class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{$data[0]->email}}</span>
            <span class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Date:</strong> &nbsp; {{$data[0]->date}}</span>
            <span class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Starting Time:</strong> &nbsp; {{$data[0]->starting_time}}</span>
            <span class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">End Time:</strong> &nbsp; {{$data[0]->end_time}}</span>
        </div>
      </div>
    </div>


    <div class="col-12 col-xl-8">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-8 d-flex align-items-center">
              <h6 class="mb-0">Image Attachment</h6>
            </div>
            <div class="col-md-4 text-end">
            </div>
          </div>
        </div>
        <div class="card-body p-3">
            @foreach($data as $row)
                <img src="{{$row->file_path}}" width="70%"><br><br>
                <br>
              @endforeach
        </div>
      </div>
    </div>


  </div>
</div>



@endsection

@section('script')
  <script type="text/javascript">
      $(document).on('click', 'div#folder', function(){
        var data =  $(this).attr('name');
        window.open("{{route('heads.ot')}}?sik123kasdh123iaasd="+data); 
      });
  </script>
@endsection

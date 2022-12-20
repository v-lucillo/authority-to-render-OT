@extends('heads-layout.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Employee Folder</h6>
      </div>
    </div>
  </div>


  <div class="row">



    @foreach ($employee as $row)

    @if($row->id == session('user')->id || $row->user_lvl != 0)
      @continue
    @endif
      <div class="col-md-2 mt-md-4 mt-4" id ="folder" name = "{{$row->id}}">
        <div class="card">
          <div class="card-header mx-4 p-3 text-center">
            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
              <i class="fab fa-paypal opacity-10" aria-hidden="true"></i>
            </div>
          </div>
          <div class="card-body pt-0 p-3 text-center">
            <h6 class="text-center mb-0">{{$row->first_name." ".$row->last_name}}</h6>
            <span class="text-xs">{{$row->email}}</span>
            <hr class="horizontal dark my-3">
            <!-- <h5 class="mb-0">$455.00</h5> -->
          </div>
        </div>
      </div>
    @endforeach
    <div class="col-md-2 mt-md-4 mt-4" id ="folder" name = "view_all">
      <div class="card">
        <div class="card-header mx-4 p-3 text-center">
          <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
            <i class="fab fa-paypal opacity-10" aria-hidden="true"></i>
          </div>
        </div>
        <div class="card-body pt-0 p-3 text-center">
          <h6 class="text-center mb-0">View all</h6>
          <span class="text-xs">Employee</span>
          <hr class="horizontal dark my-3">
          <!-- <h5 class="mb-0">$455.00</h5> -->
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

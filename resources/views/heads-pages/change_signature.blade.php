@extends('heads-layout.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Change Password</h6>
      </div>
    </div>
  </div>


  <div class="row">
    <form role="form text-left" enctype="multipart/form-data" method="POST" action="{{route('heads.submit_change_signature')}}">
      @csrf
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <input type="file" name = "signature" multiple class="form-control">
            <small>if no e-signature, please make one here <a href="https://www.signwell.com/online-signature/" target = "_blank"> "Create signature"</a></small>
          </div>
            @error('signature')
                <div class="text-muted font-italic">
                  <small class="text-warning font-weight-700">{{$message}} </small>
                </div>
            @enderror
          <small class="form-hint">
          </small>
        </div>
      </div>

  

      <div class="text-center">
        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
      </div>
      
    </form>



  </div>
</div>



@endsection

@section('script')
<script type="text/javascript">
    var message = "{{session('message')}}";
    if(message){
      Swal.fire(
        'Success!',
        message,
        'success'
      )
    }
</script>
@endsection

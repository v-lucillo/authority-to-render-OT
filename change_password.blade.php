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
    <form role="form text-left" enctype="multipart/form-data" method="POST" action="{{route('api.sign_up')}}">
      @csrf
      <div class="row">
        <div class="col-sm">
          <div class="mb-3">
            <input value="{{old('first_name')}}" name = "first_name" type="text" class="form-control" placeholder="First name" aria-describedby="email-addon">
            @error('first_name')
                <div class="text-muted font-italic">
                  <small class="text-warning font-weight-700">{{$message}} </small>
                </div>
            @enderror
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <input value="{{old('last_name')}}" name = "last_name" type="text" class="form-control" placeholder="Last name" aria-describedby="email-addon">
            @error('last_name')
                <div class="text-muted font-italic">
                  <small class="text-warning font-weight-700">{{$message}} </small>
                </div>
            @enderror
          </div>
        </div>
      </div>


    
      <div class="mb-3">
        <input value="{{old('email')}}" name = "email" type="email" class="form-control" placeholder="Email"  aria-describedby="email-addon">
        @error('email')
                <div class="text-muted font-italic">
                  <small class="text-warning font-weight-700">{{$message}} </small>
                </div>
            @enderror
      </div>
      

      <div class="mb-3">
        <input value="{{old('phone')}}" name = "phone" type="text" class="form-control" placeholder="Phone number"  aria-describedby="email-addon">
        @error('phone')
                <div class="text-muted font-italic">
                  <small class="text-warning font-weight-700">{{$message}} </small>
                </div>
            @enderror
      </div>
      


      <div class="row">
        <div class="col-sm">
          <div class="mb-3">
            <input value="{{old('password')}}" name = "password" type="password" class="form-control" placeholder="Password" aria-describedby="email-addon">
            @error('password')
                <div class="text-muted font-italic">
                  <small class="text-warning font-weight-700">{{$message}} </small>
                </div>
            @enderror
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <input name = "password_confirmation" type="password" class="form-control" placeholder="Confirm password" aria-describedby="email-addon">
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-sm">
          <div class="mb-3">
            <input value="{{old('time_in')}}" name = "time_in" type="time" class="form-control" placeholder="Time in" aria-describedby="email-addon">
            <small class="text-info font-weight-700">Time in (eg. 9:00 AM)</small>
            @error('time_in')
                <div class="text-muted font-italic">
                  <small class="text-warning font-weight-700">{{$message}} </small>
                </div>
            @enderror
          </div>
        </div>
        <div class="col-sm">
          <div class="mb-3">
            <input name = "time_out" type="time" class="form-control" placeholder="Time out" aria-describedby="email-addon">
            <small class="text-info font-weight-700">Time out (eg. 5:00 PM) </small>
            @error('time_out')
                <div class="text-muted font-italic">
                  <small class="text-warning font-weight-700">{{$message}} </small>
                </div>
            @enderror
          </div>
        </div>
      </div>

      <div class="mb-3">
        <select name = "restday" class="form-select form-control">
          <option value="">--Please choose a restday--</option>
          <option value="Monday">Monday</option>
          <option value="Tuesday">Tuesday</option>
          <option value="Wednesday">Wednesday</option>
          <option value="Thursday">Thursday</option>
          <option value="Friday">Friday</option>
          <option value="Saturday">Saturday</option>
          <option value="Sunday">Sunday</option>
        </select>
        @error('restday')
            <div class="text-muted font-italic">
              <small class="text-warning font-weight-700">{{$message}} </small>
            </div>
        @enderror
      </div>



      <div class="mb-3">
        <select name = "department"></select>
        @error('department')
            <div class="text-muted font-italic">
              <small class="text-warning font-weight-700">{{$message}} </small>
            </div>
        @enderror
      </div>

      <div class="form-group mb-3 row">
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
      <!-- <div class="form-check form-check-info text-left">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
        <label class="form-check-label" for="flexCheckDefault">
          I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
        </label>
      </div> -->
      <div class="text-center">
        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
      </div>
      <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{route('sign_in')}}" class="text-dark font-weight-bolder">Sign in</a></p>
    </form>



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

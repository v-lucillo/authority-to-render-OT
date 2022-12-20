@extends('user-layout.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>OverTime submission form</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="row row-cards">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Create station form</h3> -->
              </div>
              <div class="card-body">
                <form action="{{route('user.submit_ot')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Date</label>
                    <div class="col">
                      <input value = "{{old('date')}}" name = "date" type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter station name">
                        @error('date')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      <small class="form-hint">
                      </small>
                    </div>
                  </div>

                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Start Time</label>
                    <div class="col">
                      <input value = "{{old('starting_time')}}"  name = "starting_time" type="time" class="form-control" aria-describedby="emailHelp" placeholder="Enter station name">
                        @error('starting_time')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      <small class="form-hint">
                        <!-- Station name (ex: Love Radio Laog) -->
                      </small>
                    </div>
                  </div>

                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">End Time</label>
                    <div class="col">
                      <input value = "{{old('end_time')}}" name = "end_time" type="time" class="form-control" placeholder="Enter call sign">
                      @error('end_time')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      <small class="form-hint">
                        <!-- Call sign (ex: DWWS) -->
                      </small>
                    </div>
                  </div>

                   <hr>

                   <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Task</label>
                    <div class="col">
                      <input value = "{{old('task')}}" name = "task" type="text" class="form-control" placeholder="Enter task">
                        @error('task')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      <small class="form-hint">
                        <!-- Longtitude (ex: 16.691969081187874) -->
                      </small>
                    </div>
                  </div>
               
         
                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Additional information</label>
                    <div class="col">
                      <textarea value = "{{old('other_info')}}" name = "other_info" class="form-control" name="example-textarea-input" rows="6" placeholder="Additional information..."></textarea>
                        @error('other_info')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      <small class="form-hint">
                      </small>
                    </div>
                  </div>


                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Attachment(s)</label>
                    <div class="col">
                      <div class="mb-3">
                        <input type="file" name = "attachment[]" multiple class="form-control">
                      </div>
                        @error('ohter_info')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      <small class="form-hint">
                      </small>
                    </div>
                  </div>

                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
  <script type="text/javascript">
    var message = "{{session('message')}}";
    if(message){
      Swal.fire(
        'Sucess!',
        'OT is subject for signature',
        'success'
      )
    }
  </script>
@endsection
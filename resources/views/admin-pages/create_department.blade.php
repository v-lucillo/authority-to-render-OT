@extends('admin-layout.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Create Department</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="row row-cards">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Create station form</h3> -->
              </div>
              <div class="card-body">
                <form action="{{route('admin.submit_department')}}" method="POST" enctype="multipart/form-data">
                  @csrf


                   <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Department</label>
                    <div class="col">
                      <input value = "{{old('department')}}" name = "department" type="text" class="form-control" placeholder="Enter department">
                        @error('department')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      <small class="form-hint">
                        <!-- Longtitude (ex: 16.691969081187874) -->
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

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Department List</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0" id = "table" style="width:100%">
            <thead>
              <tr>
                <th >ID</th>
                <th >Departments</th>
              </tr>
            </thead>
            <tbody> </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
  <script type="text/javascript">
    var table =  $('table#table').DataTable({
      serverSide: true,
      processing: true,
      ajax: "{{route('admin.get_department')}}",
      columns: [
        {data: "id"},
        {data: "department"},
      ]

    });
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
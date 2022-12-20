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
                <form action="{{route('admin.submit_dept_head_create')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                   <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">First name</label>
                    <div class="col">
                      <input value = "{{old('first_name')}}" name = "first_name" type="text" class="form-control" placeholder="Enter first name">
                        @error('first_name')
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
                    <label class="form-label col-3 col-form-label">Last name</label>
                    <div class="col">
                      <input value = "{{old('last_name')}}" name = "last_name" type="text" class="form-control" placeholder="Enter last name">
                        @error('last_name')
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
                    <label class="form-label col-3 col-form-label">Email</label>
                    <div class="col">
                      <input value = "{{old('email')}}" name = "email" type="text" class="form-control" placeholder="Enter email">
                        @error('email')
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
                    <label class="form-label col-3 col-form-label">Department</label>
                    <div class="col">
                        <select name = "department[]" multiple></select>
                        @error('department[]')
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
                    <label class="form-label col-3 col-form-label">User level</label>
                    <div class="col">
                        <select name = "user_lvl" class="form-select form-control" style="width:100%">
                          <option value="">--Please choose a restday--</option>
                          <option value="1">First assignatory</option>
                          <option value="2">Second assignatory</option>
                          <option value="3">Human resource</option>
                        </select>
                        @error('user_lvl')
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
                    <label class="form-label col-3 col-form-label">Signature</label>
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

                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Password</label>
                    <div class="col">
                      <input value = "{{old('password')}}" name = "password" type="text" class="form-control" placeholder="Enter Password">
                        @error('password')
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
        <h6>Assignatory List</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0" id = "table" style="width:100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
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
    var message = "{{session('message')}}";
    if(message){
      Swal.fire(
        'Sucess!',
        'Account created',
        'success'
      )
    }


    var table = $('table#table').DataTable({
      serverSide: true,
      processing: true,
      ajax: "{{route('admin.get_head_account')}}",
      columns :[
        {data: "name"},
        {data: "email"},
      ]
    });

      $("select[name='department[]']").select2({
      ajax: {
        url: "{{route('admin.get_department_lov')}}",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
          };
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;

          return {
            results: data.results,
            pagination: {
              more: (params.page * 30) < data.total_count
            }
          };
        },
        cache: true
      },
      placeholder: 'Select department',
      templateResult: formatRepo,
      templateSelection: formatRepoSelection
    });

    function formatRepo (repo) {
      if (repo.loading) {
        return repo.text;
      }

      return repo.text;
    }

    function formatRepoSelection (repo) {
      return repo.text;
    }


    $(document).on('click', 'table#table tbody tr' ,function(){
      var data =  table.row(this).data();
      window.location.replace("{{route('admin.edit_head_account')}}?ajkld9123asdb123="+data.id);
    });

  </script>
@endsection
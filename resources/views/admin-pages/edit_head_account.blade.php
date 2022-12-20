@extends('admin-layout.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Edit Assignatory</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="row row-cards">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Create station form</h3> -->
              </div>
              <div class="card-body">
                <form action="{{route('admin.change_head_department')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="" name="id" value="{{$id}}" hidden>
                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Department</label>
                    <div class="col">
                        <select name = "department[]" multiple>
                          @foreach($department as $row)
                            <option value = "{{$row->department_id}}" selected>{{$row->department}}</option>
                          @endforeach
                        </select>
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
        <h6>Change Password</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="row row-cards">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Create station form</h3> -->
              </div>
              <div class="card-body">
                <form action="{{route('admin.change_head_password')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="" name="id" value="{{$id}}" hidden>
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


@endsection


@section('script')
  <script type="text/javascript">
    var message = "{{session('message')}}";
    if(message){
      Swal.fire(
        'Sucess!',
        message,
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


  </script>
@endsection
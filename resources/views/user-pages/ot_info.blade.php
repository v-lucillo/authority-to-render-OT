@extends('user-layout.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>OverTime Table</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0" id = "for_sig_table">
            <thead>
              <tr>
                <th >Task</th>
                <th >Date Filed</th>
                <th >OT Date</th>
                <th>Staring Time</th>
                <th>Ending Time</th>
              </tr>
            </thead>
            <tbody> </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<nav class="mobile-nav">
    <li class="nav-item d-flex align-items-center">
      <a href="javascript:;" id ="first" class="nav-link text-body font-weight-bold px-0">
        <!-- <i class="fa fa-user me-sm-1" aria-hidden="true"></i> -->
        <span class="d-sm-inline d-none">First Assignatory</span>
      </a>
    </li>
    <li class="nav-item d-flex align-items-center">
      <a href="javascript:;" id ="second" class="nav-link text-body font-weight-bold px-0">
        <!-- <i class="fa fa-user me-sm-1" aria-hidden="true"></i> -->
        <span class="d-sm-inline d-none">Second Assignatory</span>
      </a>
    </li>
    <li class="nav-item d-flex align-items-center">
      <a href="javascript:;" id ="third" class="nav-link text-body font-weight-bold px-0">
        <!-- <i class="fa fa-user me-sm-1" aria-hidden="true"></i> -->
        <span class="d-sm-inline d-none">Human Resource</span>
      </a>
    </li>
</nav>

<!-- Modal -->
<div class="modal fade" id="ot_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
  <script type="text/javascript">
    var for_sig_table = $("table#for_sig_table").DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{route('user.ot_lvl1')}}?stat=0",
      columns: [
        {data:"task"},
        {data: "date_filled"},
        {data: "date"},
        {data: "starting_time"},
        {data: "end_time"},
      ]
    });

    $(document).on('click', 'a#first' ,function(){
      for_sig_table.ajax.url("{{route('user.ot_lvl1')}}?stat=0",).load();
    });

    $(document).on('click', 'a#second' ,function(){
      for_sig_table.ajax.url("{{route('user.ot_lvl1')}}?stat=1",).load();
    });

    $(document).on('click', 'a#third' ,function(){
      for_sig_table.ajax.url("{{route('user.ot_lvl1')}}?stat=2",).load();
    });

    $(document).on('click', 'table#for_sig_table tbody tr' ,function(){
      var data =  for_sig_table.row( this ).data();
      console.log("asd as");
    });


  </script>
@endsection

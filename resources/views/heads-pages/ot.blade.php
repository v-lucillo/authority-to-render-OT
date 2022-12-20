@extends('heads-layout.layout')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>OverTime Table</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0" id = "for_sig_table" style="width:100%">
            <thead>
              <tr>
                <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                <th >Name</th>
                <th >Task</th>
                <th >Date Filed</th>
                <th >OT Date</th>
                <th>Staring Time</th>
                <th>Ending Time</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody> </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
  <form id = "sign_ot_form">
    <button type="button" class="btn btn-primary" name = "sign_ot">
    Approved & Sign
  </button>
</form>

  <form id = "generate_pdf_form">
    <button type="button" class="btn btn-primary" name = "generate_pdf_button">
        Generate PDF
    </button>
</form>

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
    <li class="nav-item d-flex align-items-center">
      <a href="javascript:;" id ="fourth" class="nav-link text-body font-weight-bold px-0">
        <!-- <i class="fa fa-user me-sm-1" aria-hidden="true"></i> -->
        <span class="d-sm-inline d-none">Archived</span>
      </a>
    </li>
</nav>


@endsection

@section('script')
  <script type="text/javascript">
    $('form#generate_pdf_form').hide();
    var user_lvl =  "{{$user_lvl}}";
    if(user_lvl != 1){
      $('form#sign_ot_form').hide();
    }
    var for_sig_table = $("table#for_sig_table").DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{route('heads.get_submitted_ot')}}?stat=0&id={{$id}}",
      columns: [
        {data:"id"},
        {data:"name"},
        {data:"task"},
        {data: "date_filled"},
        {data: "date"},
        {data: "starting_time"},
        {data: "end_time"},
        {data: function(data){
          console.log(data);
          return '<i class="fa fa-eye cursor-pointer" id = "view" aria-hidden="true"></i>';
        }},
      ],
      'columnDefs': [{
         'targets': 0,
         'searchable': false,
         'orderable': false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
         }
      }],
      'order': [[1, 'asc']]
    });


       // Handle click on "Select all" control
     $('#example-select-all').on('click', function(){
        // Get all rows with search applied
        var rows = for_sig_table.rows({ 'search': 'applied' }).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
     });

   // Handle click on checkbox to set state of "Select all" control
   $('table#for_sig_table tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });

    if(user_lvl == "1"){
      $(document).on('click', 'a#first' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=0&id={{$id}}",).load();
        $('form#sign_ot_form').show();
      });

      $(document).on('click', 'a#second' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=1&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });

      $(document).on('click', 'a#third' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=2&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });

      $(document).on('click', 'a#fourth' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=3&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });

    }else if(user_lvl == "2"){
      $(document).on('click', 'a#first' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=0&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });

      $(document).on('click', 'a#second' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=1&id={{$id}}",).load();
        $('form#sign_ot_form').show();
      });

      $(document).on('click', 'a#third' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=2&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });
      $(document).on('click', 'a#fourth' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=3&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });
    }else if(user_lvl == "3"){
      $(document).on('click', 'a#first' ,function(){
        $( "#example-select-all" ).prop( "checked", false);
        for_sig_table.ajax.reload();
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=0&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
        $('form#generate_pdf_form').hide();
      });

      $(document).on('click', 'a#second' ,function(){
        $( "#example-select-all" ).prop( "checked", false);
        for_sig_table.ajax.reload();
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=1&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
        $('form#generate_pdf_form').hide();
      });

      $(document).on('click', 'a#third' ,function(){
        $( "#example-select-all" ).prop( "checked", false);
        for_sig_table.ajax.reload();
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=2&id={{$id}}",).load();
        $('form#sign_ot_form').show();
        $('form#generate_pdf_form').hide();
      });
      $(document).on('click', 'a#fourth' ,function(){
        $( "#example-select-all" ).prop( "checked", false);
        for_sig_table.ajax.reload();
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=3&id={{$id}}",).load();
        $('form#generate_pdf_form').show();
        $('form#sign_ot_form').hide();
      });
    }else{
      $(document).on('click', 'a#first' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=0&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });

      $(document).on('click', 'a#second' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=1&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });

      $(document).on('click', 'a#third' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=2&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });
      $(document).on('click', 'a#fourth' ,function(){
        for_sig_table.ajax.url("{{route('heads.get_submitted_ot')}}?stat=3&id={{$id}}",).load();
        $('form#sign_ot_form').hide();
      });
    }

    $(document).on('click', 'table#for_sig_table tbody tr td i#view' ,function(){
      var data =  for_sig_table.row( $(this).parent().parent() ).data();
      window.open("{{route('heads.view_ot')}}?asdlasjkdhaskjdhasjkd="+data.id);
    });



  $('button[name="sign_ot"]').on('click', function(e){
      var form = $("form#sign_ot_form");
      // Iterate over all checkboxes in the table
      var data = [];
      console.log($("table#for_sig_table tbody tr").find('input[type="checkbox"]'));
      $("table#for_sig_table tbody tr").find('input[type="checkbox"]').each(function(index){
          if(this.checked){
            var ot_id = $(this).attr('value');
            data[index] = {id: ot_id };
          }
      });

      $.ajax({
        url: "{{route('heads.approved_and_sign_ot')}}",
        data: {ot: data},
        success: function(e){
          for_sig_table.ajax.reload(null,false);
          if(e.message){
            for_sig_table.ajax.reload(null, false);
            Swal.fire(
              'Success!',
              'Overtime Signed',
              'success'
            )
          }
        },
        error: function(e){
          console.log(e);
        }

      });
   });



  $('button[name="generate_pdf_button"]').on('click', function(e){
      var form = $("form#generate_pdf_form");
      // Iterate over all checkboxes in the table
      var data = [];
      console.log($("table#for_sig_table tbody tr").find('input[type="checkbox"]'));
      $("table#for_sig_table tbody tr").find('input[type="checkbox"]').each(function(index){
          if(this.checked){
            var ot_id = $(this).attr('value');
            data[index] = {id: ot_id};
          }
      });

      $.ajax({
        url: "{{route('heads.generate_pdf')}}",
        data: {ot: data},
        type: "GET",
        xhrFields: {
            responseType: 'blob' // to avoid binary data being mangled on charset conversion
        },
        success: function(blob, status, xhr) {
          $( "#example-select-all" ).prop( "checked", false);
            for_sig_table.ajax.reload(null, false);
            // check for a filename
            var filename = "";
            var disposition = xhr.getResponseHeader('Content-Disposition');
            if (disposition && disposition.indexOf('attachment') !== -1) {
                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                var matches = filenameRegex.exec(disposition);
                if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
            }

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                window.navigator.msSaveBlob(blob, filename);
            } else {
                var URL = window.URL || window.webkitURL;
                var downloadUrl = URL.createObjectURL(blob);

                if (filename) {
                    // use HTML5 a[download] attribute to specify filename
                    var a = document.createElement("a");
                    // safari doesn't support this yet
                    if (typeof a.download === 'undefined') {
                        window.location.href = downloadUrl;
                    } else {
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                    }
                } else {
                    window.location.href = downloadUrl;
                }

                setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
            }
        },
        error: function(e){
          console.log(e);
        }
      });
   });

  </script>
@endsection

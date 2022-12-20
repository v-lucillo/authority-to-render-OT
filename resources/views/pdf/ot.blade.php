  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title></title>
      <style>
          table,
          th,
          td {
              border: 1px solid black;
              border-collapse: collapse;
              padding: 6px;
              text-align: center;
              width: 100%;
              font-family: Tahoma, sans-serif;
          }
      </style>
  </head>
  <body>
      @foreach($user_ids as $row)
          <table style="padding:0px; margin: 0px;">
              <tr>
                  <th height="30px" colspan="10" style="background-color:#d4d4d4; text-align: left;">Request for overtime payment
                      <img src="{{public_path('/mbc_logo.png')}}" style="width: 150px; margin-top: -25px;padding: 10px; margin-left: 500px;">
                  </th>
              </tr>

              <tr style="line-height: 12px; font-size: 14px; font-weight: bold; background-color:#d4d4d4">
                  <td colspan="3" style="text-align: right;">To</td>
                  <td colspan="4" style="text-align: left;">{{$user_info[$row]->name}}</td>
                  <td colspan="1" style="text-align: right;">Date</td>
                  <td colspan="2" style="text-align: left;">{{$user_info[$row]->lvl2_date_signed}}</td>
              </tr>
              <tr style="line-height: 12px; font-size: 14px; font-weight: bold; background-color:#d4d4d4">
                  <td colspan="3" style="text-align: right;">Payee</td>
                  <td colspan="4" style="text-align: left;">Accounting Dept</td>
                  <td colspan="1" style="text-align: right;">Reg.Schedule</td>
                  <td colspan="2" style="text-align: left;">{{$user_info[$row]->time_in}} - {{$user_info[$row]->time_out}}</td>
              </tr>
              <tr style="line-height: 10px; font-size: 14px; font-weight: bold; background-color:#d4d4d4">
                  <td colspan="3" style="text-align: right;">DEPT./STATION</td>
                  <td colspan="4" style="text-align: left;">{{$user_info[$row]->department}}</td>
                  <td colspan="1" style="text-align: right;">Rest Day</td>
                  <td colspan="2" style="text-align: left;">{{$user_info[$row]->restday}}</td>
              </tr>


              <tr style="line-height: 12px; font-size: 12px; font-weight: bold; background-color:#d4d4d4">
                  <td colspan="5">PURSUANT TO THE AUTHORIZATION/APPROVAL DATED</td>
                  <td colspan="3" style="text-align: right;">HRAS RECEIVED DATE:</td>
                  <td colspan="2"></td>
              </tr>


              <tr>
                  <td colspan="10"></td>
              </tr>

              <tr style="line-height: 12px; font-size: 14px; font-weight: bold">
                  <td colspan="2">Date</td>
                  <td colspan="4">Task</td>
                  <td colspan="1">From</td>
                  <td colspan="1">To</td>
                  <td colspan="2">No. of Hours</td>
              </tr>


              @foreach($ot as $row2)
                  @if($row2->user_id == $row)
                      <tr style="line-height: 12px; font-size: 12px;">
                          <td colspan="2">{{$row2->date}}</td>
                          <td colspan="4">{{$row2->task}}</td>
                          <td colspan="1">{{$row2->starting_time}}</td>
                          <td colspan="1">{{$row2->end_time}}</td>
                          <td colspan="2"></td>
                      </tr>
                  @endif
              @endforeach







              <tr>
                  <td colspan="10"></td>
              </tr>

              <tr style="line-height: 12px; font-size: 14px;">
                  <td colspan="2">Requested by:</td>
                  <td colspan="6">Approved by:</td>
                  <td colspan="2">Approved by:</td>
              </tr>

              <tr style="line-height: 12px; font-size: 14px;">
                  <td colspan="2">{{$user_info[$row]->name}}<img src="{{public_path($user_info[$row]->signature)}}" style="width: 200px; margin-top:-70px"></td>
                  <td colspan="3">{{$user_assignatory[$row][0]->name}}<img src="{{public_path($user_assignatory[$row][0]->signature)}}" style="width: 200px; margin-top:-40px"></td>
                  <td colspan="3">{{$user_assignatory[$row][1]->name}}<img src="{{public_path($user_assignatory[$row][1]->signature)}}" style="width: 200px; margin-top:-40px;margin-left:40px"></td>
                  <td colspan="2">Ms. Ellen Fullido <img src="{{public_path($user_info[$row]->signature)}}" style="width: 200px; margin-top:-70px"></td>
              </tr>

              <tr style="visibility: hidden;">
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
              </tr>
          </table>
          <hr style="margin-top: -14px; padding: 0px;">









          <br>
          <br> <br>
          <div style="page-break-before: always;"></div>




           <table style="padding:0px; margin: 0px;">
              <tr>
                  <th height="30px" colspan="10" style="background-color:#f5f5f5">FJElizalde GROUP OF COMPANIES</th>
              </tr>
              <tr>
                  <td colspan="10"></td>
              </tr>
              <tr>
                  <th height="30px" colspan="10" style="background-color:#f5f5f5">Authorization to Work Overtime</th>
              </tr>
              <tr>
                  <td colspan="10"></td>
              </tr>
              <tr>
                  <td colspan="10"></td>
              </tr>

              <tr style="line-height: 12px; font-size: 14px; font-weight: bold">
                  <td colspan="2">Date</td>
                  <td colspan="4">Task</td>
                  <td colspan="1">From</td>
                  <td colspan="1">To</td>
                  <td colspan="2">Noted by {{$user_assignatory[$row][0]->name}}</td>
              </tr>


              @foreach($ot as $row2)
                  @if($row2->user_id == $row)
                      <tr style="line-height: 12px; font-size: 12px;">
                          <td colspan="2">{{$row2->date}}</td>
                          <td colspan="4">{{$row2->task}}</td>
                          <td colspan="1">{{$row2->starting_time}}</td>
                          <td colspan="1">{{$row2->end_time}}</td>
                          <td colspan="2"><img src="{{public_path($user_assignatory[$row][0]->signature)}}" style="width: 150px; margin-top:-5px"></td>
                      </tr>
                  @endif
              @endforeach


              <tr>
                  <td colspan="10"></td>
              </tr>

              <tr style="line-height: 12px; font-size: 14px;">
                  <td colspan="2">Requested by:</td>
                  <td colspan="6"></td>
                  <td colspan="2">Approved by:</td>
              </tr>

              <tr style="line-height: 12px; font-size: 14px;">
                  <td colspan="2">{{$user_info[$row]->name}} <img src="{{public_path($user_info[$row]->signature)}}" style="width: 200px; margin-top:-70px"></td>
                  <td colspan="6"></td>
                  <td colspan="2">{{$user_assignatory[$row][1]->name}}<img src="{{public_path($user_assignatory[$row][1]->signature)}}" style="width: 200px; margin-top:-70px"></td>
              </tr>

              <tr style="visibility: hidden;">
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
              </tr>
          </table>
          <hr style="margin-top: -14px; padding: 0px;">
          <div style="page-break-before: always;"></div>
      @endforeach
  </body>
  </html>

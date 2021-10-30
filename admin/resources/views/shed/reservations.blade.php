
        @extends('shed.admin_layout')
        @section('content') 
        @section('title', 'Reservations')


<div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">Reservations</h6>
        <div class="element-box">
            <h5 class="form-header">Reservations</h5>
            <div class="form-desc">

            


             @if ($delete_message = Session::get('delete_success'))
             <div class="alert alert-danger">
              <p>{{ $delete_message }}</p>
             </div>
             @endif

            
                
            </div>
            <div class="table-responsive">
                <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                   
                    <tbody>
                        @foreach ($reservation as $reservation)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $reservation->fname }} {{ $reservation->lname }}</td>
                            <td>{{ $reservation->email }}</td>
                            
                            <td>{{ $reservation->phone }}</td>
                            <td>{{ $reservation->time }}</td>
                            <td>{{ $reservation->date }}</td>
                            <td>{{ $reservation->guests }}</td>
                            <td>{{ $reservation->reservation_status }}</td>
                          <td>

                              <form action="{{ route('shed_reservation_data.destroy',$reservation->id) }}" method="POST">
                          
                                  <!-- <a href="details.html" class="btn btn-info btn-xs"><i class="os-icon os-icon-external-link"></i></a> -->
                                  {{-- @csrf
                                   @method('DELETE') --}} 
                    
                                   {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <button type="button" class="btn btn-danger btn-xs" style="margin-left:0px" data-target="#myModal{{$reservation->id}}" class="trigger-btn" data-toggle="modal"><i class="os-icon os-icon-ui-15"></i></button>
                                  @include('shed.reservations_delete_modal')
                                  </form>
                                </td> 
                        </tr>
                       
                       
                        
                         @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


         @stop 
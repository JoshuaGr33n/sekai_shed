        @extends('shed.admin_layout')
        @section('title', 'Item Order History')
        @section('content') 


<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Item Order History</h6>
            <div class="element-box">
                <div class="controls-above-table">
                  <div class="row">
                    <div class="col-sm-6"></div>
                      <div class="col-sm-6" style="text-align: right;">
                          <a class="btn btn-sm btn-success" href="back">Back</a>
                          
                      </div>
                      
                  </div>
              </div>
                <div class="table-responsive">
                 @if ($delete_message = Session::get('delete_success'))
                       <div class="alert alert-danger">
                   <p>{{ $delete_message }}</p>
                  </div>
                 @endif
                    <table class="table table-lightborder" id="dataTable1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Quantity</th>
                                <th>Placed on</th>
                                <th>Delivery Status</th>
                                <th>Payment Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Quantity</th>
                                <th>Placed on</th>
                                <th>Delivery Status</th>
                                <th>Payment Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </tfoot>

                        <tbody>
                           @foreach ($itemOrders as $itemOrders)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $itemOrders->customerFname }} {{ $itemOrders->customerLname }}</td>
                                <td>{{ $itemOrders->phone }}</td>
                                <td>{{ $itemOrders->quantity }}</td>
                                <td>{{ date("d M Y", strtotime($itemOrders->created_at)) }}</td>
                                <td>
                                    {{ $itemOrders->delivery_status }}
                                </td>
                                <td>
                                    {{ $itemOrders->payment_status }}
                                </td>
                                <td class="text-right">
                                <form action="{{ route('shed_menu_data.deleteItemOrder',$itemOrders->id) }}" method="POST">
                                 <a href="{{ route('shed_order_data.show',$itemOrders->id) }}" class="btn btn-info btn-xs"><i class="os-icon os-icon-external-link"></i></a>
                                 
                                  {{-- @csrf
                                   @method('DELETE') --}} 
                    
                                   {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <button type="button" class="btn btn-danger btn-xs"  data-target="#myModal{{$itemOrders->id}}" class="trigger-btn" data-toggle="modal"><i class="os-icon os-icon-ui-15"></i></button>
                                  @include('shed.item_order_history_delete_modal')
                             </form>
                                </td>
                            </tr>
                            @endforeach

                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="content-panel">
        <div class="content-panel-close">
            <i class="os-icon os-icon-close"></i>
        </div>

     
    </div>
</div>
@stop 
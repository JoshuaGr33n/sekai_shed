
       @extends('shed.admin_layout')
        @section('content')  
        @section('title', 'Orders')




<div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">Orders</h6>
        <div class="element-box">
            <h5 class="form-header">Orders</h5>
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
                           <th></th>
                           <th>Name</th>
                            <th>Order</th>
                            <th>Item Id</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Placed On</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                           <th>#</th>
                           <th></th>
                           <th>Name</th>
                            <th>Order</th>
                            <th>Item Id</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Placed On</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                          @foreach ($orders as $orders)
                       
                        
                        <tr>
                            <td>{{ ++$i }}</td>
                            <?php if (!empty($orders->pic)){?>
                                <td><div class="product-image"><img alt="" src="{{ asset($orders->pic) }}" style="width:80px; height:70px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div></td>
                            <?php }else{?>
                                <td><div class="product-image"><img alt="" src="{{ asset('public/shed/img/empty.jpg') }}" style="width:80px; height:70px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div></td>
                            <?php }?>
                            <td>{{ $orders->customerFname }} {{ $orders->customerLname }}</td>
                            <td>{{ $orders->order }}</td>
                            <td>{{ $orders->item_id }}</td>
                            <td>{{ $orders->quantity }}</td>
                            <td>#{{ $orders->price }}</td>
                            <td>{{ date("d M Y", strtotime($orders->created_at)) }}</td>
                            <td>{{ $orders->payment_method }}</td>
                            <td>{{ $orders->payment_status }}</td>
                            <td>{{ $orders->delivery_status }}</td>
                            <td class="text-center">
                              <form action="{{ route('shed_order_data.destroy',$orders->id) }}" method="POST">
                                 <a href="{{ route('shed_order_data.show',$orders->id) }}" class="btn btn-info btn-xs"><i class="os-icon os-icon-external-link"></i></a>
                                 
                                  {{-- @csrf
                                   @method('DELETE') --}} 
                    
                                   {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <button type="button" class="btn btn-danger btn-xs"  data-target="#myModal{{$orders->id}}" class="trigger-btn" data-toggle="modal"><i class="os-icon os-icon-ui-15"></i></button>
                                  @include('shed.orders_delete_modal')
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



                @stop  
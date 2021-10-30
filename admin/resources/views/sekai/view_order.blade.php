@extends('sekai.admin_layout')
 @section('content') 
 @section('title', 'View Order Item')


    <div class="content-box">
        <div class="row">
            <div class="col-md-8">
                <div class="order-box">
                     <div class="form-group"><a href="{{url('sekaiOrders')}}" class="btn btn-success">Back</a></div>
                    <div class="order-details-box">
                        <div class="order-main-info"><span>Order #{{ $Orders->order_id }}</span><strong>{{ $Orders->id }}</strong></div>
                        <div class="order-sub-info"><span>Placed On</span><strong>{{  date("d M Y", strtotime($Orders->created_at)) }}</strong></div>
                    </div>
                  
                    <div class="order-controls">
                        <form class="form-inline" action="{{ route('sekai_order_data.update',$Orders->id ) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="">Delivery Status</label>
                                <select class="form-control form-control-sm" name="delivery">
                                   <option value="{{ $Orders->delivery_status }}">{{ $Orders->delivery_status }}</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Payment Status</label>
                                <select class="form-control form-control-sm" name="payment">
                                    <option value="{{ $Orders->payment_status }}">{{ $Orders->payment_status }}</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group"><button type="submit" class="btn btn-primary">Save</button></div>
                        </form>
                    </div>
                    <div class="order-items-table">
                        <div class="table-responsive">
                            <table class="table table-lightborder">
                                <thead>
                                    <tr>
                                        <th colspan="2">Order Info</th>
                                      
                                        <th colspan="2">Item Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><div class="product-image" style="background-image: url(img/product7.jpg);"><img alt="" src="{{ asset('img/product7.jpg') }}" /></div></td>
                                        <td>
                                            <div class="product-name">{{ $Orders->order }}</div>
                                            <div class="product-details">
                                                <span>Quantity: </span><strong> {{ $Orders->quantity }}</strong>
                                                <div class="color-box" style="background-color: #d4c1a2;"></div>
                                            </div>
                                        </td>
                                     
                                        <td class="text-md-center"><div class="product-price">#{{ $Orders->price }}</div></td>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="order-foot">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h5></h5>
                                <?php if (!empty($Orders->pic)){?>
                                 <div class="product-image"><img alt="" src="{{ asset($Orders->pic) }}" style="width:250px; height:200px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div>
                                <?php }else{?>
                                <div class="product-image"><img alt="" src="{{ asset('public/sekai/img/empty.jpg') }}" style="width:250px; height:200px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div>
                                <?php }?>
                           
                            </div>
                            

                            <div class="col-md-5 offset-md-1">
                                <h5 class="order-section-heading">Order Summary</h5>
                                <div class="order-summary-row">
                                    <div class="order-summary-label"><span>Quantity Ordered</span></div>
                                    <div class="order-summary-value">{{ $Orders->quantity }}</div>
                                </div>
                                <div class="order-summary-row">
                                    <div class="order-summary-label"><span>Payment Method</span><strong></strong></div>
                                    <div class="order-summary-value">{{ $Orders->payment_method }}</div>
                                </div>
                                <div class="order-summary-row">
                                    <div class="order-summary-label"><span>Total Price</span><strong></strong></div>
                                    <div class="order-summary-value">#{{ $Orders->price * $Orders->quantity }}</div>
                                </div>
                                <div class="order-summary-row as-total">
                                    <!-- <div class="order-summary-label"><span>Quantity</span></div>
                                    <div class="order-summary-value">{{ $Orders->quantity }}</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-foot">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h5>Order Note</h5>
                                <div class="form-group"><textarea class="form-control" disabled style="height:150px">{{ $Orders->note }}</textarea></div>
                               
                            </div>
                            <div class="col-md-5 offset-md-1">

                                <div class="order-summary-row as-total">
                                    <div class="order-summary-label"><span></span></div>
                                    <div class="order-summary-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ecommerce-customer-info">
                    
                    <div class="ecommerce-customer-sub-info">
                        <div class="ecc-sub-info-row">
                            <div class="sub-info-label">Email</div>
                            <div class="sub-info-value"><a href="#">{{ $Orders->email }}</a></div>
                        </div>
                        <div class="ecc-sub-info-row">
                            <div class="sub-info-label">Phone</div>
                            <div class="sub-info-value">{{ $Orders->phone }}</div>
                        </div>
                    </div>
                    <div class="os-tabs-controls">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_overview"> Billing</a></li>

                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="ecc-sub-info-row">
                            <div class="sub-info-label">Address</div>
                            <div class="sub-info-value">
                            {{ $Orders->address }}
                            </div>
                        </div>
                        <div class="ecc-sub-info-row">
                            <div class="sub-info-label">Payment Method</div>
                            <div class="sub-info-value"><img alt="" src="{{ asset('public/sekai/img/mastercard.png') }}" style="width: auto; height: 40px;" /><span>{{ $Orders->payment_method }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      
        
    </div>



@stop 
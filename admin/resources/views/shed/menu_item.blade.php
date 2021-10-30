@extends('shed.admin_layout')
 @section('content') 
 @section('title', 'Menu Item')


    <div class="content-box">
        <div class="row">
            <div class="col-md-8">
                <div class="order-box">
                     <div class="form-group"><a href="{{url('shedMenu')}}" class="btn btn-success">Back</a></div>
                          <?php if (!empty($MenuData->pic)){?>
                            <div class="product-image"><img alt="" src="{{ asset($MenuData->pic) }}" style="width:250px; height:200px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div>
                            <?php }else{?>
                                <div class="product-image"><img alt="" src="{{ asset('public/shed/img/empty.jpg') }}" style="width:250px; height:200px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div>
                            <?php }?>
                    
                    <div class="order-details-box">
                        <div class="order-main-info"><span>Item #</span><strong>{{ $MenuData->name }}</strong></div>
                        <div class="order-sub-info"><span>Placed On</span><strong>{{  date("d M Y", strtotime($MenuData->created_at)) }}</strong></div>
                    </div>
                    
                    <div class="order-controls">
                        <form class="form-inline" action="{{ route('shed_menu_data.updateMenuStatus',$MenuData->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('get') }}
                          
                            <div class="form-group">
                                <label for="">Item Status</label>
                                <select class="form-control form-control-sm" name="item_status">
                                    <option value="{{ $MenuData->item_status }}">{{ $MenuData->item_status }}</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                    <option value="Available">Available</option>
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
                                        <th colspan="2">Product Info</th>
                                      
                                        <th colspan="2">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php if (!empty($MenuData->pic)){?><div class="product-image"><img alt="" src="{{ asset($MenuData->pic) }}"  style="width:100px; height:80px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div><?php }else{?> <div class="product-image"><img alt="" src="{{ asset('public/shed/img/empty.jpg') }}" style="width:100px; height:70px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div><?php }?></td>
                                        <td>
                                            <div class="product-name">{{ $MenuData->name }}</div>
                                            <div class="product-details">
                                                  <?php $trimed_category = str_replace("','", " ", $MenuData->category);?>
                                                <span>Category: </span><strong> <?php print_r($trimed_category);?></strong>
                                                <div class="color-box" style="background-color: #d4c1a2;"></div>
                                            </div>
                                        </td>
                                     
                                        <td class="text-md-center"><div class="product-price">{{ $MenuData->price }}</div></td>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="order-foot">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h5>Description</h5>
                                <div class="form-group"><textarea class="form-control" disabled style="height:150px">{{ $MenuData->description }}</textarea></div>
                                <!-- <button class="btn btn-primary">Save Notes</button> -->
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
                    
                <a href="{{ route('shed_menu_data.itemOrderHistory',$MenuData->id) }}" class="btn btn-secondary" style="margin-left:100px">Item Order History</a>
                </div>
            </div>
        </div>

       
        
      
        
    </div>



@stop 
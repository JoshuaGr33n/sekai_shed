
        @extends('sekai.admin_layout')
        @section('title', 'Menu')
        @section('content') 


     

        <script>
$(document).ready(function(){
    var maxLength = 100;
    $(".show-read-more").each(function(){
        var myStr = $(this).text();
        if($.trim(myStr).length > maxLength){
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function(){
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });
});
</script>
<style>
    .show-read-more .more-text{
        display: none;
    }
</style>









  
       
        

<div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">Menu <button class="mr-2 mb-2 btn btn-warning" type="button" style="margin-left:500px" data-toggle="modal" data-target="#ModalLoginForm">Add Menu +</button></h6>
        <div class="element-box">
            <h5 class="form-header">Menu</h5>
            <div class="form-desc">

            @if ($message = Session::get('success'))
           <div class="alert alert-success">
              <p>{{ $message }}</p>
           </div>
          @endif


          @if ($delete_message = Session::get('delete_success'))
           <div class="alert alert-danger">
              <p>{{ $delete_message }}</p>
           </div>
          @endif

          @if ($duplicate_message = Session::get('duplicateERROR'))
           <div class="alert alert-danger">
              <p>{{ $duplicate_message }}</p>
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
                            <th>Category</th>
                            <th>Price</th>
                            <th>Item Status</th>
                            <th>Special</th>
                            <th>Action</th>
                           
                    </thead>
                    <tfoot>
                        <tr>
                             <th>#</th>
                             <th></th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Item Status</th>
                            <th>Special</th>
                            <th>Action</th>
                           
                        </tr>
                    </tfoot>
                   
                    <tbody>
                       @foreach ($menu as $menu)
                         <tr>
                            <td>{{ ++$i }}</td>
                            <?php if (!empty($menu->pic)){?>
                                <td><div class="product-image"><img alt="" src="{{ asset($menu->pic) }}" style="width:80px; height:70px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div></td>
                            <?php }else{?>
                                <td><div class="product-image"><img alt="" src="{{ asset('public/sekai/img/empty.jpg') }}" style="width:80px; height:70px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div></td>
                            <?php }?>
                           
                            <td>{{ $menu->name }}</td>
                            <?php $trimed_category = str_replace("','", " ", $menu->category);?>
                            <td><?php print_r($trimed_category);?></td>
                            <td>#{{ $menu->price}}</td>
                             <!-- <td class="show-read-more">{{ $menu->description }}</td> -->
                             <td>{{ $menu->item_status}}</td>
                             <td>{{ $menu->specials}}</td>
                               <td>

                               <form action="{{ route('sekai_menu_data.destroy',$menu->id) }}" method="POST">
                                  <a href="{{ route('sekai_menu_data.show',$menu->id) }}" class="btn btn-info btn-xs"><i class="os-icon os-icon-external-link"></i></a>
                                  <a href="{{ route('sekai_menu_data.edit',$menu->id) }}" class="btn btn-primary btn-xs" style="margin-left:0px;"><i class="os-icon os-icon-ui-49"></i></a>
                                  <!-- <a class="text-danger" href="#"><i class="os-icon os-icon-ui-15"></i></a></td>  -->

                                  {{-- @csrf
                                   @method('DELETE') --}} 
                    
                                   {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <input type="hidden" name="sno" value="{{ $menu->id }}"/>
                                  <button type="button" class="btn btn-danger btn-xs"  data-target="#myModal{{$menu->id}}" class="trigger-btn" data-toggle="modal"><i class="os-icon os-icon-ui-15"></i></button>
                                  @include('sekai.menu_delete_modal')
                                </form>
                                  </td>
                         </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


  <!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add New Menu</h1>
            </div>
            <div class="modal-body">


             @if ($errors->any())
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                   @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                    @endforeach
              </ul>
              </div>
               @endif
                <form role="form" method="POST" action="{{ route('sekai_menu_data.store') }}" id="formValidate" enctype="multipart/form-data">
                             {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label class="control-label">Avatar</label>
                        <div>
                        <input type="file" name="image" onchange="previewFile(this);"  class="form-control" id="customFile" alt="Preview Avartar" accept=".jfif,.jpg,.jpeg,.png,.gif">
                        </div>
                    </div>
                    <img id="previewImg" src="{{ asset('public/img/no-img.png') }}" alt="" width="300" height="300">

                   
                    
              
                    
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="name" value="" data-error="Required"  required="required">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Catgory</label>
                        <div>
                          
                                <!-- <label><input type="checkbox" name="category[]" value="starter"> STARTERS</label>
                                <label><input type="checkbox" name="category[]" value="breakfast"> BREAKFAST</label>
                                <label><input type="checkbox" name="category[]" value="lunch"> LUNCH</label>
                                <label><input type="checkbox" name="category[]" value="dinner"> DINNER</label>
                                <label><input type="checkbox" name="category[]" value="desserts"> DESSERTS</label> -->

                                             
                                                   
                                                    <select class="form-control select2" multiple="true" name="category[]" style="width:100%" data-error="Required" required="required">
                                                    @foreach($menu_categories as $menu_categories)
                                                        <option>{{$menu_categories->category}}</option>
                                                    @endforeach    
                                                    </select>
                                                
                             

                                
                           <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Price</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="price" data-error="Required" required="required">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Decription</label>
                        <div>
                           <textarea class="form-control input-lg" name="description" style="height:100px" data-error="Required" required="required"></textarea>
                           <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <label><input type="checkbox" name="special" value="Yes"> Special</label>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success btn-xs" style="width:450px; height:40px">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



         @stop 
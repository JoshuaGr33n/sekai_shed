       @extends('shed.admin_layout')
        @section('content') 
        @section('title', 'Edit Menu Item')
        
        <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">       
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
       <style type="text/css">
     
     h2 {
         margin: 50px 0
     }
     
     .file-drop-area {
         position: relative;
         display: flex;
         align-items: center;
         max-width: 100%;
         padding: 25px;
         border: 1px dashed rgba(255, 255, 255, 0.4);
         border-radius: 3px;
         transition: .2s
     }
     
     .choose-file-button {
         flex-shrink: 0;
         background-color: rgba(255, 255, 255, 0.04);
         border: 1px solid rgba(255, 255, 255, 0.1);
         border-radius: 3px;
         padding: 8px 15px;
         margin-right: 10px;
         font-size: 12px;
         text-transform: uppercase
     }
     
     .file-message {
         font-size: small;
         font-weight: 300;
         line-height: 1.4;
         white-space: nowrap;
         overflow: hidden;
         text-overflow: ellipsis
     }
     
     .file-input {
         position: absolute;
         left: 0;
         top: 0;
         height: 100%;
         widows: 100%;
         cursor: pointer;
         opacity: 0
     }
             </style>
     
     
        <script>
          $(document).on('change', '.file-input', function() {
     
     
     var filesCount = $(this)[0].files.length;
     
     var textbox = $(this).prev();
     
     if (filesCount === 1) {
     var fileName = $(this).val().split('\\').pop();
     textbox.text(fileName);
     } else {
     textbox.text(filesCount + ' file selected');
     }
     
     
     
     if (typeof (FileReader) != "undefined") {
     var dvPreview = $("#divImageMediaPreview");
     dvPreview.html("");
     $($(this)[0].files).each(function () {
     var file = $(this);
     var reader = new FileReader();
     reader.onload = function (e) {
     var img = $("<img />");
     img.attr("style", "width:500px; height:500px; border:1px solid #ccc;padding:5px 5px 5px 5px; padding: 10px");
     img.attr("src", e.target.result);
     dvPreview.append(img);
     }
     reader.readAsDataURL(file[0]);
     });
     } else {
     alert("This browser does not support HTML5 FileReader.");
     }
     
     
     });
         </script>
     
     <div class="col-sm-7" style="margin:auto">
         <div class="element-wrapper">
             <div class="element-box">
               @if ($message = Session::get('success'))
                <div class="alert alert-success">
                   <p>{{ $message }}</p>
                </div>
                @endif
     
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
     
                 @if ($duplicate_message = Session::get('duplicateERROR'))
                <div class="alert alert-danger">
                   <p>{{ $duplicate_message }}</p>
                </div>
               @endif
     
                 <form id="formValidate" action="{{ route('shed_menu_data.update',$MenuData->id) }}" method="POST" enctype="multipart/form-data">
     
                   {{ csrf_field() }}
                   {{ method_field('PATCH') }}
                     <div class="element-info">
                         <div class="element-info-with-icon">
                             <div class="element-info-icon"><div class="os-icon os-icon-wallet-loaded"></div></div>
                             <div class="element-info-text">
                                 <h5 class="element-inner-header">Edit Menu Item  <a class="mr-2 mb-2 btn btn-success btn-xs" href="{{url('shedMenu')}}" style="margin-left:300px">Back</a></h5>
                                 <div class="element-inner-desc">
                                    
                                 </div>
                             </div>
                         </div>
                     </div>
                    
                               <?php if (!empty($MenuData->pic)){?>
                                 <div class="product-image"><img alt="" src="{{ asset($MenuData->pic) }}" style="width:250px; height:200px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div>
                                 <?php }else{?>
                                     <div class="product-image"><img alt="" src="{{ asset('public/shed/img/empty.jpg') }}" style="width:250px; height:200px; border:1px solid #ccc;padding:5px 5px 5px 5px"/></div>
                             <?php }?>
     
     
     
                     <div class="file-drop-area"> <span class="choose-file-button"></span> <span class="file-message btn btn-success btn-xs">Select Image</span> <input type="file" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" name="image"> </div>
                     
                     <div id="divImageMediaPreview"> </div>
     
     
     
                     <div class="form-group">
                         <label for=""> Name</label><input class="form-control" data-error="Required"  required="required" type="text" value="{{ $MenuData->name }}" name="name"/>
                         <div class="help-block form-text with-errors form-control-feedback"></div>
                     </div>
                     <div class="row">
                         <div class="col-sm-6">
                             <div class="form-group">
                                 <label for=""> Price</label><input class="form-control"   required="required"  data-match-error="Required" type="text" value="{{ $MenuData->price }}" name="price"/>
                                 <div class="help-block form-text text-muted form-control-feedback"></div>
                             </div>
                         </div>
                         <div class="col-sm-6">
                          <div class="form-group">
                             <label for=""> Category</label>
                              <select class="form-control" disabled>
                              <?php $trimed_category = str_replace("','", " ", $MenuData->category);?>
                             <option><?php print_r($trimed_category);?></option>
                             
                            </select>
                          </div>
                            
                         </div>
                     </div>
                                             <div class="form-group">
                                                    <label for=""> Category</label>
                                                    <select class="form-control select2" multiple="true" name="category[]" style="width:100%">
                                                    @foreach($menu_categories as $menu_categories)
                                                        <option>{{$menu_categories->category}}</option>
                                                    @endforeach    
                                                    </select>
                                                    <input type="hidden" name="categoryHidden" value="{{ $MenuData->category }}"/>
                                                </div>
                         
                     <div class="form-group">
                         <label for="">Description</label><textarea class="form-control"  style="height:150px" data-error="Required"  required="required" name="description">{{ $MenuData->description }}</textarea>
                         <div class="help-block form-text with-errors form-control-feedback"></div>
                     </div>
                    @if (!empty($MenuData->specials))
                     <label><input type="checkbox" name="special" value="Yes" checked> Special</label>
                    @else
                    <label><input type="checkbox" name="special" value="Yes"> Special</label>
                    @endif
                     <div class="form-buttons-w"><button class="btn btn-primary" type="submit">Update</button></div>
                 </form>
             </div>
         </div>
     </div>

@stop
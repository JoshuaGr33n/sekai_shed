
        @extends('sekai.admin_layout')
        @section('content') 
        @section('title', 'Menu Categories')

     <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" /> -->



<div   style="margin:auto;" width="40%">
    <div class="element-wrapper">
        <h6 class="element-header">Menu Categories <button class="mr-2 mb-2 btn btn-warning" type="button" style="margin-left:500px" data-toggle="modal" data-target="#ModalAdd">Add Menu Category +</button></h6>
        <div class="element-box">
            <h5 class="form-header">Menu Categories</h5>
            <div class="form-desc">

            


            @if ($delete_message = Session::get('delete_success'))
           <div class="alert alert-danger">
              <p>{{ $delete_message }}</p>
           </div>
          @endif

          @if ($duplicate_message = Session::get('duplicate_err'))
           <div class="alert alert-danger">
              <p>{{ $duplicate_message }}</p>
           </div>
          @endif

          @if ($success_message = Session::get('success'))
           <div class="alert alert-success">
              <p>{{ $success_message }}</p>
           </div>
          @endif


          @if ($edit_success_message = Session::get('update_success'))
           <div class="alert alert-success">
              <p>{{ $edit_success_message }}</p>
           </div>
          @endif

            
                
            </div>
            <div class="table-responsive">
                <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                   
                    <tbody>
                        @foreach ($categories as $categories)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ ucfirst($categories->category) }} </td>
                          <td>

                                 <form action="{{ route('sekai_categories_data.update',$categories->id) }}" method="POST">
                                   {{ csrf_field() }}
                                   {{ method_field('PATCH') }}
                                  <button type="button" class="btn btn-success btn-xs" style="margin-left:0px" data-target="#myModal{{ $categories->id }}" class="trigger-btn" data-toggle="modal"><i class="os-icon os-icon-ui-49"></i></button>
                                  @include('sekai.edit_categories_modal')
                                  </form>
                                  </td>
                                  <td> 
                                      <?php 
                                      $check_menu_category = DB::select("SELECT * FROM sekai_menu WHERE category like '%$categories->category%'");
                                      ?>
                                      
                                  <form action="{{ route('sekai_categories_data.destroy',$categories->id) }}" method="POST">
                                  {{-- @csrf
                                   @method('DELETE') --}} 
                    
                                   {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <input type="hidden" name="sno" value="{{ $categories->id }}"/>
                                  @if(count($check_menu_category)>0)
                                  @else
                                  <button type="button" class="btn btn-danger btn-xs"  data-target="#deleteModal{{$categories->id}}" class="trigger-btn" data-toggle="modal"><i class="os-icon os-icon-ui-15"></i></button>
                                  @endif
                                  <!-- Delete Modal HTML -->

<div id="deleteModal{{$categories->id}}" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="material-icons">X</i>
				</div>						
				<h4 class="modal-title w-100">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete this record? This process cannot be undone.</p>
			</div>
			<div class="modal-footer justify-content-center">
              
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Delete</button>
                 
			</div>
		</div>
	</div>
</div> 

<!-- Delete Modal HTML -->
                                 
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
 <div id="ModalAdd" class="modal fade">
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
                <form  method="POST" action="sekai_store_category"  class="btn-submit" id="formValidate">
                {{ csrf_field() }}
                   
                    <div class="form-group">
                        <label class="control-label">Category Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="category_name"  value="" data-error="Required"  required="required">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button class="btn btn-success btn-xs" style="width:450px; height:40px">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<!-- <script type="text/javascript">


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#ModalAdd').on('click','.btn-submit',function(e){

        e.preventDefault();

        var category_name = $("input[name=category_name]").val();
        var url = '{{ url('store_category') }}';

        $.ajax({
           url:url,
           method:'POST',
           data:{
            category:category_name, 
                 
                },
           success:function(response){
              if(response.success){
                  alert(response.message) //Message come from controller
              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
	});

</script> -->
         @stop 
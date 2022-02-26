<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style type="text/css">
      .card-img-top{
        min-height: 200px;
        max-height: 200px;
      }
      
    </style>

    <title>Creative Hustlers assignment</title>
  </head>
  <body>
    <h1 class="text-center">Creative Hustlers assignment</h1>
    <div class="container">
      <div class="row">

        <div class="m-2 col-sm-3 border border-info">
          <form method="post" id="SearchBookForm" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="col-sm-12">
                <br></br>
                <div class="form-group">
                  <label>Author</label>
                  <select class="form-control m-bot15" name="author_id">
                    <option value="">Select Author</option>
                     @if($authorlist->count() > 0)
                      @foreach($authorlist as $author)
                       <option value="{{$author->id}}">{{$author->firstname}} {{$author->lastname}}</option>
                      @endForeach
                      
                    @endif   
                  </select>
                </div>
              </div>

              <div class="col-sm-12">
                <label>Publisher</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="publishername" placeholder="Enter Publisher Name" id="">
                </div>
              </div>

              <div class="col-sm-12">
                <label>Price</label>
              <div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                  <input type="number" class="form-control" name="min_price" placeholder="Min" id="">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <input type="number" class="form-control" name="max_price" placeholder="Max" id="">
                </div>
              </div>
              </div>
            </div>

              

              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success">Search</button>
              </div>
            </div>
          </form>
        </div>

        <div class="m-2 col-sm-8 border border-info">
           <span style="float:right;padding-top:10px;" ><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addbookmodal"> + Add New Book</button></span>
          <div class="row searchlist">            
            @foreach ($booklist as $booklistKey => $booklistValue)
            
              <div class="p-2 col-sm-6 cardcol" data-id="{{ $booklistValue['id'] }}">
                <div class="card"  >
                  <div class="card-body">
                    <img class="card-img-top image-responsive" src="{!! asset('storage/app/public/uploads/book/') !!}/{{ $booklistValue->image }}" alt="Card image" style="width:100%" />
                  
                    <h4 class="card-title">{{$booklistValue->id}}Name : {{ $booklistValue->bookname }}</h4>
                    <p class="card-title">Author : {{ $booklistValue->author_name }}</p>
                    <p class="card-text">Price : {{ $booklistValue->price }}</p>

                    <button type="button" class="btn btn-warning btn-sm text-white editbutton" data-toggle="modal" data-target="#editbookmodal" data-id="{{ $booklistValue['id'] }}"> <i class="fa fa-edit" aria-hidden="true"></i> </button>

                    <button type="button" class="btn btn-danger btn-sm text-white" onclick="deleteValue('{{ $booklistValue['id'] }}');" > <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
                  </div>
                </div>
              </div>

              @endforeach
            </div>

            <!-- addbookmodal start-->
            <div class="modal fade" id="addbookmodal" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h4 class="modal-title">Add New Book</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="post" id="AddBookForm" enctype="multipart/form-data">
                      
                      @csrf
                    <div class="row">
                      <div class="col-sm-12"><span class="text-danger" id="image-input-error1"></span></div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <select class="form-control m-bot15" name="add_author_id">
                            <option value="">Select Author</option>
                             @if($authorlist->count() > 0)
                              @foreach($authorlist as $author)
                               <option value="{{$author->id}}">{{$author->firstname}} {{$author->lastname}}</option>
                              @endForeach
                              
                            @endif   
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="add_bookname" placeholder="Enter Book Name" id="">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="add_publishername" placeholder="Enter Publisher Name" id="">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="number" class="form-control" name="add_price" placeholder="Enter Price" id="">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="file" name="add_image" class="form-control">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- addbookmodal end -->



            <!-- editbookmodal start-->
            <div class="modal fade" id="editbookmodal" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h4 class="modal-title">Update Book</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="post" id="EditBookForm" enctype="multipart/form-data">
                      
                    @csrf
                    <div class="row">
                      <div class="col-sm-12"><span class="text-danger" id="image-input-error"></span></div>
                      <div class="col-sm-6">
                        <input type="hidden" class="form-control" name="edit_book_id" id="edit_book_id">
                        <div class="form-group">
                          
                          <select class="form-control m-bot15" name="edit_author_id" id="edit_author_id">
                            <option value="">Select Author</option>
                             @if($authorlist->count() > 0)
                              @foreach($authorlist as $author)
                               <option value="{{$author->id}}">{{$author->firstname}} {{$author->lastname}}</option>
                              @endForeach
                              
                            @endif   
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="edit_bookname" placeholder="Enter Book Name" id="edit_bookname">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="edit_publishername" placeholder="Enter Publisher Name" id="edit_publishername">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="number" class="form-control" name="edit_price" placeholder="Enter Price" id="edit_price">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="file" name="edit_image" class="form-control">
                          
                        </div>
                      </div>
                      <div class="col-sm-5" id="book-image-preview"></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- editbookmodal end -->
                            
        </div>
      </div> 
    </div>


    <script>
      $(document).ready(function () {
        
        $("#SearchBookForm").trigger("reset");
        $("#AddBookForm").trigger("reset");
        $("#EditBookForm").trigger("reset");


        $('#AddBookForm').on('submit',function(e){
           e.preventDefault();
           let formData = new FormData(this);
           $('#image-input-error1').val('');
           

           $.ajax({
              type:'POST',
              url : "{{ route('add-book') }}",
               data: formData,
               contentType: false,
               processData: false,
               success: (response) => {
                if(response.success){
                  this.reset();
                  $('#addbookmodal').modal('toggle');
                  refreshRecords();
                }
                if(response.error){
                  alert(data.error);
                }
               },
               error: function(response){
                $('#image-input-error1').text(response.responseJSON.errors.file);
               }
           });
        });
        

        

        $('#EditBookForm').on('submit',function(e){
           e.preventDefault();
           let formData = new FormData(this);
           $('#image-input-error').val('');
           

           $.ajax({
              type:'POST',
              url : "{{ route('update-book') }}",
               data: formData,
               contentType: false,
               processData: false,
               success: (response) => {
                if(response.success){
                  this.reset();
                  $('#editbookmodal').modal('toggle');
                  refreshRecords();
                }
                if(response.error){
                  // alert(data.error);
                }
               },
               error: function(response){
                $('#image-input-error').text(response.responseJSON.errors.file);
               }
           });
        });

        $('#SearchBookForm').on('submit',function(e){
           e.preventDefault();
           let formData = new FormData(this);
           

           $.ajax({
              type:'POST',
              url : "{{ route('search-book') }}",
               data: formData,
               contentType: false,
               processData: false,
               success: (response) => {
                if(response.success){
                  console.log(response.data);
                  // this.reset();
                  var ooo = "ooo";

                  $('.searchlist').html('');
                  $.each(response.data, function(key, value) {
                    var radio_with_label = $('<div class="p-2 col-sm-6 cardcol" data-id="'+ value.id +'"><div class="card"  > <div class="card-body"> <img class="card-img-top image-responsive" src="{!! asset('storage/app/public/uploads/book/') !!}/'+ value.image +'" alt="Card image" style="width:100%" /> <h4 class="card-title">'+ value.id +'Name : '+ value.bookname +'</h4> <p class="card-title">Author : '+ value.author_name +'</p> <p class="card-text">Price : '+ value.price +'</p> <button onclick="fetchRecords('+ value.id +')" type="button" class="btn btn-warning btn-sm text-white editbutton" data-toggle="modal" data-target="#editbookmodal" data-id="'+ value.id +'"> <i class="fa fa-edit" aria-hidden="true"></i> </button> <button type="button" class="btn btn-danger btn-sm text-white" onclick="deleteValue('+ value.bookname +');" > <i class="fa fa-trash-o" aria-hidden="true"></i> </button> </div> </div> </div>');
                    console.log(radio_with_label);
                    $('.searchlist').append(radio_with_label); 
                  });
                }
                if(response.error){
                  alert(data.error);
                }
               },
               error: function(response){
                alert("No Record Found");
               }
           });
        });

      });

      $('.editbutton').on('click',function(e){
          var editBtnID = $(this).attr('data-id');
          // alert(editBtnID);
          $('#edit_book_id').val(editBtnID);

          //get edit value to set in fields
          fetchRecords(editBtnID);          
        });

      function refreshRecords(){
        $.ajax({
              url : "{{ route('all-book') }}",
           data: "",
           type : 'GET',
           dataType : 'json',
               success: (response) => {
                if(response.success){
                  console.log(response.data);
                  // this.reset();

                  $('.searchlist').html('');
                  $.each(response.data, function(key, value) {
                    var radio_with_label = $('<div class="p-2 col-sm-6 cardcol" data-id="'+ value.id +'"><div class="card"  > <div class="card-body"> <img class="card-img-top image-responsive" src="{!! asset('storage/app/public/uploads/book/') !!}/'+ value.image +'" alt="Card image" style="width:100%" /> <h4 class="card-title">'+ value.id +'Name : '+ value.bookname +'</h4> <p class="card-title">Author : '+ value.author_name +'</p> <p class="card-text">Price : '+ value.price +'</p> <button onclick="fetchRecords('+ value.id +')" type="button" class="btn btn-warning btn-sm text-white editbutton" data-toggle="modal" data-target="#editbookmodal" data-id="'+ value.id +'"> <i class="fa fa-edit" aria-hidden="true"></i> </button> <button type="button" class="btn btn-danger btn-sm text-white" onclick="deleteValue('+ value.bookname +');" > <i class="fa fa-trash-o" aria-hidden="true"></i> </button> </div> </div> </div>');
                    console.log(radio_with_label);
                    $('.searchlist').append(radio_with_label); 
                  });
                }
                if(response.error){
                  alert(data.error);
                }
               },
               error: function(response){
                alert("No Record Found");
               }
           });
        
      }


      

      function fetchRecords(edit_book_id){
        $.ajax({        
           url : "{{ route('get-book-details') }}",
           data : {'id' : edit_book_id},
           type : 'GET',
           dataType : 'json',
           success : function(result){
            console.log(result);

            $('#edit_book_id').val(result.id);
            $('#edit_author_id').val(result.author_id);
            $('#edit_bookname').val(result.bookname);
            $('#edit_publishername').val(result.publishername);
            $('#edit_price').val(result.price);
            var imagepreview = '<div ><img class="card-img-top image-responsive" src="{!! asset('storage/app/public/uploads/book/') !!}/'+result.image+'" alt="Card image" width="200px" /></div>';
            // var html = "<option value=''>Select State </option>";
            // for (var i = 0; i < result.length; i++) {
            //    html += "<option value='"+result[i].id+"'>"+result[i].name+"</option>";
            // }
            $('#book-image-preview').html(imagepreview);

            }
       });
        
      }


      
      

    function deleteValue(id) {
      var confirmBox = confirm("Are you sure you want to Delete?");
      if(confirmBox == true){
          // var id = "deleteButton_"+ id ;
          // $( "#"+id ).click();
          
          $.ajax({        
            url : "{{ route('delete-book') }}",
            data : {'id' : id,
             "_token": "{{ csrf_token() }}",
           },
            type : 'POST',
            dataType : 'json',
             success:function(data){
                  if(data.success){
                    $('.cardcol[data-id="'+id+'"]').remove();
                  }
                  if(data.error){
                    alert(data.error);
                  }

             }
        });
      }
    }
</script>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  </body>
</html>
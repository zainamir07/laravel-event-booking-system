 <!-- Footer -->
 <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<script>
$(document).ready(function () { 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
          // --------------------------------
          // User CRUD Operatrions Start Here
          // -------------------------------- 
    
       //For User registeration 
       $(document).on('click', '.register-btn', function(e){
            e.preventDefault();
            $.ajax({
        type: "POST",
        url: "{{route('admin_user_register')}}",
        data: $("#form").serialize(),
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
            $('.modalBtn').click();
            $('#save_errList').html("");
            $('#save_errList').addClass("alert alert-danger");
            $.each(response.errors, function(key, arr_values){
             $('#save_errList').append('<li>'+arr_values+'</li>')
            })
          }else{
            $('.modalBtn').hide();
            Swal.fire(
                  'Registered!',
                  'User has been registered successfully.',
                  'success'
                )
            console.log(response);
          }
        }
      });
    });
    
      //For User Details edit 
      $(document).on('click', '.editmodalbtn', function(e){
       var user_id = $(this).data('id');
            $.ajax({
        type: "POST",
        url: "{{route('admin_user_edit')}}",
        data: {'user_id': user_id},
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
            $('#save_errList').html("");
            $('#save_errList').addClass("alert alert-danger");
            $.each(response.errors, function(key, arr_values){
             $('#save_errList').append('<li>'+arr_values+'</li>')
            //  $(this).click();
            })
          }else{
            console.log(response);
           $('#user_id').val(response.user.id);
           $('#editname').val(response.user.name);
           $('#editemail').val(response.user.email);
           $('#editcontact').val(response.user.contact);
           $('#editaddress').val(response.user.address);
          }
        }
      });
    });
    
       //For User details Update 
       $(document).on('click', '.updateBtn', function(e){
           id = $('#user_id').val();
            e.preventDefault();
        $.ajax({
        type: "POST",
        url: "{{url('admin/users/update')}}"+"/"+id,
        data: $("#updateform").serialize(),
        dataType: "json",
        success: function(response){
          if(response.errors){
             console.log(response.errors);
             $('#edit_errList').html("");
             $('#edit_errList').addClass("alert alert-danger");
             $.each(response.errors, function(key, arr_errors){
                $('#edit_errList').append('<li>'+arr_errors+'</li>')
             })
             $('.editmodalbtn').click();
          }else{
            $('#editModal').modal('hide');
            Swal.fire(
                  'Updated!',
                  'User has been updated successfully.',
                  'success'
                )
            console.log(response);
          }
        }
      });
    });
    
    //  Chnage User Status 
    $('.user_status').on('change', function(){
       var status = $(this).prop('checked') == true ? 1 : 0;
       var user_id = $(this).data('id');
       $.ajax({
              type: 'POST',
              url: "{{route('status_check')}}",
              data: {'status':status, 'user_id': user_id},
              success: function(response){
                if(response.errors){
                   $('#save_errList').html("");
                   $('#save_errList').addClass("alert alert-danger");
                   $.each(response.errors, function(key, arr_values){
                   $('#save_errList').append('<li>'+arr_values+'</li>')
            })
                }
                Swal.fire(
                  'Updated!',
                  'User status has been updated.',
                  'success'
                )}
    });
    });
    
          // --------------------------------
          // User CRUD Operatrions End 
          // -------------------------------- 
  
          // --------------------------------
          // UEvent Type CRUD Operatrions End 
          // -------------------------------- 
                 //For Event Type Addition 
       $(document).on('click', '.eventTypeName-btn', function(e){
            e.preventDefault();
            $.ajax({
        type: "POST",
        url: "{{route('eventTypes_register')}}",
        data: $("#eventTypeForm").serialize(),
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
            // $('.eventTypeAddModal').click();
            $('#save_errList').html("");
            $('#save_errList').addClass("alert alert-danger");
            $.each(response.errors, function(key, arr_values){
             $('#save_errList').append('<li>'+arr_values+'</li>')
            })
          }else{
            // $('.modalBtn').hide();
            Swal.fire(
                  'Added!',
                  'Event Type has been added successfully.',
                  'success'
                )
            console.log(response);
          }
        }
      });
    });
    
      //For Event Type Details edit 
      $(document).on('click', '.editeventTypeModalbtn', function(e){
       var eventType_id = $(this).data('id');
            $.ajax({
        type: "POST",
        url: "{{route('admin_eventType_edit')}}",
        data: {'eventType_id': eventType_id},
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
            $('#save_errList').html("");
            $('#save_errList').addClass("alert alert-danger");
            $.each(response.errors, function(key, arr_values){
             $('#save_errList').append('<li>'+arr_values+'</li>')
            //  $(this).click();
            })
          }else{
            console.log(response);
           $('#eventType_id').val(response.eventType.event_type_id);
           $('#edit_eventTypeName').val(response.eventType.event_type_name);
          }
        }
      });
    });
    
       //For Event Type details Update 
       $(document).on('click', '.update_eventTypeName', function(e){
           id = $('#eventType_id').val();
            e.preventDefault();
        $.ajax({
        type: "POST",
        url: "{{url('admin/eventType/update')}}"+"/"+id,
        data: $("#updateEventTypeForm").serialize(),
        dataType: "json",
        success: function(response){
          if(response.errors){
             console.log(response.errors);
             $('#edit_errList').html("");
             $('#edit_errList').addClass("alert alert-danger");
             $.each(response.errors, function(key, arr_errors){
                $('#edit_errList').append('<li>'+arr_errors+'</li>')
             })
             $('.update_eventTypeName').click();
          }else{
            Swal.fire(
                  'Updated!',
                  'Event Type has been updated successfully.',
                  'success'
                )
            console.log(response);
          }
        }
      });
    });
    
         // --------------------------------
          // Event Type CRUD Operatrions End 
          // -------------------------------- 

           // --------------------------------
          // Guest Capacity CRUD Operatrions End 
          // -------------------------------- 
                 //For GuestCapacity Addition 
       $(document).on('click', '.guestCapacity-btn', function(e){
            e.preventDefault();
            $.ajax({
        type: "POST",
        url: "{{route('guestCapacity_register')}}",
        data: $("#guestCapacityForm").serialize(),
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
            // $('.eventTypeAddModal').click();
            $('#save_errList').html("");
            $('#save_errList').addClass("alert alert-danger");
            $.each(response.errors, function(key, arr_values){
             $('#save_errList').append('<li>'+arr_values+'</li>')
            })
          }else{
            $('.modalBtn').hide();
            Swal.fire(
                  'Added!',
                  'GuestCapacity has been added successfully.',
                  'success'
                )
            console.log(response);
          }
        }
      });
    });
    
      //For Event Type Details edit 
      $(document).on('click', '.editeventTypeModalbtn', function(e){
       var eventType_id = $(this).data('id');
            $.ajax({
        type: "POST",
        url: "{{route('admin_eventType_edit')}}",
        data: {'eventType_id': eventType_id},
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
            $('#save_errList').html("");
            $('#save_errList').addClass("alert alert-danger");
            $.each(response.errors, function(key, arr_values){
             $('#save_errList').append('<li>'+arr_values+'</li>')
            //  $(this).click();
            })
          }else{
            console.log(response);
           $('#eventType_id').val(response.eventType.event_type_id);
           $('#edit_eventTypeName').val(response.eventType.event_type_name);
          }
        }
      });
    });
    
       //For Event Type details Update 
       $(document).on('click', '.update_eventTypeName', function(e){
           id = $('#eventType_id').val();
            e.preventDefault();
        $.ajax({
        type: "POST",
        url: "{{url('admin/eventType/update')}}"+"/"+id,
        data: $("#updateEventTypeForm").serialize(),
        dataType: "json",
        success: function(response){
          if(response.errors){
             console.log(response.errors);
             $('#edit_errList').html("");
             $('#edit_errList').addClass("alert alert-danger");
             $.each(response.errors, function(key, arr_errors){
                $('#edit_errList').append('<li>'+arr_errors+'</li>')
             })
             $('.editmodalbtn').click();
          }else{
            Swal.fire(
                  'Updated!',
                  'Event Type has been updated successfully.',
                  'success'
                )
            console.log(response);
          }
        }
      });
    });
    
         // --------------------------------
          // Guest Capacity CRUD Operatrions End 
          // -------------------------------- 

         // --------------------------------
          // Event Subscription Change  
          // -------------------------------- 
          $('#eventSubscription').on('change', function(){
            value = $(this).val();
            if(value == 'P'){
              $('.eventTicketPrice').removeAttr('hidden');
            }else if(value == 'F'){
              $('.eventTicketPrice').attr('hidden', '');
            }
            // alert(value);
          })

          // --------------------------------
          // View Ticket details 
          // -------------------------------- 
            $('.ticketModalbtn').on('click', function(){
              var event_id = $(this).data('id');
            $.ajax({
        type: "Get",
        url: "{{url('admin/tickets/viewTicketDetails')}}"+"/"+event_id,
        // data: {'event_id': event_id},
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
            $('#save_errList').html("");
            $('#save_errList').addClass("alert alert-danger");
            $.each(response.errors, function(key, arr_values){
             $('#save_errList').append('<li>'+arr_values+'</li>')
            })
          }else{
            console.log(response);
            $('.ticketImages').html("");
              $.each(response.eventImages, function(key, image){
                // alert(image.event_image_path);
                $('.ticketImages').append('<div class="carousel-item"> <img src="{{url("Backend/event_images")}}/'+image.event_image_path+' " class="img-fluid" alt="slider-listing" ></div>');

                let activeClass = (key == 0) ? "active" : "";
                $('.carousel-item').addClass(activeClass);
             })

           $('#organizerName').html(response.eventName);
           $('#subscription').html(response.eventSubscription);
           $('#ticketPrice').html(response.eventTicketPrice);
           $('#totalTickets').html(response.totalTickets);
           $('#remainingTickets').html(response.remainingTickets);
           $('#eventLocation').html(response.eventLocation);
           $('#address').html(response.eventAddress);
           $('#startDate').html(response.eventStartDate);
           $('#endDate').html(response.eventEndDate);
          }
        }
      });
    });


           // Sweet Alert JQuery 
        $('.deleteBtn').on('click', function (event) {
          event.preventDefault();
      const url = $(this).attr('href');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {  
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
          )
          setTimeout(function() { 
            window.location.href = url;
          }, 500);
        }
      })
    });


      //----------------------
    //Delete Listing Images Start 
    //----------------------
    $(document).on('click', '.deleteImageBtn', function(e){
    var image_id = $(this).data('id');
           e.preventDefault();
           Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) { 
        $.ajax({
      type: "GET",
      url: "{{url('admin/edit_event/image')}}"+"/"+image_id,
      dataType: "json",
      success: function(response){
      if(response.errors){
        console.log(response.errors);
        $('#edit_errList').html("");
        $('#edit_errList').addClass("alert alert-danger");
        $.each(response.errors, function(key, arr_errors){
          $('#edit_errList').append('<li>'+arr_errors+'</li>')
    })
        }
      }
    })
    $(this).parents('.image-container').hide();
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
          )
        }
    })
  });
  

});  //Document Ready Function End
</script>    
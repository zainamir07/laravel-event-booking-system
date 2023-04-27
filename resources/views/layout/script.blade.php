

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('Frontend/lib/wow/wow.min.js')}}"></script>
    <script src="{{url('Frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{url('Frontend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{url('Frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script>
    <script src="{{url('Backend/js/jquery.imagesloader-1.0.1.js')}}"></script>
  
    <!-- Template Javascript -->
    <script src="{{url('Frontend/js/main.js')}}"></script>


    <script>
        $(document).ready(function () {
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    //For User registeration 
  $(document).on('click', '.register-btn', function(e){
        e.preventDefault();
        $.ajax({
    type: "POST",
    url: "{{route('register_check')}}",
    data: $("#registerform").serialize(),
    dataType: "json",
    success: function(response){
      if(response.errors){
        console.log(response.errors);
        $('#register_errList').html("");
        $('#register_errList').addClass("alert alert-danger");
        $.each(response.errors, function(key, arr_values){
          $('#register_errList').append('<li>'+arr_values+'</li>')
        })
      }else{
        Swal.fire( 
              'Registered!',
              'You have been register successfully.',
              'success'
            )
        console.log(response);
        setInterval(() => {
          window.location.href = "{{route('login')}}";
        }, 1000);
      }
    }
  });
});



    //For organization registeration 
    $(document).on('click', '.org-register-btn', function(e){
      e.preventDefault();
      // formData = $("#orgRegisterform").serialize(),
        $.ajax({
    type: "POST",
    url: "{{route('org_register_check')}}",
    // data: ['formData':formData]
    data: $("#orgRegisterform").serialize(),
    dataType: "json",
    success: function(response){
      if(response.errors){
        console.log(response.errors);
        $('#register_errList').html("");
        $('#register_errList').addClass("alert alert-danger");
        $.each(response.errors, function(key, arr_values){
          $('#register_errList').append('<li>'+arr_values+'</li>')
        })
      }else{
        Swal.fire( 
              'Registered!',
              'Your Organization have been register successfully.',
              'success'
            )
        console.log(response);
        setInterval(() => {
          window.location.href = "{{route('login')}}";
        }, 1000);
      }
    }
  });
});


    //For User Login 
    $(document).on('click', '.login-btn', function(e){
        e.preventDefault();
        $.ajax({
    type: "POST",
    url: "{{route('login_check')}}",
    data: $("#loginform").serialize(),
    dataType: "json",
    success: function(response){
      if(response.errors){
        console.log(response.errors);
        $('#login_errList').html("");
        $('#login_errList').addClass("alert alert-danger");
        $.each(response.errors, function(key, arr_values){
         $('#login_errList').append('<li>'+arr_values+'</li>')
        }); 
        return false;
      }
      if(response == 0){
        $('#login_errList').html("");
        $('#login_errList').addClass("alert alert-danger");
         $('#login_errList').append('<li>Email is incorrect</li>');
        return false;
        } 
        if(response == 1){
        $('#login_errList').html("");
        $('#login_errList').addClass("alert alert-danger");
         $('#login_errList').append('<li>Password are incorect</li>');
        return false;
        }  
      else{ Swal.fire(
              'Logged in!',
              'You have been logged in successfully.',
              'success'
            )
        $('#loginModal').modal('hide');
        console.log(response)
        setTimeout(() => {
          window.location.href = "{{url('/')}}";
        }, 1000);
      }
    }
  });
});

    
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
          });

             // --------------------------------
          // View Ticket details in Admin Panel 
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

       // --------------------------------
          // View Ticket details in Organizer Panel 
          // -------------------------------- 
          $('.orgticketModalbtn').on('click', function(){
              var event_id = $(this).data('id');
            $.ajax({
        type: "Get",
        url: "{{url('tickets/viewTicketDetails')}}"+"/"+event_id,
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

     //  Follow Btn On Org Profile
     $( document ).on('change', '.follow-btn',  function(){
       var org_id = $(this).data('id');
       var status = $(this).prop('checked') == true ? 1 : 0;
       if(status == 1 ){
        $('.follow-btn-label').html('Un Follow ');
        let count = $("#total-followers").html();
        count ++;
        $("#total-followers").text(count);
       }else if(status == 0){
        $('.follow-btn-label').html('Follow ');
        let count = $("#total-followers").html();
        count --;
        $("#total-followers").text(count);
       }
       $.ajax({
        type: 'POST',
              url: "{{url('profile/follow')}}"+"/"+org_id,
              data: {'status':status, 'org_id': org_id},
              success: function(response){
                if(response.errors){
                   $('#save_errList').html("");
                   $('#save_errList').addClass("alert alert-danger");
                   $.each(response.errors, function(key, arr_values){
                   $('#save_errList').append('<li>'+arr_values+'</li>')
            })
                }
               console.log(response); 
               return false;
              }
    });
    });



     // Un Follow Btn on User Followings 
     $( document ).on('click', '.unfollow-org-btn',  function(){
       var org_id = $(this).data('id');
      $(this).removeClass('btn btn-sm btn-outline-primary unfollow-org-btn');
       $(this).html('<span class="text-danger">Removed <i class="fa fa-check"></i></span>');

       $.ajax({
        type: "POST",
        url: "{{route('user_following_remove')}}",
        data: {'org_id': org_id},
        dataType: "json",
        success: function(response){
            console.log(response);
        }
      });

    });

    $(document).on('click', '.share_event_review', function(){
       let event_id = $(this).data('id');
      $('#event_id_for_review').val(event_id);
    });


    //For User Following Check
    $(document).on('click', '.my_following_organizers', function(e){
      var user_id = $(this).data('id');
            $.ajax({
        type: "POST",
        url: "{{route('user_following_check')}}",
        data: {'user_id': user_id},
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
           
          }else{
            $('#following_list').html('');    
            $.each(response.users, function(key, arr_values){
            $('#following_list').append(
              '<div class="bg-light p-2 m-3 border rounded d-flex justify-content-between align-items-center following-list"><h5>'+arr_values.org_name+'</h5><p class="btn btn-sm btn-outline-primary unfollow-org-btn" data-id='+arr_values.id+'>Un Follow <i class="fa fa-user-minus"></i></p></div>');
            })
            
          
          }
        }
      });
    });

    $(document).on('click', '.remove-follower', function(){
      var user_id = $(this).data('id');
      $(this).hide();
      $(this).parents('.removed-user').append('<span class="text-danger">Removed <i class="fa fa-check"></i></span>')
      $.ajax({
        type: "POST",
        url: "{{route('org_remove_follower')}}",
        data: {'user_id': user_id},
        dataType: "json",
        success: function(response){
          if(response.errors){
            console.log(response.errors);
            
          }else{
            console.log(response) 
          }
        }
      });
    })

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
      url: "{{url('edit_event/image')}}"+"/"+image_id,
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




    $(document).on('click', '.message_send_btn', function(){
      let message = $('#message').val();
      let reciever = $('#reciever_id').val();
      let sender = $('#sender_id').val();
      $.ajax({
        type: "POST",
        url: "{{route('send_message')}}",
        data: {'message': message, 'reciever': reciever, 'sender': sender},
        success: function(response){
          if(response.errors){
            console.log(response.errors);
          }else{
            console.log(response) 
            $('#message').val('');
            //Fetch Out Messages
            $.ajax({
            type: "POST",
            url: "{{route('fetch_out_message')}}",
            data: {'sender': sender, 'reciever': reciever},
            success: function(response){
              console.log(response);
              console.log(response.chat.message);
              console.log(response.sender);
              $('.chat-list').append(
                '<li class="out out-message"><div class="chat-img"> <img alt="Avtar" src=http://127.0.0.1:8000/'+response.senderImage+'></div> <div class="chat-body"><div class="chat-message send-message"> <h5>'+response.sender+'</h5><p>'+response.chat.message +'</p> </div></div></li>')
            }
        });
        

          }
        }
      });
        
    }); 



});  //Document Ready End Here 
</script>





</body>

</html>
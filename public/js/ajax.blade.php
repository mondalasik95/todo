<script>
    function loadTodo(){
                   //to call ajax in Jquery we have a prebuilt function i.e $.ajax
                   $.ajax({
                'url':`{{url('/todos')}}`,
                'method':'GET',
                'success':function(data,status){
                         //console.log('Status :'+status);
                         //console.log('Data :'+data);
                          if(status == 'success'){
                             //console.log(data);
                             //we will start a timer which will show the loader image to the client.
                             $('#result').html(`
                                      <h4><img src='{{asset('./images/Ajax-loader.gif')}}' height='64px' width='64px'/> 
                                      Please wait ....</h4>
                                   `);
                             setTimeout(function(){
                                var todoData = data;
                              var tableContent =`
                               <table class='table table-hover table-bordered'>
                               <tr>
                               <th>Title:</th>
                               <th>Description:</th>
                               <th>Created:</th>
                               </tr>
                              `;
                              for(let todoObj of todoData){
                                  tableContent+=`
                                      <tr>
                                         <td>${todoObj.title}</td>
                                         <td>${todoObj.description}</td>
                                         <td>${todoObj.created}</td>
                                      </tr>
                                  `;
                              }
                                tableContent+='</table>';
                             $('#result').html(tableContent);     
                             },3000);//1000ms = 1sec // 3 sec 
                              
                            }
                        },
                'error': function(error){
                        console.log(error);
                }
    });
}
    $(document).ready(function(){
        console.log('jQuery loaded');
        $('#btn').click(function(){
               console.log('Button clicked');
                  loadTodo();
              
        }); //document.getElementById

        $("#btnSave").click(function(){
            console.log("btnSave clicked");
            $.ajax({
                'url':`{{url('/todo')}}`,
                'method':'POST',
                'data':{'title':$('#title').val(),'desc':$('#desc').val()},
                'success': function(data,status){
                    if(status=='success'){
                         //alert(data);
                          console.log(data);
                          alert(data.message);
                          $('#addTodoModal').modal('hide');
                          loadTodo();
                        }
                },
                'error':   function(error){
                    console.log(error);
                }
            });
        });

        $('#search1').keyup(function(){
                
            let value = $(this).val();
            if(value.length>=3){
                //min thresold is 3 letters ...
                //search will starts ...
                $.ajax({
                    'url':`{{url('/todo/search')}}`,
                    'method':'POST',
                    'data':{'xyz':value},
                    'success':function(data,status){
                        if(status=='success'){
                              let todoData = data;
                              var tableContent =`
                               <table class='table table-hover table-bordered'>
                               <tr>
                                   <th>Title:</th>
                                   <th>Description:</th>
                                   <th>Created:</th>
                               </tr>
                              `;
                              for(let todoObj of todoData){
                                 tableContent+=`
                                     <tr>
                                        <td>${todoObj.title}</td>
                                        <td>${todoObj.description}</td>
                                        <td>${todoObj.created}</td>
                                     </tr>
                                 `;
                              }

                               tableContent+="</table>";
                               $('#result').html(tableContent);

                        }
                    },
                    'error'  :function(error){}
                });
            
            }
        });

        $('#btnAsc').click(function(){
               var selectedColumn = $('#sortField').val();
               $.ajax({
                'url':`{{url('/todo/sort')}}`,
                'method':'POST',
                'data':{'s1':selectedColumn,'s2':'ASC'},
                'success':function(data,status){
                         console.log(data);
                         let todoData = data;
                              var tableContent =`
                               <table class='table table-hover table-bordered'>
                               <tr>
                                  
                                   <th>Title:</th>
                                   <th>Description:</th>
                                   <th>Created:</th>
                               </tr>
                              `;
                              for(let todoObj of todoData){
                                 tableContent+=`
                                     <tr>
                                        <td>${todoObj.title}</td>
                                        <td>${todoObj.description}</td>
                                        <td>${todoObj.created}</td>
                                     </tr>
                                 `;
                              }

                               tableContent+="</table>";
                               $('#result').html(tableContent);
                },
                'error': function(error){
                      console.log(error);
                }
               });
        });
        $('#btnDesc').click(function(){
            var selectedColumn = $('#sortField').val();
               $.ajax({
                'url':`{{url('/todo/sort')}}`,
                'method':'POST',
                'data':{'s1':selectedColumn,'s2':'DESC'},
                'success':function(data,status){
                         console.log(data);
                         let todoData = data;
                              var tableContent =`
                               <table class='table table-hover table-bordered'>
                               <tr>
                                   <th>Title:</th>
                                   <th>Description:</th>
                                   <th>Created:</th>
                               </tr>
                              `;
                              for(let todoObj of todoData){
                                 tableContent+=`
                                     <tr>
                                        <td>${todoObj.title}</td>
                                        <td>${todoObj.description}</td>
                                        <td>${todoObj.created}</td>
                                     </tr>
                                 `;
                              }

                               tableContent+="</table>";
                               $('#result').html(tableContent);
                },
                'error': function(error){
                      console.log(error);
                }
               });
        });
    });
</script>

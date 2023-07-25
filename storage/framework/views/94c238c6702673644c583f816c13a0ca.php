<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <!--Never used Bootstrap jquery  for ajax prpose as it doesnot contains $.ajax()-->
  <!--jquery ajax w3schools ->search this at google -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script>
    function loadTodo() {
      //to call ajax in Jquery we have a prebuilt function i.e $.ajax
      $.ajax({
        url: `<?php echo e(url('/todos')); ?>`,
        method: "GET",
        success: function (data, status) {
          //console.log('Status :'+status);
          //console.log('Data :'+data);
          if (status == "success") {
            //console.log(data);
            //we will start a timer which will show the loader image to the client.
            $("#result").html(`
              <h4><img src='<?php echo e(asset('./images/Ajax-loader.gif')); ?>' height='64px' width='64px'/>Please wait ..</h4>
                              `);
            setTimeout(function () {
              var todoData = data;
              var tableContent = `
                               <table class='table table-hover table-bordered'>
                               <tr>
                               <th>Name</th>
                               <th>Title</th>
                               <th>Description</th>
                               <th>Created</th>
                               </tr>
                              `;
              for (let todoObj of todoData) {
                tableContent += `
                                      <tr>
                                         <td>${todoObj.name}</td>
                                         <td>${todoObj.title}</td>
                                         <td>${todoObj.description}</td>
                                         <td>${todoObj.created}</td>
                                      </tr>
                                  `;
              }
              tableContent += "</table>";
              $("#result").html(tableContent);
            }, 2000); //1000ms = 1sec // 3 sec
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
    $(document).ready(function () {
      console.log("jQuery loaded");


      $("#btn").click(function () {
        console.log("Button clicked");
        $('#filter').show();
        loadTodo();
      }); //document.getElementById

      $("#btnSave").click(function () {
        //console.log("btnSave clicked");
        $('#filter').show();
        $.ajax({
          url: `<?php echo e(url('/todo')); ?>`,
          method: "POST",
          data: {
            user_id : $("#user_id_val").val(),
            title: $("#title").val(),
            desc: $("#desc").val(),
          },
          success: function (data, status) {
            if (status == "success") {
              //alert(data);
              console.log(data);
              alert(data.message);
              $("#addTodoModal").modal("hide");
              loadTodo();
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      });
      
      $("#btnLoad").click(function () {
        var user_id = $("#user_id_val").val();
        $('#filter').hide();
        //console.log(user_id);
        
        $.ajax({
          url    :`<?php echo e(url('/users/todos')); ?>/${user_id}`,
          method : 'GET',
          data   : {user_id : user_id},
          success: function(data, status){
             if(status=='success'){
              $("#result").html(`
              <h4><img src='<?php echo e(asset('./images/Ajax-loader.gif')); ?>' height='64px' width='64px'/>Please wait ..</h4>`);
            setTimeout(function () {
              var todoData = data;
              var tableContent = `
                              <table class='table table-hover table-bordered text-center'>
                                <tr>
                                  <th>Action</th>
                                  <th>Title</th>
                                  <th>Description</th>
                                  <th>Created</th>
                                </tr>
                              `;
              for (let todoObj of todoData) {
                tableContent += `
                                <tr>
                                  <td>
                                    <a href="#" onclick="deleteTodo(${todoObj.todo_id})"  class='btn btn-sm btn-outline-danger'>Delete</a> |
                                    <a href="#" data-target="#editTodoModal" onclick="editTodo(${todoObj.todo_id})" data-toggle="modal" class='btn btn-sm btn-outline-info'>Edit</a>
                                  </td>
                                  <td>${todoObj.title}</td>
                                  <td>${todoObj.description}</td>
                                  <td>${todoObj.created}</td>
                                </tr>
                              `;
              }
              tableContent += "</table>";
              $("#result").html(tableContent);
            }, 2000); //1000ms = 1sec // 3 sec
          }
        },
          error  : function(error){
            console.log(error);
          }
        })
      
      });
    
      $("#search1").keyup(function () {
        let value = $(this).val();
        if (value.length >= 3) {
          //min thresold is 3 letters ...
          //search will starts ...
          $.ajax({
            url: `<?php echo e(url('/todo/search')); ?>`,
            method: "POST",
            data: { xyz: value },
            success: function (data, status) {
              if (status == "success") {
                let todoData = data;
                var tableContent = `
                               <table class='table table-hover table-bordered'>
                               <tr>
                                   <th>Name</th>
                                   <th>Title:</th>
                                   <th>Description:</th>
                                   <th>Created:</th>
                               </tr>
                              `;
                for (let todoObj of todoData) {
                  tableContent += `
                                     <tr>
                                        <td>${todoObj.name}</td>
                                        <td>${todoObj.title}</td>
                                        <td>${todoObj.description}</td>
                                        <td>${todoObj.created}</td>
                                     </tr>
                                 `;
                }

                tableContent += "</table>";
                $("#result").html(tableContent);
              }
            },
            error: function (error) { },
          });
        }
      });

      $("#btnAsc").click(function () {
        var selectedColumn = $("#sortField").val();
        $.ajax({
          url: `<?php echo e(url('/todo/sort')); ?>`,
          method: "POST",
          data: { s1: selectedColumn, s2: "ASC" },
          success: function (data, status) {
            console.log(data);
            let todoData = data;
            var tableContent = `
                               <table class='table table-hover table-bordered'>
                               <tr>
                                   <th>Name</th>
                                   <th>Title:</th>
                                   <th>Description:</th>
                                   <th>Created:</th>
                               </tr>
                              `;
            for (let todoObj of todoData) {
              tableContent += `
                                     <tr>
                                        <td>${todoObj.name}</td>
                                        <td>${todoObj.title}</td>
                                        <td>${todoObj.description}</td>
                                        <td>${todoObj.created}</td>
                                     </tr>
                                 `;
            }

            tableContent += "</table>";
            $("#result").html(tableContent);
          },
          error: function (error) {
            console.log(error);
          },
        });
      });
      $("#btnDesc").click(function () {
        var selectedColumn = $("#sortField").val();
        $.ajax({
          url: `<?php echo e(url('/todo/sort')); ?>`,
          method: "POST",
          data: { s1: selectedColumn, s2: "DESC" },
          success: function (data, status) {
            console.log(data);
            let todoData = data;
            var tableContent = `
                               <table class='table table-hover table-bordered'>
                               <tr>
                                   
                                   <th>Name</th>
                                   <th>Title:</th>
                                   <th>Description:</th>
                                   <th>Created:</th>
                               </tr>
                              `;
            for (let todoObj of todoData) {
              tableContent += `
                                     <tr>
                                        <td>${todoObj.name}</td>
                                        <td>${todoObj.title}</td>
                                        <td>${todoObj.description}</td>
                                        <td>${todoObj.created}</td>
                                     </tr>
                                 `;
            }
            tableContent += "</table>";
            $("#result").html(tableContent);
          },
          error: function (error) {
            console.log(error);
          },
        });
      });
      function getCurrentTime() {
        let myDate = new Date();

        let day = myDate.getDate(); //05
        let month = myDate.getMonth() + 1; //jan-->0
        let year = myDate.getFullYear();

        let hr = myDate.getHours();
        let min = myDate.getMinutes();
        let sec = myDate.getSeconds();

        return (
          year + "-" + month + "-" + day + " " + hr + ":" + min + ":" + sec);
      }
      $("#btnEdit").click(function () {
        var dataToUpdate = {
          title: $("#editTitle").val(),
          description: $("#editDesc").val(),
          created: getCurrentTime()
        };

        var todo_id = $("#hid").val();

        $.ajax({
          url: `<?php echo e(url('/todo')); ?>/${todo_id}`,
          method: "PUT",
          data: dataToUpdate,
          success: function (data, status) {
            if (status == "success") {
              console.log(data);
              alert(data.message);
              loadTodo();
              $("#editTodoModal").modal("hide");
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      });
    });

    function editTodo(todo_id) {
      console.log(todo_id);
      $.ajax({
        url: `<?php echo e(url('/todo/edit')); ?>/${todo_id}`,
        method: "GET",
        success: function (data, status) {
          if (status == "success")
          console.log(data);
          //setting up the data into the modal form.
          $("#editTitle").val(data.title);
          $("#editDesc").val(data.description);
          $("#hid").val(data.todo_id);
        },
        error: function (error) {
          console.log(error);
        },
      });
    }

    function deleteTodo(todo_id) {
      console.log(todo_id);
      var r = confirm("Do you want to Delete This Record ?");
      if (r) {
        $.ajax({
          url: `<?php echo e(url('/todo/delete')); ?>/${todo_id}`,
          method: "DELETE",
          success: function (data, status) {
            if (status == "success") {
              alert(data.message);
              loadTodo();
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      }
    }

    function onLogout() {
      $.ajax({
        url: `<?php echo e(url('/users/logout')); ?>`,
        method: "GET",
        success: function (data, status) {
          if (data.message == "success") {
            alert("you have succesfully LoggedOut!!");

            window.location.href = `<?php echo e(url('/users')); ?>`;
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  </script>
</head>

<body>
  <div class="container">
    <header class="modal-header">
      <h4>Displaying all Todos Info</h4>
      <?php if(session()->has('USER')): ?>
      <div class="float-right">
        Welcome <?php echo e(session()->get('USER')); ?> | 
        <a href="#" onclick="onLogout()">Logout</a>
      </div>
      <?php else: ?>
      <script>
        window.location.href = `<?php echo e(url('/users')); ?>`;
      </script>
      <?php endif; ?>
    </header>
    <button id="btnLoad" class="btn btn-outline-warning" >Load Todos of <?php echo e(session()->get('USER')); ?></button> |
    <button id="btn" class="btn btn-outline-primary">Load All Todos</button> |
    <button id="btnAdd" class="btn btn-outline-info" data-target="#addTodoModal" data-toggle="modal">Add Todo</button>

    <!--Placing the seatch option -->
    <div id="filter" class="float-right" style="display: none">
      <input type="text" name="search1" id="search1" placeholder="Search title,description..." class="form-control" />
      <select id="sortField">
        <option>--- Choose a Field ---</option>
        <option>Title</option>
        <option>Description</option>
        <option>Created</option>
      </select>
      <button id="btnAsc" class="btn btn-sm btn-primary">ASC</button>
      <button id="btnDesc" class="btn btn-sm btn-secondary">DESC</button>
    </div>
    <hr />
    <br />
    <div id="result">
      <!--All Todo Information will be fetched from backend api and gets display here
        using ajax mechanism [without reloading the entire Page].-->
    </div>
  </div>
</body>

</html>

<!--Adding Bootstrap-4 Modal-->

<!-- Modal -->
<div class="modal fade" id="addTodoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Todo:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Title:</label>
          <input type="text" name="title" id="title" class="form-control" />
        </div>
        <div class="form-group">
          <label>Description:</label>
          <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <input id="user_id_val" type="hidden" value="<?php echo e(session()->get('USER-ID')); ?>">
          <button type="button" id="btnSave" class="btn btn-sm btn-outline-success">Add</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- editModal -->
<div class="modal fade" id="editTodoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Todo:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Title</label>
          <input type="text" name="title" id="editTitle" class="form-control" />
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="desc" id="editDesc" cols="30" rows="10" class="form-control"></textarea>
          <!--Adding a hidden field -->
          
          <input type="hidden" name="hid" id="hid" value="<?php echo e(session()->get('USER-ID')); ?>"/>
        </div>
        <div class="form-group">
          <button type="button" id="btnEdit" class="btn btn-sm btn-outline-success">Update</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><?php /**PATH C:\xampp\htdocs\laravel\myApp\resources\views/ajax/index.blade.php ENDPATH**/ ?>
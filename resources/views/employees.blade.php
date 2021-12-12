<!DOCTYPE html>
<htmL>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
        </style>

        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Job</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        @foreach ($employees as $emp)
        <tr>
            <td id="firstName_{{$emp['id']}}">{{ $emp['firstName'] }}</td>
            <td id="lastName_{{$emp['id']}}">{{ $emp['lastName'] }}</td>
            <td id="email_{{$emp['id']}}">{{ $emp['email'] }}</td>
            <td id="address_{{$emp['id']}}">{{ $emp['address'] }}</td>
            <td id="job_{{$emp['id']}}">{{ $emp['job'] }}</td>
            <td>
                <button id="delete_{{$emp['id']}}" class="delete">Delete </button> 
            </td>
            <td>
                <button id="update_{{$emp['id']}}" class="update">Update </button> 
            </td>
        </tr>
        @endforeach
        </table>
        <br>
        <div style="border-style: solid;border-width: 5px;display:inline-block;">
            <p> Add new employee </p>
            <label for="firstName">First name:</label><br>
            <input type="text" id="firstName" name="firstName"><br>
            <label for="lastName">Last name:</label><br>
            <input type="text" id="lastName" name="lastName"><br><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email"><br><br>
            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address"><br><br>
            <label for="job">Job Position:</label><br>
            <input type="text" id="job" name="job"><br><br>
            <button id='new-emp'>Add New Employee </button>
        </div>
        
        <div style="border-style: solid;border-width: 5px;display:none;" id="update_box">
            <p id="update-title"></p>
            <input type="text" id="update_emp_id" name="update_emp_id" style="display:none;">
            <label for="update_firstName">First name:</label><br>
            <input type="text" id="update_firstName" name="update_firstName"><br>
            <label for="update_lastName">Last name:</label><br>
            <input type="text" id="update_lastName" name="update_lastName"><br><br>
            <label for="update_email">Email:</label><br>
            <input type="text" id="update_email" name="update_email"><br><br>
            <label for="update_address">Address:</label><br>
            <input type="text" id="update_address" name="update_address"><br><br>
            <label for="update_job">Job Position:</label><br>
            <input type="text" id="update_job" name="update_job"><br><br>
            <button id='update_emp'>Update Employee </button>
        </div>
    </body>
    <script>
         $(".delete").click(function(event){
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let id = this.id.split('_');
            id = id[1];
            $.ajax({
               type:'DELETE',
               url:'/api/posts/' + id,
               data:{
                _token: _token
                },
               success:function(data) {
                  location.reload();
               }
            });
         });

         $("#new-emp").click(function(event){
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let firstname = $("#firstName").val();
            let lastname = $("#lastName").val();
            let address = $("#address").val();
            let email = $("#email").val();
            let job = $("#job").val();
            $.ajax({
               type:'POST',
               url:'/api/posts/',
               data:{
                   firstName: firstname,
                   lastName: lastname,
                   address: address,
                   email: email,
                   job: job,
                   _token: _token
                },
               success:function(data) {
                  location.reload();
               }
            });
         });

         $(".update").click(function(event){
            let id = this.id.split('_'); id = id[1];
            let div = document.getElementById("update_box");
            let firstname = $("#firstName_"+id).html();
            let lastname = $("#lastName_"+id).html();
            let address = $("#address_"+id).html();
            let email = $("#email_"+id).html();
            let job = $("#job_"+id).html();
            
            div.style.display = "inline-block";
            document.getElementById("update-title").innerHTML = "Update " + firstname + " " + lastname + " Employee"; 
            document.getElementById("update_firstName").value = firstname;
            document.getElementById("update_lastName").value = lastname;
            document.getElementById("update_email").value = email;
            document.getElementById("update_job").value = job;
            document.getElementById("update_address").value = address;
            document.getElementById("update_emp_id").value = id;
         });

         $("#update_emp").click(function(event){
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let firstname = $("#update_firstName").val();
            let lastname = $("#update_lastName").val();
            let address = $("#update_address").val();
            let email = $("#update_email").val();
            let job = $("#update_job").val();
            let id = $("#update_emp_id").val();
            
            $.ajax({
               type:'PUT',
               url:'/api/posts/'+id,
               data:{
                   firstName: firstname,
                   lastName: lastname,
                   address: address,
                   email: email,
                   job: job,
                   _token: _token
                },
               success:function(data) {
                  location.reload();
               }
            });
         });
        </script>
</html>
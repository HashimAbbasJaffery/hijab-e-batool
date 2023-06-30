@extends('layout.master')
@section("title", "Profile")
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-11" style="background: white; margin: 10px; border-radius: 10px;">
            &nbsp;
            <h1 class="text-4xl text-bold py-4">Users</h1>
            <div class="box">
                <div class="box-header">
                <div role="alert" class="hidden fixed bottom-4 right-5" id="alertBox">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                  Error
                </div>
                <div id="flash-message"class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                  <p>Error will be shown here</p>
                </div>
              </div>
                <div role="alert" class="hidden fixed bottom-4 right-5" id="alertBoxSuccess">
                <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
                  Error
                </div>
                <div id="flash-message-success"class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
                  <p>Error will be shown here</p>
                </div>
              </div>
              
                </div><!-- /.box-header -->
                <div class="box-body flex space-x-5">
                    <div id="security" class="w-1/2 security-details">
                        <form id="changePassword" name="changePassword" method="POST">
                          <h2 class="text-2xl text-bold mb-3">Security Information</h2>
                          <p class="text-red hidden" id="old_password"></p>
                          <x-input type="password" label="Old Password" name="old_password"/>
                          <p class="text-red hidden" id="password"></p>
                          <x-input type="password" label="New Password" name="password"/>
                          <p class="text-red hidden" id="password_confirmation"></p>
                          <x-input type="password" label="Confirm Password" name="password_confirmation"/>
                          <x-input type="submit" value="Change Password!" name="change_pass_btn"/>
                        </form>
                    </div>
                    <div id="general" class="w-1/2 general-details">
                        <form id="changeDetails" name="changeDetails" method="POST" enctype="multipart/form-data">
                          @method("PATCH")
                          <h2 class="text-2xl text-bold mb-3">General Information</h2>
                          <img class="mb-6 rounded-full avatar" src="{{ getAvatar(60, 60) }}" width="60" />
                          <x-input type="file" id="picture" label="Profile Picture" name="error-picture"/>
                          <p class="text-red" id="error-password"></p>
                          <x-input type="text" id="name" label="Name" name="name" value="{{ $user->name }}"/>
                          <p class="text-red" id="error-name"></p>
                          <x-input type="text" id="email" label="Email" name="email" value="{{ $user->email }}"/>
                          <p class="text-red" id="error-email"></p>
                          <x-input type="submit" value="Change Details!" name="change_details_btn"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push("scripts")
    <script>
      const success = message => {

      }
    </script>
    <script>
      const form = document.getElementById("changePassword");
      form.addEventListener("submit", function(e) {
        e.preventDefault();
        const data = new FormData(form);
        const submitter = {};

        // Making an object to submit to server

        for(item of data) {
          submitter[item[0]] = item[1]
        }

        axios.put("/admin/profile/changePassword", submitter)
        .then(function(data) {
          const alertBoxSuccess = document.getElementById("alertBoxSuccess");
          alertBoxSuccess.classList.add("hidden");
          const alert = document.getElementById("alertBox");
          const fields = ["old_password", "password", "password_confirmation"];
          fields.forEach(field => {
            const element = document.getElementById(field);
            element.textContent = "";
            element.classList.add("hidden");
          })
          if(data.data.errors) {

            // This block of code will execute only if there is some error

            const errors = data.data.errors;

            // Looping through entire error object and displaying

            for(error in errors) {
              console.log(errors[error]);
              if(errors[error]) {
                const element = document.getElementById(error);
                element.classList.remove("hidden");
                element.textContent = errors[error];
              } else {
                elment.textContent = "";
                element.classList.add("hidden");
              }
            }
          } else if(data.data === 1) {

            // This block of code will run only if Password changed successfully

                        const alert = document.getElementById("alertBoxSuccess");
            const alertDanger = document.getElementById("alertBox");
            const message = document.getElementById("flash-message-success");
            alert.classList.remove("hidden");
            alertDanger.classList.add("hidden");
            message.textContent = "Password has been changed succesfully!";

            // Emptying the values of the input 

            const passFields = document.querySelectorAll("#changePassword input[type='password']");

            console.log(passFields);

            passFields.forEach(field => {
              field.value = "";
            })


          } else {
            // If there is no validation error. but application specified error
        
            alert.classList.remove("hidden");
            document.getElementById("flash-message").textContent = data.data;
          }


        })
        .catch(function(err) {
          console.log(err)
        })
      })
    </script>
    <script>
        const flashMessage = status => {
            const alert = document.getElementById("alertBoxSuccess");
            const alertDanger = document.getElementById("alertBox");
            const message = document.getElementById("flash-message-success");

            if(status == "success") {
              alert.classList.remove("hidden");
              alertDanger.classList.add("hidden");
            } else {
              alert.classList.add("hidden");
              alertDanger.classList.remove("hidden");
            }
            
            message.textContent = "Details has been changed succesfully!";
        }
        const changeAvatars = response => {
            // If avatar exists then update in the front
            const avatars = document.querySelectorAll(".avatar");
            const avatarAddress = response.data.new_avatar;
            if(avatarAddress) {
              avatars.forEach(avatar => {
                avatar.src = `/uploads/${avatarAddress}`
              });
            }
        }
        const changeName = () => {
          const names = document.querySelectorAll(".user-name");
          const nameField = document.getElementById("name");
          names.forEach(name => {
            name.textContent = nameField.value;
          })
        }
        const detailForm = document.getElementById("changeDetails");
        detailForm.addEventListener("submit", function(e) {
          e.preventDefault();
          let fileData = new FormData();

          fileData.append("picture", document.getElementById("picture").files[0]);
          fileData.append("name", document.getElementById("name").value);
          fileData.append("email", document.getElementById("email").value);
          
          axios.post("/admin/profile/changeDetails", fileData)
          .then(function(response) {
            const messages = document.querySelectorAll(".text-red");
            messages.forEach(message => {
                console.log(messages);
                message.textContent = "";
            
            });
            if(response.data.status === 1) {
              changeAvatars(response);

              flashMessage("success");

              changeName();
            } else {
              const errors = response.data[1];
              for(error in errors) {
                const message = document.getElementById("error-" + error);
                message.textContent = errors[error];
              }
            }
          })
          .catch(function(err) {
            console.log(err);
          })
        })
    </script>
    <script>
      const setNewRole = id => {
        const options = document.querySelector(`select[data-key='${id}']`);
        axios.post(`/admin/users/${id}`, {
          role: options.value
        })
        .then(function(data) {
          console.log(data);
        })
        .then(function(err) {
          console.log(err)
        })
      }
    </script>
    <script type="text/javascript">
        $(function () {
          $("#example1").dataTable();
          $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
          });
        });
      </script>
      <script>
      </script>
      <script src="/assets/btnInteraction.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="/assets/changeStatus.js"></script>
      <script src="/assets/template.js"></script>
      <script src="/assets/paginationTemplate.js"></script>
      <script src="/assets/axiosRequest.js"></script>
      <script src="/assets/dict.js"></script>
      <script>
        function deleteItem(url) {
          const request = new axiosWrapper(url);
          request.delete(5);
        }
      </script>
      <script>
        const q = document.getElementById("q");
        let timer = null;
        q.addEventListener("keyup", () => {
          clearTimeout(timer);
            timer = setTimeout(() => {
                
          sessionStorage.setItem("keyword", q.value);
          let url;
          if(q.value) {
            url = `/api/products/${q.value}/search`;
          } else {
            url = `/api/products/search`;
          }
          const request = new axiosWrapper(url);
          // getResult(`/api/products/${q.value}/search`);
          request.get();
        }, 250);
        })
        const request = new axiosWrapper("/api/products");
        request.get();
      </script>
      <script>
          const sample = (label) => {
            sessionStorage.setItem("page", label);
            const search = document.getElementById("q").value;
            let url;
            console.log(search);
            if(!search) 
              url = `/api/products/search?page=${label}`;
            else  
              url = `/api/products/${search}/search?page=${label}`;
            

            const request = new axiosWrapper(url);
            request.get();
          }
      </script>
      <script>
        const updateStatus = id => {
          const button = document.getElementById(`button-${id}`);
          const slug = button.getAttribute("data-slug");
          const url = `/admin/products/${slug}/updateStatus`;
          const request = new axiosWrapper(url);
          console.log(request.post(false, 1, changeStatus(button)));
        }
      </script>
    @endpush
@endsection
@extends('layout.master')
@section("title", "Users")
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-11" style="background: white; margin: 10px; border-radius: 10px;">
            <h1 class="text-4xl text-bold py-4">Users</h1>
            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="search">
                    {{-- @php 
                      $pageArray = request()->only('page');
                      $page = $pageArray["page"] ?? null;
                      $query_string = http_build_query($pageArray);
                      $paginated = "";
                      if($page) {
                        $paginated = "&$query_string";
                      }
                    @endphp --}}
                  <form action="#" method="GET" name="filterUser" id="filterUser"> 
                    <input type="text" class="mb-10 outline-0 px-2" name="q" placeholder="Search for products" style="border: 1px solid gray" name="searcg" id="search">
                    <select id="role" name="role" class="mb-10 outline-0 px-2 border: 1px solid gray" style="border: 1px solid black;">
                        <option value="">--- Status ---</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="user">User</option>
                      </select>
                      <input type="submit" class="mb-10 outline-0 px-2" name="search" placeholder="Search for products" style="border: 1px solid gray" name="q" id="q">
                  </form>  
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
                      @foreach($users as $user)
                        <tr>
                          <td><img src="https://placehold.co/40x40.png" class="rounded-full w-auto"></td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>
                            <form names="changeRole" id="changeRole">
                              <select id="userRole" style="border: 1px solid black;" onchange="setNewRole('{{ $user->id }}')" data-key="{{ $user->id }}">
                                <option value="admin" @selected($user->role == "admin")>admin</option>
                                <option value="editor" @selected($user->role == "editor")>Editor</option>
                                <option value="user" @selected($user->role == "user")>User</option>
                              </select>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                   </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                <!-- LINKS -->
                {{ $users->withQueryString()->links() }}
            </div>
    </div>
    @push("scripts")
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
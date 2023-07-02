@extends('layout.master')
@section("title", "Products")
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-11" style="background: white; margin: 10px; border-radius: 10px;">
            <h1>Products</h1>
            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="search">
                    <p>Search</p>
                    <input type="text" class="mb-10 outline-0 px-2" placeholder="Search for products" style="border: 1px solid gray" name="q" id="q">
                      <a href="/admin/category/create" class="create">Create!</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
                      @foreach($categories as $category)
                        {{-- <x-table-column :category="$category"/> --}}
                      @endforeach
                   </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              {{ $categories->links() }}
            </div>
            <button id="btn">Click me!</button>
    </div>
    @push("scripts")
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
      <script src="/assets/dict.js"></script>
      <script src="/assets/btnInteraction.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="/assets/changeStatus.js"></script>
      <script src="/assets/template.js"></script>
      <script src="/assets/paginationTemplate.js"></script>
      <script src="/assets/axiosRequest.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js" integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
      <script>
        function deleteItem(url) {
          let isConfirmed = confirm("Do you really want to delete the category permanently? All products with this category will also be deleted!");
          if(isConfirmed) {
            const request = new axiosWrapper(url);
            request.delete(5);
          }
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
              url = `/api/categories/${q.value}/search`;
            } else {
              url = `/api/categories/search`;
            }
            const request = new axiosWrapper(url);
            request.get(1, true);
          }, 250);          
        })
        const request = new axiosWrapper("/api/categories");
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
          const url = `/admin/category/${slug}/updateStatus`;
          const request = new axiosWrapper(url);
          console.log(request.put(false, 1, changeStatus(button)));
        }
      </script>
    @endpush
@endsection
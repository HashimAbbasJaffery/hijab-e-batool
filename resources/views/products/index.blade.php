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
                    <a href="/admin/products/create" class="create">Create!</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sold</th>
                        <th>Profit/Loss</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
                      @foreach($products as $product)
                        <x-table-column :product="$product"/>
                      @endforeach
                   </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              {{ $products->links() }}
            </div>
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
      <script src="/assets/btnInteraction.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="/assets/changeStatus.js"></script>
      <script src="/assets/template.js"></script>
      <script src="/assets/paginationTemplate.js"></script>
      <script src="/assets/axiosRequest.js"></script>
      <script src="/assets/dict.js"></script>
      <script>
        function deleteItem(url) {
          const isConfirmed = confirm("Do you really want to delete this record permanently?")
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
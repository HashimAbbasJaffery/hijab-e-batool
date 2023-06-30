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
                    <form action="#" method="GET" name="searches" id="search">
                      <p>Search</p>
                      <input type="text" value="{{ $filters['q'] }}" class="mb-10 outline-0 px-2" name="q" placeholder="Search for products" style="border: 1px solid gray" name="searcg" id="search">
                      <select id="status" name="status" class="mb-10 outline-0 px-2 border: 1px solid gray" style="border: 1px solid black;">
                        <option value="">--- Status ---</option>
                        <option value="Delivered" @selected($filters['status'] == "Delivered")>Delivered</option>
                        <option value="Dispatched" @selected($filters['status'] == "Dispatched")>Dispatched</option>
                        <option value="Pending" @selected($filters['status'] == "Pending")>Pending</option>
                        <option value="Cancelled" @selected($filters['status'] == "Cancelled")>Cancelled</option>
                      </select>
                      <input type="text" value="{{ $filters['orderNumber'] }}" class="mb-10 outline-0 px-2" id="orderNumber" name="orderNumber" placeholder="Search for products" style="border: 1px solid gray" name="q" id="q">
                      <input type="submit" class="mb-10 outline-0 px-2" name="search" placeholder="Search for products" style="border: 1px solid gray" name="q" id="q">
                    
                    </form>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Order#</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>View</th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach($orders as $order)
                          <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user->name }}</td>
                            @php
                              $names = []; 
                              foreach($order->products as $product) {
                                array_push($names, $product->name);
                              }
                              $product_name = implode(", ", $names);
                            @endphp
                            <td>
                              {{ substr($product_name, 0, 25) }}
                              {{ (strlen($product_name) > 25) ? "..." : "" }}
                            </td>
                            <td>{{ $order->grand_total }}</td>
                            <td>
                              {{ $order->status }}
                            </td>
                            <td>
                            <a href="/admin/order/{{ $order->order_number }}" class="bg-blue-500 text-white font-bold py-2 px-4 border-b-4 border-blue-700 rounded cursor-pointer">
                              View more!
                            </a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                   </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                <!-- LINKS -->
                {{ $orders->links() }}
            </div>
    </div>
    @push("scripts")
    <script>
      const search = document.getElementById("search").value;
      const status = document.getElementById("status").value;
      const orderNumber = document.getElementById("orderNumber").value;
      const filters = [search, status, orderNumber];
      console.log(filters);
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
@extends('layout.master')
@section("title", "Products")
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-11" style="background: white; margin: 10px; border-radius: 10px;">
            <h1 class="text-4xl text-bold py-5">{{ $order->user->name }}'s Order - {{ $order->status }}</h1>
            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                    <h2 class="text-2xl text-bold mb-10">Products</h1>
                    @foreach($order->products as $product)
                        <div class="products divide-y-2">
                            <div class="product flex py-4">
                                <div class="product-thumbnail">
                                    <img width="150" height="200" src="{{ '/uploads/' . $product->picture }}">
                                </div>
                                <div class="product-information ml-5" style="width: 100%">
                                    <h2 class="product-name text-3xl text-bold">{{ $product->name }}<h2>
                                    <p class="details mt-2">{!! substr($product->description, 0, 50) !!} ... <a href="#" class="underline">See more<a> </p>
                                    <div class="order-information flex ">
                                        <p class="price mt-5 text-bold">{{ $product->price * $product->pivot->quantity }} RS&nbsp;-&nbsp;</p>
                                        <p class="quantiy mt-5 text-bold">{{ $product->pivot->quantity }} Pieces</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <h3 class="text-2xl mt-3 text-bold mb-10">Grand Total - {{ $order->grand_total }} RS</h3>
                    <form method="POST" style="display: inline-block;" action="/admin/order/{{ $order->order_number }}/changeStatus" name="changeStatus" id="changeStatus">
                      {{ method_field("PUT") }}
                      @csrf 
                      <select name="status" style="border: 1px solid black;">
                          <option value="">--- Change Status ---</option>
                          <option value="delivered">Delivered</option>
                          <option value="dispatched">Dispatched</option>
                          <option value="pending">Pending</option>
                          <option value="cancelled">Cancelled</option>
                      </select>
                      <input type="submit" value="Submit" class="bg-blue-500 active:bg-blue-600 text-white py-1 px-3 rounded">
                    </form>
                    <button class="bg-red-500 active:bg-red-600 text-white py-1 px-3 rounded">
                        Delete
                    </button>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                <!-- LINKS -->
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
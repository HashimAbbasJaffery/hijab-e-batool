@extends('layout.master')
@section("title", "Add Product")
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-11" style="background: white; margin: 10px; border-radius: 10px;">
            <h1 class="text-5xl text-bold mb-10">Add Products</h1>
            <form action="{{ route("product.create") }}" method="POST" id="addProduct" enctype="multipart/form-data">
                @csrf   
            <div class="col-lg-6">
                <p id="field-name" class="text-danger mb-2"></p>
                <x-input name="name" id="name" label="Product name"/>
                <p id="field-slug" class="text-danger mb-2"></p>
                <x-input name="slug" id="slug" label="Slug"/>
                <p id="field-price" class="text-danger mb-2"></p>
                <x-input name="price" id="price" label="price"/>
                <p id="field-wholeSalePrice" class="text-danger mb-2"></p>
                <x-input name="wholeSalePrice" id="wholeSalePrice" label="whole sale price"/>
                <p id="field-description" class="text-danger mb-2"></p>
                <label for="description" style="width: 100%;">
                    <p>Description</p>
                    <textarea name="description" id="description" class="inputs border-2 border-black px-2 rounded text-light" style="width: 100%; resize: none; height: 200px"></textarea>
                </label>
                <input type="submit" id="form-submit" class="bg-blue-500 text-white px-4 py-2 rounded mb-10" value="Create!">
            </div>
            <div class="col-lg-6">
                <p id="field-product_img" class="text-danger mb-2"></p>
                <x-input type="file" name="product_img" id="product_img" label="Product name"/>
              
                <p id="field-quantity" class="text-danger mb-2"></p>
                <x-input name="quantity" id="quantity" label="Quantity"/>
                <div id="button" class="flex">
                    <span data-value="1" class="product-status p-2 status bg-green-500 text-white text-center rounded mr-5 cursor-pointer" style="width: 10%;">Active</span>
                    <span data-value="0" class="product-status p-2 status bg-gray-400 text-white text-center rounded cursor-pointer" style="width: 10%;">Deactive</span>
                </div>
                <x-input type="hidden" value="0" id="status" name="status"/>
                <p id="field-category" class="text-danger mb-2"></p>
                <p>Select categories</p>
                <div class="multiple-selection border-2 overflow-auto mb-4" style="height:150px; width: 50%;">
                    @foreach($categories as $category)
                        <label for="{{ $category->id }}" class="p-2 block">
                            <input type="checkbox" name="category" id="{{ $category->id }}" class="category-checkbox">
                            <p style="display: inline;" class="ml-2">{{ $category->name }}</p>
                        </label>
                    @endforeach
                </div>
                <x-input type="text" value="" id="categories" name="categories"/>

            </div>
        </form>
        </div>
    </div>
    @push('scripts')
        <script>
            let myDropzone = new Dropzone("#file");
        </script>
        <script>
            const productName = document.getElementById("name");
            const slugInput = document.getElementById("slug");
            productName.addEventListener("keyup", function() {
                const name = productName.value;
                const slug = name.toLowerCase().replaceAll(" ", "-").replace(/-$/, "");
                slugInput.value = slug;
            })
        </script>
        <script>
            const status = document.getElementById("status");
            const setStatus = () => {
                const active = document.querySelector("[data-value='1']");
                const deactive = document.querySelector("[data-value='0']");
                console.log(active);
                console.log(deactive);
                if(status.value == "1") {
                    active.classList.add("bg-green-500");
                    active.classList.remove("bg-gray-400");

                    deactive.classList.add("bg-gray-400");
                    deactive.classList.remove("bg-green-500");
                } else {
                    deactive.classList.add("bg-green-500");
                    deactive.classList.remove("bg-gray-400");

                    active.classList.add("bg-gray-400");
                    active.classList.remove("bg-green-500");
                }
            }
            setStatus();
            const buttons = document.querySelectorAll(".product-status");
            buttons.forEach(button => {
                button.addEventListener("click", () => {
                    let newStatus = button.getAttribute("data-value");
                    status.value = newStatus;
                    setStatus();
                })
            })
        </script>
        
         <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="/assets/axiosRequest.js"></script>
        <script>
            
            const button = document.getElementById("form-submit");
            button.addEventListener("click", e => {
                e.preventDefault();
                getCategories();
                submitForm();
            })
            const success = () => {
                window.location.href = "/admin/products";
            }
            const getCategories = () => {
                const categoryInput = document.getElementById("categories");
                const categories = [];
                const inputs = document.querySelectorAll(".category-checkbox");
                inputs.forEach(input => {
                    if(input.checked)
                        categories.push(input.id);
                    else 
                        console.log("not checked");
                });
                const json = JSON.stringify(categories);
                console.log(categoryInput);
                categoryInput.value = json;
            }
            const submitForm = () => {
                const url = "/admin/products/create";
                const request = new axiosWrapper(url);
                const messages = document.querySelectorAll(".text-danger");
                const inputs = document.querySelectorAll(".inputs");

                inputs.forEach(input => {
                    input.classList.remove("border-rose-600");
                    input.classList.add("border-slate-300");
                    input.classList.add("border-black");
                })

                messages.forEach(message => {
                    message.textContent = "";
                })
                try {
                    
                    const response = request.post(false, 1, success, document.getElementById("addProduct"));
                } catch(e) {
                    console.log("check internet connection");
                }
            }
        </script>
    @endpush
@endsection
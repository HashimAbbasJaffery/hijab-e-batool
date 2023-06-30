@extends('layout.master')
@section("title", "Upload images")
@section('content')

    <div class="content-wrapper">
        <div class="col-lg-11" style="background: white; margin: 10px; border-radius: 10px;">
            <h1 class="text-5xl text-bold mb-10 mt-10">Upload images</h1>
            <div class="alert-danger rounded mb-5">
                <p class="px-3 py-3 mb-5 text-3xl text-bold hidden" id="message"></p>
            </div>
            <div style="display: flex;" class="mb-10">
            @foreach($images as $image)
                <label for="image-{{ $image->id }}" id="label-image-{{ $image->id }}" style="padding: 11px; box-sizing: border-box;" class="mr-10 flex space-between">
                    <div class="cursor-pointer" onclick="selectImage('{{ $image->id }}')">
                        @php 
                            $filename = $image->filename;
                            $path = "/uploads/" . $filename;
                        @endphp 
                        <img width="250" class="rounded" src="{{ $path }}" alt="{{ $filename }}"/>
                    </div>

                    <input type="radio" class="hidden box" id="image-{{ $image->id }}" >
                </label>
            @endforeach
            </div>
            <form style="margin-bottom: 40px" action="/admin/product/{{ $productId->id }}/imageUpload" method="POST" id="my-great-dropzone" class="dropzone" enctype="multipart/form-data">
                @csrf   
                {{ method_field("POST") }}
            </form>
            
            <input type="submit" id="delete-selected" class="bg-red-500 text-white px-4 py-2 rounded mb-10" value="Deleted selected image!">
            <input type="submit" id="go-back" class="bg-blue-500 text-white px-4 py-2 rounded mb-10" value="Back!">
        </div>
    </div>

    @push('scripts')
        <script>
            const parseId = (id, separator) => {
                const parsed = id.split(separator);
                return parsed[1];
            }
            const deleteSelected = document.getElementById("delete-selected");
            deleteSelected.addEventListener("click", function() {
                const ids = [];
                const selectedImages = document.querySelectorAll(".box[checked]");
                selectedImages.forEach(selectedImage => {
                    const id = selectedImage.getAttribute("id");
                    ids.push(parseId(id, "-"));
                })
                axios.post("/admin/image/delete", { key: ids })
                .then(response => {
                    console.log(response.data);
                    if(response.data === 1) {
                        ids.forEach(id => {
                            const deletedImage = document.getElementById(`label-image-${id}`);
                            deletedImage.style.display = "none";
                        })
                    } 
                })
                .catch(err => {
                    console.log(err);
                });
            })
        </script>
        <script>
            const selectImage = id => {
                const image = document.getElementById("image-" + id);
                const label = document.getElementById("label-image-" + id);

                image.toggleAttribute("checked");
                if(image.hasAttribute("checked")) {
                    label.classList.add("checked-image")
                } else {
                    label.classList.remove("checked-image")
                }
            }
        </script>
        <script>
            Dropzone.options.myGreatDropzone = { // camelized version of the `id`
                maxFilesize: 3, // MB
                maxFiles: 4,
                acceptedFiles: ".jpeg,.jpg,.png",
                accept: function(file, done) {
                    done();
                },
                success: function(file, response) {
                    const message = document.getElementById("message");
                    if(response["error"]) {
                        message.classList.remove("hidden");
                        message.textContent = response["error"]
                    } else {
                        message.classList.add("hidden");
                    }
                    
                }
            };
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
                categoryInput.value = json;
            }
            const submitForm = () => {
                const url = "/admin/products/create";
                const request = new axiosWrapper(url);
                const inputs = document.querySelectorAll("input");
                inputs.forEach(input => {
                    const field = document.getElementById(`field-${input.id}`);
                    // field.innerHTML = "";
                    if(field)
                        field.innerHTML = "";
                    input.classList.remove("border-rose-600");
                    input.classList.add("border-black");
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
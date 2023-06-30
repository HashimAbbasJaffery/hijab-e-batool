const template = (color, size, state = "") => `${state}bg-${color}-${size}`
const buttons = document.querySelectorAll(".status-btn");
const pageButtons = document.querySelectorAll(".page-button")
buttons.forEach(button => {
  button.addEventListener("click", function () {
    const slug = button.getAttribute("data-slug");
    // console.log(slug);
    const request = new axiosWrapper(`/products/${slug}/updateStatus`);
    request.post();
    // sendRequest(slug, button);
    // console.log(response);
  })
})
const getUrl = page => `http://127.0.0.1:8000/api/products?page=${page}`;
pageButtons.forEach(button => {
  button.addEventListener("click", e => {
    e.preventDefault();
    const href = button.getAttribute("href");
    const pageNum = button.innerText;
    const url = getUrl(pageNum);
    const request = new axiosWrapper(url);
    request.get();
  })
})
const changeStatus = (button) => {
  const value = button.innerText;
  if (value == "Deactived") {
    button.classList.remove("bg-red-500");
    button.classList.add("bg-green-500")
    button.classList.remove("hover:bg-red-400");
    button.classList.add("hover:bg-green-400");
    button.classList.remove("border-red-700");
    button.classList.add("border-green-700");
    button.classList.remove("hover:border-red-500");
    button.classList.add("hover:border-green-500");
    button.innerText = "Actived";
  } else {
    button.classList.add("bg-red-500");
    button.classList.remove("bg-green-500")
    button.classList.add("hover:bg-red-400");
    button.classList.remove("hover:bg-green-400");
    button.classList.add("border-red-700");
    button.classList.remove("border-green-700");
    button.classList.add("hover:border-red-500");
    button.classList.remove("hover:border-green-500");
    button.innerText = "Deactived";
  }
}
const sendRequest = (slug, button) => {
  axios.post(`/admin/products/${slug}/updateStatus`)
    .then(function (response) {
      console.log(response);
      changeStatus(response.data, button);
    }).catch(function (err) {
      console.log(err);
    })
}
// const getResult = (url, currentPage = 1) => {
//     axios.get(url)
//     .then(response => {
//       let content = "";
//       const res = response;
//       const linkElements = document.getElementById("links");
//       linkElements.innerHTML = renderPages(response.data, currentPage)
//       const table = document.getElementById("table-body");
//       const data = response.data.data;
//       data.forEach(datum => {
//         content += HTMLtemplate(datum);
//       })
//       table.innerHTML = content;
//     })
//     .catch(err => {
//       console.log(err);
//     })
//   }
  // const axios = new axios(url);
  //axios.delete()'
class axiosWrapper {
  constructor(url) {
    this.url = url;
    this.flag = false;
  }
  #createUrl(string) {
    let url = "";
    for(const key in string) {
      if(string[key]) {
        url += (!this.flag) ? `?${key}=${string[key]}` : `&${key}=${string[key]}`;
      }
      this.flag = true;
    }
    return url;
  }
  #appendData(isProduct = true) {
    const userURL = new URL(window.location.href);
    const path = userURL.pathname.split("/");
    const userSubject = path[2];
    let currentPage = sessionStorage.getItem("page");
    let keyword = sessionStorage.getItem("keyword");
    if(!currentPage) {
      currentPage = 1;
    }
    if(!keyword) { 
      keyword = " ";
    }
    const url = this.#createUrl({ q: keyword, page: currentPage });
    console.log(`/api/${userSubject}/${url}`);
    fetch(`/api/${userSubject}/${url}`)
      .then(response => {
        response.json().then(data => {
          const records = data.data;
          const links = data;
          let content = "";
          const linkElements = document.getElementById("links");
          linkElements.innerHTML = renderPages(links, currentPage);
          const table = document.getElementById("table-body");
          records.forEach(record => {
            content += HTMLtemplate(record, isProduct);
          })
          table.innerHTML = content;
        });
      });
  }
  get(currentPage = 1, isRender = true, callback = null) {
    axios.get(this.url)
    .then(response => {
      if(isRender) {
        this.#appendData(response, currentPage);
      }
      if(callback)
        callback();
    })
    .catch(err => {
      console.log(err);
    })
  }
  delete(currentPage = 1, callback = null) {
    axios.delete(this.url)
    .then(response => {
      this.#appendData(response, currentPage);
      if(callback)
        callback();
    })
    .catch(err => {
      console.log(err);
    })
  }
  #response(response) {
    this.data = response;
  }
  async postSync(render = true, current_page = 1, callback = null, form = null) {
    const res = await axios.post(this.url, form);
  }
  post(render = true, current_page = 1, callback = null, form = null) {
    // const values = {};
    // if(form) {
    //   for(let key of form) {
    //     values[key.name] = key.value;
    //   }
    // }
    let values = null;
    if(form) {
      values = new FormData(form);
    }
    axios.post(this.url, values)
    .then(response => {
      console.log({response});
      if(render)
        this.#appendData(response, current_page);
      if(response.data == 1)
        callback();
      console.log(response.data);
      try {
        const errors = response.data;
  
        for(const err in errors) {
          const element = err;
          const id = `field-${element}`;
          const el = document.getElementById(id);
          const field = document.getElementById(err);
          console.log(field);
          const relatedError = errors[err][0];
          el.innerText = relatedError;
          field.classList.remove("border-black");
          field.classList.add("border-rose-600");
        }
      } catch(e) {

      }
      console.log(response.data);
      localStorage.setItem("response", JSON.stringify(response));
    })
    .catch(err => {
      console.log(err);
    })
  }
  put(render = true, current_page = 1, callback = null, form = null) {

    // const values = new FormData(form);
    let values = null;
    if(form) {
      values = new FormData(form);
    }
    axios.put(this.url, values)
    .then(response => {
      if(render)
        this.#appendData(response, current_page);
      if(response.data == 1 && callback)
        callback();
      try {
        const errors = response.data;
  
        for(const err in errors) {
          const element = err;
          const id = `field-${element}`;
          const el = document.getElementById(id);
          const field = document.getElementById(err);
          console.log(field);
          const relatedError = errors[err][0];
          el.innerText = relatedError;
          field.classList.remove("border-black");
          field.classList.add("border-rose-600");
        }
      } catch(e) {

      }
      console.log(response.data);
      localStorage.setItem("response", JSON.stringify(response));
    })
    .catch(err => {
      console.log(err);
    })
  } 
  patch(render = true, current_page = 1, callback = null, form = null) {
    let values = null;
    if(values) {
      values = new FormData(form);
    }
    // const values = new FormData(form);
    axios.patch(this.url, values)
    .then(response => {
      if(render)
        this.#appendData(response, current_page);
      if(response.data == 1 && callback)
        callback();
      try {
        const errors = response.data;
  
        for(const err in errors) {
          const element = err;
          const id = `field-${element}`;
          const el = document.getElementById(id);
          const field = document.getElementById(err);
          console.log(field);
          const relatedError = errors[err][0];
          el.innerText = relatedError;
          field.classList.remove("border-black");
          field.classList.add("border-rose-600");
        }
      } catch(e) {

      }
      console.log(response.data);
      localStorage.setItem("response", JSON.stringify(response));
    })
    .catch(err => {
      console.log(err);
    })
  } 
}
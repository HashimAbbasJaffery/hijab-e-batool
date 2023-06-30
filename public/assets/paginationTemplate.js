const createLink = (link, current_page, url, label) => {
    console.log({current_page})
    const req = new axiosWrapper(url);
    let page = "";
    if(link.current_page == label) {
        return `<span aria-current="page">
                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">${label}</span>
                </span>`
    } else {
        return `<a onclick="sample(${label})" id="link-${label}" style="cursor: pointer;" class="page-button relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="${label}">
                    ${label}
                </a>`
    }
    }
    const renderPages = (links, current_page) => {
        const pageLinks = links.links;
        console.log(links);
        console.log(links.current_page);
        let html = "";
        pageLinks.forEach(function (link, i) {
            if(i == 0 || i == (pageLinks.length - 1)) {
                return;
            }
            // console.log(link);
            html += createLink(links, links.current_page, link.url, link.label);
        });
        return html;
    }
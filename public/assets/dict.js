const dictionary = plural => {
    const dict = {
        "products": "product",
        "categories": "category"
    }
    if(plural in dict) {
        return dict[plural];
    } else {
        return 0;
    }
}
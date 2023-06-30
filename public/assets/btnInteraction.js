function setNoShadow(id, toRemove, secondRemove) {
    const buttonId = `button-${id}`;
    const button = document.getElementById(buttonId);
    button.classList.remove(toRemove);
    button.classList.remove(secondRemove)
    button.style.marginTop = "3px";
}
function setShadow(id, toRemove, secondRemove) {
    const buttonId = `button-${id}`
    const button = document.getElementById(buttonId);
    button.classList.add(toRemove);
    button.classList.add(secondRemove)
    button.style.marginTop = "0px";
}
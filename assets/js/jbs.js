function isPossible(elem) {
    console.log(elem);
    if (elem.dataset.possible === 'true') {
        elem.dataset.possible = "false";
        return true;
    } else {
        elem.parentElement.nextElementSibling.innerHTML = "";
        elem.dataset.possible = "true";
        return false;
    }
}
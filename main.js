// amount controller
function controller(type) {
    const stock = parseInt(document.getElementById('stock').value);
    let n = parseInt(document.getElementById('number').innerHTML);
    if (type == "more") {
        n += 1;
        document.getElementById('number').innerHTML = n;
        document.getElementById('qty').value = n;
        document.getElementById('less').disabled = false;
        if (n == stock) {
            document.getElementById('more').disabled = true;
        }
    } else if (type == "less") {
        n -= 1;
        document.getElementById('number').innerHTML = n;
        document.getElementById('qty').value = n;
        document.getElementById('more').disabled = false;
        if (n == 1) {
            document.getElementById('less').disabled = true;
        }
    }
}

// search clearing
function clearSearch() {
    document.getElementById('search').value = "";
}
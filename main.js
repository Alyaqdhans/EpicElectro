// amount controller
const stock = parseInt(document.getElementById('qty').value);
document.getElementById('qty').value = 1;

function increase() {
    let n = parseInt(document.getElementById('number').innerHTML);

    if (n < stock) {
        n += 1;
        document.getElementById('number').innerHTML = n;
        document.getElementById('qty').value = n;

        document.getElementById('less').disabled = false;
    }

    if (n == stock) {
        document.getElementById('more').disabled = true;
    }
}

function decrease() {
    let n = parseInt(document.getElementById('number').innerHTML);

    if (n > 1) {
        n -= 1;
        document.getElementById('number').innerHTML = n;
        document.getElementById('qty').value = n;
        
        document.getElementById('more').disabled = false;
    }

    if (n == 1) {
        document.getElementById('less').disabled = true;
    }
}
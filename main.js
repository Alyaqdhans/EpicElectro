// amount controller for view & cart
function controller(type, id) {
    const stock = parseInt(document.getElementById('stock'+id).value);
    let n = parseInt(document.getElementById('number'+id).innerHTML);
    if (type == "more") {
        n += 1;
        document.getElementById('number'+id).innerHTML = n;
        document.getElementById('qty'+id).value = n;
        document.getElementById('less'+id).disabled = false;
        if (n == stock) {
            document.getElementById('more'+id).disabled = true;
        }
    } else if (type == "less") {
        n -= 1;
        document.getElementById('number'+id).innerHTML = n;
        document.getElementById('qty'+id).value = n;
        document.getElementById('more'+id).disabled = false;
        if (n == 1) {
            document.getElementById('less'+id).disabled = true;
        }
    }
}

// make entire table row activate checkbox
document.querySelector("table").addEventListener("click", ({ target }) => {
    if (target.nodeName === "INPUT") return;
    const tr = target.closest("tr");
    if (tr.id == "clickable") {
        const checkbox = tr.querySelector("input[type='checkbox']");
        if (!checkbox.disabled) {
            checkbox.checked = !checkbox.checked;
        }
    }
});
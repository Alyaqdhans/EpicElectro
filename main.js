// amount controller for view & cart
function controller(type, id) {
    const stock = parseInt(document.getElementById('stock'+id).value);
    let n = parseInt(document.getElementById('number'+id).innerHTML);
    if (type == "more" && n < stock) {
        n += 1;
        document.getElementById('number'+id).innerHTML = n;
        document.getElementById('qty'+id).value = n;
        document.getElementById('less'+id).disabled = false;
        if (n == stock) {
            document.getElementById('more'+id).disabled = true;
        }
    } else if (type == "less" && n > 1) {
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
let table = document.querySelector("table");
if (table) {
    table.addEventListener("click", ({ target }) => {
        if (target.nodeName === "INPUT" || target.nodeName === "A" || target.nodeName === "SELECT") return;
        const tr = target.closest("tr");
        if (tr.id == "clickable") {
            const checkbox = tr.querySelector("input[type='checkbox']");
            if (!checkbox.disabled) {
                checkbox.checked = !checkbox.checked;
            }
        }
    });
}



// notification show
function notify(text, color) {
    if (window.performance.getEntriesByType("navigation")[0].type == 'navigate') { // check if page isnt reloaded
        if (!text) {text = "Changes Saved Successfully";}
        if (color) {document.getElementById("notify").children[0].style.background = color;}
        document.getElementById("span").innerHTML = text;

        if (!document.getElementById("notify").classList.contains("hide-notify")) { // check if its already shown
            document.getElementById("notify").classList.add("hide-notify");
        }

        setTimeout(() => { // show after 200ms
            document.getElementById("notify").classList.remove("hide-notify");
        }, 200);

        setTimeout(() => { // hide after 5 sec
            document.getElementById("notify").classList.add("hide-notify");
        }, 6000);
    }
}

// notification hide
function notifyHide() {
    document.getElementById("notify").classList.add("hide-notify"); // hide
}



// loading window show
function loading() {
    document.getElementById("sb").disabled = true;
    document.getElementById("loading").classList.remove("hide-loading");
}



// disable button account agreement
function openDisable() {
    setTimeout(() => {
        if (document.getElementById("confirmCheck").checked) {
            document.getElementById("disableBtn").disabled = false;
        } else {
            document.getElementById("disableBtn").disabled = true;
        }
    }, 100);
}
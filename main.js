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
let table = document.querySelector("table");
if (table) {
    table.addEventListener("click", ({ target }) => {
        if (target.nodeName === "INPUT") return;
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
function notify(text) {
    if (window.performance.getEntriesByType("navigation")[0].type == 'navigate') { // check if page isnt reloaded
        if (!text) {text = "Changes Saved Successfully"}
        document.getElementById("span").innerHTML = text;
        setTimeout(() => { // show after 200ms
            document.getElementById("notify").classList.remove("hide-notify");
        }, 200);

        setTimeout(() => { // hide after 5 sec
            document.getElementById("notify").classList.add("hide-notify");
        }, 5000);
    }
}

// notification hide
function notifyHide() {
    document.getElementById("notify").classList.add("hide-notify"); // hide
}



// checkout loading window show
function checkout() {
    document.getElementById("sb").disabled = true;
    setTimeout(() => {
        document.getElementById("loading").classList.remove("hide-loading");
    }, 200);
}



// disable account agreement
function openDisable() {
    setTimeout(() => {
        if (document.getElementById("confirm").checked) {
            document.getElementById("disable").disabled = false;
        } else {
            document.getElementById("disable").disabled = true;
        }
    }, 200);
}



// theme prefrence store
const darkMode = document.getElementById("dark-mode");
const selectMode = document.getElementById("theme");
const systemThemeDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

// retrieve and apply prefrence
const retrieveSelect = function() {
    const selectState = localStorage.getItem("system-theme");
    if (selectState == "true") {
        selectMode.value = "system";
        darkMode.disabled = true;
    } else {
        selectMode.value = "manual";
        darkMode.disabled = false;
    }
}

// retrieve and apply theme
const retrieveTheme = function() {
    const themeState = localStorage.getItem("dark-mode");
    if (themeState == "true") {
        darkMode.checked = true;
    } else {
        darkMode.checked = false;
    }
}

document.onload = retrieveSelect();

if (selectMode.value == "manual") {
    // apply stored theme when page loads
    retrieveTheme();
} else {
    darkMode.checked = systemThemeDark;
}

// system theme changed
window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", event => {
    if (selectMode.value == "system") {
        darkMode.checked = event.matches;
    }
});

// theme select changed
selectMode.addEventListener("change", () => {
    if (selectMode.value == "system") {
        darkMode.disabled = true;
        localStorage.setItem("system-theme", true);
        darkMode.checked = systemThemeDark;
    } else {
        darkMode.disabled = false;
        localStorage.setItem("system-theme", false);
        retrieveTheme();
    }
});

// theme switch changed
darkMode.addEventListener("click", () => {
    localStorage.setItem("dark-mode", darkMode.checked);
});
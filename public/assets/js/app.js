/**** FUNCTIONS *******/
function show(parent, child) { // Show with Toggle visibility
    if(parent !== "") {
        parent.addEventListener('click', () => {
            child.classList.toggle('visible');
        })
    } 
}
function destroySession() { // Supprimer une session active
    sessionStorage.clear();
}

function showBlock(parent, child) { // Show with Style display
    parent.addEventListener('click', () => {
        child.style.display = "block";
    })
}
function hideBlock(parent, child) { // Hide with Styledisplay
    parent.addEventListener('click', () => {
        child.style.display = "none";
    })
}

function showFromRight(parent, child) { // Show & ANimate avec une animation de droite à gauche
    parent.addEventListener('click', () => {
        child.classList.toggle('visible');
        child.classList.remove('invisible');
        child.classList.toggle('slide-left');
    })
}

function close(parent, child) {
    parent.addEventListener('click', () => {
        child.classList.remove('visible');
    })
}
function isEmpty(str) {
    return (!str || str.length === 0 );
}
function addElement (parent, content) { // ElementID => Élément parent, Content => Contenu AJouté
    // crée un nouvel élément div
    var newDiv = document.createElement("p");
    // et lui donne un peu de contenu
    var newContent = document.createTextNode(content);
    // ajoute le nœud texte au nouveau div créé
    newDiv.appendChild(newContent);
  
    // ajoute le nouvel élément créé et son contenu dans le DOM
    var currentDiv = document.getElementById(parent);
    parent.insertBefore(newDiv, currentDiv);
  }

/**** SHOW/HIDDEN ELEMENTS in Header*/
const viewMore = document.querySelector('.viewMore'),
      blockContent = document.querySelector('.block-content'),
      notifIcon = document.querySelector('.notifications'),
      notifBlock = document.querySelector('.notif-block'),
      closeBtn = document.getElementById('notifClose-btn');
    show(viewMore, blockContent);
    showFromRight(notifIcon, notifBlock);
    showFromRight(closeBtn, notifBlock);
/*** End */

/**** Show notifications */
/*
function showNotifications () {
    const xhr = new XMLHttpRequest();


    const value = {
        container : document.getElementById("notif-content"),
        subject : document.getElementById("notif-title"),
        message : document.getElementById("notif-message")
    }

    xhr.open("POST", "/query/ajax.php", true)
    xhr.responseType = "json";
    xhr.send();

    console.log(xhr)
}

// Afficher chaque 10 sécondes
setInterval(() => {
    showNotifications();
}, 10000);

*/


/**** EFFET SUR INPUT RECHERCHE */
document.getElementById("searchInput").onclick = function () {
    document.getElementById("overlay").style.display = "block"
}

document.getElementById("overlay").onclick = function () {
    this.style.display = "none"
}

/**** Menu Principal */
const menuIcon = document.getElementById('menuIcon'),
      menuBlock = document.getElementById('menuPrincipal'),
      menuCloseBtn = document.getElementById('menuClose-btn');

menuIcon.onclick = function() {
    menuBlock.style.visibility = "visible"
    menuBlock.style.opacity = "1"
    menuBlock.style.left = "0"
}

menuCloseBtn.onclick = function() {
    menuBlock.style.visibility = "hidden"
    menuBlock.style.opacity = "0"
    menuBlock.style.left = "-315px"
}
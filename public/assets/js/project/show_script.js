function hide(element) {
    element.style.display = "none";
    element.classList.remove("active");
}

function show(element, other) { // Affiche element et cache other
    element.style.display = "block";
    element.classList.add("active");

    other.forEach((e) => {
        hide(e);
    })
}

function addClass(element, other) { // Affiche element et cache other
    element.classList.add("activeNav")

    other.forEach(e => e.classList.remove("activeNav"));
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

function showFromRight(element) {
    element.style.right = "2%";
    element.style.visibility = "visible";
    element.style.opacity = ".9";
    element.style.position = "fixed";
    element.style.display = "flex";
}

function hideNotif(element) {
    element.style.right = "-90%";
}

/*** Single Project JS */

// Toggle de blocs
const projetBlock = document.getElementById("projet"),
      entrepriseBlock = document.getElementById("entreprise"),
      financeBlock = document.getElementById("finance"),
      commentaireBlock = document.getElementById("commentaire"),

      // ID Nav Style 
      navOne = document.getElementById("navOne"),
      navTwo = document.getElementById("navTwo"),
      navThree = document.getElementById("navThree"),
      navFour = document.getElementById("navFour"),

      // Class Nav Active 
      navActive = document.getElementById("activeNav");

    navOne.addEventListener("click", () => {
        const otherBlock = [entrepriseBlock, financeBlock, commentaireBlock];
        show(projetBlock, otherBlock);

        // Ajouter class active
        const otherNav = [navTwo, navThree, navFour];
        addClass(navOne, otherNav)
    })
    navTwo.addEventListener("click", () => {
        const otherBlock = [projetBlock, financeBlock, commentaireBlock];
        show(entrepriseBlock, otherBlock);

        // Ajouter class active
        const otherNav = [navOne, navThree, navFour];
        addClass(navTwo, otherNav)
    })
    navThree.addEventListener("click", () => {
        const otherBlock = [entrepriseBlock, projetBlock, commentaireBlock];
        show(financeBlock, otherBlock);

        // Ajouter class active
        const otherNav = [navTwo, navOne, navFour];
        addClass(navThree, otherNav)
    })
    navFour.addEventListener("click", () => {
        const otherBlock = [entrepriseBlock, financeBlock, projetBlock];
        show(commentaireBlock, otherBlock);

        // Ajouter class active
        const otherNav = [navTwo, navThree, navOne];
        addClass(navFour, otherNav)
    })

// Action => Investir

const invest = document.getElementById("invest");

invest.addEventListener("submit", (e) => {
    e.preventDefault();

    const value = {
        amount : document.getElementById("investAmount").value,
        minInvest : document.getElementById("minInvest").value, // Montant minimum d'investissement
        data : new FormData(invest)
    }

    const container = {
        amount: document.getElementById("investAmount"),
        amountParent: document.querySelector(".process"),
        notification:document.querySelector(".alert-notification"),
        notifContent: document.getElementById("notifContent")
    }

    if (value.amount < value.minInvest) {
        const error = "Le montant doit être supérieur ou égal à " + value.minInvest + " €";

        container.notifContent.textContent = error; // AJouter l'erreur dans la notification

        showFromRight(container.notification) // Afficher l'erreur

        setTimeout(() => { // Faire disparaître l'erreur après 5 secondes
            hideNotif(container.notification)
        }, 5000)

        console.log(error);
    } else {
        $params = window.location.search;
        window.location.href = "payement.php" + $params; // Rediriger vers la page de payement
    }

    // ENvoyer Montant
    const xhr = new XMLHttpRequest();

    xhr.open("GET", "payement.php", false)
    xhr.send("id=" + value.amount)
}, false)
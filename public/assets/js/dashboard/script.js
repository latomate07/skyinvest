function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}
function previewFile() { // Voir un fichier en direct
    const preview = document.getElementById('preview');
    const file = document.getElementById("file").files[0];
    const reader = new FileReader();
  
    reader.addEventListener("load", function () {
      // convert image file to base64 string
      preview.src = reader.result;
    }, false);
  
    if (file) {
      reader.readAsDataURL(file);
    }
} 

/**** Show and hidden in Dashboard */
const firstStep = document.querySelector('.firstStep'),
      secondStep = document.querySelector('.secondStep'),
      thirdStep = document.querySelector('.thirdStep'),
      fourStep = document.querySelector('.fourStep'),

      /** Class Active */
      activeStepOne = document.querySelector('.stepOne'),
      activeStepTwo = document.querySelector('.stepTwo'),
      activeStepThree = document.querySelector('.stepThree'),
      activeStepFour = document.querySelector('.stepFour'),

      /* Block à afficher */
      stepOne = document.getElementById('step-1'),
      stepTwo = document.getElementById('step-2'),
      stepThree = document.getElementById('step-3'),
      stepFour = document.getElementById('step-4');

      /** Class des TABS [mes données, accès, investir et préférences] */
      const tab = {
        tabOne: document.getElementById('tab-1'),
        tabTwo: document.getElementById('tab-2'),
        tabThree: document.getElementById('tab-3'),
        tabFour: document.getElementById('tab-4')
      }

      /***** CONTENU DE LA NAVIGATION */
      const block = {
        bottomOne: document.getElementById('bottom-1'),
        bottomTwo: document.getElementById('bottom-2'),
        bottomThree: document.getElementById('bottom-3'),
        bottomFour: document.getElementById('bottom-4')
      }

/*** Switch TAB => NAVIGATION */
tab.tabOne.onclick = function () {
    // Ajouter class active à l'élement de navigation
    this.classList.add("active")

    // Supprimer la class active nav pour les autres élements de navigation
    const otherNav = [tab.tabTwo, tab.tabThree, tab.tabFour];
    otherNav.forEach((e) => {
        e.classList.remove("active")
    })

    // Afficher le block correspondant à la navigation
    block.bottomOne.classList.remove("hideBottom")

    // Cacher les autres blocks
    const other = [ block.bottomTwo, block.bottomThree, block.bottomFour];
    other.forEach((e) => {
        e.classList.add("hideBottom")
    })
}

tab.tabTwo.onclick = function () {
    // Ajouter class active à l'élement de navigation
    this.classList.add("active")

    // Supprimer la class active nav pour les autres élements de navigation
    const otherNav = [tab.tabOne, tab.tabThree, tab.tabFour];
    otherNav.forEach((e) => {
        e.classList.remove("active")
    })

    // Afficher le block correspondant à la navigation
    block.bottomTwo.classList.remove("hideBottom")

    // Cacher les autres blocks
    const other = [ block.bottomOne, block.bottomThree, block.bottomFour];
    other.forEach((e) => {
        e.classList.add("hideBottom")
    })
}
tab.tabThree.onclick = function () {
    // Ajouter class active à l'élement de navigation
    this.classList.add("active")

    // Supprimer la class active nav pour les autres élements de navigation
    const otherNav = [tab.tabTwo, tab.tabOne, tab.tabFour];
    otherNav.forEach((e) => {
        e.classList.remove("active")
    })

    // Afficher le block correspondant à la navigation
    block.bottomThree.classList.remove("hideBottom")

    // Cacher les autres blocks
    const other = [ block.bottomTwo, block.bottomOne, block.bottomFour];
    other.forEach((e) => {
        e.classList.add("hideBottom")
    })
}
tab.tabFour.onclick = function () {
    // Ajouter class active à l'élement de navigation
    this.classList.add("active")

    // Supprimer la class active nav pour les autres élements de navigation
    const otherNav = [tab.tabTwo, tab.tabThree, tab.tabOne];
    otherNav.forEach((e) => {
        e.classList.remove("active")
    })

    // Afficher le block correspondant à la navigation
    block.bottomFour.classList.remove("hideBottom")

    // Cacher les autres blocks
    const other = [ block.bottomTwo, block.bottomThree, block.bottomOne];
    other.forEach((e) => {
        e.classList.add("hideBottom")
    })
}





/*** Switch TAB => COMPLÉTER VOS DONNÉES PERSONNELLES */
firstStep.addEventListener('click', () => {
    stepOne.style.display = "block";

    /* Hidden Others block */
    stepFour.style.display = "none";
    stepTwo.style.display = "none";
    stepThree.style.display = "none";
})
secondStep.addEventListener('click', () => {
    stepTwo.style.display = "block";
    
    /* Hidden Others block */
    stepFour.style.display = "none";
    stepOne.style.display = "none";
    stepThree.style.display = "none";
})
thirdStep.addEventListener('click', () => {
    stepThree.style.display = "block";

    /* Hidden Others block */
    stepFour.style.display = "none";
    stepTwo.style.display = "none";
    stepOne.style.display = "none";
})
fourStep.addEventListener('click', () => {
    stepFour.style.display = "block";

    /* Hidden Others block */
    stepOne.style.display = "none";
    stepTwo.style.display = "none";
    stepThree.style.display = "none";
})

/*** End */

/*******  Changement de photo de profil ******/
const overlay = document.querySelector(".addImgOverlay"),
      addImgContainer = document.querySelector(".addImgContainer"),
      preview = document.getElementById("preview");

document.getElementById("addImg").addEventListener("click", function() {
    addImgContainer.style.top = "100px"
    addImgContainer.style.visibility = "visible"
    addImgContainer.style.opacity = "1"
    overlay.style.display = "block"
})

overlay.onclick = function () {
    this.style.display = "none"
    addImgContainer.style.top = "800px"
    addImgContainer.style.visibility = "hidden"
    addImgContainer.style.opacity = "0"
}

document.getElementById('changeImg').addEventListener('submit', function(e) {
    e.preventDefault();

    const data = new FormData(this),
          xhr = new XMLHttpRequest(),
          image = document.getElementById("file");

    if (image.value != "") {
        const file = new FileReader(),
              extension = image.files[0].type, // Extension du fichier
              size = image.files[0].size, // Poid du fichier
              name = image.files[0].name, // Nom du fichier
              allowedExtension = ["image/jpeg", "image/jpg", "image/png", "image/webp"]; // Les extensions autorisées

        if(inArray(extension, allowedExtension)) {
            console.log("Parfait mon gâté !")
            xhr.open("POST", "/ajax/dashboard", true) // Envoyer le fichier pour le traiter
            xhr.responseType = "json"
            xhr.send(data)   

            // Changer automatiquement src user logo
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200) {
                    $('.userLogo').attr('src', 'assets/client/logos/' + this.response.path_logo)
                }
            }

            console.log(xhr);

            // Fermer le modal 
            addImgContainer.style.top = "800px"
            addImgContainer.style.visibility = "hidden"
            addImgContainer.style.opacity = "0"
            overlay.style.display = "none"
        } else {
            const erreur = "Les extensions devrait être : " + allowedExtension
            console.log(erreur)
        }
    }
}, false)


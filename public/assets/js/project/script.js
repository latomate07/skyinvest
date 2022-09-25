function returnToHome() {
    const redirect = window.location.href = "index.php";
    return redirect;
}

/*** Post Project JS */
const form = document.getElementById("postProject"),

      // Conteneur des formulaires
      firstBlock = document.getElementById("stepOne"),
      secondBlock = document.getElementById("stepTwo"),
      thirdBlock = document.getElementById("stepThree"),
      fourBlock = document.getElementById("stepFour"),

      // Block ÉTAT DU FORMULAIRE
      blockSuccess = document.getElementById("successForm"),

      // Variable des button suivant 
      firstBlockSubmit = document.getElementById("submitFirstStep"),
      secondBlockSubmit = document.getElementById("submitSecondStep"),
      thirdBlockSubmit = document.getElementById("submitThirdStep"),
      fourBlockSubmit = document.getElementById("submitAll"),

      // Variable des button retour
      returnToFirstStep = document.getElementById("returnSecondStep"),
      returnToSecondStep = document.getElementById("returnThirdStep"),
      returnToThirdStep = document.getElementById("returnFourStep"),

      // Class Nav Style 
      navStepOne = document.getElementById("step-1"),
      navStepTwo = document.getElementById("step-2"),
      navStepThree = document.getElementById("step-3"),
      navStepFour = document.getElementById("step-4"),

      // Conteneur de statuts
      error = {
        stepOne: document.getElementById("stepOneError"),
        stepTwo: document.getElementById("stepTwoError"),
        stepThree: document.getElementById("stepThreeError"),
        stepFour: document.getElementById("stepFourError")
      },
      errorTitle = document.getElementById("titleMinLength"),
      descMin = document.getElementById("descMinLength"),
      descMax = document.getElementById("descMaxLength");

      // Block de notification
      const container = {
        notification:document.querySelector(".alert-notification"),
        notifContent: document.getElementById("notifContent")
    }
/* Logique du boutton SUIVANT
 * Condition => Tout les élements doivent avoir une valeur !
*/

firstBlockSubmit.addEventListener('click', () => {
    const value = {
        title: document.getElementById("postName").value,
        categorie: document.getElementById("categorie").value,
        place: document.getElementById("postPlace").value,
        amount: document.getElementById("postAmount").value
    };

    if (value.title !== "" && value.title.length > 20 && value.categorie !== "" && value.place !== "" && value.amount !== "") {
        firstBlock.classList.add("stepInactive");
        secondBlock.classList.remove("stepInactive");

        // Supprimer la classe active à l'étape 1
        navStepOne.classList.remove("stepActive");

        // Ajouter la classe active à l'étape 2
        navStepTwo.classList.add("stepActive");

        // Supprimer les erreurs si elles ont déjà été appelés
        error.stepOne.style.display = "none";
        errorTitle.style.display = "none";

        console.log("Parfait !")
    } else if (value.title.length <= 20) {  // Afficher erreur si nombre de caractère du titre est inférieur à 20   
        errorTitle.style.display = "block";
    } else {
        error.stepOne.style.display = "block";
        errorTitle.style.display = "none"; // Supprimer cette erreur lorsque les autres champs sont vides
        console.log("Veuillez remplir tout les champs !")
    }
});

secondBlockSubmit.addEventListener('click', () => {
    const value = {
        interet: document.getElementById("tauxdeprofit").value,
        vduRoi: document.getElementById("vduRoi").value,
        campaignTime: document.getElementById("campaignTime").value,
        minAmount: document.getElementById("minAmount").value
    };

    if (value.interet !== "" && value.vduRoi !== "" && value.campaignTime !== "" && value.minAmount !== "") {
        secondBlock.classList.add("stepInactive");
        thirdBlock.classList.remove("stepInactive");

        // Supprimer la classe active à l'étape 2
        navStepTwo.classList.remove("stepActive");

        // Ajouter la classe active à l'étape 3
        navStepThree.classList.add("stepActive");

        // Supprimer l'erreur si elle a déjà été appelé
        error.stepTwo.style.display = "none";

        console.log("Parfait !")
    } else {
        error.stepTwo.style.display = "block";
        console.log("Veuillez remplir tout les champs !")
    }
});

thirdBlockSubmit.addEventListener('click', () => {
    const value = {
        descriptionValue: document.getElementById("projectDescription").value ,
        description: document.getElementById("projectDescription")
    };
    
    if (value.descriptionValue !== "" && value.descriptionValue.length > 500) {
        thirdBlock.classList.add("stepInactive");
        fourBlock.classList.remove("stepInactive");

        // Supprimer la classe active à l'étape 3
        navStepThree.classList.remove("stepActive");

        // Ajouter la classe active à l'étape 4
        navStepFour.classList.add("stepLastActive");

        // Supprimer les erreurs si elles ont déjà été appelées
        descMin.style.display = "none";
        descMax.style.display = "none";
        error.stepThree.style.display = "none";

        console.log("Parfait !")
    } else if (value.descriptionValue.length < 500) { // Et si les caracteres de la description inférieurs à 500
        descMin.style.display = "block";
    } else if (value.descriptionValue.length > 3000 ) { // Et si les caracteres de la description sont supérieurs à 3000
        descMax.style.display = "block";
    } else {
        error.stepThree.style.display = "block";
        console.log("Veuillez remplir tout les champs !")
    }
});

fourBlockSubmit.addEventListener('click', () => {
    const value = {
        image: document.getElementById("image").value,
        ytbVideo: document.getElementById("video").value,
    };

     if (value.image !== "") {
        fourBlock.classList.add("stepInactive");

        // Supprimer la classe active à l'étape 4
        navStepFour.classList.remove("stepLastActive");

        // Supprimer erreur si elle a déjà existé
        error.stepFour.style.display = "none";

        console.log("Parfait !")
    } else {
        error.stepFour.style.display = "block";
        console.log("Veuillez remplir tout les champs !")
    }
});


/* Logique du boutton PRÉCÉDENT
*/

returnToFirstStep.addEventListener("click", () => {
    firstBlock.classList.remove("stepInactive");
    secondBlock.classList.add("stepInactive");

    // Supprimer la classe active à l'étape 3
    navStepTwo.classList.remove("stepActive");

    // Ajouter la classe active à l'étape 4
    navStepOne.classList.add("stepActive");
});

returnToSecondStep.addEventListener("click", () => {
    secondBlock.classList.remove("stepInactive");
    thirdBlock.classList.add("stepInactive");

    // Supprimer la classe active à l'étape 3
    navStepThree.classList.remove("stepActive");

    // Ajouter la classe active à l'étape 4
    navStepTwo.classList.add("stepActive");
});

returnToThirdStep.addEventListener("click", () => {
    thirdBlock.classList.remove("stepInactive");
    fourBlock.classList.add("stepInactive");

    // Supprimer la classe active à l'étape 3
    navStepFour.classList.remove("stepLastActive");

    // Ajouter la classe active à l'étape 4
    navStepThree.classList.add("stepActive");
});

/** Send DATA with Ajax */
form.addEventListener("submit", (e) => {
    e.preventDefault();
    const data = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.status === 200) {
            console.log("Le statut est égale à 200")
            blockSuccess.classList.remove("stepInactive"); // Afficher le block SUCCÈS
            
        } else {
            if (document.getElementById("errorForm")) {
                 const  blockError = document.getElementById("errorForm");
                 blockError.classList.remove("stepInactive");
            }
        }
    }

    xhr.open("POST", "/projet/publication", true);
    xhr.responseType = "json";
    xhr.send(data);

    //console.log("youpi")
    console.log(xhr)
}, false)
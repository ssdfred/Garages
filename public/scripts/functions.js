const togglePassword = () => {
    //affiche le mdp en clair
    const passwordInput = document.querySelector("#password")
    passwordInput.type = passwordInput.type === "text" ? "password" : "text"
    // affiche l'oeil fermée ou ouvert
    const eyeIcon = document.querySelector("#eye")
    eyeIcon.classList.contains("d-none") ? eyeIcon.classList.remove("d-none") : eyeIcon.classList.add("d-none")
    const eyeSlashIcon = document.querySelector("#eye-slash")
    eyeSlashIcon.classList.contains("d-none") ? eyeSlashIcon.classList.remove("d-none") : eyeSlashIcon.classList.add("d-none")
}

function updateAvailableSeats() {
    // Envoie une requête AJAX pour interroger le backend sur le nombre de places disponibles
    $.ajax({
      url: '/api/available-seats',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Met à jour la valeur du compteur avec le nombre de places disponibles retourné
        $('#available-seats-counter').text(data.availableSeats);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  }
  
  // Exécute la fonction `updateAvailableSeats` toutes les 5 secondes
  setInterval(updateAvailableSeats, 5000);
  



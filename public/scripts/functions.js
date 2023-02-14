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





document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("bookingModal");
    const closeModal = document.getElementById("closeModal");
    const bookingButtons = document.querySelectorAll(".book-btn");
    const movieIdInput = document.getElementById("movieId");

    // Окончательно скрываем модалку сразу при загрузке
    modal.style.display = "none";
    modal.style.opacity = "0";

    bookingButtons.forEach(button => {
        button.addEventListener("click", function () {
            const movieId = this.getAttribute("data-movie-id");
            movieIdInput.value = movieId;
            modal.style.display = "flex";
            setTimeout(() => (modal.style.opacity = "1"), 10); // Делаем анимацию плавной
        });
    });

    closeModal.addEventListener("click", function () {
        modal.style.opacity = "0";
        setTimeout(() => (modal.style.display = "none"), 300);
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.opacity = "0";
            setTimeout(() => (modal.style.display = "none"), 300);
        }
    });

    // Очистка sessionStorage при уходе со страницы
    window.addEventListener("beforeunload", function () {
        sessionStorage.removeItem("modalOpen");
    });
});

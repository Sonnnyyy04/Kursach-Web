document.addEventListener("DOMContentLoaded", function() {
  const seatAreas = document.querySelectorAll("area[data-seat]");
  const selectedSeats = document.getElementById("selectedSeatsCount");
  const seatInput = document.getElementById("seat_numbers");
  let selected = [];

  seatAreas.forEach(area => {
      area.addEventListener("click", function(event) {
          event.preventDefault();
          const seatNumber = this.dataset.seat;

          if (selected.includes(seatNumber)) {
              selected = selected.filter(s => s !== seatNumber);
              this.classList.remove("selected-seat");
          } else {
              selected.push(seatNumber);
              this.classList.add("selected-seat");
          }

          selectedSeats.textContent = selected.length;
          seatInput.value = selected.join(",");
      });
  });
});

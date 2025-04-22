document.addEventListener("DOMContentLoaded", () => {
  const seatingChart = document.getElementById("seatingChart");
  const seatInput = document.getElementById("seat_numbers");

  const rows = 10;
  const seatsPerRow = 10;

  const occupiedSeats = ["A5", "B6", "D3"];
  const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

  for (let row = 0; row < rows; row++) {
      const rowDiv = document.createElement("div");
      rowDiv.classList.add("row");

      for (let seat = 0; seat < seatsPerRow; seat++) {
          const seatDiv = document.createElement("div");

          if (seat < 2 || seat > 7) {
              seatDiv.classList.add("seat", "empty");
          } else {
              const seatId = `${alphabet[row]}${seat - 1}`;
              seatDiv.classList.add("seat");
              seatDiv.dataset.seat = seatId;
              seatDiv.textContent = seatId;

              if (occupiedSeats.includes(seatId)) {
                  seatDiv.classList.add("occupied");
              } else {
                  seatDiv.addEventListener("click", () => {
                      if (!seatDiv.classList.contains("occupied")) {
                          seatDiv.classList.toggle("selected");

                          const selectedSeats = Array.from(
                              document.querySelectorAll(".seat.selected")
                          ).map(seat => seat.dataset.seat);

                          seatInput.value = selectedSeats.join(",");
                      }
                  });
              }
          }

          rowDiv.appendChild(seatDiv);
      }

      // Добавляем метку с номером ряда
      const rowLabel = document.createElement("span");
      rowLabel.classList.add("row-label");
      rowLabel.textContent = `Ряд ${row}`;
      rowDiv.appendChild(rowLabel);
      seatingChart.appendChild(rowDiv);
  }
});

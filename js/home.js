document.querySelectorAll(".toggle-btn").forEach(button => {
    button.addEventListener("click", () => {
      const shortText = button.previousElementSibling.previousElementSibling;
      const fullText = button.previousElementSibling;

      if (fullText.style.display === "none") {
        shortText.style.display = "none";
        fullText.style.display = "inline";
        button.textContent = "Less";
      } else {
        shortText.style.display = "inline";
        fullText.style.display = "none";
        button.textContent = "More";
      }
    });
  });
  

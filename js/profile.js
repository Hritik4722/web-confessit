let public_btn = document.getElementById('public_b');
let private_btn = document.getElementById('private_b');
let private_div = document.getElementById('private_con');
let Public_div = document.getElementById('Public_con');
public_btn.addEventListener("click",
    () => {
      public_btn.classList.add("clicked_btn");
      private_btn.classList.remove("clicked_btn");
      Public_div.style.display = "flex";
      private_div.style.display = "none";
    });
 private_btn.addEventListener("click",
    () => {
      private_btn.classList.add("clicked_btn");
      public_btn.classList.remove("clicked_btn");
      Public_div.style.display = "none";
      private_div.style.display = "flex";
    });   
    

    
  
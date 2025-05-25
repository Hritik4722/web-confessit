let home = document.getElementById("home");
let pencil = document.getElementById("pencil");
let profile = document.getElementById("profile");
let search_tab = document.getElementById("search_tab");

home.addEventListener("click", () => {
  window.location.href = "home.php";
});
search_tab.addEventListener("click", () => {
  window.location.href = "search.php";
});

pencil.addEventListener("click", () => {
  window.location.href = "confess.php";
});
profile.addEventListener("click", () => {
  window.location.href = "profile.php";
});

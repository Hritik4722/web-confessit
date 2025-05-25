document.querySelectorAll(".read-more-btn").forEach((button) => {
  button.addEventListener("click", () => {
    const comment = button.closest(".comment");
    const shortText = comment.querySelector(".comment-short");
    const fullText = comment.querySelector(".comment-full");

    shortText.style.display = "none";
    fullText.style.display = "inline";
    button.style.display = "none";
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const likeBtn = document.getElementById("like-btn");
  const likeCount = document.getElementById("like-count");

  likeBtn.addEventListener("click", () => {
    const confessionId = new URLSearchParams(window.location.search).get("id");

    fetch("like_toggle.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + confessionId,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.error) return alert(data.error);

        likeBtn.classList.toggle("liked");
        likeBtn.innerHTML = data.liked
          ? '<img src="img/like.svg" alt="like" width="24" height="24">'
          : '<img src="img/unlike.svg" alt="unLike" width="24" height="24">';

        likeCount.textContent = data.likes;
      });
  });
});



function nativeShare() {
  if (navigator.share) {
    navigator.share({
      title: 'Check this confession',
      text: 'Look at this confession I found!',
      url: window.location.href
    }).catch((error) => console.log('Sharing failed:', error));
  } else {
    alert("Sharing not supported on this device. Try copy link instead.");
  }
}


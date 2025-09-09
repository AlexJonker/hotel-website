function scrollToNext(event) {
  event.preventDefault();
  const nextSection =
    document.querySelector(".hero-container").nextElementSibling;
  if (nextSection) {
    nextSection.scrollIntoView({ behavior: "smooth" });
  }
}

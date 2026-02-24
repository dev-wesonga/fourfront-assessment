// ── Hamburger / Drawer ──
const menuBtn = document.getElementById("menuBtn");
const drawer = document.getElementById("drawer");
const overlay = document.getElementById("overlay");

function openDrawer() {
  drawer.classList.add("open");
  overlay.classList.add("active");
  menuBtn.classList.add("open");
}
function closeDrawer() {
  drawer.classList.remove("open");
  overlay.classList.remove("active");
  menuBtn.classList.remove("open");
}
menuBtn.addEventListener("click", () =>
  drawer.classList.contains("open") ? closeDrawer() : openDrawer(),
);
overlay.addEventListener("click", closeDrawer);

// ── Membership Toggle ──
function setupToggle(toggleId, headerId, bodyId) {
  const toggle = document.getElementById(toggleId);
  const header = document.getElementById(headerId);
  const body = document.getElementById(bodyId);

  toggle.addEventListener("click", () => {
    const isOpen = body.classList.contains("show");
    body.classList.toggle("show", !isOpen);
    header.classList.toggle("active", !isOpen);
    toggle.setAttribute("aria-expanded", String(!isOpen));
  });
}
setupToggle("foundationToggle", "foundationHeader", "foundationBody");
setupToggle("economyToggle", "economyHeader", "economyBody");

// ── Form Validation ──
document.getElementById("submitJoin").addEventListener("click", function () {
  const form = document.getElementById("joinForm");
  form.classList.add("was-validated");
  if (!form.checkValidity()) return;

  // Success: close modal & reset
  const modal = bootstrap.Modal.getInstance(
    document.getElementById("joinModal"),
  );
  modal.hide();
  form.reset();
  form.classList.remove("was-validated");
  alert("Application submitted! We will be in touch shortly.");
});

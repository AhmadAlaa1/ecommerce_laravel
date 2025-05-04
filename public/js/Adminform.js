const userData = JSON.parse(localStorage.getItem("user"));

if (!userData || userData.role !== "admin") {
  window.location.href = "/unauthorized.html";
}

function handleLogout(event) {
  event.preventDefault(); 
  localStorage.removeItem('user'); 
  window.location.href = event.target.href;
}
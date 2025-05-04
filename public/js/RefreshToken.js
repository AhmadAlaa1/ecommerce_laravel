
    async function checkAndRefreshToken() {
  const user = JSON.parse(localStorage.getItem("user"));
  if (!user || !user.token) return;

  const token = user.token;
  const payload = JSON.parse(atob(token.split('.')[1]));

  const now = Math.floor(Date.now() / 1000); // Current time in seconds

  if (payload.exp && payload.exp < now) {
    console.log("Token expired, refreshing...");

    try {
      const response = await fetch("/api/refresh", {
        method: "POST",
        headers: {
          "Authorization": "Bearer " + token,
          "Accept": "application/json"
        }
      });

      const data = await response.json();

      if (data.msg) {
        // Replace token in localStorage
        user.token = data.msg;
        localStorage.setItem("user", JSON.stringify(user));
        console.log("Token refreshed successfully");
      } else {
        console.warn("Token refresh failed:", data);
      }
    } catch (err) {
      console.error("Error refreshing token:", err);
    }
  } else {
    console.log("Token is still valid.");
  }
}

window.addEventListener('DOMContentLoaded', checkAndRefreshToken);


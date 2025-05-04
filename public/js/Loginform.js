document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('/api/login', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.token) {
        const token = data.token;
        const payload = JSON.parse(atob(token.split('.')[1]));

        const userInfo = {
          name: payload.name || null,
          email: payload.email || null,
          role: payload.role || null,
          token: token
        };

        localStorage.setItem('user', JSON.stringify(userInfo));
        console.log("User logged in:", userInfo);

        window.location.href = data.redirect_url;
      } else {
        alert(data.message || "Login failed");
      }
    })
    .catch(err => {
      console.error("Login error:", err);
      alert("Something went wrong.");
    });
  });
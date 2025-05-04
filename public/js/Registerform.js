document.getElementById('registerform').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('/api/register', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.token) {
        const token = data.token;
        const payload = JSON.parse(atob(token.split('.')[1]));

        localStorage.setItem('token', token);

        const userInfo = {
          name: payload.name,
          email: payload.email,
          role: payload.role,
          token: token 
        };

        localStorage.setItem('user', JSON.stringify(userInfo));

        window.location.href = data.redirect_url;
      } else {
        alert(data.message || "Register failed");
      }
    })
    .catch(err => {
      console.error("Error decoding token or during registration:", err);
      alert("Something went wrong.");
    });
  });
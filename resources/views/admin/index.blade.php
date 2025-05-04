<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

  <!-- Navbar -->
  <nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
    <a href="{{ route('home.index') }}" 
   class="text-gray-700 hover:text-black"
   onclick="handleLogout(event)">
   Logout
</a>

<script>
  function handleLogout(event) {
    event.preventDefault(); 
    localStorage.removeItem('user'); 

    window.location.href = event.target.href;
  }
</script>

<script>
  const userData = JSON.parse(localStorage.getItem("user"));
  
  if (!userData || userData.role !== "admin") {
    window.location.href = "/unauthorized.html";
  }
  </script>
  
  </nav>

  <!-- Main Container -->
  <div class="p-8 grid md:grid-cols-2 gap-6">

    <!-- Upload Product Section -->
    <div class="bg-white shadow rounded-lg p-6">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Upload New Product</h2>
      <form action={{route('product.upload')}} method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="product_name" placeholder="Product Name" class="w-full p-2 border rounded" required />
        <input type="number" name="price" placeholder="Price" class="w-full p-2 border rounded" required />
        <select id="categorySelect" name="category_id" class="w-full p-2 border rounded" required>
          <option value="" disabled selected>Select Category</option>
        </select>
        <input type="file" name="image" class="w-full p-2 border rounded" required />
        <textarea name="description" rows="3" placeholder="Description" class="w-full p-2 border rounded"></textarea>
        <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Upload</button>
      </form>
    </div>

    <!-- User List Section -->
    <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Registered Users</h2>
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-200 text-sm">
            <th class="p-2">ID</th>
            <th class="p-2">Name</th>
            <th class="p-2">Email</th>
            <th class="p-2">Role</th>
          </tr>
        </thead>
        <tbody id="user-table-body">
        </tbody>
      </table>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const user = JSON.parse(localStorage.getItem("user"));
        const token = user?.token;
    
        fetch("http://127.0.0.1:8000/api/all-users", {
          method: "GET",
          headers: {
            "Authorization": `Bearer ${token}`
          }
        })
        .then(response => {
          if (!response.ok) {
            throw new Error("Failed to fetch users");
          }
          return response.json();
        })
        .then(data => {
          const tbody = document.getElementById("user-table-body");
          tbody.innerHTML = ""; // Clear existing
    
          data.forEach(user => {
            const row = `
              <tr class="hover:bg-gray-100">
                <td class="p-2">${user.id}</td>
                <td class="p-2">${user.name}</td>
                <td class="p-2">${user.email}</td>
                <td class="p-2 capitalize">${user.role}</td>
              </tr>
            `;
            tbody.insertAdjacentHTML("beforeend", row);
          });
        })
        .catch(error => {
          console.error("Error loading users:", error);
        });
      });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const user = JSON.parse(localStorage.getItem("user"));
        const token = user?.token;
    
        fetch("http://127.0.0.1:8000/api/all-categories", {
          headers: {
            "Authorization": `Bearer ${token}`
          }
        })
        .then(res => res.json())
        .then(categories => {
          const select = document.getElementById("categorySelect");
    
          categories.forEach(category => {
            const option = document.createElement("option");
            option.value = category.id;
            option.textContent = category.name;
            select.appendChild(option);
          });
        })
        .catch(err => {
          console.error("Error fetching categories:", err);
        });
      });
    </script>
  </div>
 
</body>
</html>
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
    <a href="#" class="text-gray-700 hover:text-black">Logout</a>
  </nav>

  <!-- Main Container -->
  <div class="p-8 grid md:grid-cols-2 gap-6">

    <!-- Upload Product Section -->
    <div class="bg-white shadow rounded-lg p-6">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Upload New Product</h2>
      <form action="/upload-product" method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="product_name" placeholder="Product Name" class="w-full p-2 border rounded" required />
        <input type="number" name="price" placeholder="Price" class="w-full p-2 border rounded" required />
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
        <tbody>
          <!-- Example rows, replace with dynamic content -->
          <tr class="hover:bg-gray-100">
            <td class="p-2">1</td>
            <td class="p-2">John Doe</td>
            <td class="p-2">john@example.com</td>
            <td class="p-2">User</td>
          </tr>
          <tr class="hover:bg-gray-100">
            <td class="p-2">2</td>
            <td class="p-2">Admin</td>
            <td class="p-2">admin@example.com</td>
            <td class="p-2">Admin</td>
          </tr>
          <!-- Add more dynamically -->
        </tbody>
      </table>
    </div>

  </div>

</body>
</html>

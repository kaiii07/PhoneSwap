<?php
require __DIR__ . '/../../dbcon/dbcon.php';
require __DIR__ . '/../../dbcon/authentication.php';
require __DIR__ . '/../../dbcon/session_get.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Swap Phones</title>
  <link rel="icon" href="../src/assets/images/icon1.svg" type="image/svg">
  <link rel="stylesheet" href="../../src/output.css" />
  <script src="https://kit.fontawesome.com/10d593c5dc.js" crossorigin="anonymous"></script>
  <style>
    .dropdown-menu {
      display: none;
    }

    .dropdown:focus-within .dropdown-menu {
      display: block;
    }
  </style>
</head>

<body>
  <div class="flex">
    <!-- Sidebar -->
    <div class="w-1/5 bg-blue-950 text-white h-screen p-4 fixed">
      <h1 class="text-4xl mb-6 mt-2 font-medium font-russo">PhoneSwap</h1>
      <ul>
        <li class="mb-4">
          <a class="flex items-center hover:bg-opacity-30 hover:bg-white p-2 text-base font-medium rounded-lg"
            href="../dashboard/dashboard.php">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
          </a>
        </li>
        <li class="mb-4">
          <a class="flex items-center hover:bg-opacity-30 hover:bg-white p-2 text-base font-medium rounded-lg"
            href="audittrail.php">
            <i class="fas fa-list-alt mr-3"></i>
            Audit Trail
          </a>
        </li>
        <li class="mb-4">
          <a class="flex items-center bg-opacity-30 bg-white p-2 text-base font-medium rounded-lg"
            href="swapphones.php">
            <i class="fas fa-warehouse mr-3"></i>
            Swap Phones
          </a>
        </li>
        <li class="mb-4">
          <a class="flex items-center hover:bg-opacity-30 hover:bg-white p-2 text-base font-medium rounded-lg"
            href="usermanagement.php">
            <i class="fas fa-tools mr-3"></i>
            User Management
          </a>
        </li>
        <li class="mb-4">
          <a class="flex items-center hover:bg-opacity-30 hover:bg-white p-2 text-base font-medium rounded-lg"
            href="../sidebar_pages/user_audit.php">
            <i class="fas fa-list-alt mr-3"></i>
            User Audit Log
          </a>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="w-4/5 ml-auto">
      <!-- Navbar section -->
      <div class="fixed w-4/5 bg-white z-10 px-6 py-3 flex justify-between items-center shadow-md">
        <!-- Menubar -->
        <div class="flex flex-row items-center gap-4">
          <button class="text-black focus:outline-none">
            <i class="fas fa-bars"></i>
          </button>
          <h2 class="text-xl font-semibold mr-4">Swap Phones</h2>
        </div>


        <div class="flex flex-row items-center gap-4">
          <!-- Notification Bell -->
          <div class="relative inline-block text-left">

          </div>

          <!-- Avatarbar -->
          <div class="relative dropdown">
            <button
              class="flex flex-row items-center gap-3 border border-black shadow-gray-700 shadow-sm bg-amber-400 text-black px-4 w-fit rounded-xl">
              <i class="fa-regular fa-user fa-xl"></i>
              <div class="flex flex-col items-start">
                <h1 class="font-medium"><?= htmlspecialchars($userName) ?></h1>
                <h1 class="text-sm"><?= htmlspecialchars($userRole) ?></h1>
              </div>
              <i class="fa-solid fa-angle-down fa-sm pl-3"></i>
            </button>
            <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 hidden">
              <a href="../accountsetting.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Account
                Settings</a>
              <a href="../../src/logout.php" id="logoutBtn" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                Logout
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="pt-22 py-6 laptop:px-12 phone:px-4">
        <!-- contents -->
        <div class="flex flex-col gap-1 items-end justify-center w-full mx-auto">
          <div class="flex flex-col gap-3 mx-auto py-4 w-full">
            <!-- Filter & Search -->
            <div class="flex laptop:flex-row phone:flex-col gap-2 w-full">
              <div class="flex justify-start">
                <form method="" class="flex flex-row items-center">
                  <select name="filter" id="filterSelect"
                    class="px-4 py-2 h-10 w-48 text-sm border border-gray-700 rounded-l-lg outline-none">
                    <option value="">Select Filter</option>
                    <option value="">Device Model</option>
                    <option value="">Serial Number</option>
                    <option value="">Status</option>
                    <option value="">Team Leader</option>
                    <option value="">Table Number</option>
                  </select>
                  <input type="text" name="" id="" placeholder="Search" value
                    class="w-full h-10 p-2 border border-gray-700 shadow-sm sm:text-sm outline-none rounded-r-lg" />
                </form>
              </div>

              <!-- Export -->
              <div class="flex ml-auto">
                <div class="flex justify-end gap-2">
                  <button id="openModalBtn"
                    class="flex items-center gap-2 font-semibold border border-black  bg-blue-950 hover:bg-blue-950 hover:bg-opacity-95 text-white px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-filter"></i></i><span>Export</span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Swap Phones Table -->
            <div class="w-full overflow-x-auto h-full border border-gray-300 rounded-lg shadow-md">
              <table class="w-full bg-white pl-7">
                <thead>
                  <tr class="bg-gray-200 border-b border-gray-400 text-sm text-left px-4">
                    <th class="py-3 px-4 whitespace-nowrap">Device Model</th>
                    <th class="py-3 px-4 whitespace-nowrap">Serial Number</th>
                    <th class="py-3 px-4 whitespace-nowrap">Status</th>
                    <th class="py-3 px-4 whitespace-nowrap">Team Leader</th>
                    <th class="py-3 px-4 whitespace-nowrap">Table Number</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class=" border-b">
                    <td class="py-5 px-4 whitespace-nowrap">Iphone 8</td>
                    <td class="py-5 px-4 whitespace-nowrap">
                      I8-2024110023
                    </td>
                    <td class="py-2 px-4 whitespace-nowrap">
                      <span
                        class="text-green-800 bg-green-100 border border-green-800 rounded-full bg-opacity-100 py-2 px-6 font-medium shadow-lg">Active</span>
                    </td>

                    <td class="py-5 px-4 whitespace-nowrap">Yul Grant Gatchalian</td>
                    <td class="py-5 px-4 whitespace-nowrap">Table 1</td>
                  </tr>
                  <tr class=" border-b">
                    <td class="py-5 px-4 whitespace-nowrap">Iphone 8</td>
                    <td class="py-5 px-4 whitespace-nowrap">
                      I8-2024110023
                    </td>
                    <td class="py-2 px-4 whitespace-nowrap">
                      <span
                        class="text-green-800 bg-green-100 border border-green-800 rounded-full bg-opacity-100 py-2 px-6 font-medium shadow-lg">Active</span>
                    </td>
                    <td class="py-5 px-4 whitespace-nowrap">Cylie Gonzales</td>
                    <td class="py-5 px-4 whitespace-nowrap">Table 2</td>
                  </tr>
                  <tr class=" border-b">
                    <td class="py-5 px-4 whitespace-nowrap">Iphone 8</td>
                    <td class="py-5 px-4 whitespace-nowrap">
                      I8-2024110023
                    </td>
                    <td class="py-2 px-4 whitespace-nowrap">
                      <span
                        class="text-green-800 bg-green-100 border border-green-800 rounded-full bg-opacity-100 py-2 px-6 font-medium shadow-lg">Active</span>
                    </td>
                    <td class="py-5 px-4 whitespace-nowrap">Kian David</td>
                    <td class="py-5 px-4 whitespace-nowrap">Table 2</td>
                  </tr>
                  <tr class=" border-b">
                    <td class="py-5 px-4 whitespace-nowrap">Iphone 8</td>
                    <td class="py-5 px-4 whitespace-nowrap">
                      I8-2024110023
                    </td>
                    <td class="py-2 px-4 whitespace-nowrap">
                      <span
                        class="text-green-800 bg-green-100 border border-green-800 rounded-full bg-opacity-100 py-2 px-6 font-medium shadow-lg">Active</span>
                    </td>
                    <td class="py-5 px-4 whitespace-nowrap">Miko Basilio</td>
                    <td class="py-5 px-4 whitespace-nowrap">Table 2</td>
                  </tr>
                  <tr class=" border-b">
                    <td class="py-5 px-4 whitespace-nowrap">Iphone 8</td>
                    <td class="py-5 px-4 whitespace-nowrap">
                      I8-2024110023
                    </td>
                    <td class="py-2 px-4 whitespace-nowrap">
                      <span
                        class="text-green-800 bg-green-100 border border-green-800 rounded-full bg-opacity-100 py-2 px-6 font-medium shadow-lg">Active</span>
                    </td>
                    <td class="py-5 px-4 whitespace-nowrap">Daniel Quinzy Digo</td>
                    <td class="py-5 px-4 whitespace-nowrap">Table 1</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Pagination -->
          <div class="flex space-x-2">
            <button class="rounded-lg px-4 py-2 hover:bg-blue-50 hover:font-semibold">
              <i class="fa-solid fa-angle-left"></i>
            </button>
            <button class="rounded-lg px-4 py-2 hover:bg-blue-50 hover:font-semibold">
              1
            </button>
            <button
              class="border border-gray-300 rounded-lg px-4 py-2 hover:bg-yellow-800 bg-yellow-600 text-white font-medium">
              2
            </button>
            <button class="rounded-lg px-4 py-2 hover:bg-blue-50 hover:font-semibold">
              3
            </button>
            <button class="rounded-lg px-4 py-2 hover:bg-blue-50 hover:font-semibold">
              4
            </button>
            <button class="rounded-lg px-4 py-2 hover:bg-blue-50 hover:font-semibold">
              5
            </button>
            <button class="rounded-lg px-4 py-2 hover:bg-blue-50 hover:font-semibold">
              <i class="fa-solid fa-angle-right"></i>
            </button>
          </div>
        </div>
      </div>
</body>

<!-- Script for notification bell dropdown-->
<script>
  const notificationButton = document.getElementById("notificationButton");
  const notificationDropdown = document.getElementById(
    "notificationDropdown"
  );

  notificationButton.addEventListener("click", () => {
    notificationDropdown.classList.toggle("hidden");
  });
</script>

</html>
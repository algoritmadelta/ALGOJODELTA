<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Input dan Tampil Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .menu-section {
            display: none;
        }
        .menu-section.active {
            display: block;
        }
        .file-preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Login Section -->
        <div id="login-section" class="menu-section active">
            <h2 class="text-center">Login</h2>
            <form id="loginForm" class="mt-4">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" placeholder="Masukkan username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="text-danger text-center mt-3" id="errorMessage" style="display: none;">Username atau password salah!</p>
            </form>
        </div>

        <!-- Main Section -->
        <div id="main-section" class="menu-section">
            <h1 class="text-center">Web Input dan Tampil Data</h1>
            <ul class="nav nav-pills mt-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#" id="menu-input">Input Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="menu-tampil">Tampil Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="menu-logout">Logout</a>
                </li>
            </ul>

            <!-- Input Data Section -->
            <div id="input-section" class="menu-section active mt-4">
                <h2>Input Data</h2>
                <form id="fileForm">
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Unggah File:</label>
                        <input type="file" id="fileInput" class="form-control" accept=".doc,.pdf,.ppt,.mp3,.jpg,.jpeg,.png" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Unggah</button>
                </form>
            </div>

            <!-- Tampil Data Section -->
            <div id="tampil-section" class="menu-section mt-4">
                <h2>Tampil Data</h2>
                <ul id="fileList" class="list-group">
                    <!-- File yang diunggah akan muncul di sini -->
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Login credentials
        const validUsername = "akulaku";
        const validPassword = "04122323";

        // Element references
        const loginSection = document.getElementById("login-section");
        const mainSection = document.getElementById("main-section");
        const loginForm = document.getElementById("loginForm");
        const errorMessage = document.getElementById("errorMessage");

        const menuInput = document.getElementById("menu-input");
        const menuTampil = document.getElementById("menu-tampil");
        const menuLogout = document.getElementById("menu-logout");
        const inputSection = document.getElementById("input-section");
        const tampilSection = document.getElementById("tampil-section");
        const fileForm = document.getElementById("fileForm");
        const fileList = document.getElementById("fileList");

        // Show a specific menu
        function showMenu(menu) {
            inputSection.classList.remove("active");
            tampilSection.classList.remove("active");
            menu.classList.add("active");
        }

        // Login functionality
        loginForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            if (username === validUsername && password === validPassword) {
                alert("Login berhasil!");
                loginSection.style.display = "none";
                mainSection.style.display = "block";
            } else {
                errorMessage.style.display = "block";
            }
        });

        // Menu navigation
        menuInput.addEventListener("click", (e) => {
            e.preventDefault();
            showMenu(inputSection);
        });

        menuTampil.addEventListener("click", (e) => {
            e.preventDefault();
            showMenu(tampilSection);
        });

        menuLogout.addEventListener("click", (e) => {
            e.preventDefault();
            alert("Anda telah logout.");
            mainSection.style.display = "none";
            loginSection.style.display = "block";
        });

        // File upload functionality
        fileForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const fileInput = document.getElementById("fileInput");
            const file = fileInput.files[0];

            if (file) {
                const listItem = document.createElement("li");
                listItem.className = "list-group-item";

                const fileName = document.createElement("p");
                fileName.textContent = `File: ${file.name}`;
                listItem.appendChild(fileName);

                const filePreview = document.createElement("div");

                if (file.type.startsWith("image/")) {
                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(file);
                    img.className = "file-preview";
                    filePreview.appendChild(img);
                } else if (file.type === "audio/mpeg") {
                    const audio = document.createElement("audio");
                    audio.controls = true;
                    audio.src = URL.createObjectURL(file);
                    filePreview.appendChild(audio);
                } else {
                    const downloadLink = document.createElement("a");
                    downloadLink.href = URL.createObjectURL(file);
                    downloadLink.textContent = `Unduh ${file.name}`;
                    downloadLink.download = file.name;
                    filePreview.appendChild(downloadLink);
                }

                listItem.appendChild(filePreview);
                fileList.appendChild(listItem);

                fileInput.value = "";
            }
        });
    </script>
</body>
</html>

<!--Programmer Name: SERENE LOH ZI TING (TP075920)
Program Name: community.php
Description: Forum to let user post their archievement
First Written on: Tuesday, 24-June-2025
Edited on: 9-July-2025-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RUNTIME FITNESS - Community</title>
  <link rel="icon" href="images/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }

    body {
      background-color: #fdf8f2;
      color: #333;
      line-height: 1.6;
    }

    header {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff;
      height: 85px;
      padding: 0 7% 0 3%;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
      position: relative;
    }
    
    #navbar-img {
      flex: 1;
      display: flex;
      align-items: center;
    }
    
    .nav-links {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      display: flex;
      gap: 2rem;
      justify-content: center;
    }
    
    .profile-link {
      flex: 1;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      text-decoration: none;
    }
    
    #navbar-img img{
      height: 50px;
    }

    .home-nav-item {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #f3ede3;
      color: #8D7151;
      font-size: 1.2rem;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(106, 72, 25, 0.1);
      border: 1px solid rgba(141, 113, 81, 0.1);
      margin-left: 16px;
      text-decoration: none;
    }

    .home-nav-item:hover {
      background-color: #8D7151;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(106, 72, 25, 0.2);
    }

    .home-nav-item::after {
      display: none;
    }

    .nav-links a {
      text-decoration: none;
      color: #8D7151;
      font-weight: 500;
      transition: all 0.3s;
      font-size: 1.1rem;
      padding: 0 0 5px 0;
      position: relative;
      border-bottom: none;
    }

    .nav-links a:hover::after{
      content:'';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 100%;
      height: 2px;
      background-color: #8E735B;
    }

    .profile-icon {
      width: 40px;
      height: 40px;
      background-color:rgb(182, 148, 120);
      font-weight: 600;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3 ease, transform 0.2s;
    }

    .profile-icon:hover {
      background-color:rgba(198, 163, 135, 0.9);
      transform: scale(1.05);
    }

    .community-section {
      padding: 4rem 8%;
    }

    .community-title {
      text-align: center;
      font-size: 2.5rem;
      margin-bottom: 2rem;
      color: #4a3c2c;
    }

    .post-form {
      background-color: #fff;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }

    .post-form textarea {
      width: 100%;
      padding: 1rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      resize: vertical;
      min-height: 100px;
    }

    .post-form button {
      margin-top: 1rem;
      padding: 0.6rem 1.2rem;
      border: none;
      background-color: #836953;
      color: white;
      border-radius: 6px;
      cursor: pointer;
    }

    .post-list .post {
      background-color: #fff;
      padding: 1.2rem;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
      margin-bottom: 1rem;
    }

    .post strong {
      color: #8E735B;
    }

    footer {
      text-align: center;
      padding: 2rem;
      background: #f3eee8;
      font-size: 0.9rem;
      color: #777;
    }

    .nav-links a.active::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: #8E735B;
    }
  </style>
</head>

<body>
  <header>
    <div id="navbar-img">
      <a href="memberHomepage.php" class="home-nav-item" title="BACK TO MAIN PAGE">
        <i class="fas fa-home"></i>
      </a>
    </div>
    <div class="nav-links">
      <a href="DP.indexMain.php">Diet Plans</a>
      <a href="W.main.php">Workout</a>
      <a href="tracking.php">Progress Tracking</a>
      <a href="community.php" class="active">Community</a>
    </div>
    <div>
      <a href="P.viewProfile.php" class="profile-link">
        <div class="profile-icon">👤</div>
      </a>
    </div>
    <div>
      <a href="#" title="Logout" id="logout-link" style="margin-left: 1rem;color: #8E735B;">
        <i class="fa fa-sign-out fa-lg"></i>
      </a>
    </div>
  </header>

  <section class="community-section">
    <h1 class="community-title">🏡 Community Lounge</h1>

    <div class="post-form">
      <textarea id="postContent" placeholder="Share your workout tips, meal ideas, or questions..."></textarea>
      <button onclick="addPost()">Post</button>
    </div>

    <div class="post-list" id="postList">
      <div class="post">
        <strong>@fitnessfan</strong>
        <p>Just finished my 20-minute stretch and it feels amazing 🔥 Any tips for lower back strength?</p>
      </div>
      <div class="post">
        <strong>@mealprepqueen</strong>
        <p>Here's my go-to protein bowl: Quinoa, chickpeas, grilled veggies & tahini dressing 💪</p>
      </div>
      <div class="post">
        <strong>@weekendwarrior</strong>
        <p>Who's down for a Sunday group challenge? 30 squats + 15 pushups + 1min plank 💥</p>
      </div>
    </div>
  </section>

  <footer style="background-color: #f9f6f0; color: #8D7151; padding: 20px 0; margin-top: 60px; text-align: center; border-top: 1px solid #e5dbc7;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <p style="font-size: 1rem; margin: 0;">RunTime Fitness © 2025 | All rights reserved.</p>
        </div>
    </footer>

  <script>
    function addPost() {
      const content = document.getElementById("postContent").value.trim();
      if (content === '') return alert("Post cannot be empty!");

      const postDiv = document.createElement("div");
      postDiv.className = "post";
      postDiv.innerHTML = `<strong>@you</strong><p>${content}</p>`;

      const postList = document.getElementById("postList");
      postList.insertBefore(postDiv, postList.firstChild);

      document.getElementById("postContent").value = '';
    }
    // Logout confirmation
        const logoutLink = document.getElementById('logout-link');
        if (logoutLink) {
            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Update your progress?',
                    text: "💪 Have you updated your progress for today?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update now',
                    cancelButtonText: 'Logout anyway',
                    reverseButtons: true,
                    background: '#fff8f3',
                    confirmButtonColor: '#8E735B',
                    cancelButtonColor: '#ccc'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'tracking.php';
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = 'P.Logout.php';
                    }
                });
            });
        }
  </script>
</body>

</html>

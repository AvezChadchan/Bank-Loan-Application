<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bank Loan Options</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
    }
    html {
      scroll-behavior: smooth;
    }
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #0070f3, #00dabf);
      color: #222;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    a {
      color: inherit;
      text-decoration: none;
    }
    button {
      font-family: inherit;
      cursor: pointer;
      border-radius: 10px;
      border: none;
      font-weight: 600;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px 24px;
      min-width: 160px;
    }

    header {
      background: rgba(255 255 255 / 0.2);
      backdrop-filter: saturate(180%) blur(10px);
      box-shadow: 0 1px 12px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 0 24px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .logo {
      font-weight: 700;
      font-size: 1.4rem;
      color: white;
    }

    nav {
      display: flex;
      align-items: center;
      gap: 24px;
      flex-wrap: wrap;
    }
    nav a {
      font-weight: 600;
      font-size: 1rem;
      color: white;
      padding: 8px 0;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }
    nav a:hover {
      background-color: rgba(255 255 255 / 0.15);
    }

    .login-btn {
      background: white;
      color: #0070f3;
      padding: 8px 20px;
      font-weight: 700;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgb(0 112 243 / 0.4);
    }

    .login-btn:hover {
      background-color: #005bb5;
      color: white;
    }

    main {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 64px 24px 96px;
      max-width: 720px;
      margin: 0 auto;
      text-align: center;
    }
    main h1 {
      font-weight: 800;
      font-size: 2.8rem;
      color: white;
      text-shadow: 0 2px 10px rgba(0,0,0,0.25);
    }
    main p {
      font-weight: 500;
      font-size: 1.1rem;
      margin-bottom: 48px;
      color: rgba(255 255 255 / 0.85);
    }

    .loan-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 24px;
      width: 100%;
      max-width: 680px;
      margin-top: 20px;
    }

    .loan-btn {
      background-color: white;
      color: #0070f3;
      padding: 18px 20px;
      border-radius: 12px;
      font-weight: 700;
      box-shadow: 0 5px 8px rgb(0 112 243 / 0.25);
    }

    .loan-btn:hover {
      background-color: #e6f0ff;
      box-shadow: 0 10px 18px rgb(0 112 243 / 0.45);
    }

    .loan-btn .material-icons {
      font-size: 20px;
      color: #0070f3;
    }

    section {
      max-width: 800px;
      margin: 0 auto;
      padding: 60px 24px;
      text-align: center;
      color: white;
    }

    section h2 {
      font-size: 2.2rem;
      margin-bottom: 16px;
    }

    section p {
      font-size: 1.05rem;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.9);
    }

    footer {
      background: rgba(255 255 255 / 0.1);
      color: white;
      text-align: center;
      padding: 20px;
    }

    @media (max-width: 768px) {
      nav {
        gap: 12px;
      }
      main h1 {
        font-size: 2.2rem;
      }
      .loan-container {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      }
    }

    @media (max-width: 480px) {
      .logo {
        font-size: 1.2rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">BankLoan</div>
    <nav>
      <a href="#">Home</a>
      <a href="entry.php">Apply</a>
      <a href="#about">About</a>
      <a href="#contact">Contact</a>
      <a href="adminlogin.php" class="login-btn" target="_blank">Admin</a>
      <a href="login.php" class="login-btn" target="_blank">Login</a>
    </nav>
  </header>

  <main>
    <h1>Our Bank Provides These Types of Loans</h1>
    <p>Select the best loan type that fits your needs. Apply now and get started:</p>

    <form action="entry.php" method="GET" class="loan-container">
      <button type="submit" name="type" value="education" class="loan-btn">
        <span class="material-icons">school</span> Education Loan
      </button>
      <button type="submit" name="type" value="business" class="loan-btn">
        <span class="material-icons">business</span> Business Loan
      </button>
      <button type="submit" name="type" value="personal" class="loan-btn">
        <span class="material-icons">person</span> Personal Loan
      </button>
      <button type="submit" name="type" value="home" class="loan-btn">
        <span class="material-icons">home</span> Home Loan
      </button>
      <button type="submit" name="type" value="car" class="loan-btn">
        <span class="material-icons">directions_car</span> Car Loan
      </button>
      <button type="submit" name="type" value="medical" class="loan-btn">
        <span class="material-icons">local_hospital</span> Medical Loan
      </button>
    </form>
  </main>

  <!-- About Section -->
  <section id="about">
    <h2>About Us</h2>
    <p>
      BankLoan is a trusted banking solution offering a wide range of financial products designed to meet the needs of individuals and businesses. With over 20 years of experience, we are committed to providing transparent, fast, and secure loan services. Our team works diligently to ensure you get the right support for your financial journey.
    </p>
  </section>

  <!-- Contact Section -->
  <section id="contact">
    <h2>Contact Us</h2>
    <p>
      Got questions? We're here to help! Reach out to us at:<br><br>
      📞 Phone: +91-1234567890<br>
      ✉️ Email: bankloan@gmail.com<br>
      🏢 Address: 123 Finance Avenue, Mumbai, India
    </p>
  </section>

  <footer>
    &copy; 2025 BankLoan. All rights reserved.
  </footer>
</body>
</html>

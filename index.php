<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SZP - Sulong Botolan</title>
<style>
  body {
    margin: 0;
    padding: 0;
    background: rgb(13, 9, 120);
    background: linear-gradient(90deg, rgba(13, 9, 120, 1) 0%, rgba(37, 37, 166, 1) 43%, rgba(72, 148, 233, 1) 100%);
  }
  
  .container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    animation: fadeIn 2s ease forwards;
  }
  
  .logo {
    width: 80px; 
    height: 40px; 
    border-radius: 50%; 
    box-shadow: 0px 0px 20px 2px rgba(255, 255, 255, 0.3); 
    animation: expand 2s ease forwards;
  }
  
  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  
  @keyframes expand {
    0% {
      transform: scale(4.5);
    }
    100% {
      transform: scale(5); 
    }
  }
</style>
</head>
<body>
  <div class="container">
    <img src="img/SZP.png" alt="SZP Logo" class="logo"> 
  </div>

  <script>
    setTimeout(function(){
      window.location.href = 'login.php'; 
    }, 2500);
  </script>
</body>
</html>

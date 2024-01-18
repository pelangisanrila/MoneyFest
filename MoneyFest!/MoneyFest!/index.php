<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      background-image: #FFFFF3;
    
    }
    .overlay {
      position: absolute;
      top: 50%;
      left: 25%;
      /* right: 70%; */
      transform: translate(-50%, -50%);
      /* text-align: center; */
    }
    .overlay h1 {
      display: flex;
      width: 573px;
      height: 50px;
      flex-direction: column;
      justify-content: center;
      flex-shrink: 0;
      color: #5C5C5C;
      font-family: Roboto;
      font-size: 80px;
      font-style: normal;
      font-weight: 700;
      line-height: 24px; /* 25.263% */
      word-wrap: break-word;
    }
    .overlay h3 {
      height: 100px; 
      color: #5C5C5C; 
      font-size: 20px; 
      font-family: Roboto; 
      font-weight: 400; 
      line-height: 35px; 
      word-wrap: break-word;
    }
    .overlay #button1 {
      width: 120px; 
      height: 50px;  
      background-color: #F7F2FA;  
      box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.15); 
      border-radius: 10px; 
      justify-content: center; 
      align-items: center;
      display: inline-flex;
      text-align: center; 
      color: #5C5C5C; 
      font-size: 20px; 
      font-family: Roboto; 
      font-weight: 500; 
      line-height: 20px; 
      letter-spacing: 0.10px; 
      word-wrap: break-word;
      border-color: transparent;
      text-decoration: none;
    } 
    .overlay #button2 {
      left: 10px;
      width: 120px; 
      height: 50px; 
      background-color: #5C5C5C; 
      border-radius: 10px; 
      justify-content: center; 
      align-items: center; 
      display: inline-flex;
      text-align: center; 
      color: white; 
      font-size: 20px; 
      font-family: Roboto; 
      font-weight: 500; 
      line-height: 20px; 
      letter-spacing: 0.10px; 
      word-wrap: break-word;
      border-color: transparent;
      text-decoration: none;
    }
    .overlay #tutorial {
      position: fixed;
      padding-top: 50%;
    }
    .overlay #tutorial iframe {
      padding-left: 10%;
    }
    .overlay #tutorial h2 {
      color: #5C5C5C;
      font-family: Roboto;
      font-size: 40px;
      font-style: normal;
      font-weight: 700;
      line-height: 24px; /* 60% */
      padding-bottom: 50px;
    }
    html {
      scroll-behavior: smooth;
    }

  </style>
</head>
<body>
  <div class="container">
    <img src="images/Rectangle1.png" style="width: 750px; height: 1600px; left: -17px; top: -15px; position: absolute;" alt="">
    <img src="images/cover.png" alt="" style="width: 750px; height: auto; padding-left: 505px;">
    <img src="images/logo.png"  alt="" style="width: 100px; height: auto; left: 5px; top: -5px; position: absolute">
  <div class="overlay">
    <h1>MoneyFest!</h1>
    <h3>An Integrated Platform for Financial Education <br>and Management Towards a Sustainable Future <br>Based on a Website.</h3>
    <a href="#tutorial" id="button1">Learn More</a>&nbsp;
    <a href="sign-in.php" id="button2">Sign in</a>
    <div id="tutorial">
      <h2>How To Use This Website ?</h2>
      <iframe width="1000" height="515" src="https://www.youtube.com/embed/C9SqURRhriQ?si=bo1kFEoEkV3rMC8S" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
  </div>
</div>

<script>
  document.getElementById("button1").addEventListener("click", function() {
    document.getElementById("tutorial").style.display = "block";
  });
</script>

</body>
</html>
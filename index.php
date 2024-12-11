<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bingkai-Gratis</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js">
    </script>
    <link rel="stylesheet" href="style.css">
    <style>
              body {
            background: rgb(14,0,255);
            background: linear-gradient(90deg, rgba(14,0,255,1) 0%, rgba(205,220,223,1) 100%);
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: r;
            align-items: center;
            justify-content: center;
            height: 100vh;
            
        }
        h3{
          text-align: center;
          font-weight: bold;
        }

        .twibbon {
            position: relative;
            display: inline-block;
            border: 5px solid #4a90e2;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            padding: 10px;
        }

        #photo {
            width: 300px; /* Example width */
            height: 200px; /* Example height */
            background-color: lightblue; /* Placeholder for the photo */
            border-radius: 5px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #twibbonimg{
          margin-top: 20px;
            padding: 10px 10px;
            font-size: 16px;
            color: black;
            background-image: linear-gradient(to bottom right, #AFFCAF, #12DFF3 );
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #photoimg{
          margin-left: 30px;
          margin-top: 20px;
            padding: 7px;
            font-size: 16px;
            color: black;
            background-image: linear-gradient(to bottom right, #AFFCAF, #12DFF3 );
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .pilihan{
          margin-top: 20px;
            padding: 10px 10px;
            font-size: 16px;
            color: #fff;
            background-color: #4a90e2;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #download {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: black;
            background-image: linear-gradient(to bottom right, #AFFCAF, #12DFF3 );
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        #download:hover {
            background-color: red;
            transform: translateY(-2px);
        }

        #download:active {
            transform: translateY(0);
        }

    </style>
  </head>
  <body>
    

    </select>
    <br>
    <div class="pilihan">
    <h3>Pilih Bingkai</h3>
    <select id = "twibbonimg">
      <option value="img/teacherday.png">Hari Guru</option>
      <option value="img/youthchildrenday.png">Hari Anak Internasional</option>
      <option value="img/bicycleday.png">Sepedaan</option>
      <option value="img/tahun.png">Ulang Tahun</option>
      <option value="img/pramuka.png">Gerakan Pramuka</option>
    <input type="file" id="photoimg" value=""> <br>
    <h4>Lebar</h4> <input type="text" id = "width" value="100%">
    <h4>Tinggi</h4>  <input type="text" id = "height" value="100%">
    <h4>Atas</h4> <input type="text" id = "top" value="0px">
    <h4>Kiri</h4> <input type="text" id = "left" value="0px">
    </div>


    <hr>

    <div class="card">
      <h2>Siap  untuk digunakan</h2>
      <div class="twibbon">
        <img src="" id = "twibbon" alt="">
        <img src="" id = "photo" alt="">
      </div>
      <a href="#" id = "download">Download</a>
    </div>

    <script type="text/javascript">
      var photoimg = "";
      // Upload image to the directory
      $(document).ready(function() {
          $('#photoimg').change(function(){
              var formData = new FormData();
              var files = $('#photoimg')[0].files;
              formData.append('photo', files[0]);
              $.ajax({
                  url: "upload.php",
                  type: "POST",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response){
                    photoimg = response;
                  }
              });
          });
      });

      // Real time preview twibbon
      setInterval(function(){
        preview();
      }, 0);

      function preview(){
        var twibbonimg = $('#twibbonimg').val();
        var width = $('#width').val();
        var height = $('#height').val();
        var top = $('#top').val();
        var left = $('#left').val();
        $("#photo").attr("src", photoimg);
        $('#twibbon').attr("src", twibbonimg);
        $('#photo').css("width", width);
        $('#photo').css("height", height);
        $('#photo').css("top", top);
        $('#photo').css("left", left);
      }

      // Download twibbon
      var element = $(".twibbon");
      $("#download").on('click', function(){
        html2canvas(element, {
          onrendered: function(canvas) {
            var imageData = canvas.toDataURL("image/png");
            var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
            $("#download").attr("download", "image.png").attr("href", newData);
          }
        });
      });
    </script>
  </body>
</html>

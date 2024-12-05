<?php
session_start();
include('db.php'); // تضمين ملف الاتصال بقاعدة البيانات
// التحقق مما إذا كان المستخدم قد سجل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: auth.php");
    exit();
}

// عرض رسالة ترحيبية للمستخدم بعد تسجيل الدخول
echo "مرحبًا " . htmlspecialchars($_SESSION['username']) . "!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مغامرة حياتك</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <div id="google_translate_element"></div>

    <style>
        /* ضبط حجم الشعار */
        .logo {
            width: 60px; /* عرض الشعار (تم تصغيره) */
            height: auto; /* الحفاظ على نسبة العرض إلى الطول */
            max-width: 100%; /* عدم تجاوز الشعار حجم الحاوية */
        }
        .trash_pop {
  max-width: 100vw;
  height: 100vh;
  position: fixed;
  width: 100%;
  left: 50%;
  top: -100%;
  transform: translate(-50%);
  display: flex;
  align-items: center;
  justify-content: center;
  background-size: calc(10 * 2px) calc(10 * 2px);
  opacity: 0;
}

.container-inner {
  background: #a4363e;
  padding: 40px;
  border-radius: 30px;
  box-shadow: 5px 6px 0px -2px #620d15, -6px 5px 0px -2px #620d15,
    0px -2px 0px 2px #ee9191, 0px 10px 0px 0px #610c14,
    0px -10px 0px 1px #e66565, 0px 0px 180px 90px #0d2f66;
  width: 640px;
}
.trash_pop.open {
    opacity: 1;
    top: 0;
}
.content_trush {
  font-family: "Skranji", cursive;
  background: radial-gradient(#fffbf3, #ffe19e);
  padding: 24px;
  box-sizing: border-box;
  border-radius: 20px 18px 20px 18px;
  box-shadow: 0px 0px 0px 6px #5e1e21, 0px 0px 8px 6px #84222b,
    inset 0px 0px 15px 0px #614506, 6px 6px 1px 1px #e66565,
    -6px 6px 1px 1px #e66565;
  text-align: center;

  p {
    font-size: 56px;
    padding: 40px;
    box-sizing: border-box;
    color: #461417;
  }
}

.buttons_trush {
  margin-top: 40px;
  display: flex;
  justify-content: normal;
  align-items: center;
  gap: 30px;
  box-sizing: border-box;

  button {
    padding: 20px;
    flex: 1;
    border-radius: 20px;
    border: 2px solid #49181e;
    font-family: "Skranji", cursive;
    color: #fff;
    font-size: 32px;
    text-shadow: 1px 2px 3px #000000;
    cursor: pointer;

    &.confirm {
      background: linear-gradient(#ced869, #536d1b);
      box-shadow: 0px 0px 0px 4px #7e1522, 0px 2px 0px 3px #e66565;
      &:hover {
      box-shadow: 0px 0px 0px 4px #7e1522, 0px 2px 0px 3px #e66565,
        inset 2px 2px 10px 3px #4e6217;
      } 
    }

    &.cancel {
      background: linear-gradient(#ea7079, #891a1a);
      box-shadow: 0px 0px 0px 4px #7e1522, 0px 2px 0px 3px #e66565;
      &:hover {
      box-shadow: 0px 0px 0px 4px #7e1522, 0px 2px 0px 3px #e66565,
        inset 2px 2px 10px 3px #822828;
      }
    }
  }
 
}

 


    </style>
</head>

<body>
    <header>
        <div id="menu-bar" class="fas fa-bars" onclick="showmenu()"></div>
        <a href="" class="logo"><span>مغامرة</span><span>حياتك</span></a>
        <nav class="navbar">
            <a href="#home">الرئيسية</a>
            <a href="singup.php">انشاء حساب</a>
            <a href="contact.php">تواصل معنا</a>
            <a href="#services">مميزات موقعنا</a>
        </nav>
        <div class="icon">
            <i class="fas fa-search" onclick="showbar()" id="search-btn"></i>
            <i class="fas fa-user" onclick="showform()"></i>
            <i class="fa-solid fa-calendar-days" id="trash_bt" onclick="show_pop()" ></i>
        </div>

        <div class="trash_pop" id="pup">
        <div class="container-inner">
              <div class="content_trush">
              
               <?php
               
               $user_id = $_SESSION['user_id']; // Ensure this is set appropriately
            //    // SQL query to retrieve bookings
            $sql = "
            UPDATE bookings 
            SET booked = 0 
            WHERE user_id = ? AND booked = 1 AND trip_id IN (
            SELECT b.trip_id 
            FROM bookings b 
            JOIN trips t ON b.trip_id = t.id 
            WHERE b.user_id = ? AND b.booked = 1
        ";
            
            //    // Prepare and execute the statement
               if ($stmt = $conn->prepare($sql)) {
                   $stmt->bind_param("i", $user_id); // Bind user_id as integer
                   $stmt->execute();
                   $result = $stmt->get_result();
                   
            //        // Check for results
                   if ($result->num_rows > 0) {
                       echo "<ul>";
                       while ($row = $result->fetch_assoc()) {
                           echo "<li style= 'font-size: 20px;'>عدد الأشخاص: " . $row['num_people'] .'<br>'. " تاريخ الحجز: " . $row['created_at'] .'<br>'.  " المدينة: " . $row['location'] . "</li>";
                           echo "</br>";
                       }
                       echo "</ul>";
                   } else {
                       echo "لا توجد حجوزات."; // No bookings found
                   }
               
                   $stmt->close(); // Close the statement
               } else {
                   echo "خطأ في إعداد استعلام الحجوزات: " . $conn->error; // Error preparing the statement
               }
               
               ?>
                
               </div>
           <div class="buttons_trush" >
               <button type="button" class="confirm" onclick="hide_pop()">رجوع</button>
            <button type="button" class="cancel" onclick= "hide_pop()"><a href="delete.php" style="color: white"><i class="fas fa-trash-can"></i></a></button>
           </div>
        </div>
       </div>
     
        <form action="" class="search-form">
            <input type="search" id="search-bar" placeholder="عن ماذا تبحث">
            <label for="search-bar" class="fas fa-search"></label>
        </form>
    </header>

    <div class="login-form">
        <i class="fas fa-times" id="form-close" onclick="hideform()"></i>
        <form action="">
            <h3>تسجيل دخول</h3>
            <input type="email" class="box" placeholder="اكتب اسم المستخدم الخاص بك">
            <input type="password" class="box" placeholder="اكتب الرمز الخاص بك">
            <input type="submit" value="تسجيل دخول الان" class="btn">
            <input type="checkbox" id="تذكرني">
            <label for="تذكرني">تذكرني</label>
            
            <p>ليس لديك حساب؟ <a href="singup.php">تسجيل جديد</a></p>
        </form>
    </div>

    <section class="home" id="home">
        <div class="content">
            <h3>المغامرات معنا غير</h3>
            <p>اختر واحجز مايناسبك من بين العديد من الرحلات والمغامرات</p>
        </div>
        <div class="controls">
            <span class="video-btn blue" data-src="images/vid-3.mp4"></span>
            <span class="video-btn " data-src="images/vid-1.mp4"></span>
            <span class="video-btn" data-src="images/vid-2.mp4"></span>
            <span class="video-btn" data-src="images/vid-5.mp4"></span>
        </div>
        <div class="video-container">
            <video src="images/vid-3.mp4" id="video-slider" loop autoplay muted></video>
        </div>
    </section>

   

    <section class="packages" id="packages">
    <h1 class="heading">
        <span>رحلات الهايكنج</span>
    </h1>
    <div class="container">
        <?php
            // استعلام من قاعدة البيانات لعرض الرحلات
            $result = mysqli_query($conn, "SELECT * FROM trips"); // تأكد من أن جدول "trips" موجود
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="box">';
                    echo '<img src="images/' . $row['image'] . '" alt="' . $row['location'] . '">';
                    echo '<div class="content">';
                    echo '<h3><i class="fas fa-map-marker-alt"></i> ' . htmlspecialchars($row['location']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '<div class="stars">';
                    for ($i = 0; $i < $row['rating']; $i++) {
                        echo '<i class="fas fa-star"></i>';
                    }
                    echo '</div>';
                    echo '<div class="price">' . htmlspecialchars($row['price']) . ' <span>' . htmlspecialchars($row['original_price']) . '</span></div>';
                    echo '<a href="' . htmlspecialchars($row['link']) . '" class="btn">احجز الان</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>حدث خطأ في جلب بيانات الرحلات.</p>';
            }
        ?>
    </div>
</section>

    <!------------------------------------------------------------------------------------>
    <!------------------------------------------------------------------------------------>

    <section class="services" id="services">

        <h1 class="heading">
            <span>الرحلات</span>
        </h1>

        <div class="container">
            <div class="box">
                <i class="fas fa-mountain"></i>
                <h3>مغامرة لاتُنسى</h3>
                <p>قد تحظى بتجربة فريدة من نوعها في المناطق الجبلية السعودية.</p>
            </div>
            <div class="box">
                <i class="fas fa-flag"></i>
                <h3>مغامرة لاتُنسى</h3>
                <p>لقد تأكدنا أن موقعنا يدعم رؤية السعودية 2030.</p>
            </div>
            <div class="box">
                <i class="fas fa-baby"></i> <i class="fas fa-hiking"></i>
                <h3>مغامرة لاتُنسى</h3>
                <p> نحن أول من دعم حتى الأطفال لممارسة رياضة المشي لمسافات طويلة في المملكة العربية السعودية.</p>
            </div>
            <div class="box">
                <i class="fas fa-map"></i> <i class="fas fa-plus-circle"></i>
                <h3>مغامرة لاتُنسى</h3>
                <p>لقد قمنا بتوفير المسعفين والمرشدين السياحيين لضمان سلامة الجميع.</p>
            </div>
            <div class="box">
                <i class="fas fa-hourglass-half"></i>
                <h3>مغامرة لاتُنسى</h3>
                <p>لن تواجه أي صعوبة في الانتظار حيث يوفر موقعنا الحجز المسبق.</p>
            </div>
            <div class="box">
                <i class="fas fa-calendar-alt"></i>
                <h3>مغامرة لاتُنسى</h3>
                <p>ستجد أننا أول موقع سياحي يدعم الحجز المسبق لممارسة رياضة المشي لمسافات طويلة في المملكة العربية السعودية.</p>
            </div>
        </div>
    </section>
    
    <!-----------------------#تم كتابته بالعربي باقي العنوان--------------------------------------------------------------->
    <!-------------------------------------------------------------------------------------->

    <section class="gallary" id="gallary">

        
                 
            
         

    </section>

    <!--------------------حذف الصور --------------------------------------------------------------------->
    <!----------------------------------------------------------------------------------------->
    
    <section class="review" id="review">

        <h1 class="heading">
            <span>التعليقات</span>
        </h1>

        <div class="swiper review-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="box">
                        <img src="images/pic1.jpg" alt="">
                        <h3>YARA</h3>
                        <p>اكثر شي عجبني انه فيه حجز لناااا اخيراا</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <img src="images/pic2.jpg" alt="">
                        <h3>HATTAN</h3>
                        <p>فكرة الحجز المسبق فكرة جميلة وتوفير وقت وجهد مع زحمة الرياض , مبدعيييين</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <img src="images/pic3.jpg" alt="">
                        <h3>KHALED</h3>
                        <p>شكرا لكم قضيت وقت جميل!</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <img src="images/pic4.jpg" alt="">
                        <h3>GHADI</h3>
                        <p>المرشدين تعاملهم فوق الممتاز وحبيت انكم مهتمين حتى للاطفال انتو فنانيييين استمروووا</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    <!----------------------------------------------------------------------------------------------------->
    <!----------------------------------------------------------------------------------------------------->

    <section class="contact" id="contact">

        <h1 class="heading">
            <span>الرسائل</span>
        </h1>

        <div class="row">
            <div class="image">
                <img src="images/contact-img.svg" alt="">
            </div>
            <form action="">
                <div class="inputbox">
                    
                </div>
                <div class="inputbox">
                    <input type="number" placeholder="عدد النجوم">
                    <input type="text" placeholder="المستخدم">
                </div>
                <textarea name="" id="" cols="30" rows="10" placeholder="رسالة"></textarea>
                <input type="submit" class="btn" value=" إرسال الرسالة">
            </form>
        </div>
    </section>
  
    <!------------------------------------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------->

    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>من نحن؟</h3>
                <p>
                    نحن فريق من الشباب السعودي الشغوفين بالطبيعة والمغامرة، اجتمعنا لنشارك حبنا لرياضة الهايكنق واستكشاف جمال المملكة. نسعى لخلق تجربة فريدة للمغامرين من خلال تنظيم رحلات استكشافية مليئة بالإثارة والتحدي، مع الحفاظ على التراث الطبيعي والثقافي لبلدنا. رؤيتنا هي أن نصبح الوجهة الأولى لعشاق الهايكنق في السعودية، وأن نلهم الجميع لاستكشاف روعة الطبيعة السعودية بكل أمان واحترافية. كما نؤمن بأن الهايكنق ليس مجرد رياضة، بل هو أسلوب حياة يعزز الصحة الجسدية والذهنية، ويقربنا أكثر من بيئتنا الطبيعية. هدفنا هو بناء مجتمع من المغامرين والمستكشفين الذين يتشاركون نفس الشغف، ونسعى دائمًا لتطوير خبراتنا ومهاراتنا لنقدم أفضل التجارب لعشاق الطبيعة والمغامرة.</p>
            </div>
            <div class="box">
                <h3>الفروع</h3>
                <a href="medina.php">المدينة المنورة</a>
                <a href="alula.php">العلا</a>
                <a href="asir.php">عسير</a>
                <a href="riyadh.php">الرياض</a>
                <a href="hail.php">حائل</a>
                <a href="taif.php">الطائف</a>
            </div>
            <div class="box">
                <h3>روابط سريعة</h3>
                <a href="#">الرئيسية</a>
                <a href="singup.php">انشاء حساب</a>
                <a href="contact.php">تواصل معنا</a>
                <a href="#">services</a>
                <a href="#">gallary</a>
                <a href="#">review</a>
                <a href="#">contact</a>
            </div>
            <div class="box">
                <h3>تابعنا في</h3>
                <a href="#">الفيسبوك</a>
                <a href="#">الانستقرام</a>
                
                <a href="#">سناب شات</a>
            </div>
        </div>
       
    </section>



<script>
function show_pop(){
    document.getElementById('pup').classList.add('open');
}
function hide_pop(){
    document.getElementById('pup').classList.remove('open');
}



</script>


    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="travel.js"></script>
    





</body>
</html>
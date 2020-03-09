<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>PHP Mail Function</title>
    <style>
      body{
    background: -webkit-linear-gradient(left, #0072ff, #00c6ff);
}
.contact-form{
    background: #fff;
    margin-top: 10%;
    margin-bottom: 5%;
    width: 70%;
}
.contact-form .form-control{
    border-radius:1rem;
}
.contact-image{
    text-align: center;
}
.contact-image img{
    border-radius: 6rem;
    width: 11%;
    margin-top: -3%;
    transform: rotate(29deg);
}
.contact-form form{
    padding: 14%;
}
.contact-form form .row{
    margin-bottom: -7%;
}
.contact-form h3{
    margin-bottom: 8%;
    margin-top: -10%;
    text-align: center;
    color: #0062cc;
}
.contact-form .btnContact {
    width: 50%;
    border: none;
    border-radius: 1rem;
    padding: 1.5%;
    background: #dc3545;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}
.btnContactSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    color: #fff;
    background-color: #0062cc;
    border: none;
    cursor: pointer;
}
    </style>
  </head>
  <body>
    <div class="container contact-form">
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <h3>Drop Us a Message</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="comments" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>
<!--MAIL START-->
<?php
    error_reporting(1);
    if(isset($_POST['submit']))
    {
        //The form has been submitted, prep a nice thank you message
        $output = '<h1>Thanks for your Comments!</h1>';
        //Set the form flag to no display (cheap way!)
        $flags = 'style="display:none;"';

        //Deal with the email
        $to = 'example@gmail.com';
        $subject = 'sample-email';

        $message="<table border=1>";
        $message .="<tr><th>Comments</th></tr>";
        $message .="<tr><td>Name</td><td> ".strip_tags($_POST['name'])."</td>";
        $message.="<tr><td>Email Id</td><td> ".strip_tags($_POST['email'])."</td>";
        $message.="<tr><td>Subject</td><td> ".strip_tags($_POST['subject'])."</td>";
        $message.="<tr><td>Comments</td><td> ".strip_tags($_POST['comments'])."</td>";
        $message.="</table>";

        $attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
        $filename = $_FILES['file']['name'];

        $boundary =md5(date('r', time())); 

        $headers = "From:".strip_tags($_POST['email'])."\r\nReply-To: ".strip_tags($_POST['email']);
        $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

        $message="This is a multi-part message in MIME format.

        --_1_$boundary
        Content-Type: multipart/alternative; boundary=\"_2_$boundary\"

        --_2_$boundary
        Content-Type: text/html; charset=\"iso-8859-1\"
        Content-Transfer-Encoding: 7bit

        $message

        --_2_$boundary--";
            if(mail($to, $subject, $message, $headers))
            {
                echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';

            
                }
                else
                {
                    echo "<div class='alert alert-danger'>
        <strong>Error!</strong> in sending mail.
        </div>";
                }
            }

        ?>
        <!--MAIL END-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
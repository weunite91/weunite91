<!doctype html>
<html>
<head>
<title></title>
<style type="text/css">
/* CLIENT-SPECIFIC STYLES */
body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }

/* RESET STYLES */
img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

/* iOS BLUE LINKS */
a[x-apple-data-detectors] {
   color: inherit !important;
   text-decoration: none !important;
   font-size: inherit !important;
   font-family: inherit !important;
   font-weight: inherit !important;
   line-height: inherit !important;
}

/* MOBILE STYLES */
@media screen and (max-width: 600px) {
 .img-max {
   width: 100% !important;
   max-width: 100% !important;
   height: auto !important;
 }

 .max-width {
   max-width: 100% !important;
 }

 .mobile-wrapper {
   width: 85% !important;
   max-width: 85% !important;
 }

 .mobile-padding {
   padding-left: 5% !important;
   padding-right: 5% !important;
 }
}

/* ANDROID CENTER FIX */
div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important; background-color: #F1F1F1;" bgcolor="#F1F1F1">
    <div style="padding: 25px">
        <p> Name : {{ $data['fullname'] }} </p>
        <p> Number : {{ $data['mobilenumber'] }} </p>
        <p> Email : {{ $data['supportemail'] }} </p>
        <p> Support Message : {{ $data['querymsg'] }} </p>
    </div>
</body>
</html>

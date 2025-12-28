<?php
$files = ["contact.php", "services.php", "faq.php", "login.php", "register.php"];
foreach ($files as $file) {
  if (file_exists($file)) {
    $content = file_get_contents($file);
    $content = str_replace("from-blue-500 to-blue-600", "bg-[#006699]", $content);
    $content = str_replace("from-blue-600 to-blue-700", "from-[#006699] to-[#004d73]", $content);
    $content = str_replace("bg-blue-600", "bg-[#006699]", $content);
    $content = str_replace("text-blue-600", "text-[#006699]", $content);
    $content = str_replace("text-orange-600", "text-[#F89E1B]", $content);
    $content = str_replace("border-blue-600", "border-[#006699]", $content);
    file_put_contents($file, $content);
    echo "Updated $file
";
  }
}

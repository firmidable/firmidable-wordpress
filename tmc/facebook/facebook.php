<?php

function firm_fb_pixel($pixel_id,$thankyou_slug) {

echo "<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '".$pixel_id."');\r\n";
if (isset($thankyou_slug) && is_page($thankyou_slug)) { echo "fbq('track', 'Lead')\r\n";}
echo "fbq('track', 'PageView');
</script>
<noscript><img height='1' width='1' style='display:none'
src='https://www.facebook.com/tr?id=".$pixel_id."&ev=PageView&noscript=1'
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->\r\n";
}

function firm_fb_pixel_funct() {
	$tmc_fb_pixel_id = esc_attr( get_option( 'facebook_pixel_id' ) );
	$tmc_fb_pixel_thankyou_page = esc_attr( get_option( 'mailer_thankyoupage' ) );
	firm_fb_pixel($tmc_fb_pixel_id, $tmc_fb_pixel_thankyou_page);
}

add_action( 'wp_head','firm_fb_pixel_funct');

?>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Plugin Name: Woo Product Import
Plugin URI: http://www.wp1stop.com
Description: Allows you to import products
Version: 1.0
Author: Frederick Pohl
Author URI: http://www.wp1stop.com
/* ----------------------------------------------*/



?>
<?php

$themetrack = "Product Import";
$shortname1 = "propertyimporter";
$options1 = array (


array(    "name" => "Add a Featured track",
        "type" => "title"),

array(    "type" => "open"),

array(    "name" => "Featured Track Code 1 ",
        "desc" => "Enter the code for the feature track",
        "id" => $shortname1."_featuredtrack",
        "type" => "textarea"),
		
		array(    "name" => "Featured Track Code 2 ",
        "desc" => "Enter the code for the feature track",
        "id" => $shortname1."_featuredtrack2",
        "type" => "textarea"),
		
		array(    "name" => "Featured Track Code 3 ",
        "desc" => "Enter the code for the feature track",
        "id" => $shortname1."_featuredtrack3",
        "type" => "textarea"),
		
		array(    "name" => "Featured Track Code 4 ",
        "desc" => "Enter the code for the feature track",
        "id" => $shortname1."_featuredtrack4",
        "type" => "textarea"),
		

array(    "type" => "close")

);




function mytheme_add_propimport() {

    global $themetrack, $shortname1, $options1;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options1 as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options1 as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=importlisting.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options1 as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=importlisting.php&reset=true");
            die;

        }
    }

    add_theme_page($themetrack." ", "".$themetrack."", 'edit_themes', basename(__FILE__), 'mytheme_soundcloud');

}

function mytheme_soundcloud() {

    global $themetrack, $shortname1;
	
	?>
<div class="wrap">
<h2><?php echo $themetrack; ?> settings</h2>

    <input type="file" id="takePictureField" /> 

    <button type="button" class="importall">Import Now!</button>

    

<div class="thestatus">

</div>

<div class="buffer1">

</div>

 <div class="theids">

</div>
 <div class="thelistcount">

</div>

 <div class="thecustomcount">

</div>

 <div class="theimgcount">

</div>





<div class="thestatus2">

</div>

<div class="buffer2">

</div>

 <div class="theids2">

</div>
 <div class="thelistcount2">

</div>

 <div class="thecustomcount2">

</div>

 <div class="theimgcount2">

</div>



<div class="thestatus3">

</div>

<div class="buffer3">

</div>

 <div class="theids3">

</div>
 <div class="thelistcount3">

</div>

 <div class="thecustomcount3">

</div>

 <div class="theimgcount3">

</div>



<div class="thestatus4">

</div>

<div class="buffer4">

</div>

 <div class="theids4">

</div>
 <div class="thelistcount4">

</div>

 <div class="thecustomcount4">

</div>

 <div class="theimgcount4">

</div>


<?php
}



add_action('admin_menu', 'mytheme_add_propimport'); 


function my_sideload_image($url,$postid) {
    $file = media_sideload_image($url,$postid);
    echo $file;
}
add_action( 'admin_init', 'my_sideload_image' );


                         

function processVariablePA($parentid,$posttitle,$choice1,$option1,$msrp,$yourprice,$price) {
  
     //my array for setting the attributes
$avail_attributes = array(
   $choice1
);

//Sets the attributes up to be used as variations but doesnt actually set them up as variations
wp_set_object_terms ($parentid, 'variable', 'product_type');
wp_set_object_terms( $parentid, $avail_attributes, 'pa_color' );

   
//everything works well but

$thedata = array(
'pa_color'=> array(
                'name'=>'pa_color',
               'value'=>'',
               'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
                )
);
update_post_meta( $parentid,'_product_attributes',$thedata);


  $my_post = array(
      'post_title'    => 'Variation ' . esc_attr(strip_tags($posttitle)),
      'post_name'     => 'product-' . $parentid . '-variation-' . $i,
      'post_status'   => 'publish',
      'post_parent'   => $parentid,
      'post_type'     => 'product_variation',
      'guid'          =>  home_url() . '/?product_variation=product-' . $parentid . '-variation-'
    );

    // Insert the post into the database
    $variable_id = wp_insert_post( $my_post );
   
  // _price
   
  // _sale_price
   
  // _regular_price
   
  // _msrp


 update_post_meta( $variable_id, 'attribute_pa_color', $choice1);
   update_post_meta( $variable_id, '_price', 8.50 );
  update_post_meta( $variable_id, '_regular_price', '8.50');
  update_post_meta( $variable_id, '_sale_price', '8.50');
   update_post_meta( $variable_id, '_msrp_price', '8.50');
  
      
   
  
  }

  add_action( 'admin_init', 'processVariablePA' );



 function get_attachment_id_from_src($image_src) {
      global $wpdb;
      $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
      $id = $wpdb->get_var($query);     
       return $id;
     
    }

add_action( 'admin_init', 'get_attachment_id_from_src' );

function my_add_productterm($postid,$termvalue,$termcategory) {
    ///$file = media_sideload_image($url,$postid);
    ///echo $file;
}
add_action( 'admin_init', 'my_add_productterm' );





 add_action( 'wp_ajax_my_processobjectterm', 'get_processobjectterm' );  
add_action('wp_ajax_nopriv_my_processobjectterm', 'get_processobjectterm');

          
function get_processobjectterm($result) {
  

  
   $termval = $_POST['termval'];    
     $product_cat = $_POST['product_cat'];    
      
   $parent_post_id = $_POST['post_id']; 

    wp_set_object_terms($parent_post_id, $termval, $product_cat ); 


echo $termval;


}





   add_action( 'wp_ajax_my_publishingimages', 'get_publishingimages' );  
add_action('wp_ajax_nopriv_my_publishingimages', 'get_publishingimages');

          
function get_publishingimages($result) {
  
  
   $filename = $_POST['server_path'];    
    
      
   $parent_post_id = $_POST['post_id']; 
       // $uploads = wp_upload_dir(); /*Get path of upload dir of wordpress*/  
   
   
     //$img =  file_get_contents($filename);
   
          $file = media_sideload_image($filename,$parent_post_id);

            /// echo $file;
   
   
   // Check the type of tile. We'll use this as the 'post_mime_type'.
//$filetype = wp_check_filetype( basename( $filename ), null );

// Get the path to the upload directory.
//$wp_upload_dir = wp_upload_dir();

// Prepare an array of post data for the attachment.
//$attachment = array(
//	'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
//	'post_mime_type' => $filetype['type'],
//	'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
//	'post_content'   => '',
//	'post_status'    => 'inherit'
//);

// Insert the attachment.
///$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
///require_once( ABSPATH . 'wp-admin/includes/image.php' );

// Generate the metadata for the attachment, and update the database record.
///$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
///wp_update_attachment_metadata( $attach_id, $attach_data );

///set_post_thumbnail($parent_post_id, $attach_id);
 echo 'Image Uploaded 2!! ---------';

// Remove any unwanted HTML, keep just a plain URL (or whatever is in the image src="..." )
///$image = preg_replace("/.*(?<=src=[''])([^'']*)(?=['']).*/", '$1', $file);
 
// Get the Attachment ID
///$attachment_id = $this -> get_attachment_id_from_src ($image);

///echo $attachment_id;
///echo $file;

   $xpath = new DOMXPath(@DOMDocument::loadHTML($file));
$src = $xpath->evaluate("string(//img/@src)");

echo $src;
echo 'Image Uploaded!! ---------';

}         



        
        
         add_action( 'wp_ajax_my_publishingwoogallery', 'get_publishingwoogallery' );  
add_action('wp_ajax_nopriv_my_publishingwoogallery', 'get_publishingwoogallery');

          
function get_publishingwoogallery($result) {
  
  
   $images = $_POST['server_path'];    
    
      
   $parent_post_id = $_POST['post_id']; 
       // $uploads = wp_upload_dir(); /*Get path of upload dir of wordpress*/  
   
   
 update_post_meta( $post_id, '_product_image_gallery', $images );  



}


   
        
        
        


   add_action( 'wp_ajax_my_publishingimagesfeature', 'get_publishingimagesfeature' );  
add_action('wp_ajax_nopriv_my_publishingimagesfeature', 'get_publishingimagesfeature');

          
function get_publishingimagesfeature($result) {
  
  
  $filename = $_POST['server_path'];    
 $parent_post_id = $_POST['post_id']; 
       // $uploads = wp_upload_dir(); /*Get path of upload dir of wordpress*/  
   
   
     //$img =  file_get_contents($filename);
   
          $file = media_sideload_image($filename,$parent_post_id);

            /// echo $file;

            /// echo $file;
   
   

   
   // Check the type of tile. We'll use this as the 'post_mime_type'.
//$filetype = wp_check_filetype( basename( $filename ), null );

// Get the path to the upload directory.
//$wp_upload_dir = wp_upload_dir();

// Prepare an array of post data for the attachment.
//$attachment = array(
//	'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
//	'post_mime_type' => $filetype['type'],
//	'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
//	'post_content'   => '',
//	'post_status'    => 'inherit'
//);

// Insert the attachment.
///$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
///require_once( ABSPATH . 'wp-admin/includes/image.php' );

// Generate the metadata for the attachment, and update the database record.
///$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
///wp_update_attachment_metadata( $attach_id, $attach_data );

///update_post_meta($parent_post_id, '_product_image_gallery', $attachment_id);


// Remove any unwanted HTML, keep just a plain URL (or whatever is in the image src="..." )
//$image = preg_replace("/.*(?<=src=[''])([^'']*)(?=['']).*/", '$1', $file);
 
///$xpath = new DOMXPath(@DOMDocument::loadHTML($file));
///$src = $xpath->evaluate("string(//img/@src)");
 
 
// Get the Attachment ID
///$attachment_id = $this ->get_attachment_id_from_src($src);

///set_post_thumbnail($parent_post_id, $attachment_id);
///echo $attachment_id;
///echo 'Featured ID!! ---------';
///set_post_thumbnail($parent_post_id, $attach_id);
 echo 'Image Uploaded 3!! ---------';

// Remove any unwanted HTML, keep just a plain URL (or whatever is in the image src="..." )
///$image = preg_replace("/.*(?<=src=[''])([^'']*)(?=['']).*/", '$1', $file);
 
// Get the Attachment ID
///$attachment_id = $this -> get_attachment_id_from_src ($image);

///echo $attachment_id;
///echo $file;

   $xpath = new DOMXPath(@DOMDocument::loadHTML($file));
$src = $xpath->evaluate("string(//img/@src)");
  
  
  // Get the Attachment ID
$attachment_id = get_attachment_id_from_src($src);
set_post_thumbnail($parent_post_id, $attachment_id);

echo $src;
echo 'Image Uploaded!! ----- ATTACH ID-';
echo $attachment_id;
}







  add_action( 'wp_ajax_my_publishingfields', 'get_publishingfields' );  
add_action('wp_ajax_nopriv_my_publishingfields', 'get_publishingfields');

          
function get_publishingfields($result) {
  
 $mykey =  $_POST['mykey'];
         
      


// Insert custom field
add_post_meta( $_POST['post_id'], $mykey, $_POST['mycustomvalue'] ); 

echo  "CUSTOM FIELD PUBLISHED!!!! -------";
echo  "Post ID-";
echo $_POST['post_id'];
echo  "---";
echo  "KEY-";
echo  $mykey;
echo  "---Custom Value-";
echo  $_POST['mycustomvalue'];
 

}







add_action( 'wp_ajax_my_publishing', 'get_publishing' );  
add_action('wp_ajax_nopriv_my_publishing', 'get_publishing');

          
function get_publishing($result) {

      // Create post object
///$my_post = array(
 /// 'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
 /// 'post_content'  => $_POST['post_content'],
 /// 'post_status'   => 'publish',
 /// 'post_author'   => 1,
 /// 'post_type' => 'listing',
///  'tax_input'      => array( 'listing_category' => $_POST['category'] )
///);
    
 $my_post = array(
       'post_content' => $_POST['post_content'],
     'post_status' => "publish",
     'post_title' => wp_strip_all_tags( $_POST['post_title'] ),
     'post_parent' => '',
     'post_type' => "product",
     'tax_input'      =>   array (
                           'listing_category' => $_POST['listing_cat'],
                           'product_type' => 'simple',
                           'product_shipping_class' => $_POST['shipping_class'],
                           'product_brand' => $_POST['brand']
                           )
       
         

     );


// Insert the post into the database
$mypostid = wp_insert_post( $my_post );



  $term_taxonomy_ids = wp_set_object_terms($mypostid, 'simple', 'product_type');      
  
  
    $term_taxonomy_ids1 = wp_set_object_terms($mypostid, $_POST['listing_cat'], 'product_cat');     
  if ( is_wp_error( $term_taxonomy_ids ) ) {
	// There was an error somewhere and the terms couldn't be set.

} else {
	// Success! The post's categories were set.  
  

}  






 $term_taxonomy_ids2 = wp_set_object_terms($mypostid, $_POST['shipping_class'], 'product_shipping_class'); 
   $term_taxonomy_ids3 =  wp_set_object_terms($mypostid,  $_POST['brand'], 'product_brand');   





   
                       

if($_POST['option1']) {

        $parentid =  $mypostid;
        
        $posttitle    =  $_POST['post_title'];
        $choice1    =  $_POST['choice1'];
        $option1    =  $_POST['option1'];
        $msrp       =  $_POST['msrp'];
        $yourprice    =  $_POST['yourprice'];
        $price       =  $_POST['listPrice'];


  processVariablePA($parentid,$posttitle,$choice1,$option1,$msrp,$yourprice,$price);


}




    /// process variable product
          /// processVariablePA($parentid,$posttitle,$data);



echo $mypostid;
}












add_action('admin_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
?>
<script type="text/javascript"> 
   jQuery(document).ready( function() {  
   
          
 function processCustomfield (theid,index,field) {
 
 
                 var data = {
               action:'my_publishingfields',
                post_id:theid,
                mykey:index,
                mycustomvalue:field
                   };
      
                  jQuery.post(ajaxurl,data, function(response) {
                     
                  console.log(response);
                      
                       jQuery('.buffer4').html('<div id="message" class="error">Buffer server Delay process - '+response+'</div>');    
                              
                 
                    });  
                    
                    
                     window.thecustomfieldcounter++;  
 
 
 
 }  
 
 function processimage(url,postid) {

    
              
                
                  var data = {
                  action:'my_publishingimages',
                   server_path:url,
                   post_id:postid
                    }; 
             
                   jQuery.post(ajaxurl,data, function(response) {
                  console.log(response);
                   ///jQuery('.theids').prepend('MULTIMEDIA'+window.thecounter);
                   
                  console.log('IMaGE UPLOADED'); 
                   
                      });  
                       window.theimagecounter++;  
   
 
 }    
 
 
   function processwoogallery(url,postid) {

    
              
                  
                  var data = {
                  action:'my_publishingwoogallery',
                   server_path:url,
                   post_id:postid
                    }; 
             
                   jQuery.post(ajaxurl,data, function(response) {
                  console.log(response);
                   ///jQuery('.theids').prepend('MULTIMEDIA'+window.thecounter);
                      });  
                         
   
 
 }
   
 
 
 
  function processimagefeature(url,postid) {

    
              
                 
                  var data = {
                  action:'my_publishingimagesfeature',
                   server_path:url,
                   post_id:postid
                    }; 
             
                      
             
                   jQuery.post(ajaxurl,data, function(response) {
                  console.log(response);
                   ///jQuery('.theids').prepend('MULTIMEDIA'+window.thecounter);
                   
                  console.log('IMaGE UPLOADED'); 
                   
                      });  
                       window.theimagecounter++;  
   
        
                   

 
 }       
 
 
 function processobjectterm(thepostid,termval,product_cat) {
 
 
   var data = {
                  action:'my_publishingobjectterm',
                    post_id:thepostid,
                    termval:termval,
                    product_cat:product_cat
                    }; 
             
                   jQuery.post(ajaxurl,data, function(response) {
                  console.log(response);
                   ///jQuery('.theids').prepend('MULTIMEDIA'+window.thecounter);
                      });
 
 
 }   
                         
   
   
   
   
   
   
   function processTourismAPI(response, callback) {


        window.thecounter = 0;    

  var jsonText = JSON.stringify(xmlToJson(response));
         console.log(jsonText); 


        var $obj = jQuery.parseJSON(jsonText);

      console.log($obj);
 
    $obj2 = $obj.rowset.Product;
       
        
     
    console.log($obj2);
     
            

    
                
           //  for(var i in $obj2)
    //    {  
          //          console.log(i);
       //    console.log($obj2[i]); 
// console.log($obj2[i].product_record);   
             // i is the property name
     // obj3[i] is the property value - the item
   //     };


 


          
jQuery.each($obj2, function(index, element) {
// console.log(window.recordcount);
  console.log(index);
    console.log("-----------------------");
   console.log(element);   
  console.log("-----------------------");
 
   /// console.log(element.product_record.product_name);


  var OriginalID,PAGE_NUMBER,MAP_PRICE,CATALOG_PRICE,YOUR_PRICE,STOCKING_CODE,CATALOG_DESCRIPTION,CATALOG_COPY,WARRANTY,SMALL_WEB_IMAGE,LARGE_WEB_IMAGE,XL_WEB_IMAGE,WEIGHT,UoM,PACKAGE_TYPE,DELIVERY_PLANT,PID,SMID,UPC;  
  
  
     console.log(element.OriginalID);  
     $obj3 = element.OriginalID;  
          for(var i in $obj3)
        {  
          console.log($obj3[i]);
            OriginalID = $obj3[i];
            
            
             console.log(OriginalID);
          
        }

        
         $obj4 = element.CATALOG_DESCRIPTION;
       
     for(var i in $obj4)
        {                 

///jQuery('.thestatus').append($obj3[i]+'<br>');

var post_title = $obj4[i];
             // i is the property name
     // obj3[i] is the property value - the item
     
  console.log(post_title);
        };
        

       $obj5 = element.CATALOG_COPY; 
       
     for(var i in $obj5)
        { 

var post_content = $obj5[i];


console.log(post_content);
}



    $OPTION_1 = element.OPTION_1; 
       
     for(var i in $OPTION_1)
        { 

var OPTION_1 = $OPTION_1[i];

  
console.log(OPTION_1);
}

$CHOICE_1 = element.CHOICE_1; 
       
     for(var i in $CHOICE_1)
        { 

var CHOICE_1 = $CHOICE_1[i];

 console.log('------Choice---------');
console.log(CHOICE_1);
}
    
   // UoM
    
    //DELIVERY_PLANT
    //PID
   //SMID
   // UPC
     



 $obj6 = element.MAP_PRICE; 
       
     for(var i in $obj6)
        { 

MAP_PRICE = $obj6[i];


console.log('MAP_PRICE');
console.log(MAP_PRICE);
}



 $obj7 = element.CATALOG_PRICE; 
       
     for(var i in $obj7)
        { 
   console.log('CATALOG_PRICE');
CATALOG_PRICE = $obj7[i];



console.log(CATALOG_PRICE);
}



 $obj8 = element.YOUR_PRICE; 
       
     for(var i in $obj8)
        { 

YOUR_PRICE = $obj8[i];

console.log(YOUR_PRICE);

}



 $obj9 = element.STOCKING_CODE; 
       
     for(var i in $obj9)
        { 

STOCKING_CODE = $obj9[i];

console.log(STOCKING_CODE);

}



 $obj10 = element.LARGE_WEB_IMAGE; 
       
     for(var i in $obj10)
        { 

LARGE_WEB_IMAGE = $obj10[i];

LARGE_WEB_IMAGE  ="http://www.itaintjustdirt.com/GTSS/webstoreimages/LARGE_WEB_IMAGE/"+ LARGE_WEB_IMAGE ;

console.log(LARGE_WEB_IMAGE);
}



 $obj11 = element.XL_WEB_IMAGE; 
       
     for(var i in $obj11)
        { 

XL_WEB_IMAGE = $obj11[i];

 XL_WEB_IMAGE  ="http://www.itaintjustdirt.com/GTSS/webstoreimages/XL_WEB_IMAGE/"+ XL_WEB_IMAGE;

console.log(XL_WEB_IMAGE);

}



 $obj12 = element.WEIGHT; 
       
     for(var i in $obj12)
        { 

WEIGHT = $obj12[i];
console.log(WEIGHT);
}
    
    
     $brand = element.BRAND; 
       
     for(var i in $brand )
        { 

var BRAND = $brand [i];
console.log(BRAND);
}


 $obj13 = element.PACKAGE_TYPE; 
       
     for(var i in $obj13)
        { 

PACKAGE_TYPE1 = $obj13[i];


if(PACKAGE_TYPE1 == 'Small pack') { PACKAGE_TYPE='ground';} else if(PACKAGE_TYPE1 == 'LTL carrier'){PACKAGE_TYPE='ground';} else {PACKAGE_TYPE='call_for_freight';} 


console.log(PACKAGE_TYPE);
}



 $obj14 = element.Product_Hierarchy_Level_1; 
       
     for(var i in $obj14)
        { 

        console.log($obj14[i]);
        
        var mystring = $obj14[i];  
var newchar = ','
mystring = mystring.split('/').join(newchar);

console.log(mystring);

}


  window.productcategory = mystring;
  
  console.log('category string');
    console.log(window.productcategory);
         //for(var i in productcategory) {   
  
             ///wp_set_object_terms( $post_id, 'Races', 'product_cat' );  
    
    ///console.log(productcategory[i]);    /// }
  
  
  
  
 $obj15 = element.SMALL_WEB_IMAGE; 
       
     for(var i in $obj15)
        { 

SMALL_WEB_IMAGE = $obj15[i];

SMALL_WEB_IMAGE  ="http://www.itaintjustdirt.com/GTSS/webstoreimages/SMALL_WEB_IMAGE/"+ SMALL_WEB_IMAGE ;

console.log(SMALL_WEB_IMAGE);
}

  
  
  
  
 

 //$obj7 = element.Product_Hierarchy_Level_2; 
       
     //for(var i in $obj7)
      //  { 
      //   console.log($obj7[i]);
         
  //var mystring2 = $obj6[i];         
 // mystring += ",";     
//mystring += mystring2.split('/').join(newchar);

//console.log(mystring);

//}






       var listPrice = YOUR_PRICE + (YOUR_PRICE * .15)
     




        
                        
       
      var data = {
        action:'my_publishing',
post_title:post_title,
post_content:post_content,
listing_cat:window.productcategory,  
shipping_class:PACKAGE_TYPE,
brand:BRAND,
option1: OPTION_1 ,
choice1: CHOICE_1,
msrp:CATALOG_PRICE,
yourprice:YOUR_PRICE,
price:listPrice 
      };
      
        
      
jQuery.post(ajaxurl,data, function(response) {
   jQuery('.thestatus').html('<div id="message" class="updated"><p>Published!!!!!!!</strong> Please wait <img src="http://thecampingsite.wpengine.com/wp-content/uploads/2014/06/wpspin_light.gif"></div>');

   
  
 
      console.log('Published Post !!!!!!!---------------------------------');
         var thepostid =  response.substr(0, response.length-1); 
          console.log(thepostid);
           console.log('Published!!!!!!!---------------------------------');
          
          ///var thepostid =  response.substr(0, response.length-1); 

        jQuery('.thestatus').html('<div id="message" class="updated">Post Published ID '+window.thepostid+' <img src="http://thecampingsite.wpengine.com/wp-content/uploads/2014/06/wpspin_light.gif"></div>');
          
         
               
         
  jQuery('.thelistcount').html('Total Listings Added: '+window.thecounter);
        
         
        
                  console.log("----- FInISHED CUSTOM FIELDS -------------");
       
       
          ///  console.log(SMALL_WEB_IMAGE);
          ///       console.log(LARGE_WEB_IMAGE);
   
            var theimg = new Array();
        
        console.log("----- Process Small  -------------");   
        console.log(SMALL_WEB_IMAGE);
        console.log(LARGE_WEB_IMAGE);
     var img1 =  processimagefeature(LARGE_WEB_IMAGE,thepostid);
       
                 
                 
              
        /// console.log("----- Process 2 Feature -------------");   
 // var img2 = processimagefeature(LARGE_WEB_IMAGE,thepostid);
                // theimg.push(img2);
       ///   console.log("----- Process 3 -------------");   
         /// var img3 = processimage(XL_WEB_IMAGE,thepostid);   
            
                 // theimg.push(img3);
       //// var img1 =   var img2    var img3 =   
       
            /// var theimg = img1 +','+ img2  +','+ img3 ;
                   console.log("----- Process woogallery -------------");
                     ///console.log(theimg);
                            ///var myimgs =   theimg.join(",")
                processwoogallery(img1,thepostid);
                 
         console.log("----- Process Images -------------");
               
              


   ///update_post_meta( $post_id, '_regular_price', "1" );  
   
     processCustomfield (thepostid,'_regular_price',CATALOG_PRICE);
   
///update_post_meta( $post_id, '_sale_price', "1" );  

  processCustomfield (thepostid,'_sale_price',YOUR_PRICE);
  
  
  var listPrice = YOUR_PRICE + (YOUR_PRICE * .15)
 
/// update_post_meta( $post_id, '_price', "1" );    _msrp_price   _stock   _price

  processCustomfield (thepostid,'_price',listPrice);

 /// update_post_meta( $post_id, '_msrp_price', "1" );
 
   processCustomfield (thepostid,'_msrp_price',CATALOG_PRICE);
   
 

         //update_post_meta($post_id, '_sku', "");
         
           processCustomfield (thepostid,'_sku',OriginalID);
         
    // update_post_meta( $post_id, '_visibility', 'visible' );
    
      processCustomfield (thepostid,'_visibility','visible');
    
    // update_post_meta( $post_id, '_stock_status', 'instock');
    
      processCustomfield (thepostid,'_stock_status','instock');
    
         //update_post_meta( $post_id, '_featured', "no" );  
               
         
           processCustomfield (thepostid,'_featured',"no");
            
     //update_post_meta( $post_id, '_downloadable', 'no');
     
       processCustomfield (thepostid,'_downloadable','no');
     
     //update_post_meta( $post_id, '_virtual', 'no');
     
       processCustomfield (thepostid,'_virtual','no');
     
     
          // update_post_meta( $post_id, '_weight', "" );
          
       processCustomfield (thepostid,'_weight',"");     
          
          
          // update_post_meta( $post_id, '_manage_stock', "no" );
          
          
         processCustomfield (thepostid,'_manage_stock',"no" );   
          
             // update_post_meta( $post_id, '_backorders', "no" );      
             
             
           processCustomfield (thepostid,'_backorders',"no" );      
             
                // update_post_meta( $post_id, '_sold_individually', "" );   
                
                
             processCustomfield (thepostid,'_sold_individually',"");
                  
     //update_post_meta( $post_id, '_stock', "" );
     
       processCustomfield (thepostid,'_stock','');
     
     
          
         // update_post_meta( $post_id, 'total_sales', '0');   
         
         
           processCustomfield (thepostid,'total_sales','0');
         
    // update_post_meta( $post_id, '_purchase_note', "" );
  
       processCustomfield (thepostid,'_purchase_note','');
  
  

    // update_post_meta( $post_id, '_length', "" );
    // update_post_meta( $post_id, '_width', "" );
     //update_post_meta( $post_id, '_height', "" );
  
    // update_post_meta( $post_id, '_product_attributes', array());
    // update_post_meta( $post_id, '_sale_price_dates_from', "" );
     //update_post_meta( $post_id, '_sale_price_dates_to', "" );
    
     

    /// wp_set_object_terms($post_id, 'simple', 'product_type');      
    
      /// wp_set_object_terms($post_id, 'simple', 'product_shipping_class'); 
      /// wp_set_object_terms($post_id, 'simple', 'product_brand');         
          
          jQuery('.thestatus').html('<div id="message" class="updated">Processing Custom fields -  Please wait <img src="http://thecampingsite.wpengine.com/wp-content/uploads/2014/06/wpspin_light.gif"></div>');
           
           
           jQuery('.thestatus').html('<div id="message" class="updated">Processing Data-  Please wait <img src="http://thecampingsite.wpengine.com/wp-content/uploads/2014/06/wpspin_light.gif"></div>');
           
           
        
        
     



                 


     

      

          console.log('LOOP11');
            /// Add Custom Fields
          console.log(window.thecounter); 
           console.log('LOOP11'); 
            
             window.thecounter++;    



            


});  ///enD  Publishing   
  
       console.log('LOOP22');
   


});    



     
 console.log("Completed!!!");       
  

};
//// End API Processor Function
















   function xmlToJson(xml) {
	
	// Create the return object
	var obj = {};

	if (xml.nodeType == 1) { // element
		// do attributes
		if (xml.attributes.length > 0) {
		obj["@attributes"] = {};
			for (var j = 0; j < xml.attributes.length; j++) {
				var attribute = xml.attributes.item(j);
				obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
			}
		}
	} else if (xml.nodeType == 3) { // text
		obj = xml.nodeValue;
	}

	// do children
	if (xml.hasChildNodes()) {
		for(var i = 0; i < xml.childNodes.length; i++) {
			var item = xml.childNodes.item(i);
			var nodeName = item.nodeName;
			if (typeof(obj[nodeName]) == "undefined") {
				obj[nodeName] = xmlToJson(item);
			} else {
				if (typeof(obj[nodeName].push) == "undefined") {
					var old = obj[nodeName];
					obj[nodeName] = [];
					obj[nodeName].push(old);
				}
				obj[nodeName].push(xmlToJson(item));
			}
		}
	}
	return obj;
};
    
    
   function printToScreen(datas){
       
       jQuery('.thestatus').prepend(datas);       
       
       
       }  
     
 
   jQuery('.importall').click(function() {
         console.log('AAAAAAAAA');
         
         alert('aa');


       
         
    
          
          
           //alert(); 
          // alert(delta_date);   
          //return; //stop the execution of function
         
///jQuery('.thestatus').html('<div id="message" class="updated"><p><strong>AAAProcessing Product Import Data...</strong> Please wait </div>');

     console.log('AAAAAAAAA');
 //var jqxhr = jQuery.get( "http://wordpress.localhost/myxml.xml", function( data ) {
//
//})

 

       
        //   var data = {
       // action: 'my_getlatest',
       // delta_date:delta_date
      
        ///searchterm: searchterm ,
  //  };
      
  
//jQuery.post(ajaxurl,data, function(response) {
  //  console.log(response);
     //   
      //    console.log("That was the response");
      //    
        //  processTourismAPI(response);
              
                   
  //});
  
  
   
  
  
    
  jQuery.ajax({
    type: "GET",
    url: 'http://wordpress.localhost/getwoo.xml',
    dataType: "xml",
    success: function(xml){
        console.log(xml);
        
        
        processTourismAPI(xml);
    }
})   
        

        
        

  
     
  
        
    


  
 
             
       
        
  


});



 
 
// var jqxhr = jQuery.get( "http://edmqtz.info/ATDW-WebServiceSample.php", function( data ) {
//  console.log('success');


  jQuery('#takePictureField').change(function(e) {
  
   console.log('dfdfdfd');
    var file = jQuery(this).val();
    console.log(jQuery(this).val()); 
     
   console.log(event.target.files[0]);
   
   var file = event.target.files[0];
   
   var reader = new FileReader();

reader.onload = function(e) {
  var text = reader.result;
  
  console.log(text);
  
  var xmlDoc = jQuery.parseXML(text);
processTourismAPI(xmlDoc);
  
  
  
}

reader.readAsText(file);
    
   
    
    

    
    
    //resize(file, 487, 800, 70, "image/jpeg");
});


})
                                                
                                  
    

    
    
    





  




 


</script>  
<?php
}


?>
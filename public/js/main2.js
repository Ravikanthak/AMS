const formTop = document.querySelector('.form-top');
const formTopTextarea = document.querySelector('.form-top-textarea');
const formBottomTextarea = document.querySelector('.form-bottom-textarea');
const editableArea = document.querySelector('.editable_area');

const createSlotButton = document.querySelector('.create_slot_btn');
const createHTMLButton = document.querySelector('.create_html_btn');
const saveHTMLButton = document.querySelector('.save_html_btn');
const copyAllButton = document.querySelector('.copy_all_btn');
const previewHTMLButton = document.querySelector('.preview_html_btn');


createSlotButton.addEventListener('click', e => {

  var genarated_text = "";

  const text_content = formTopTextarea.value.trim()

  const text_contentx = `<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
      <meta name="description" content="Demonstration eBay Store - Professional eBay Template Design Solution - fiverr/merkrv">
      <meta name="keywords" content="ebay , ebay template, listing tempalte , ebay template generator, ebay template design, ebay templates uk, ebay templates html, ebay template software, ebay templates shop, ebay template editor, ebay template listing, ebay template free, ebay template shop, ebay template download, ebay template responsive, ebay template builder free, ebay template active content, ebay template auction, ebay template auctiva, ebay templates australia, ">
      <meta name="author" content="merkrv">
      <title>Demonstration eBay Store</title>
      <link rel="stylesheet" href="https://merkrv.com/ebay/Demonstration/styles.css" type="text/css">
  </head>
  <body>
      
  <div class="main_div">
  <input class="ravi" type="text" value="RaviMK">
  <p class="xxx">so purchase today !</p>
  <div class="topbanner_div">
      <div class="topbanner_in">
        <div class="topbanner"><img src="https://merkrv.com/ebay/Demonstration/topbanner.png"></div>
      </div>
  </div>
  
  
  <div class="promo_div [promo_cls]">
      <div class="promo_in">
        <p class="p1">Any change in the value of Dollar will Reflect a Price Change of Future Stock</p>
          <p class="p2">so purchase today !</p>
      </div>
  </div>
  
  
  <div class="mainbanner_div [img_main_cls]">
      <div class="mainbanner_in">
          <img src="[IMG_MAIN]" alt="[IMG_MAIN_ALT]">
      </div>
  </div>
  
  
  
  <div class="product_description_div">
      <div class="product_descrption_div_in">
  
          <div class="title_bar"><p>PRODUCT INFORMATION</p></div>
  
          <div class="description_sec1">
              <h1>[TITLE]</h1>
  
              <div class="description_text">[DESCRIPTION]</div>
  
              <p class="sub_title">FEATURES</p>
              <ul class="features">[FEATURES]</ul>
          </div>
  
  
          <div class="description_sec2">
              
              <div class="description_sec_half">
                  <div class="title_bar2"><p>SPECIFICATIONS</p></div>
  
                  <div class="bullets_div">
                      <ul>[SPECIFICATIONS]</ul>
                  </div>
              </div>
  
              <div class="description_sec_half">
                  <div class="title_bar2"><p>PACKAGE INCLUDES</p></div>
  
                  <div class="bullets_div">
                      <ul>[PACKAGE_INCLUDES]</ul>
                  </div>
              </div>
          
          </div>
  
      </div>
  </div>
  
  
  
  
  
  <div class="image_grid_div">
      <div class="image_grid_in">
  
          <div class="title_div"><p>PRODUCT IMAGES</p></div>
  
          <div class="image_grid">
  
              <div class="image_div [img1_cls]">
                  <div class="imgwrap"><img id="img" src="[img1]" alt="[img1_alt]"></div>
                  <div class="titlewrap">
                      <h2>[img1_txt]</h2>
                  </div>
              </div>
  
              <div class="image_div [img2_cls]">
                  <div class="imgwrap"><img id="img" src="[img2]" alt="[img2_alt]"></div>
                  <div class="titlewrap">
                      <h2>[img2_txt]</h2>
                  </div>
              </div>   
  
              <div class="image_div [img3_cls]">
                  <div class="imgwrap"><img id="img" src="[img3]" alt="[img3_alt]"></div>
                  <div class="titlewrap">
                      <h2>[img3_txt]</h2>
                  </div>
              </div>
  
              <div class="image_div [img4_cls]">
                  <div class="imgwrap"><img id="img" src="[img4]" alt="[img4_alt]"></div>
                  <div class="titlewrap">
                      <h2>[img4_txt]</h2>
                  </div>
              </div>   
  
              <div class="image_div [img5_cls]">
                  <div class="imgwrap"><img id="img" src="[img5]" alt="[img5_alt]"></div>
                  <div class="titlewrap">
                      <h2>[img5_txt]</h2>
                  </div>
              </div>
  
              <div class="image_div [img6_cls]">
                  <div class="imgwrap"><img id="img" src="[img6]" alt="[img6_alt]"></div>
                  <div class="titlewrap">
                      <h2>[img6_txt]</h2>
                  </div>
              </div>
  
          </div>
      </div>
  </div>
  
  
  
  
  
  
  
  
  <div class="feedback_div">
      <div class="feedback_div_in">
          <div class="feedback_div_in_in">
  
              <div class="left">
                  <p>WHY BUY FROM US?</p>
                  <div><img class="why_img" src="https://merkrv.com/ebay/Demonstration/why.png"></div>
              </div>
  
              <div class="right">
                  <div class="box">
                      <div class="title">
                          <p>LATEST PRODUCT REVIEWS</p>
                          <a target="_blank" href="https://www.ebay.com.au/fdbk/feedback_profile/____USERID____" class="button">View All Reviews</a>
                      </div>
  
                      <div class="rating">
                      <p class="pp1 pp11"></p>
                      <p class="pp2 pp21"><span class="stars"></span></p>
                      </div>
  
                      <div class="rating">
                      <p class="pp1 pp12"></p>
                      <p class="pp2 pp22"><span class="stars"></span></p>
                      </div>
  
                      <div class="rating">
                      <p class="pp1 pp13"></p>
                      <p class="pp2 pp23"><span class="stars"></span></p>
                      </div>
  
                      <div class="rating">
                      <p class="pp1 pp14"></p>
                      <p class="pp2 pp24"><span class="stars"></span></p>
                      </div>
  
                      <div class="rating">
                      <p class="pp1 pp15"></p>
                      <p class="pp2 pp25"><span class="stars"></span></p>
                      </div>
  
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  
  
  
  
  <div class="policy_div">
      <div class="policy_div_in">
  
        <div class="title"><p>POLICIES INFORMATION</p></div>
  
          <div class="policy_div_in_in">
  
              <div class="sub_title">
                  <div><p class="payment ico">PAYMENT</p></div>
              </div>
  
              <div class="cont">
                  <div>
                      <p class="p2">We accept PayPal. PayPal is the fastest way to pay on eBay. You do not require a PayPal account and you can use your credit or debit card to make PayPal payments.</p>
                  </div>
              </div>
  
  
              <div class="sub_title">
                  <div><p class="shipping ico">Shipping & Handling</p></div>
              </div>
  
              <div class="cont">
                  <div>
                      <p class="p2">We deliver your order within 1-5 business days. Orders that are placed over the weekend will be shipped the next business day. Once post has collected your parcel you will receive an email that will include your tracking number.</p>
                  </div>
              </div>
  
              <div class="sub_title">
                  <div><p class="returns ico">Returns</p></div>
              </div>
  
              <div class="cont">
                  <div>
                      <p class="p2">30 Day returns. The buyer pays return postage. 15% restocking fee may apply. Reasonable conditions apply.</p>
                  </div>
              </div>
  
          
              <div class="sub_title">
                  <div><p class="feedback ico">FEEDBACK</p></div>
              </div>
  
              <div class="cont">
                  <div>
                      <p class="p2">Our goal is always 100% complete customer satisfaction. Please do assist us here, and take the short time to send through your feedback. <br><br>
                      If for any reason you are not satisfied please contact us before leaving feedback. We strive for 100% satisfied loyal customers who are happy to shop with us again & again.<br><br>
                      Shop With Confidence.</p>
                  </div>
              </div>
  
  
              <div class="sub_title">
                  <div><p class="about ico">About Us</p></div>
              </div>
  
              <div class="cont">
                  <div>
                      <p class="p2">We are an Australian family business so you can have confidence when shopping with us, as we're dedicated to delivering exceptional customer service and sell only quality products.</p>
                  </div>
              </div>
  
          </div>
  
      </div>
  </div>
  
  
  
  
  <div class="footer_div">
      <div class="footer_in">
          <div class="footer_in_in">
  
              <div class="left"><img src="https://merkrv.com/ebay/Demonstration/logo.png"></div>
  
              <div class="mid"><p>ANY QUESTIONS? ASK US<br><span>We happily respond within 24hrs</span></p></div>
              
              <div class="right">
      
                  <div class="se2">
                      <img src="https://merkrv.com/ebay/Demonstration/lady.png">
                  </div>
      
                  <div class="se1">
                      <span class="line1">Dedicated To</span>
                      <span class="line2">Five Star</span>
                      <span class="line3">Customer Support</span>
                      <span class="line4"></span>          
                  </div>
              
              </div>
  
          </div>
      </div>
      
      
      <div class="copyright_div">
          <div class="copyright_div_in">
          <a target="_blank" href="https://my.ebay.com.au/ws/eBayISAPI.dll?AcceptSavedSeller&linkname=includefavoritestore&sellerid=___USER_ID___" class="a1">Add Us to Favourite Seller</a>
          <span class="a2">Copyright &copy; Demonstration. All Rights Reserved : <img src="https://merkrv.com/ebay/Demonstration/logomerk.png"></span>
          </div>
      </div>
  </div>
  
  
  
  
  
  </div>
  
  <div class="footer_space"></div>
  
  </body>
  </html>
  `




  // Test Only
  // var promoText1 = document.querySelector(".step_title");
  // promoText1.style.display = 'none'
  //console.log(promoText1)

  
  // Promo Section
  if (text_content.includes(`[promo_cls]`)) {

    genarated_text = genarated_text +   `<div class='dyn_sec dyn_sec_promo'>
    <div class='img_div'>
      <div class='inputs'>
        <div class='name'><label>Text Line 1</label></div>
        <div class='input'>
          <input class='promo_new_link1 new_input' value='Any change in the value of Dollar will Reflect a Price Change of Future Stock'>
        </div>
        <div class='name'><label>Text Line 2</label></div>
        <div class='input'>
          <input class='promo_new_link2 new_input' value='so purchase today !'>
        </div>
      </div>  
      <div class='disable_button'>
        <button class='img_new_dis_btn dis_btn'>Disable</button>
      </div>
    </div>
  </div>`
  }
  // Promo Section


  

  // Main Image Banner Section
  if (text_content.includes(`[img_main_cls]`)) {
    genarated_text = genarated_text +   `<div class='dyn_sec dyn_sec_image_main'>
    <div class='img_div'>
      <div class='number'><span>Main Image</span></div>
      <div class='inputs'>
        <div class='name'><label>Image Link</label></div>
        <div class='input'>
          <input class='img_new_link new_input' value=''>
          <button class='paste_btn btn_ico'></button>
          <button class='clear_btn btn_ico'></button>
        </div>
        <div class='name'><label>ALT Tag</label></div>
        <div class='input'>
          <input class='img_new_link_alt new_input' value=''>
          <button class='paste_btn btn_ico'></button>
          <button class='clear_btn btn_ico'></button>
        </div>
      </div>  
      <div class='disable_button'>
        <button class='img_new_dis_btn dis_btn'>Disable</button>
      </div>
    </div>
  </div>`
  }
  // Main Image Banner Section




  // Image Section
  genarated_text = genarated_text + "<div class='dyn_sec_images'>"
  for(a = 1 ; a <= 12 ; a++ ){

    if (text_content.includes(`[img${a}]`)) {
      genarated_text = genarated_text + inputImageSlot(a)
    }

  }
  genarated_text = genarated_text + "</div>"

  function inputImageSlot(num){
    return `
    <div class='dyn_sec dyn_sec_image${num}'>
      <div class='img_div'>
        <div class='number'><span>${num}</span></div>
        <div class='inputs'>
          <div class='name'><label>Image Link</label></div>
          <div class='input'>
            <input class='img${num}_new_link new_input' value=''>
            <button class='paste_btn btn_ico'></button>
            <button class='clear_btn btn_ico'></button>
          </div>
          <div class='name'><label>Features</label></div>
          <div class='input'>
            <input class='img${num}_new_link_txt new_input' value=''>
            <button class='paste_btn btn_ico'></button>
            <button class='clear_btn btn_ico'></button>
          </div>
          <div class='name'><label>ALT Tag</label></div>
          <div class='input'>
            <input class='img${num}_new_link_alt new_input' value=''>
            <button class='paste_btn btn_ico'></button>
            <button class='clear_btn btn_ico'></button>
          </div>
        </div>  
        <div class='disable_button'>
          <button class='img_new_dis_btn dis_btn'>Disable</button>
        </div>
      </div>
    </div>`
  }
  // Image Section


  // Title Section
  if (text_content.includes('[TITLE]')) {
    genarated_text = genarated_text + `<div class='line'></div><div class='dyn_sec dyn_sec_title'><label>Product Title</label><input id='title_new_link' value=''></div><div class='line'></div>`
  }
  // Title Section


  // Description Section
  if (text_content.includes('[DESCRIPTION]')) {
    genarated_text = genarated_text + `<div class='dyn_sec dyn_sec_des'><label>Product Description</label><textarea class='content' id='editor' autofocus></textarea></div><div class='line'></div>`
  }
  // Description Section

  
  // Features Section
  if (text_content.includes('[FEATURES]')) {
    genarated_text = genarated_text + `<div class='dyn_sec dyn_sec_fea'><div><label>Product Features</label><button class='fea_dis_btn dis_btn'>Disable</button></div><textarea class='features' id='features' autofocus></textarea></div>`
  }
  // Features Section


  // Specifications Section
  if (text_content.includes('[SPECIFICATIONS]')) {
    genarated_text = genarated_text + `<div class='dyn_sec dyn_sec_spec'><div><label>Product Specifications</label></div><textarea class='specifications' id='specifications' autofocus></textarea></div>`
  }
  // Specifications Section


  // Package Section
  if (text_content.includes('[PACKAGE_INCLUDES]')) {
    genarated_text = genarated_text + `<div class='dyn_sec dyn_sec_pkg'><div><label>Package Contents</label></div><textarea class='packagecontents' id='packagecontents' autofocus></textarea></div>`
  }
  // Package Section


  // Set and Display Editable Fields to User
  editable_area.innerHTML  =  genarated_text;


  // // Load Ritch Text Editor
  $(document).ready(function() {
    $('.content').richText({
      fonts: false,
      fileUpload: false,
      videoEmbed: false,
    });
  });


});



// Main Image and #img DISABLE BUTTON
$("body").on("click",".img_new_dis_btn",function(e){

  $(this).parent().parent().parent().toggleClass('disable_section') // Disable DIV Section
  $(this).parent().siblings('div.inputs').children('.input').children('.new_input').prop('disabled', true) // Disable Input Fields
  $(this).parent().siblings('div.inputs').children('.input').children('.btn_ico').toggleClass('btn_hide') // Disable Paste/Clear Icons

  if ($(this).text() == 'Disable' ) {
    $(this).text('Enable')
    $(this).parent().siblings('div.inputs').children('.input').children('.new_input').prop('disabled', true)
  }
  else{
    $(this).text('Disable')
    $(this).parent().siblings('div.inputs').children('.input').children('.new_input').prop('disabled', false)
  }

})

// Features DISABLE BUTTON
$("body").on("click",".fea_dis_btn",function(){

  $(this).parent().parent().toggleClass('disable_section') // Disable DIV Section
  $(this).parent().siblings('.features').attr('readonly', true); // Readonly Textarea

  if ($(this).text() == 'Disable' ) {
    $(this).text('Enable')
    $(this).parent().siblings('.features').attr('readonly', true)
  }
  else{
    $(this).text('Disable')
    $(this).parent().siblings('.features').attr('readonly', false)
  }
})

// Specifications DISABLE BUTTON
$("body").on("click",".spec_dis_btn",function(){

  $(this).parent().parent().toggleClass('disable_section')
  $(this).parent().siblings('.specifications').attr('readonly', true); 

  if ($(this).text() == 'Disable' ) {
    $(this).text('Enable')
    $(this).parent().siblings('.specifications').attr('readonly', true)
  }
  else{
    $(this).text('Disable')
    $(this).parent().siblings('.specifications').attr('readonly', false)
  }
})

// Package Contents DISABLE BUTTON
$("body").on("click",".pkg_dis_btn",function(){

  $(this).parent().parent().toggleClass('disable_section') 
  $(this).parent().siblings('.packagecontents').attr('readonly', true);

  if ($(this).text() == 'Disable' ) {
    $(this).text('Enable')
    $(this).parent().siblings('.packagecontents').attr('readonly', true)
  }
  else{
    $(this).text('Disable')
    $(this).parent().siblings('.packagecontents').attr('readonly', false)
  }
})




// -----------------------// -----------------------// -----------------------// -----------------------// -----------------------// -----------------------// -----------------------// -----------------------// -----------------------// -----------------------// -----------------------// -----------------------




// CREATE HTML CODE BUTTON
createHTMLButton.addEventListener('click' , e => {

  const text_content = formTopTextarea.value.trim()
  
  var finalHTML = text_content;



  // Promo Text Line
  if (finalHTML.includes(`[promo_cls]`)) {
    if ( $(`.dyn_sec_promo `).hasClass('disable_section') ) {  // If slot is disabled
        var title_section = finalHTML.replace( `[promo_cls]` , `promo_div_disable` )
        finalHTML = title_section
    } 
    else{ // If image slot enabled
        var title_section = finalHTML.replace( `[PROMO_1]` , document.querySelector('.promo_new_link1').value )
        finalHTML = title_section

        var title_section2 = finalHTML.replace( `[PROMO_2]` , document.querySelector('.promo_new_link2').value )
        finalHTML = title_section2
    }
  }
  // Promo Text Line



  // Main Image Section
  if (finalHTML.includes(`[img_main_cls]`)) {
    if ( $(`.dyn_sec_image_main `).hasClass('disable_section') ) {  // If slot is disabled
        var img_main_section = finalHTML.replace( `[img_main_cls]` , `img_main_div_disable` )
        finalHTML = img_main_section
    } 
    else{ // If image slot enabled
        var img_main_section = finalHTML.replace( `[IMG_MAIN]` , document.querySelector('.img_new_link').value )
        finalHTML = img_main_section

        var img_main_section2 = finalHTML.replace( `[IMG_MAIN_ALT]` , document.querySelector('.img_new_link_alt').value )
        finalHTML = img_main_section2
    }
  }
  // Main Image Section



  // Product Title Section
  if (finalHTML.includes(`[TITLE]`)) {
    var product_title_section = finalHTML.replace( `[TITLE]` , document.querySelector('#title_new_link').value )
    finalHTML = product_title_section
  }
  // Product Title Section



  // Description Section
  if (finalHTML.includes(`[DESCRIPTION]`)) {
    var description_section = finalHTML.replace( `[DESCRIPTION]` , document.querySelector('.richText-editor').innerHTML )
    finalHTML = description_section
  }
  // Description Section



  // Features Section
  if ($(`.dyn_sec`).hasClass(`dyn_sec_fea`)) { // Check if slot existis
      
    if ( $(`.dyn_sec_fea`).hasClass('disable_section') ) {  // If slot disabled
      var features_section = finalHTML.replace( `<p class="sub_title">FEATURES</p>` , "" ) // Remove Features title
      features_section = features_section.replace( `<ul class="features">[FEATURES]</ul>` , "" ) // Remove Features content
      finalHTML = features_section
    }
    else{ // If slot enabled
      var featuresData = ""
      var featuresTextareaVal = $('#features').val().trim().split(/\n/); // Split features text into new lines
      featuresTextareaVal.forEach(line => {
        if (line != "") {
          featuresData = featuresData + "<li>" + line + "</li>"; // Add LI tags for each new text lines
        }
      })
      var features_section = finalHTML.replace( `[FEATURES]` , featuresData )
      finalHTML = features_section
    }
  }
  // Features Section


  // Specifications Section
  if ($(`.dyn_sec`).hasClass(`dyn_sec_spec`)) {
      
    if ( $(`.dyn_sec_spec`).hasClass('disable_section') ) { } 
    else{ 
      var specificationsData = ""
      var specificationsTextareaVal = $('#specifications').val().trim().split(/\n/);
      specificationsTextareaVal.forEach(line => {
        if (line != "") {
          specificationsData = specificationsData + "<li>" + line + "</li>";
        }
      })
      var specifications_section = finalHTML.replace( `[SPECIFICATIONS]` , specificationsData )
      finalHTML = specifications_section
    }
  }
  // Specifications Section


  // Package Section
  if ($(`.dyn_sec`).hasClass(`dyn_sec_pkg`)) {
      
    if ( $(`.dyn_sec_pkg`).hasClass('disable_section') ) { } 
    else{ 
      var packagecontentsData = ""
      var packagecontentsTextareaVal = $('#packagecontents').val().trim().split(/\n/);
      packagecontentsTextareaVal.forEach(line => {
        if (line != "") {
          packagecontentsData = packagecontentsData + "<li>" + line + "</li>";
        }
      })
      var package_contents_section = finalHTML.replace( `[PACKAGE_INCLUDES]` , packagecontentsData )
      finalHTML = package_contents_section
    }
  }
  // Package Section



  // Image Section
  if (finalHTML.includes(`[img1]`)) {
    if ( $(`.dyn_sec_image1`).hasClass('disable_section') ) {  // If image slot disabled
      var images_section = finalHTML.replace( `[img1_cls]` , `image_div_disable` )
      finalHTML = images_section
    } 
    else{ // If image slot enabled
      var images_section = finalHTML.replace( `[img1]` , document.querySelector('.img1_new_link').value )
      images_section = images_section.replace( `[img1_txt]` , document.querySelector('.img1_new_link_txt').value )
      images_section = images_section.replace( `[img1_alt]` , document.querySelector('.img1_new_link_alt').value )
      finalHTML = images_section
    }
  }

  if (finalHTML.includes(`[img2]`)) {
    if ( $(`.dyn_sec_image2`).hasClass('disable_section') ) {  // If image slot disabled
      var images_section = finalHTML.replace( `[img2_cls]` , `image_div_disable` )
      finalHTML = images_section
    } 
    else{ // If image slot enabled
      var images_section = finalHTML.replace( `[img2]` , document.querySelector('.img2_new_link').value )
      images_section = images_section.replace( `[img2_txt]` , document.querySelector('.img2_new_link_txt').value )
      images_section = images_section.replace( `[img2_alt]` , document.querySelector('.img2_new_link_alt').value )
      finalHTML = images_section
    }
  }

  if (finalHTML.includes(`[img3]`)) {
    if ( $(`.dyn_sec_image3`).hasClass('disable_section') ) {  // If image slot disabled
      var images_section = finalHTML.replace( `[img3_cls]` , `image_div_disable` )
      finalHTML = images_section
    } 
    else{ // If image slot enabled
      var images_section = finalHTML.replace( `[img3]` , document.querySelector('.img3_new_link').value )
      images_section = images_section.replace( `[img3_txt]` , document.querySelector('.img3_new_link_txt').value )
      images_section = images_section.replace( `[img3_alt]` , document.querySelector('.img3_new_link_alt').value )
      finalHTML = images_section
    }
  }

  if (finalHTML.includes(`[img4]`)) {
    if ( $(`.dyn_sec_image4`).hasClass('disable_section') ) {  // If image slot disabled
      var images_section = finalHTML.replace( `[img4_cls]` , `image_div_disable` )
      finalHTML = images_section
    } 
    else{ // If image slot enabled
      var images_section = finalHTML.replace( `[img4]` , document.querySelector('.img4_new_link').value )
      images_section = images_section.replace( `[img4_txt]` , document.querySelector('.img4_new_link_txt').value )
      images_section = images_section.replace( `[img4_alt]` , document.querySelector('.img4_new_link_alt').value )
      finalHTML = images_section
    }
  }

  if (finalHTML.includes(`[img5]`)) {
    if ( $(`.dyn_sec_image5`).hasClass('disable_section') ) {  // If image slot disabled
      var images_section = finalHTML.replace( `[img5_cls]` , `image_div_disable` )
      finalHTML = images_section
    } 
    else{ // If image slot enabled
      var images_section = finalHTML.replace( `[img5]` , document.querySelector('.img5_new_link').value )
      images_section = images_section.replace( `[img5_txt]` , document.querySelector('.img5_new_link_txt').value )
      images_section = images_section.replace( `[img5_alt]` , document.querySelector('.img5_new_link_alt').value )
      finalHTML = images_section
    }
  }

  if (finalHTML.includes(`[img6]`)) {
    if ( $(`.dyn_sec_image6`).hasClass('disable_section') ) {  // If image slot disabled
      var images_section = finalHTML.replace( `[img6_cls]` , `image_div_disable` )
      finalHTML = images_section
    } 
    else{ // If image slot enabled
      var images_section = finalHTML.replace( `[img6]` , document.querySelector('.img6_new_link').value )
      images_section = images_section.replace( `[img6_txt]` , document.querySelector('.img6_new_link_txt').value )
      images_section = images_section.replace( `[img6_alt]` , document.querySelector('.img6_new_link_alt').value )
      finalHTML = images_section
    }
  }
  // Image Section


  // Set Final HTML to Bottom Textarea
  formBottomTextarea.innerHTML = finalHTML


})



// SAVE HTML CODE BUTTON
//saveHTMLButton.addEventListener('click' , (e) => {

  // var finalTextSave = "";

  // var finalTextSave = finalTextSave + main_text1 + "[tags-s]"

  // if ($('.img1_new_link').hasClass('dis')) { }
  // else{
  //   var img_new_link_val = $('.img1_new_link').val()
  //   var img1 = `<img id="img1" src="[img1-s]${img_new_link_val}]]">`
  //   finalTextSave = finalTextSave + img1
  // }

  // var title_new_link_val = document.getElementById('title_new_link').value
  // var title = `<p id="title">[title-s]${title_new_link_val}]]</p>`
  // finalTextSave = finalTextSave + title

  // var description_new_link_val = document.getElementById('editor').value
  // var des = `<p id="des">[des-s]${description_new_link_val}]]</p>`
  // finalTextSave = finalTextSave + des

  // var finalTextSave = finalTextSave + "[tags-e]" + main_text2

  // formBottomTextarea.innerHTML = finalTextSave



  // var blob = new Blob([formBottomTextarea.value], {
  //     type: "text/plain;charset=utf-8;",
  // });
  // saveAs(blob, "html_code.txt");


//})





// PREVIEW HTML BUTTON
previewHTMLButton.addEventListener('click' , (e) => {

	var dtype="";
	var chrset='<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
	var wTB = window.open("","TBpopup0",",,directories=no,menubar=yes,status=yes,toolbar=yes,resizable=yes,scrollbars=yes,screenY=0,top=0,screenX=0,left=0" );
	wTB.document.writeln(dtype+'\n<html><head><title>Preview</title>'+chrset+'</head><body>');
	wTB.document.writeln(formBottomTextarea.value);
	wTB.document.writeln("<hr><form><center><input type=\"submit\" value=\"Close Window\" onClick=\"window.close();return false; \"></center></form>" );
	wTB.document.writeln("</body></html>" );
	wTB.document.close() ;
	if (document.focus){wTB.document.focus(true)} else if (window.focus){wTB.focus(true)}; //<-- ??

})


// INPUT IMAGR LINK CLEAR BUTTON
$("body").on("click","#img1_new_clear_btn",function(e){
  $(this).siblings('.new_input').val("")
});

// INPUT ALT TAG CLEAR BUTTON
$("body").on("click","#img1_new_clear_btn",function(e){
  $(this).siblings('.new_input').val("")
});


// COPY HTML CODE
const clipboard = new ClipboardJS('.copy_all_btn');
copyAllButton.addEventListener('click' , (e) => { })



// DELETE/CLEAR BUTTON
$( document ).ready(function() {

  $("body").on("click",".clear_btn ",function(e){
    //$(this).value=""
    console.log($(this).value)
  });
});



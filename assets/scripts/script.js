

//  Doc ready starts
$(document).ready(function(){

   
    // const radio = $('.radio-btn')
    // $(radio).click(function(){
    //     $('.form-check-input').addClass('checked')
    // })

    const termsButton = document.querySelectorAll('.termsClick')
    const popupClose = document.querySelector('.popupClose')
    const popupOuter = document.querySelector('.popupOuter')
    termsButton.forEach((terms)=>{
        terms.addEventListener('click',()=>{
            popupOuter.classList.add('show')
        })
    })
    
    popupClose.addEventListener('click', function(){
        popupOuter.classList.remove('show')
    })

    const msgclose = document.querySelector('.msgclose')
//console.log(12);
if (msgclose) { 
     msgclose.addEventListener('click', ()=>{
         //   this.classList.add()
         const fullUrl = window.location.href;
            const hash = window.location.hash
            const remainingUrl = fullUrl.replace(hash, '');
            const outerOverlay = document.querySelector('.participation')
           outerOverlay.classList.remove('active')
           if(hash === '#getCoupon') {
            window.location.replace(remainingUrl);
           }
           
            })
}

  /*Invoice check start*/
  
  // const rootUrl = window.location.origin
   const rootUrl = window.location.origin + '/projects/pert/'
 const invoiceUrl = `${rootUrl}/inc/ajax-invoice-check.php`
// console.log(invoiceUrl);


 $('#inv-number').on('change', function(){
  //var invZone = $('#zone').val()
     var invoiceNo = $('#inv-number').val();
     console.log(invoiceNo);
     $.ajax({
         type: 'POST',
         url: invoiceUrl,
         data: {
          invoice: invoiceNo,
        //   zone: invZone // Add invZone to the data object
      },
         success:function(html){
      //    console.log(html);
             $("#invoice_exists").html(html)
             var inverror = $('#invoice_exists p').html();
           //  console.log(inverror);
          //   var lastSeven = inverror.substr(inverror.length - 7);
            //  if(lastSeven === 'exists.') {
            //   document.getElementById('getCoupon').reset();
            //   // setTimeout(function() {
            //   //     location.href=`${rootUrl}/projects/persil`
            //   //   }, 900);
            //  }
          //   document.getElementById('getCoupon').reset();
            
             

         }
     });

 })

 /*Invoice check ends*/
   


            //  Image check starts
            $('#inputInvoice').on('change', function(){
                var inputInvoice = $('#inputInvoice').val();
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            
                if (!allowedExtensions.exec(inputInvoice)) {
                //    alert('Invalid file type! Please select a JPG, JPEG, PNG, or GIF image.');
                    $('#invoice-err').html('<p class="errormsg">Invalid file type! Please select a JPG, JPEG, PNG, or GIF image.</p>')
                    // Clear the input field if an invalid file is selected
                    $(this).val('');
                    return false;
                } else {
                    $('#invoice-err .errormsg').remove();
                }
            
            });
            
            // Image check ends

            // Submit


            
$('#submit-button').on('click', function(e){
  //  e.preventDefault();
    const fName = $('#first-name').val();
    if(fName.length < 3) {
        $('#fname-err').html('<p class="errormsg">Please enter a valid name</p>');
        document.getElementById('first-name').focus();
        return false;
    } else {
        $('#fname-err .errormsg').remove();
    }



    const mobile = $('#inputNumber').val();
    if(mobile.length !== 9 && mobile.length !== 10) {
 //  if(!(mobile.length ===9)) { //|| !$.isNumeric(mobile)
      $('#mobile-err').html('<p class="errormsg">Please enter a valid phone number.<br>Number format : 012000000 </p>');
      document.getElementById('inputNumber').focus();
      $('.number-wraper').addClass('active')
      return false;
  } else {
      $('#mobile-err .errormsg').remove();
  }
  
  const email = $('#inputEmail4').val();
  const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
  if(!regex.test(email)){    
  /*alert("invalid email id");    
  return regex.test(email);  */  
      $('#email-err').html('<p class="errormsg">Please enter a valid email</p>');
      document.getElementById('inputEmail4').focus();
      return false;
  } else {
      $('#email-err .errormsg').remove();
  }

  const gender = $('#gender').val();
  //console.log(gender);
  
  if(gender.length < 1 ) {
      $('#gender-err').html('<p class="errormsg">Please select Gender</p>');
      document.getElementById('gender').focus();
      return false;
  } else {
      $('#gender-err .errormsg').remove();
  }

   const city = $('#city').val();
   //console.log(city);
   
   if(city.length < 1 ) {
       $('#city-err').html('<p class="errormsg">Please select Region</p>');
       document.getElementById('city').focus();
       return false;
   } else {
       $('#city-err .errormsg').remove();
   }

   const ocity = $('#ocity-name')
   //console.log(ocity);
   if($(ocity).hasClass('hideNow')) {
    // console.log(56);
   } else {
    const ocityvalue = ocity.val();

   if(ocityvalue.length < 1 ) {
       $('#city-err').html('<p class="errormsg">Please enter city</p>');
       document.getElementById('ocityvalue').focus();
       $('#ocity-name').addClass('err-border');
       return false;
   } else {
       $('#city-err .errormsg').remove();
       $('#ocity-name').removeClass('err-border');
   }
   }



  
 // Check if the checkbox is ticked
 if (!$('#customRadio1').prop('checked')) {
    $('#accept-err').html('<p class="errormsg text-danger">Please accept the Terms and Conditions</p>');
    return false;
} else {
    $('#accept-err').html(''); // Clear error message
    // Proceed with your action, e.g., form submission or redirection
   // window.location.href = 'form.php'; // Redirect to form.php
}

    if (!$("#customRadio1").prop("checked")) {
        $('#accept-err').html('<p class="errormsg">Please accept the Terms and Conditions</p>');
        return false;
    } else {
        // console.log(456);
        $('#accept-err .errormsg').remove();
      //  window.location.href = 'submit.php';
    }
   
    
    const currentUrl = window.location.href
  //   console.log(currentUrl);
    const reqUrl = currentUrl.replace('#submitForm','');
    let formSubmitted = currentUrl.includes("#submitForm");
    // if(formSubmitted === true) {
    //     console.log(4545);
    //     const msgclose = document.querySelector('.msgclose')
    //     msgclose.addEventListener('click', ()=>{
    //         console.log(123)
    //         const outerOverlay = document.querySelector('.outer-overlay')
    //         outerOverlay.classList.remove('active')
    //         window.location.replace(reqUrl);
    //         })
    // } 

    
}) 


            // Submit


            const invoice2Img = document.querySelector('.inputInvoice')
            const fileLabel2Img = document.querySelector('.invoice-wraper')
            
            const image2CopySpan = document.querySelector('.invoice-wraper')
            if(fileLabel2Img){
            fileLabel2Img.addEventListener('click', ()=>{
              //  console.log(55);
                document.getElementById('inputInvoice').click()
                image2CopySpan.classList.add('hideNow')
                invoice2Img.classList.remove('hideNow')
            })
        }

        
// City Other


 
$('#city').change(function() {
    
    var city = $('#city').find(":selected").text();
    if((city === 'Other') || (city === 'أخرى')) {
        $('#ocity-name').removeClass('hideNow');
        $('#ocity-name').addClass('cityName');
        $('#ocity-name').prop('required',true);
    } else {
        if(!$('#ocity-name').hasClass('active')){
            $('#ocity-name').addClass('hideNow');
            $('#ocity-name').removeClass('cityName');
            $('#ocity-name').prop('required',false);
        }
    }
    })



    //  Invoice submission

    

const invoice = document.querySelector('.inputInvoice')
const fileLabel = document.querySelector('.invoice-wraper')
//console.log(fileLabel)
if(fileLabel){
    fileLabel.addEventListener('click', ()=>{
      //  document.getElementById('inputInvoice').click()
        fileLabel.classList.add('hideNow')
        invoice.classList.remove('hideNow')
    })
}


$('#submit-receipt').on('click', function(){
    


    const invNumber = $('#inv-number').val();
    if(invNumber.length < 2) {
        $('#inv-number-err').html('<p class="errormsg">Please enter a valid invoice number</p>');
        document.getElementById('inv-number').focus();
        return false;
    } else {
        $('#inv-number-err .errormsg').remove();
    }

    const invoice = $('#inputInvoice').val();
   
    if(invoice.length < 1 ) {
       //  console.log(invoice);
        $('#invoice-err').html('<p class="errormsg">Please upload a picture in jpg/png/gif format </p>');
        $('#inputInvoice').val("");
        return false;
    } else {
     //   console.log(invoice.length);
        $('#invoice-err .errormsg').remove();
    }

})

}) 
// Doc ready ends
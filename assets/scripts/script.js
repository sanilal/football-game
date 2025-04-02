

//  Doc ready starts
$(document).ready(function(){

   
    // const radio = $('.radio-btn')
    // $(radio).click(function(){
    //     $('.form-check-input').addClass('checked')
    // })
    const formHeader = document.querySelector('.form-header')
    const formContainer = document.querySelector('.form-container')
    const formHeaderHeight = formHeader.offsetHeight
    // console.log(formHeaderHeight);
    formContainer.style.marginTop = `${formHeaderHeight}px`
    // console.log(formContainer.style.marginTop);
    
    
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

 
        
            
            // Image check ends

            // Submit


            
            $('#submit-button').on('click', function () {
                const name = $('#name').val();
                if (name.length < 3) {
                    $('#name-err').html('<p class="errormsg">الرجاء إدخال اسم صالح</p>');
                    document.getElementById('name').focus();
                    document.getElementById('name').classList.add('err-border');
                    return false;
                } else {
                    $('#name-err .errormsg').remove();
                    document.getElementById('name').classList.remove('err-border');
                }
        
                const mobile = $('#inputNumber').val();
                if (!(mobile.length ===9)) {
                    $('#mobile-err').html('<p class="errormsg">الرجاء إدخال رقم جوال صالح</p>');
                    document.getElementById('inputNumber').focus();
                    document.getElementById('inputNumber').classList.add('err-border');
                    return false;
                } else {
                    $('#mobile-err .errormsg').remove();
                    document.getElementById('inputNumber').classList.remove('err-border');
                }
        
                const email = $('#inputEmail4').val();
                const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    $('#email-err').html('<p class="errormsg">الرجاء إدخال بريد إلكتروني صالح</p>');
                    document.getElementById('inputEmail4').focus();
                    $('#inputEmail4').addClass('err-border');
                    return false;
                } else {
                    $('#email-err .errormsg').remove();
                    $('#inputEmail4').removeClass('err-border');
                }
        
                const city = $('#city').val();
        
                if (city.length < 1) {
                    $('#city-err').html('<p class="errormsg">الرجاء إدخال اسم مدينة صالح</p>');
                    document.getElementById('city').focus();
                    document.getElementById('city').classList.add('err-border');
                    return false;
                } else {
                    $('#city-err .errormsg').remove();
                    document.getElementById('city').classList.remove('err-border');
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
            });


            // Submit




        
// City Other


 
// $('#city').change(function() {
    
//     var city = $('#city').find(":selected").text();
//     if((city === 'Other') || (city === 'أخرى')) {
//         $('#ocity-name').removeClass('hideNow');
//         $('#ocity-name').addClass('cityName');
//         $('#ocity-name').prop('required',true);
//     } else {
//         if(!$('#ocity-name').hasClass('active')){
//             $('#ocity-name').addClass('hideNow');
//             $('#ocity-name').removeClass('cityName');
//             $('#ocity-name').prop('required',false);
//         }
//     }
//     })




}) 
// Doc ready ends
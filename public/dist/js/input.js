import { default as axios } from "axios";

imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}

//Show modal product with default value in form
$(document).on('click', '.preview', function(){
    $('.lightbox-blanket').removeClass('d-none')
    $('.modal-backdrop').hide();
    var imgValue =  $('#blah').prop('src');
    $('#img-product').attr('src', imgValue);
    var name = $('#name').val();
    var stock = $('#stock').val();
    var expired_at = $('#expired_at').val();
    var sku = $('#sku').val();
    var category_id = $('#category_id').val(); 

    $('.nameValue').html(name);
    $('.stockValue').html(stock);
    $('.expired_atValue').html(expired_at);
    $('.skuValue').html(sku);
    $('.category_idValue').html(category_id);
});            

$(document).on('change',"#selectProvince",function(event){
    event.preventDefault();
    const province = $(this).val();
    $("#selectCommune option").remove(); 
    $("#selectDistrict option").remove();            
    $.ajax({
        type: "get",
        url: "/admin/user/get-district",
        dataType: "json",
        data: { province_id: province },
        success: function(res) {
            const data = res.data
            if(data) { 
                $("#selectDistrict").append($('<option>', {
                    value: '',
                    text: 'Choose your district'
                }));
                data.map((val, index)=> {
                    $("#selectDistrict").append("<option value="+ val.id+ ">"+ val.name + "</option>");
                })
            }
        }                      
    });
});


$(document).on('change',"#selectDistrict",function(event){
    const district = $(this).val();
    $("#selectCommune option").remove();  
    $.ajax({
        type: "get",
        url: "/admin/user/get-commune",
        dataType: "json",
        data: { district_id: district },                        
        success: function(res) {
            const data = res.data
            if(data) { 
                $("#selectCommune").append($('<option>', {
                    value: '',
                    text: 'Choose your commune'
                }));
                data.map((val, index)=> {
                    $("#selectCommune").append("<option value="+ val.id+ ">"+ val.name + "</option>");
                })
            }
        }                      
    });
});


// const messages_el = $('#messages');
// const username_input = $('#username');
// const message_input = $('#message_input');
// const message_form = $('message_form');

// $(document).on('submit',"#message_form",function(event){
//     console.log(1243);
//     event.preventDefault();
//     let has_errors = false;
//     if(username_input.val() == '') {
//         alert('Please enter a username');
//         has_errors = true;
//     }
//     if(message_input.val() == '') {
//         alert('Please enter a message')
//     }
//     if(has_errors) {
//         return;
//     }

//     const option = {
//         method: 'post',
//         url: '/send-message',
//         data: {
//             username: username_input.val(),
//             message: message_input.val()
//         }
//     };

//     axios(option);
// });

// window.Echo.channel('chat')
//     .listen('.message', (e)=>{
//         console.log(e);
//     });
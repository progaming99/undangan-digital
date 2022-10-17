$(document).ready(function(){
    // Prepare the preview for profile picture
        $("#wizard-picture").change(function(){
            readURL(this);
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

// $(document).ready(function(){
//     // Prepare the preview for profile picture
//         $("#wizard-picture2").change(function(){
//             readURL(this);
//         });
//     });
//     function readURL(input) {
//         if (input.files && input.files[0]) {
//             var reader = new FileReader();
    
//             reader.onload = function (e) {
//                 $('#wizardPicturePreview2').attr('src', e.target.result).fadeIn('slow');
//             }
//             reader.readAsDataURL(input.files[0]);
//         }
//     }
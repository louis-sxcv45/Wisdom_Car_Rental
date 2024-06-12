document.addEventListener('DOMContentLoaded', function () {
    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var previewImage = document.getElementById(previewId);
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('KTP-image').addEventListener('change', function () {
        readURL(this, 'KTP-image-preview');
    });

    document.getElementById('profile-image').addEventListener('change', function () {
        readURL(this, 'profile-image-preview');
    });
});
function validatePassword() {
    var newPassword = document.getElementById("newPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var passwordError = document.getElementById("passwordError");

    if (newPassword !== confirmPassword) {
        passwordError.style.display = "block";
        return false;
    } else {
        passwordError.style.display = "none";
        return true;
    }
}
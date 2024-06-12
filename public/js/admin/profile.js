
document.getElementById('image').addEventListener('change', function() {
    var imagePreview = document.getElementById('image-preview');
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    } else {
        imagePreview.style.display = 'none';
    }
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

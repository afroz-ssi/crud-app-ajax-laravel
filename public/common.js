$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});




function LoginForm(e){
    e.preventDefault();
    alert("Hello  LoginForm");

}

function showError(field, messages)
{
    if(!messages) {
        $ ("#" + field)
        .addClass("is-valid")
        .removeClass("is-invalid")
        .siblings(".invalid-feedback")
        .text("");
    } else {
        $ ("#" + field)
        .addClass("is-invalid")
        .removeClass("is-valid")
        .siblings(".invalid-feedback")
        .text(messages);
    }
}

function resetValidasiClass(from)
{
    $(from).each(function(){
        $(from).find(':input').removeClass("is-invalid is-valid");
    });
}

function showMessage(message)
{
    return `<div class="alert alert-success" role="alert">
        <strong>${message}</strong>
    </div>`;
}
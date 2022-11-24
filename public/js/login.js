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

function showMessageSuccess(message)
{
    return `<div class="alert alert-success" role="alert">
        <strong>${message}</strong>
    </div>`;
}

function showMessageError(message)
{
    return `<div class="alert alert-danger" role="alert">
        <strong>${message}</strong>
    </div>`;
}
function createModal(message=null, type=null, func=null)
{
    let content = document.getElementsByClassName('content')[0]

    if (document.getElementById('modal') != undefined){
        return
    }

    let modalClass = 'error-modal'
    if (type=='success')
    {
        modalClass = 'success-modal'
    }

    let modal = `
        <div id="modal" class="` + modalClass + `">
            <div class="modal-header">
            ` + type + `
            </div>
            <div class="modal-body">
            ` + message + `
            </div>
            <div class="modal-footer">
                <button id="modal-button" onclick="closeModal(`+func+`)">
                    Confirm
                </button>
            </div>
        </div>
        <div id="modal-lock"></div>
    `

    content.innerHTML = content.innerHTML + modal
}

function closeModal(func=null)
{
    let modal = document.getElementById('modal')
    let lock = document.getElementById('modal-lock')

    if (modal != undefined){
        modal.remove()
    }
    if (lock != undefined){
        lock.remove()
    }
    if (func != null)
    {
        func()
    }
}
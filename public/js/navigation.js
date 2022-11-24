async function logout(){
    await fetch("/logout", {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => {
        if (response.ok){
            window.location.href = 'login'
        }
        else{
            //throw up an error modal here
        }
    });
}

async function management(){
    window.location.href = 'management'
}

async function home(){
    window.location.href = 'home'
}

function createModal(message=null, type=null)
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
                <button id="modal-button" onclick="closeModal()">
                    Confirm
                </button>
            </div>
        </div>
        <div id="modal-lock"></div>
    `

    content.innerHTML = content.innerHTML + modal
}

function closeModal()
{
    let modal = document.getElementById('modal')
    let lock = document.getElementById('modal-lock')

    if (modal != undefined){
        modal.remove()
    }
    if (lock != undefined){
        lock.remove()
    }
}
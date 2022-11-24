
let installationsData = []

async function getOutstandingInstallations()
{
    await fetch("/get_installations", {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.message){
            let content = document.getElementById('installation-table-container')
            content.innerHTML = 'Failed to get installations data.  Error: ' + data.message
        }
        else{
            installationsData = data
            let content = document.getElementById('installation-table-container')
            let installationTable = `
            <table class='installation-table'> 
                <tr>
                    <th>Location</th>
                    <th>Installation Date</th>
                    <th>Balance Due</th>
                </tr>`

            data.forEach(installation => {
                installationTable += `
                <tr onclick="expandInstallation(` + installationsData.indexOf(installation) + `)">
                    <td>` + installation.location.name + `</td>
                    <td>` + installation.installed_on + `</td>
                    <td> $` + installation.balance_due + `.00</td>
                </tr>
                `
            });

            installationTable += '</table>'

            content.innerHTML = installationTable
        }
    })
}

function expandInstallation(index=null){
    let content = document.getElementsByClassName('content')[0]

    let installation = installationsData[index]
    let newContent = `
        
        <div class="expanded-installation">
            <div>Location: ` + installation.location.name + `</div>
            <div>Installed on: ` + installation.installed_on + `</div>
            <div>Balance Due: $` + installation.balance_due + `.00
                <button id="mark-paid-button" onclick="markPaid(` + index + `)">
                Mark Paid
                </button>
            </div>
            <h3>Chain installs/removals</h3>
            <div class="installation-actions">`

    installation.chain_actions.forEach(action => {
        let type = 'Chain Installed'
        if (!action.install_chain){type = 'Chain Removed'}
        newContent += `
            <div class="action-info">
                <div>Employee: ` + action.user.name + `</div>
                <div>Vehicle: ` + action.vehicle.vehicle_number + `</div>
                <div>` + type + `</div>
            </div>
        `
    });

    newContent += `</div> </div>
        <button id="back-button" onclick="goBack()">
            Back
        </button>`
    
    content.innerHTML = newContent
}

function goBack()
{
    location.reload()
}

async function markPaid(index=null)
{
    let content = document.getElementsByClassName('content')[0]
    let originalContent = content.innerHTML
    content.innerHTML = '<div><i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i></div>'

    await fetch("/mark_installation_paid?installation_id=" + installationsData[index].id, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        method: 'POST'
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.message){
            content.innerHTML = originalContent
            createModal('Failed to mark installation paid.  Error: ' + data.message, 'error')
        }
        else{
            content.innerHTML = ''
            createModal('Installation has been marked paid.', 'success', goBack)
        }
    })
}

async function addInstallation()
{
    let content = document.getElementsByClassName('content')[0]
    let originalContent = content.innerHTML
    content.innerHTML = '<div><i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i></div>'

    await fetch("/get_installation_options", {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.message){
            content.innerHTML = originalContent
            createModal('Failed to get Installation options.  Error: ' + data.message, 'error')
        }
        else{
            let locations = `<label for="location_id">Location:</label>
                <select name="location_id" id="location_id">`
            data.locations.forEach(loc => {
                locations += '<option value="'+loc.id+'">'+loc.name+'</option>'
            });
            locations += '</select>'

            let date = new Date();

            let newContent = `
                <div class="add-installation-container">
                    <div>
                        `+locations+`
                    </div>
                    <div>
                        <label for="installed_on">Installed on:</label>
                        <input type="date" id="installed_on" name="installed_on">
                    </div>
                    <div id="add-actions-container">
                        <h3>Chain installs/removals</h3>
                        <button id="add-action-button" onclick="addAction()">
                            Add Action
                        </button>
                        <div id="add-actions">

                        </div>
                    </div>
                </div>
                <div class="add-installation-buttons>
                        <button id="back-button" onclick="goBack()">
                            Back
                        </button>
                        <button id="save-installation-button" onclick="saveInstallation()">
                            Add Installation
                        </button>
                </div>
                `
            
            content.innerHTML = newContent
        }
    })
}
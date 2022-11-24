
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

let installationOptions = [];

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
            installationOptions = data;
            let locations = `<label for="location_id">Location:</label>
                <select name="location_id" id="location_id" onchange="updateVehicleOptions()">`
            installationOptions.locations.forEach(loc => {
                locations += '<option value="'+loc.id+'">'+loc.name+'</option>'
            });
            locations += '</select>'

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
                        <div class="add-actions-title">
                            <h3>Chain installs/removals</h3>
                            <button id="add-action-button" onclick="addAction()">
                                Add Action
                            </button>
                        </div>
                        <div id="add-actions">

                        </div>
                    </div>
                </div>
                <div class="add-installation-buttons">
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

function addAction()
{
    let content = document.getElementById('add-actions')

    let users = `<div><label for="user_id">Employee:</label>
        <select name="user_id" id="user_id">`
    installationOptions.users.forEach(user => {
        users += '<option value="'+user.id+'">'+user.name+'</option>'
    });
    users += '</select></div>'

    let vehicles = `<div><label for="vehicle_id">Vehicle:</label>
        <select name="vehicle_id" id="vehicle_id" class="vehicle-option"></select></div>`

    content.innerHTML = content.innerHTML + `
        <div class="add-action-info">
            ` + users + vehicles + `
            <div>
                <label for="installed">Action Type: </label>
                <select name="installed" id="installed">
                    <option value="1">Install</option>
                    <option value="0">Removal</option>
                </select>
            </div>
        </div>
    `

    updateVehicleOptions()
}

function updateVehicleOptions() 
{
    elements = Array.from(document.getElementsByClassName('vehicle-option'))

    locationElement = document.getElementById('location_id')
    let locationVehicles = installationOptions.vehicles.filter(vehicle => vehicle.location_id == locationElement.value)

    elements.forEach(element => {
        let options = ''

        locationVehicles.forEach(lv => {
            options += '<option value="'+lv.id+'">'+lv.vehicle_number+'</option>'
        });

        element.innerHTML = options
    });
}

async function saveInstallation()
{
    let content = document.getElementsByClassName('content')[0]
    let originalContent = content.innerHTML

    let installed_on = document.getElementById('installed_on')
    if (installed_on.value == '')
    {
        createModal('Select an installed on date.', 'error')
        return
    }
    let body = {
        'installed_on': installed_on.value,
        'location_id': document.getElementById('location_id').value
    }
    let actionElements = Array.from(document.getElementsByClassName('add-action-info'))
    if (actionElements.length != 0)
    {
        let actions = []
        actionElements.forEach(element => {
            actions.push({
                'vehicle_id': element.querySelector('#vehicle_id').value,
                'user_id': element.querySelector('#user_id').value,
                'installed': element.querySelector('#installed').value
            })
        });
        body.actions = actions
    }

    content.innerHTML = '<div><i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i></div>'

    await fetch("/create_installation", {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        method: 'POST',
        body: JSON.stringify(body)
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.message){
            content.innerHTML = originalContent
            createModal('Failed to create Installation.  Error: ' + data.message, 'error')
        }
        else{
            content.innerHTML = ''
            createModal('Installation has been Created.', 'success', goBack)
        }
    })
}
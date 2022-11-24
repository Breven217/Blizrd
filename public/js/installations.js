
async function getOutstandingInstallations()
{
    let content = document.getElementById('installation-table-container')

    await fetch("/get_installations", {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.message){
            content.innerHTML = 'Failed to get installations data.  Error: ' + data.message
        }
        else{
            let installationTable = `
            <table class='installation-table'> 
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>Receives Alert</th>
                </tr>`

            data.forEach(result => {
                let alertBox = '<i class="fa-regular fa-square fa-lg"></i>'
                if (result.receives_alerts){
                    alertBox = '<i class="fa-regular fa-square-check fa-lg"></i>'
                }
                installationTable += `
                <tr onclick="editUser(` + result.id + `)">
                    <td>` + result.name + `</td>
                    <td>` + result.phone_number.slice(0,3) + '-' + 
                        result.phone_number.slice(3,6) + '-' + 
                        result.phone_number.slice(6,10) + 
                    `</td>
                    <td>` + result.email_address + `</td>
                    <td>` + alertBox + `</td>
                </tr>
                `
            });

            installationTable += '</table>'

            content.innerHTML = installationTable
        }
    })
}
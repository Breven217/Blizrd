
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
                    <th>Location</th>
                    <th>Installation Date</th>
                    <th>Balance Due</th>
                </tr>`

            data.forEach(installation => {
                installationTable += `
                <tr onclick="expandInstallation(` + installation.id + `)">
                    <td>` + installation.location.name + `</td>
                    <td>` + installation.installed_on + `</td>
                    <td> $` + installation.balance_due + `</td>
                </tr>
                `
            });

            installationTable += '</table>'

            content.innerHTML = installationTable
        }
    })
}

function expandInstallation(installation_id=null){
    console.log(installation_id);
}
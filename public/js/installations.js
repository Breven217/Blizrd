
let installations = []

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
            installations = data
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
                <tr onclick="expandInstallation(` + installations.indexOf(installation) + `)">
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

    let installation = installations[index]
    content.innerHTML = `
        <div class="expanded-installation">
            <div>Location: ` + installation.location.name + `</div>
            <div>Installed on: ` + installation.installed_on + `</div>
            <div>Balance Due: ` + installation.balance_due + `</div>

        </div>
    `
}
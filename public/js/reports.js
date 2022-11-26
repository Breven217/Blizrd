
let currentReport = null
//0 = Installation History

async function generateInstallationHistory() {
    generateTitle('Installation History')
    currentReport = 0
}

function generateTitle(title=null)
{
    let content = document.getElementById('report-content')

    let now = new Date();
    let firstDay = new Date(now.getFullYear(), now.getMonth(), 1)
    let lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0)

    content.innerHTML = `
        <h2 class="report-title">`+title+`</h2>
        <div class="report-dates">
            <input type="date" id="report-date-to" name="report-date-to" value="`+firstDay+`">
            <input type="date" id="report-date-from" name="report-date-from" value="`+lastDay+`">
        </div>
    `
}
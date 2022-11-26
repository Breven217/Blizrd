
let currentReport = null
//0 = Installation History
//1 = Employee Performance

async function generateInstallationHistory() {
    generateFrame('Installation History')
    currentReport = 0
    setButtonActive('history-button')
}

async function generateEmployeePerformance() {
    generateFrame('Employee Performance')
    currentReport = 1
    setButtonActive('performance-button')
}

function generateFrame(title=null)
{
    let content = document.getElementById('report-content')

    let now = new Date();
    let firstDay = now.getFullYear() + '-' + now.getMonth() + '-01'
    let lastDay = now.getFullYear() + '-' + now.getMonth() + '-' + new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate()

    content.innerHTML = `
        <h2 class="report-title">`+title+`</h2>
        <div class="report-dates">
            <input type="date" id="report-date-to" name="report-date-to" value="`+firstDay+`">
            <input type="date" id="report-date-from" name="report-date-from" value="`+lastDay+`">
        </div>
        <div class="report-data">
            <div><i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i></div>
        </div>
    `
}

function setButtonActive(button_id=null)
{
    if (button_id==null){return}

    buttons = Array.from(document.getElementsByClassName('report-button'))

    buttons.forEach(button => {
        if (button.id == button_id){button.disabled = true}
        else {button.disabled = false}
    });
}
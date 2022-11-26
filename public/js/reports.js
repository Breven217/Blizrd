
let currentReport = null
//0 = Installation History
//1 = Employee Performance

function generateInstallationHistory() {
    generateFrame('Installation History')
    currentReport = 0
    setButtonActive('history-button')
    getInstallationHistoryData()
}

function generateEmployeePerformance() {
    generateFrame('Employee Performance')
    currentReport = 1
    setButtonActive('performance-button')
    getInstallationHistoryData()
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
            <input type="date" id="report-date-from" name="report-date-from" value="`+firstDay+`">
            <input type="date" id="report-date-to" name="report-date-to" value="`+lastDay+`">
        </div>
        <div id="report-data">
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

async function getInstallationHistoryData()
{
    let start = document.getElementById('report-date-from').value
    let end = document.getElementById('report-date-to').value

    let content = document.getElementById('report-data')

    await fetch("/get_history_data?start_date=" + start + "&end_date=" + end, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.message){
            content.innerHTML = 'Failed to get Installation History.  Error: ' + data.message
        }
        else{
            content.innerHTML = data
        }
    })
}
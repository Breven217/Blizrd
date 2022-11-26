async function generateInstallationHistory() {
    let content = document.getElementById('report-content')

    let firstDay = new Date(now.getFullYear(), now.getMonth(), 1)
    let lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0)

    content.innerHTML = `
        <h2 class="report-title">Installation History</h2>
        <div class="report-dates">
            <input type="date" id="report-date-to" name="report-date-to" value="`+firstDay+`">
            <input type="date" id="report-date-from" name="report-date-from" value="`+lastDay+`">
        </div>
    `
}
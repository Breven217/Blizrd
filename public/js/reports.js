async function generateInstallationHistory() {
    let content = document.getElementById('report-content')

    content.innerHTML = `
        <h2 class="report-title">Installation History</h2>
        <div class="report-dates">
            <input type="date" id="report-date-to" name="report-date-to">
            <input type="date" id="report-date-from" name="report-date-from">
        </div>
    `
}
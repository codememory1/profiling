const DEFAULT_THEME = 'dark-theme';
const LS_THEME = '__cdm-profiler-theme';


// Change theme
const selectChangeTheme = document.querySelector('.change_theme > select');

document.body.className = null === localStorage.getItem(LS_THEME) ? DEFAULT_THEME : localStorage.getItem(LS_THEME);

selectChangeTheme.onchange = function () {
    localStorage.setItem(LS_THEME, this.value);

    document.body.className = localStorage.getItem(LS_THEME);
};

// Control remove added report for compare
function deleteReportOfList() {
    const addedReport = document.querySelectorAll('.added-reports-for-compare > span');

    for(let i = 0; i < addedReport.length; i++) {
        const report = addedReport[i];

        report.querySelector('i').addEventListener('click', () => {
            report.classList.add('removed');

            setTimeout(() => {
                report.remove();
            }, 400);
        });
    }
}

deleteReportOfList();

// Btn add report to list for compare
const btnAddReport = document.querySelector('.btn_add-report');
const listReports = document.querySelector('.list_reports-select');

btnAddReport.addEventListener('click', (e) => {
    e.preventDefault();

    const span = document.createElement('span');
    span.innerHTML = '<i class="fal fa-times"></i>';
    span.innerHTML += '#' + listReports.value;
    span.addEventListener('click', deleteReportOfList);

    document.querySelector('.added-reports-for-compare').append(span);
});

// build btn compare
const btnCompare = document.querySelector('.btn-compare');

btnCompare.onclick = (eA) => {
    eA.preventDefault();

    const listAddedReports = document.querySelectorAll('.added-reports-for-compare > span');
    let hashes = [];
    let getToString = null;

    listAddedReports.forEach((e) => {
        const fullHash = e.textContent;
        const hash = fullHash.split('#')[1];

        hashes.push(hash);
    });

    getToString = '&run-reports=' + hashes.join('@');

    btnCompare.setAttribute('href', btnCompare.getAttribute('href') + getToString);
    window.location = btnCompare.getAttribute('href');
};
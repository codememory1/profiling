const DEFAULT_THEME = 'blue-theme';
const THEME_KEY = '__cdm-profiler_theme';
const MENU_KEY = '__cdm-profiler-menu';
const ACTIVATED_STATISTIC_KEY = '__cdm-profiler-statistic';
const url = new URL(location.href);

// HELPERS
/**
 *
 * @param str
 * @returns {string|*}
 */
function ucFirst(str) {
    if (!str) return str;

    return str[0].toUpperCase() + str.slice(1);
}

/**
 *
 * @param status
 * @param message
 */
function createNotification(status, message) {

    const notification = document.createElement('div');
    const span = document.createElement('span');

    notification.classList.add('notification');
    notification.classList.add(status);

    span.innerText = message;

    notification.innerHTML = span.outerHTML;

    document.querySelector('.notifications').append(notification);

    setTimeout(() => {
        notification.classList.add('active');

        setTimeout(() => {
            notification.classList.remove('active');

            setTimeout(() => {
                notification.remove();
            }, 1000);
        }, 2000);
    }, 100);

}

/**
 *
 * @param key
 * @param value
 */
function insertParam(key, value) {
    key = encodeURIComponent(key);
    value = encodeURIComponent(value);

    let s = document.location.search;
    let kvp = key + "=" + value;

    let r = new RegExp("(&|\\?)" + key + "=[^\&]*");

    s = s.replace(r, "$1" + kvp);

    if (!RegExp.$1) {
        s += (s.length > 0 ? '&' : '?') + kvp;
    }

    document.location.search = s;
}

function getSearchParameters() {
    let param = window.location.search.substr(1);

    return param != null && param !== "" ? transformToAssocArray(param) : {};
}

function transformToAssocArray(param) {
    let params = {};
    let prmarr = param.split("&");

    for (let i = 0; i < prmarr.length; i++) {
        let tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

// CHANGE THEME
const listTheme = document.querySelector('.list-themes');
const themes = document.querySelectorAll('.list-themes > option');

listTheme.addEventListener('change', function () {
    window.localStorage.setItem(THEME_KEY, this.value);

    document.body.setAttribute('class', this.value);
});

window.addEventListener('load', () => {
    const theme = window.localStorage.getItem(THEME_KEY);

    document.body.classList.add(null === theme ? DEFAULT_THEME : theme);

    themes.forEach((e) => {
        if (e.getAttribute('value') === theme) {
            e.setAttribute('selected', null);
        }
    });
});


// CLONE/OPEN Navigation
const navigation = document.querySelector('.navigation');
const btnMenu = document.querySelector('.navigation__btn');
const classMenuFromStorage = window.localStorage.getItem(MENU_KEY);

btnMenu.addEventListener('click', () => {
    navigation.classList.toggle('active');

    if (null === classMenuFromStorage) {
        window.localStorage.setItem(MENU_KEY, 'active');
    } else {
        window.localStorage.removeItem(MENU_KEY);
    }
});

window.addEventListener('load', () => {
    if (null !== classMenuFromStorage) {
        navigation.classList.add(classMenuFromStorage);
    }
});

function getCookie(name)
{

    const cookies = document.cookie.split('; ');
    let cookiesToArray = {};

    cookies.forEach((cookie) => {
        const data = cookie.split('=');

        cookiesToArray[data[0]] = data[1];
    });

    const value = cookiesToArray[name] ?? null;

    if(null !== value) {
        return decodeURIComponent(value);
    }

    return null;

}

function setCookie(name, value, path = '/')
{

    const cookie = encodeURIComponent(name) + '=' + encodeURIComponent(value);

    document.cookie = cookie + '; path=' + path;

}

// ACTIVE STATISTIC
const btnActiveStatistic = document.querySelectorAll('.btn__active-statistic');
const activatedStatistic = getCookie(ACTIVATED_STATISTIC_KEY);

if (btnActiveStatistic.length !== 0) {
    btnActiveStatistic.forEach((e) => {
        if (null !== activatedStatistic) {
            if (e.getAttribute('data-id') === activatedStatistic) {
                e.innerText = 'activated';
                e.classList.remove('light');
                e.classList.add('green');
                e.classList.add('disabled');
            }
        }

        e.addEventListener('click', function (e) {
            e.preventDefault();

            const id = this.getAttribute('data-id');

            setCookie(ACTIVATED_STATISTIC_KEY, id);

            createNotification('success', `Statistics with id ${id} activated`);

            setTimeout(() => {
                window.location.reload();
            }, 600)

            btnActiveStatistic.forEach(function (e) {
                e.innerText = 'activate';
                e.classList.remove('green');
                e.classList.add('light');
                e.classList.remove('disabled');
            });

            this.innerText = 'activated';

            this.classList.remove('light');
            this.classList.add('green');
            this.classList.add('disabled');
        });
    });
}

// DISABLED NAVIGATION ITEM
const navigationItems = document.querySelectorAll('.navigation__item');

if (null === getCookie(ACTIVATED_STATISTIC_KEY)) {
    navigationItems.forEach((e, k) => {
        if (k !== 0) {
            e.classList.add('disabled');
        }
    });
}

// ADD HASH TO COMPARE
const hashes = document.querySelectorAll('.profiling__hash');
const listWithAddedHashes = document.querySelector('.compare-input__hashes');

if (hashes.length > 0) {
    hashes.forEach((e) => {
        const hash = e.querySelector('span[data-value]').getAttribute('data-value');

        e.querySelector('.add-hash').addEventListener('click', () => {
            e.querySelector('.remove-hash').classList.toggle('hide');
            e.querySelector('.add-hash').classList.toggle('hide');

            const selectedHash = document.createElement('div');
            const span = document.createElement('span');

            span.innerHTML = '#' + hash;

            selectedHash.setAttribute('data-selected-hash', hash);
            selectedHash.classList.add('selected__hash');
            selectedHash.innerHTML += '<i class="remove-selected-hash fal fa-times"></i>';
            selectedHash.innerHTML += span.outerHTML;

            listWithAddedHashes.innerHTML += selectedHash.outerHTML;
        });

        e.querySelector('.remove-hash').addEventListener('click', () => {
            document.querySelector(`[data-selected-hash="${hash}"]`).remove();

            e.querySelector('.remove-hash').classList.toggle('hide');
            e.querySelector('.add-hash').classList.toggle('hide');
        });
    });
}

if (null !== listWithAddedHashes) {
    listWithAddedHashes.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-selected-hash')) {
            const removingHash = e.target.parentElement.getAttribute('data-selected-hash');

            document.querySelector(`[data-selected-hash="${removingHash}"]`).remove();

            hashes.forEach((e) => {
                if (e.querySelector('span').getAttribute('data-value') === removingHash) {
                    e.querySelector('.remove-hash').classList.toggle('hide');
                    e.querySelector('.add-hash').classList.toggle('hide');
                }
            });
        }
    });
}

// BTN COMPARE
const btnCompare = document.querySelector('.btn__compare');

if (null !== btnCompare) {
    btnCompare.addEventListener('click', (e) => {
        e.preventDefault();

        const selectedHash = document.querySelectorAll('.selected__hash');
        let hashes = [];

        selectedHash.forEach((el) => {
            hashes.push(el.getAttribute('data-selected-hash'));
        });

        const parameters = Object.assign(getSearchParameters(), {reports: hashes.join(',')});
        const parametersKeys = Object.keys(parameters);

        let fullParameters = [];

        for (let i = 0; i < parametersKeys.length; i++) {
            const value = parameters[parametersKeys[i]];

            fullParameters.push(parametersKeys[i] + '=' + value);
        }

        const getParameters = fullParameters.length > 0 ? '?' + fullParameters.join('&') : null;

        window.location.href = btnCompare.getAttribute('href') + getParameters;
    });
}

// Change screen content
const contentNavigationItems = document.querySelectorAll('.content__navigation-item');

if(contentNavigationItems.length > 0) {
    contentNavigationItems.forEach((e, k) => {
        e.addEventListener('click', () => {
            contentNavigationItems.forEach((el) => {
                el.classList.remove('active');
            });

            e.classList.add('active');

            const screen = document.querySelector('.content__navigation-wrap > div');
            const screenWidth = screen.clientWidth;
            const x = screenWidth - (screenWidth * (k + 1));

            const wrap = document.querySelector('.content__navigation-wrap');

            wrap.style.transform = `translateX(${x}px)`;

            wrap.setAttribute('data-old-width', wrap.clientWidth);
        });
    });
}

// top scroll to table
const scrolls = document.querySelectorAll('.scroll.on-scroll');

if(scrolls.length > 0) {
    scrolls.forEach((el) => {
        const scrollWrap = document.createElement('div');
        const topScroll = document.createElement('div');

        scrollWrap.style.overflow = 'auto';
        scrollWrap.style.height = '8px';
        scrollWrap.style.marginBottom = '9px';

        scrollWrap.classList.add('top-scroll-wrap');
        scrollWrap.classList.add('scroll');

        topScroll.classList.add('top-scroll');

        topScroll.style.width = el.querySelector('table').clientWidth + 'px';
        topScroll.style.height = '22px';

        scrollWrap.innerHTML = topScroll.outerHTML;

        scrollWrap.onscroll = function() {
            el.scrollLeft = scrollWrap.scrollLeft;
        };

        el.onscroll = function() {
            scrollWrap.scrollLeft = el.scrollLeft;
        };

        el.prepend(scrollWrap);
    });
}

// LOAD HIDDEN TR

const loadBtn = document.querySelectorAll('.load-hidden-tr');

if(loadBtn.length !== 0) {
    loadBtn.forEach((el) => {
        const table = document.querySelector('.' + el.getAttribute('data-load-table'));

        el.querySelector('span').addEventListener('click', () => {
            const hiddenTrs = table.querySelectorAll('tr[style="display: none"]');

            for (let i = 0; i < 10; i++) {
                const tr = hiddenTrs[i];

                tr.style.display = "table-row";
            }
        });
    });
}
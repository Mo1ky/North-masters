
const body = document.querySelector('body'),
	sidebar = body.querySelector('nav'),
	toggle = body.querySelector(".toggle"),
	searchBtn = body.querySelector(".search-box"),
	modeSwitch = body.querySelector(".toggle-switch"),
	mobiletoggle = body.querySelector(".mobile-toggle"),
	general = body.querySelector(".wrapper"),
	modeText = body.querySelector(".mode-text");

/* =========================== */

/* ===== Переключение бокового меню на закрытое или открытое в мобильной версии ===== */
var x = window.matchMedia("(max-width: 860px)")

function myFunction(x) {
	if (x.matches) {
		sidebar.classList.add("mobile-close");
		sidebar.classList.remove("mobile-open");

		mobiletoggle.addEventListener("click", () => {
			sidebar.classList.remove("mobile-close");
			sidebar.classList.add('mobile-open');
            general.addEventListener("click", () => {
                sidebar.classList.remove("mobile-open");
                sidebar.classList.add("mobile-close");
            })
		})


	} 
    else {
		sidebar.classList.remove("mobile-close");
		sidebar.classList.remove("mobile-open");
	}
}
myFunction(x)
x.addListener(myFunction)

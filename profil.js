document.addEventListener("DOMContentLoaded", () => {
    const profileImage = document.querySelector(".profile-img");
    const profileHeader = document.querySelector(".profile-header");
    const profileContainer = document.querySelector(".profile-container");

    profileImage.addEventListener("load", () => {
        profileImage.classList.add("loaded");
    });

    setTimeout(() => {
        profileImage.classList.add("loaded");
        profileHeader.classList.add("fadeIn");
        profileContainer.classList.add("fadeIn");
    }, 100);

    const fetchActivityData = async () => {
        try {
            const response = await fetch('get_activity.php');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("Błąd przy pobieraniu danych o aktywności:", error);
            return {};
        }
    };

    const generateCalendar = async (year, month) => {
        const calendarContainer = document.querySelector('.calendar-container');
        const monthYearDisplay = document.getElementById('calendar-month-year');
        calendarContainer.innerHTML = ''; // Czyszczenie kontenera

        const firstDayOfMonth = new Date(year, month, 1);
        const lastDayOfMonth = new Date(year, month + 1, 0);
        const firstDayOfWeek = firstDayOfMonth.getDay();
        const totalDaysInMonth = lastDayOfMonth.getDate();

        const months = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
        monthYearDisplay.textContent = `${months[month]} ${year}`;

        const activityData = await fetchActivityData();

        for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('calendar-day');
            calendarContainer.appendChild(emptyDay);
        }

        for (let day = 1; day <= totalDaysInMonth; day++) {
            const calendarDay = document.createElement('div');
            calendarDay.classList.add('calendar-day');
            calendarDay.textContent = day;

            const currentDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const activityCount = activityData[currentDate] || 0;

            if (activityCount > 0) {
                const colorIntensity = Math.min(255, 100 + activityCount * 40);
                calendarDay.classList.add('active');
                calendarDay.style.backgroundColor = `rgb(240, ${colorIntensity}, 0)`;
            } else {
                calendarDay.style.backgroundColor = '#dfe1e3';
            }

            calendarContainer.appendChild(calendarDay);
        }
    };

    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();

    generateCalendar(currentYear, currentMonth);

    document.getElementById('prev-month').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentYear, currentMonth);
    });

    document.getElementById('next-month').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentYear, currentMonth);
    });
});

document.getElementById('choose-image-btn').addEventListener('click', function() {
    document.getElementById('upload-form').style.display = 'block'; // Pokazuje formularz
});

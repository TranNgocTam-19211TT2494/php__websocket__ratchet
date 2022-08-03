const days = [
    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday',
    'Friday', 'Saturday'
];
const months = [
    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
];

/**
 * handle act click button change bg theme: light/dark
 * */ 
document.querySelector('.html__toggle').addEventListener('click', (e) => {
    const html = document.querySelector('html');
    if(html.classList.contains('dark')) {
        html.classList.remove('dark');
        e.target.innerHTML = 'Dark';
    } else {
        html.classList.add('dark');
        document.querySelector('.clock').style.backgroundColor = `#fff`;
        e.target.innerHTML = 'Light';
    }
});

/**
 * Function set time: day, hour, minute and second
 * */ 
function setTime() { 
    const time = new Date();
    const hoursForClock = time.getHours() % 12;
    const broth = time.getHours() >= 12 ? 'PM' : 'AM';
    //hour
    document.querySelector('.hour').style.transform = `translate(-50%, -100%) rotate(${scale(hoursForClock, 0, 11, 0, 360)}deg)`;
    document.querySelector('.minute').style.transform = `translate(-50%, -100%) rotate(${scale(time.getMinutes(), 0, 59, 0, 360)}deg)`;
    document.querySelector('.second').style.transform = `translate(-50%, -100%) rotate(${scale(time.getSeconds(), 0, 59, 0, 360)}deg)`;

    document.querySelector('.time').innerHTML = `${hoursForClock}:${time.getMinutes() < 10 ? `0${time.getMinutes()}` : time.getMinutes()} ${broth}`;
    document.querySelector('.date').innerHTML = `${days[time.getDay()]}, ${months[time.getMonth()]} <span class="circle">${time.getDate()}</span>`;
}

const scale = (num, in_min, in_max, out_min, out_max) => {
    return (num - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
}
setTime();
setInterval(setTime, 1000);
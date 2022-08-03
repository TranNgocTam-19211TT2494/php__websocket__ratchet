/**
 * Create html div tag main__box
 * */ 
const main_box = document.getElementById('main__box');

function createTagName () {
    let numDiv = 4;
    for (let i = 1; i < numDiv; i++) {
        for (let j = 1; j < numDiv; j++) {
            const tag = document.createElement('div');
            tag.classList.add('box');
            main_box.appendChild(tag);
        }
    }
}
createTagName();
/**
 * Handles animation for these class .box
 * */ 
const div_box = document.querySelectorAll('.box');

// scroll top 
window.addEventListener('scroll', checkBox);

checkBox();
function checkBox() { 
    const trigger_bottom = window.innerHeight / 5 * 4;
    div_box.forEach(box => {
        const scrollTop = box.getBoundingClientRect().top;
        if(scrollTop < trigger_bottom) {
            box.classList.add('show');
        } else {
            box.classList.remove('show');
        }
    });
}
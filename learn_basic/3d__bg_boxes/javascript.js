const js__boxes = document.getElementById('js__boxes');
const btn_cancel_box = document.getElementById('btn__box');

// Cancellation handling cut img
btn_cancel_box.addEventListener('click', function() {
    // console.log(1);
    js__boxes.classList.toggle('big')
});

function create() { // Create child tags inside js__boxes to shred img
    let numImg = 4;
    for (let i = 0; i < numImg; i++) {
        for (let j = 0; j < numImg; j++) {
            const class__box = document.createElement('div');
            class__box.classList.add('box');
            class__box.style.backgroundPosition = `${-j * 125}px ${-i * 125}px `;
            js__boxes.appendChild(class__box); // appendChild bổ sung DOM tại location final
        }
    }
}
create();
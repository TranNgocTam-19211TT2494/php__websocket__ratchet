const url_api = 'https://api.github.com/users/';

get();
async function get() {
    try {
        const { data } = await axios(url_api + 'TranNgocTam-19211TT2494');
        console.log(data);
        const img = document.createElement('img');
        img.src = `${data.avatar_url}`;
        document.querySelector('.container_img').appendChild(img);
        document.querySelector('.name').innerHTML = `${data.name}`;
        document.querySelector('.about').innerHTML = `${data.bio} Developer`;
    } catch (error) {
        if(err.response.status == 404) {
            console.log(1);
        }
    }
}
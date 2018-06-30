import {ajax, createElementFromHTML} from './functions.js';


function get_trips(page, limit, callback) {
  ajax(`/action/find/trips.php?page=${page}&limit=${limit}`, {
    success: callback,
    method: 'GET'
  });
}


function f(e, index) {
        console.log(e);
        // entry.appendChild(document.createTextNode('some'));
        let s =
          `
            <li class="flex horizontal flex0">
              <a href="/trip.php/${e.id}">
                <img src="${(e.img_src !== '' ? e.img_src : '/dist/images/logos/glimmerjs.svg')}" />
              </a>
              <div class="flex space-between vertical flex3">
                <a href="/trip.php/${e.id}">
                  <h4>${e.title}</h4>
                </a>
                <span>${e.short_description}</span>
                <div class="actions flex space-between horizontal">
                  <div class="author flex horizontal">
                    <a href="/user/todo">
                      <img src="/dist/images/logos/glimmerjs.svg" />
                    </a>
                    ${ e.is_public
                    ? '<img src="/dist/images/logos/unito.svg" />'
                    : '<img src="/dist/images/logos/gusto.svg" />'
                    }
                    <img class="hided" src="${ e.img_src !== '' ? e.img_src : '/dist/images/logos/gatsby.svg' }" />
                    <img class="hided" src="/dist/images/logos/prettier.svg" />
                  </div>
                  <div class="flex flex-end horizontal">
                    <!-- <?php if( isset($_SESSION['logged_user']) &&
                      ( $_SESSION['logged_user']->login == 'root' || $_SESSION['logged_user']->id == $trip->author_id)) : ?>
                      <a class="button hided warning" href="/action/delete/trip.php/<?=$trip->id?>">remove</a>
                    <?php endif; ?> -->
                    <a class="button hided" href="/share/${e.id}">share</a>
                    <a class="button" href="/trip.php/${e.id}">more</a>
                    <a class="button" href="/copy/${e.id}">copy</a>
                  </div>
                </div>
              </div>

            </li>
          `;
        let list = document.getElementById('tripsList');
        list.appendChild(createElementFromHTML(s));
        console.log(list);
};

let page = 1;
let limit = 10;
window.showmore = (event) => {
  page++;
  get_trips(page, limit, (text) => {
    let json = Object.values(JSON.parse(text));
    console.log(json);
    if (json.length > 0) {
      json.forEach(f);
    } else {
      event.target.textContent = "The end";
      event.target.onclick = (e) => alert('no more trips!');
    }
  });
}

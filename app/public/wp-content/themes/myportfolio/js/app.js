// Menu toggle functionality
const menuBtn = document.querySelector(".menu-btn");
const mobileMenu = document.querySelector(".mobile-menu");

if (menuBtn && mobileMenu) {
  menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("active");
  });
}

// Footer toggle functionality
function footerToggle(footerBtn) {
  footerBtn.classList.toggle("btnActive");
  footerBtn.nextElementSibling.classList.toggle("active");
}

// Testimonials functionality
import { html, render } from "https://cdn.jsdelivr.net/npm/lit-html@2.0.0/lit-html.min.js";

let postData = [];
let postImages = [];

function findImageById(id) {
  const image = postImages.find((item) => item.id === id);
  return image ? image.image : '';
}

function fetchTestimonials() {
  axios.get("/wp-json/wp/v2/testimonials")
    .then(response => {
      postData = response.data;
      const featuredImgIds = postData.map(item => ({
        id: item.id,
        imageId: item.featured_media,
      }));

      const imagePromises = featuredImgIds.map(item => 
        axios.get(`/wp-json/wp/v2/media/${item.imageId}`)
      );

      return Promise.all(imagePromises);
    })
    .then(imageResponses => {
      postImages = imageResponses.map((response, index) => ({
        id: postData[index].id,
        image: response.data.media_details.sizes.full.source_url,
      }));
      initApp();
    })
    .catch(error => {
      console.error("Error fetching testimonials:", error);
    });
}

function initApp() {
  const appElement = document.getElementById("testimonials-app");
  if (!appElement) {
    console.error("Testimonials app element not found");
    return;
  }

  function swapElements(arr, x, y) {
    [arr[x], arr[y]] = [arr[y], arr[x]];
    return arr;
  }

  function clickedLeft() {
    postData = swapElements([...postData], 1, 0);
    render(appTemplate(postData), appElement);
  }

  function clickedRight() {
    postData = swapElements([...postData], 1, 2);
    render(appTemplate(postData), appElement);
  }

  function decodeEntities(encodedString) {
    const textarea = document.createElement("textarea");
    textarea.innerHTML = encodedString;
    return textarea.value;
  }

  function stripHtmlTags(html) {
    const tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
  }

  // OLD TESTIMONIAL RENDER
  
  const appTemplate2 = (data) => html`
    <div class="testimonials-container">
      <div class="test-sides test-left" @click=${clickedLeft}>
        <div
          class="person-img"
          style="background-image: url('${findImageById(data[0].id)}');"
        >
          <div class="hover-bg">
            <div class="name">${data[0].first_name}</div>
          </div>
        </div>
      </div>
      <div class="test-center">
        <div class="header">
          <div
            class="user-img"
            style="background-image: url('${findImageById(data[1].id)}')"
          ></div>
          <div class="info">
            <h4>${data[1].first_name}</h4>
            <span>${data[1].position}</span>
          </div>
        </div>
        <p>${stripHtmlTags(decodeEntities(data[1].content.rendered))}</p>
      </div>
      <div class="test-sides test-right" @click=${clickedRight}>
        <div
          class="person-img"
          style="background-image: url('${findImageById(data[2].id)}')"
        >
          <div class="hover-bg">
            <div class="name">${data[2].first_name}</div>
          </div>
        </div>
      </div>
    </div>
  `;

  // END OLD DATA

  const appTemplate = (data) => {
    // Format the date (for example, to 'MM/DD/YYYY')
    const rawDate = new Date(data[1].date);
    const formattedDate = rawDate.toLocaleDateString('en-US', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    });
//testimonials-container
    return html`
    <div class="wrapper">

      <div class="testimonial-card item item1">
        <img class="headshot" src="${findImageById(data[1].id)}" alt="avi" >
        <div class="testimonial-card__content">
          <div class="testimonial-card__header">
            <h4 class="name">${data[1].first_name} ${data[1].last_name}</h4>
            <p class="date" align="center" style="animation: none">${formattedDate}</p>
            <div class="rating-row">
              <div class="rating-row__fill">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
          </div>
        </div>
        <p class="comment" align="center" style="animation: none">${stripHtmlTags(decodeEntities(data[1].content.rendered))}</p>
        <div class="google"></div>

      </div>
    </div>
    `;
};


  

  render(appTemplate(postData), appElement);
}

// Start the application
fetchTestimonials();
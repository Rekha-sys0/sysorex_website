const contactForm = document.getElementById("contactForm");
if (contactForm) {
    contactForm.addEventListener("submit", (e) => onSubmit(e));
}

const registrationForm = document.getElementById("registrationForm");

if (registrationForm) {
    registrationForm.addEventListener("submit", (e) => registerEvent(e));
}
const instructorDetail = document.getElementById("instructor-card");
const testimonial = document.getElementById("testimonial");

if (instructorDetail) {
    instructorCard();
}
// if (testimonial) {
//     testimonialCardData()
// }

function onSubmit(e) {
    e.preventDefault();
    // console.log(e);
    // return;
    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");
    const subject = document.getElementById("subject");
    const message = document.getElementById("message");
    var data = new FormData();
    data.append("name", name.value);
    data.append("email", email.value);
    data.append("phone", phone.value);
    data.append("subject", subject.value);
    data.append("message", message.value);
    const formData = {
        method: "post",
        header: { "Content-Type": "application/json" },
        body: data,
    };
    fetch("http://localhost/sysorex/contactus/addmessage", formData)
        .then((response) => {
            // console.log("response: ", response)
            return response.json();
        })
        .then((data) => {
            if (data.response == true) {
                document.getElementById("messages").innerHTML =
                    "<div class='alert alert-success'> Message Sent Successfully </div>";
            } else {
                document.getElementById("messages").innerHTML =
                    "<div class='alert alert-danger'> Something went wrong</div>";
            }
        })
        .catch((error) => console.log(error));
}

function registerEvent(e) {
    e.preventDefault();
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const eventid = urlParams.get("id");

    const name = document.getElementById("name");
    const dob = document.getElementById("dob");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");
    const address = document.getElementById("address");
    const pincode = document.getElementById("pincode");
    const country = document.getElementById("country");
    const expyear = document.getElementById("expyear");
    const organization = document.getElementById("organization");
    const skills = document.getElementById("skills");
    const experiencedetail = document.getElementById("experiencedetail");
    const goals = document.getElementById("goals");
    const intrest = document.getElementById("intrest");
    const trainingdetail = document.getElementById("trainingdetail");
    console.log(eventid);

    var data = new FormData();
    data.append("name", name.value);
    data.append("dob", dob.value);
    data.append("email", email.value);
    data.append("phone", phone.value);
    data.append("address", address.value);
    data.append("pincode", pincode.value);
    data.append("country", country.value);
    data.append("yearofexperience", expyear.value);
    data.append("organization", organization.value);
    data.append("skills", skills.value);
    data.append("experiencedetail", experiencedetail.value);
    data.append("goals", goals.value);
    data.append("intrest", intrest.value);
    data.append("trainingdetail", trainingdetail.value);
    data.append("eventid", eventid);
    const formData = {
        method: "post",
        header: { "Content-Type": "multipart/form-data" },
        body: data,
    };
    fetch("http://localhost/sysorex/event/registerevent", formData)
        .then((response) => {
            // console.log("response: ", response)
            return response.json();
        })
        .then((data) => {
            if (data.response.response == true) {
                document.getElementById("messages").innerHTML =
                    "<div class='alert alert-success'>Register Successfully </div>";
            } else {
                document.getElementById("messages").innerHTML =
                    "<div class='alert alert-danger'>" + data.response.msg + "<div>";
            }
        })
        .catch((error) => console.log(error));
}

function instructorCard(e) {
    // return;

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const eventid = urlParams.get("id");
    let data = new FormData();
    data.append("event_id", eventid);
    console.log(eventid);
    const formData = {
        method: "post",
        header: { "Content-Type": "multipart/form-data" },
        body: data,
    }
    fetch("http://localhost/sysorex/event/getInstructor", formData)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            for (let res of data) {
                document.getElementById("instructor-card").innerHTML += cardData(res.instructor_image, res.instructor_name,
                    res.instructor_designation, res.instructor_description, res.instructor_facebook, res.instructor_email, res.instructor_linkedin);
            }
        })
        .catch((error) => console.log(error));

}
function cardData(imageurl, name, designation, description, facebook, gmail, linkedin) {
    let card = "";
    card += `<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="crumina-module crumina-testimonial-item testimonial-item-quote-right" data-mh="test-item">
					<div class="testimonial-img-author">
						<img src="${imageurl}" alt="author" style="object-fit:cover; height:121px; width:121px;">
						
                        <div class=" ">
                            <ul class="socials">
                                
                                <li>
                                    <a href="${facebook}" class="social__item linkedin">
                                        <img class="image-icon" src="img/facebook.png"  />
                                    </a>
                                </li>
                                
                            <li>
                            <a href="${linkedin}" class="social__item linkedin">
                                <img class="image-icon" src="img/linkedin.png"  />
                            </a>
                        </li>
                            </ul>
                        </div>
                    </div>
                    <div class="author-info">
                        <a href="#" class="h6 author-name">${name}</a>
                        <div class="author-company">${designation}</div>
                    </div>
                    <h6 class="testimonial-text">
                    ${description}
                    </h6>
                </div>
            </div>`
    return card;
}


// function testimonialCardData(e) {
//     // return;
//     console.log("jufhjuadhfju");

//     let data = new FormData();
//     const formData = {
//         method: "post",
//         header: { "Content-Type": "multipart/form-data" },
//         body: data,
//     }
//     fetch("http://localhost/sysorex/testimonial/gettestimonial", formData)
//         .then((response) => {
//             return response.json();
//         })
//         .then((data) => {
//             for (let res of data) {
//                 document.getElementById("testimonial").innerHTML += testimonialCard(res.testimonial_title);
//             }
//         })
//         .catch((error) => console.log(error));

// }
// function testimonialCard(title) {
//     let card = `<div class="swiper-slide">
//                     <div class="col-lg-12 col-md-12 col-sm-12">
//                         <div class="crumina-module crumina-testimonial-item testimonial-item-arrow">
//                             <div class="author-info-wrap">
//                                 <div class="testimonial-img-author">
//                                     <img src="img/author2.png" alt="author">
//                                 </div>
//                                 <div class="author-info">
//                                     <a href="#" class="h6 author-name">${title}</a>
//                                     <div class="author-company">Student, 23 years old</div>
//                                 </div>
//                             </div>

//                             <h6 class="testimonial-text">
//                                 Qest etiam processus dynamicus, qui sequitur mutationem.
//                             </h6>

//                             <ul class="rait-stars">
//                                 <li>
//                                     <!-- <a href="#"> -->
//                                         <svg class="utouch-icon utouch-icon-star">
//                                             <use xlink:href="#utouch-icon-star"></use>
//                                         </svg>
//                                     <!-- </a> -->
//                                 </li>

//                             </ul>

//                         </div>

//                     </div>
//                 </div>`;
//     return card;
// }
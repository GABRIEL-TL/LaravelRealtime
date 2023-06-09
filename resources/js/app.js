import "./bootstrap";

const usersElement = document.getElementById("messages");
const messagesElement = document.getElementById("notificationsContainer");

Echo.join("slot")
    .here((users) => {
        // users.forEach((user, index) => {
        //     let element = document.createElement("li");
        //     element.setAttribute("id", user.id);
        //     element.setAttribute("onclick", 'greetUser("' + user.id + '")');
        //     element.innerText = user.name;
        //     usersElement.appendChild(element);
        // });
    })
    .joining((user) => {
        // let element = document.createElement("li");
        // element.setAttribute("id", user.id);
        // element.setAttribute("onclick", 'greetUser("' + user.id + '")');
        // element.innerText = user.name;
        // usersElement.appendChild(element);
    })
    .leaving((user) => {
        // let element = document.getElementById(user.id);
        // usersElement.removeChild(element);
    })
    .listen("SlotEvent", (e) => {
        let element = document.createElement("div");
        element.innerText = e.message;
        messagesElement.appendChild(element);
    });

// Echo.private("notifications").listen("UserSessionChanged", (e) => {
//     console.log(e);
//     // notificationElement.classList.remove("invisible");
//     // notificationElement.classList.remove("alert-success");
//     // notificationElement.classList.remove("alert-danger");
// });

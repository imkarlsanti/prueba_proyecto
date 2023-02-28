var chatbot = document.getElementById("chatbot");

function sendMessage() {
    var message = document.getElementById("input-message").value;
    if (message != "") {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                chatbot.innerHTML += "<p>Chatbot: " + response + "</p>";
                chatbot.scrollTop = chatbot.scrollHeight;
            }
        };
        xhr.open("POST", "/chatbot", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("message=" + message);
        document.getElementById("input-message").value = "";
    }
}

document.getElementById("btn-send").addEventListener("click", sendMessage);
document.getElementById("input-message").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        sendMessage();
    }
});
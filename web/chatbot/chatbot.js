document.addEventListener("DOMContentLoaded", function() {
  const chatbot = document.createElement("div");
  chatbot.classList.add("chatbot-container");
  chatbot.innerHTML = `
    <div class="chatbot-header">Asistente Inkarian 🤖</div>
    <div class="chatbot-body" id="chatbotBody">
      <div class="chatbot-message bot">¡Hola! Si necesitas ayuda, acá estoy 😊</div>
    </div>
    <div class="chatbot-input">
      <input type="text" id="chatInput" placeholder="Escribe tu pregunta..." />
      <button id="sendBtn">Enviar</button>
    </div>
  `;
  document.body.appendChild(chatbot);

  // Mostrar chatbot automáticamente después de 3 segundos
  setTimeout(() => chatbot.style.display = "block", 3000);

  const chatBody = document.getElementById("chatbotBody");
  const chatInput = document.getElementById("chatInput");
  const sendBtn = document.getElementById("sendBtn");

  sendBtn.addEventListener("click", sendMessage);
  chatInput.addEventListener("keypress", e => {
    if (e.key === "Enter") sendMessage();
  });

  function sendMessage() {
    const text = chatInput.value.trim();
    if (text === "") return;
    addMessage(text, "user");
    chatInput.value = "";

    // Enviar la pregunta al chatbot.php
    fetch("web/chatbot/chatbot.php", {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      body: "message=" + encodeURIComponent(text)
    })
    .then(res => res.text())
    .then(res => addMessage(res, "bot"))
    .catch(() => addMessage("Hubo un error 😢", "bot"));
  }

  function addMessage(text, sender) {
    const div = document.createElement("div");
    div.classList.add("chatbot-message", sender);
    div.textContent = text;
    chatBody.appendChild(div);
    chatBody.scrollTop = chatBody.scrollHeight;
  }
});

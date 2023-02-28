from flask import Flask, request
import openai

app = Flask(__name__)
openai.api_key = "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"

@app.route("/")
def index():
    return """
    <html>
    <head>
        <title>Chatbot de OpenAI</title>
    </head>
    <body>
        <div id="chatbot"></div>
        <input type="text" id="input-message" />
        <button id="btn-send">Enviar</button>
        <script src="/static/chatbot.js"></script>
    </body>
    </html>
    """

@app.route("/chatbot", methods=["POST"])
def chatbot():
    message = request.form["message"]
    response = generate_response(message)
    return response

def generate_response(prompt):
    response = openai.Completion.create(
        engine="davinci",
        prompt=prompt,
        max_tokens=1024,
        n=1,
        stop=None,
        temperature=0.7,
    )

    message = response.choices[0].text.strip()
    return message

if __name__ == "__main__":
    app.run(debug=True)

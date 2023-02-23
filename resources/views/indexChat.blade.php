<html>
  <head>
    <title>Socket.IO chat</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
      body { margin: 0; padding-bottom: 3rem; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }

      #form { background: rgba(0, 0, 0, 0.15); padding: 0.25rem; position: fixed; bottom: 0; left: 0; right: 0; display: flex; height: 3rem; box-sizing: border-box; backdrop-filter: blur(10px); }
      #input { border: none; padding: 0 1rem; flex-grow: 1; border-radius: 2rem; margin: 0.25rem; }
      #input:focus { outline: none; }
      #form > button { background: #333; border: none; padding: 0 1rem; margin: 0.25rem; border-radius: 3px; outline: none; color: #fff; }

      #messages { list-style-type: none; margin: 0; padding: 0; }
      #messages > li { padding: 0.5rem 1rem; }
      #messages > li:nth-child(odd) { background: #efefef; }
    </style>
  </head>
  <body>
    <header>
      <h1 class="text-center mt-2">Chat with your friends</h1><hr>
    </header>
    <div class="chat-content">
      <ul id="messages"></ul>
    </div>
    <form id="form">
      <input id="input" autocomplete="off" name="content" /><button type="submit" id="sent">Send</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js" integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script>
      $(function(){
        // event.preventDefault();
        let ip_address ='127.0.0.1';
        let socket_port = '3000';
        let socket = io(ip_address+ ':' +socket_port);
        socket.on('connection');
        let ChatInput = $('#input');
        ChatInput.keypress(function (e) { 
            let message = $(this).val();
            if(e.which === 13 && !e.shiftKey) {
              socket.emit('sendChatToServer', message);
              ChatInput.val('');
              return false;
            }
        });

        socket.on('sendChatToClient', (message) => {
          $('.chat-content ul').append(`<li>${message}</li>`);
          window.scrollTo(0, document.body.scrollHeight);
        });
      });
    </script>
  </body>
</html>


<?php require_once APP_ROOT . '/views/includes/header.php'; ?>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <a class="btn btn-primary mt-3" href="<?= URL_ROOT . '/users/destroySession'; ?>" role="button">Log out</a>
                <div class="card w-100 mt-3">
                    <div class="card-body">
                        <div id="chat"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card card-body bg-light mt-3">
                    <form id="post-form">
                        <div class="form-group">
                            <label for="post-message">Message:</label>
                            <textarea id="post-message" class="form-control" name="message" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    
        const showMessages = () => {
            const request = new XMLHttpRequest();
            request.open('GET', '<?= URL_ROOT . '/messages/index'; ?>', true);
            request.onload = () => {
                if (request.status === 200) {
                    let messages = <?= $data['messages']; ?>;
                    let output = '';
                    for (let i in messages) {
                        output += `<p class="card-text"><strong>${messages[i].name}:</strong> ${messages[i].message} ${messages[i].created_at}</p>`;
                    }
                    document.querySelector('#chat').innerHTML = output;
                }
            };
            request.send();
        }

        showMessages();
        setInterval(() => { showMessages(); }, 2000);

        document.querySelector('#post-form').addEventListener('submit', () => {
            const message = 'message=' + document.querySelector('#post-message').value;
            const request = new XMLHttpRequest;
            request.open('POST', '<?= URL_ROOT . '/messages/post'; ?>', true);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.onload = (e) => {
                if (request.status === 200) {
                    e.preventDefault();
                }
            };
            request.send(message);
        });

    </script>

<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>
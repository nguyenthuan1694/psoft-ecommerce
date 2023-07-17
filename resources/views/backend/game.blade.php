<!DOCTYPE html>
<html>
<head>
  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .game {
      width: 650px;
      margin: 0 auto;
    }

    .card {
      width: 150px;
      height: 150px;
      margin: 5px;
      float: left;
      perspective: 600px;
    }

    .card-inner {
      width: 100%;
      height: 100%;
      position: relative;
      transform-style: preserve-3d;
      transition: transform 0.6s;
    }

    .card.flipped .card-inner {
      transform: rotateY(180deg);
    }

    .card-front, .card-back {
      width: 100%;
      height: 100%;
      position: absolute;
      backface-visibility: hidden;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .card-front {
        background-image: url('https://haycafe.vn/wp-content/uploads/2021/11/Hinh-anh-Naruto-chibi-cool-ngau.jpg'); /* Hình mặt sau */
        border-radius: 5px;
        cursor: pointer;
        background-size: cover;
    }

    .card-back {
      background-size: cover;
      transform: rotateY(180deg);
      border-radius: 5px;
    }
    .reset-button {
      position: absolute;
      top: 5%;
      left: 50%;
      transform: translateX(-50%);
      padding: 10px 20px;
      background-color: #138496;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .reset-button:hover {
      background-color: #17a2b8;
    }

    @media (max-width: 480px) {
      .card {
        width: 50px;
        height: 50px;
      }

      .container {
        width: 250px;
      }

      .reset-button {
        font-size: 12px;
      }
    }

  </style>
</head>
<body>
  <!-- <div id="gameboard"></div> -->
  <!-- <div id="gameboard" style="width: 500px; margin: 0 auto;"></div> -->
  <div class="container">
    <div class="game" id="gameboard"></div>
  </div>

  <button class="reset-button" onclick="resetGame()">Chơi lại</button>

  <script>
    var gameBoard = document.getElementById('gameboard');
    var cards = [];
    var flippedCards = [];
    var matchedCards = 0;

    // Hình ảnh của các lá bài
    var cardImages = [
      'https://i.pinimg.com/originals/84/8e/d0/848ed00f8b5d55099ef90509f257cf23.jpg', //1
      'https://i.pinimg.com/736x/6d/46/59/6d4659107647fcec406f5b9d242dd478.jpg',
      'https://i.pinimg.com/originals/e5/f7/69/e5f7697b16193401493a6db126766f75.jpg',
      'https://i.pinimg.com/736x/2f/21/f2/2f21f29324bc9adfe84a1d1047aa1bdf--naruto-gaiden-naruto-shippuden.jpg',
      'https://duhocchaudaiduong.edu.vn/hinh-naruto-va-sasuke-ngau/imager_2142.jpg',
      'https://haycafe.vn/wp-content/uploads/2022/03/Anh-Sasuke-tong-hop-cac-sac-thai.jpg',
      'https://i.pinimg.com/originals/84/8e/d0/848ed00f8b5d55099ef90509f257cf23.jpg',//1
      'https://i.pinimg.com/736x/6d/46/59/6d4659107647fcec406f5b9d242dd478.jpg',
      'https://i.pinimg.com/originals/e5/f7/69/e5f7697b16193401493a6db126766f75.jpg',
      'https://i.pinimg.com/736x/2f/21/f2/2f21f29324bc9adfe84a1d1047aa1bdf--naruto-gaiden-naruto-shippuden.jpg',
      'https://duhocchaudaiduong.edu.vn/hinh-naruto-va-sasuke-ngau/imager_2142.jpg',
      'https://haycafe.vn/wp-content/uploads/2022/03/Anh-Sasuke-tong-hop-cac-sac-thai.jpg',
    ];

    // Tạo và hiển thị các lá bài trên gameboard
    function createGameBoard() {
      // Xáo trộn thứ tự các lá bài
      cardImages.sort(() => Math.random() - 0.5);

      for (var i = 0; i < cardImages.length; i++) {
        var card = document.createElement('div');
        card.classList.add('card');
        card.dataset.cardIndex = i;
        var cardInner = document.createElement('div');
        cardInner.classList.add('card-inner');

        var cardFront = document.createElement('div');
        cardFront.classList.add('card-front');

        var cardBack = document.createElement('div');
        cardBack.classList.add('card-back');
        cardBack.style.backgroundImage = 'url(' + cardImages[i] + ')';

        cardInner.appendChild(cardFront);
        cardInner.appendChild(cardBack);
        card.appendChild(cardInner);

        card.addEventListener('click', flipCard);
        gameBoard.appendChild(card);
        cards.push(card);
      }
    }

    // Lật một lá bài
    function flipCard() {
      // Nếu lá bài đã được lật hoặc đang hiển thị
      if (this.classList.contains('flipped') || flippedCards.length === 2) {
        return;
      }

      this.classList.add('flipped');
      this.style.backgroundImage = 'url(' + cardImages[this.dataset.cardIndex] + ')';

      flippedCards.push(this);

      if (flippedCards.length === 2) {
        checkForMatch();
      }
    }

    // Kiểm tra xem hai lá bài đã lật có giống nhau hay không
    function checkForMatch() {
        var card1 = flippedCards[0];
        var card2 = flippedCards[1];

        if (cardImages[card1.dataset.cardIndex] === cardImages[card2.dataset.cardIndex]) {
            card1.removeEventListener('click', flipCard);
            card2.removeEventListener('click', flipCard);
            matchedCards += 2;
            flippedCards = [];

            if (matchedCards === cardImages.length) {
                setTimeout(() => {
                    alert('Chúc mừng! Bạn đã hoàn thành trò chơi!');
                }, 500);
            }
        } else {
            setTimeout(() => {
                card1.style.backgroundImage = 'url(https://haycafe.vn/wp-content/uploads/2021/11/Hinh-anh-Naruto-chibi-cool-ngau.jpg)';
                card2.style.backgroundImage = 'url(https://haycafe.vn/wp-content/uploads/2021/11/Hinh-anh-Naruto-chibi-cool-ngau.jpg)';
                card1.classList.remove('flipped');
                card2.classList.remove('flipped');
                flippedCards = [];
            }, 500);
        }
    }

    // Chơi lại trò chơi
    function resetGame() {
      gameBoard.innerHTML = '';
      cards = [];
      flippedCards = [];
      matchedCards = 0;
      createGameBoard();
    }

    // Khởi tạo trò chơi khi trang web được tải
    createGameBoard();
  </script>
</body>
</html>
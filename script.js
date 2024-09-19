const canvas = document.getElementById('chessboard');
const ctx = canvas.getContext('2d');

// Размеры доски
const boardSize = 8;
const tileSize = canvas.width / boardSize;

for (let i = 0; i < boardSize; i++) {
    for (let col = 0; col < boardSize; col++) {
        // Определяем цвет клетки
        const isBlack = (i + col) % 2 === 1;

        ctx.fillStyle = isBlack ? '#000000' : '#ffffff';
        ctx.fillRect(col * tileSize, i * tileSize, tileSize, tileSize);
    }
}

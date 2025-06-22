// ◆ anyIdeasDisplay.phpからJSONデータを取得し、ourIdeas内にテーブルを動的に生成
fetch('anyIdeasDisplay.php')
    .then(response => response.json())
    .then(data => {
        const ourIdeas = document.querySelector('.ourIdeas');
        let html = '<h2>Our ideas</h2><div class="ourIdeas-wrapper">';
        if (data.length > 0) {
            html += '<table class="ourIdeas-table">';
            html += '<thead><tr><th>登録日</th><th>いつ</th><th>誰と</th><th>何をしたい</th></tr></thead>';
            html += '<tbody>';
            data.forEach(entry => {
                html += `<tr>
                    <td>${entry.time}</td>
                    <td>${entry.whenToDo}</td>
                    <td>${entry.whoWith}</td>
                    <td>${entry.whatToDo}</td>
                </tr>`;
            });
            html += '</tbody></table>';
        } else {
            html += '<p>登録データがありません</p>';
        }
        html += '</div>';
        ourIdeas.innerHTML = html;
    })
    .catch(error => {
        console.error('Error:', error);
    });

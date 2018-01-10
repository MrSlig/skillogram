<script type="text/javascript"
    src="https://code.jquery.com/jquery-3.2.1.min.js">
</script>
<script type="text/javascript">
    $(function() {
        $('#searchQuery').css('border-color', 'red');
        $('.post:eq(0)').html('new html');
        $('.post:eq(1) .title').html('new title');
        $('.post:eq(1) .text').text('text have been changed');
        var content = $('.content');
        content.find('[data-like=7]').html('7 likes');
        content.find('[data-like=8]').html('8 likes');
        $('.post').slideToggle(500);
        $('.post').slideToggle(500);
        $('.content').on('click', '#searchButton', function () {
            alert('Нажали');
        });
        console.log($('#logo').width());
        console.log($('#searchQuery').width());
        console.log($('.post:eq(0)').width());
    });

    $.ajax({
        url: "index.php?action=ajax",
        data: {},
        type: "json",
        success: function (posts) {
            posts.forEach(function (post) {
                $('.posts').append(
                    "        <div class=\"post\">\n" +
                    "            <p class=\"title\">Заголовок ajax</p>\n" +
                    "            <p class=\"text\">Текст ajax</p>\n" +
                    "        </div>")
            });
        },
        error: function (response) {
        }
    })
</script>
<div class="header">
    <img id="logo">
</div>
<div class="content">
    <input type="text" id="searchQuery">
    <input type="button" value="Искать" id="searchButton">
    <div class="posts">
        <div class="post" data-like="6">
            <p class="title">Заголовок 1</p>
            <p class="text">Текст 1</p>
        </div>
        <div class="post" data-like="5">
            <p class="title">Заголовок 2</p>
            <p class="text">Текст 2</p>
        </div>
        <div class="post" data-like="7">
            <p class="title">Заголовок 3</p>
            <p class="text">Текст 3</p>
        </div>
        <div class="post" data-like="8">
            <p class="title">Заголовок 4</p>
            <p class="text">Текст 4</p>
        </div>
    </div>
</div>
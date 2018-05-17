<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header class="col-12 flex-container">
            <div id="logo" class="col-2">
                <img src="images/logo.jpg" alt="logo"/>
            </div>
            <div class="col-10">
                <button class="card-panel">HOME</button>
                <button class="card-panel">ABOUT</button>
                <button class="card-panel" onclick="open_page('pivot.php')">PIVOT</button>
                <button class="card-panel" onclick="open_page('delivery_interface.php')">DELIVERIES</button>
                <button class="card-panel" onclick="open_page('client_variances.htm')">VARIANCES</button>
            </div>
        </header>
        <div id="slider">
            <img src="images/slider.jpg" alt="slider"/>
        </div>
        <div id="container" class="col-12">
            <div class="content flex-container">
                <article class="col-7 card-panel" id="article">
                    On the Insert tab, the galleries include items that are designed to coordinate with the overall look of your document. You can use these galleries to insert tables, headers, footers, lists, cover pages, and other document building blocks. When you create pictures, charts, or diagrams, they also coordinate with your current document look.
                    You can easily change the formatting of selected text in the document text by choosing a look for the selected text from the Quick Styles gallery on the Home tab. You can also format text directly by using the other controls on the Home tab. Most controls offer a choice of using the look from the current theme or using a format that you specify directly.
                    To change the overall look of your document, choose new Theme elements on the Page Layout tab. To change the looks available in the Quick Style gallery, use the Change Current Quick Style Set command. Both the Themes gallery and the Quick Styles gallery provide reset commands so that you can always restore the look of your document to the original contained in your current template.
                    On the Insert tab, the galleries include items that are designed to coordinate with the overall look of your document. You can use these galleries to insert tables, headers, footers, lists, cover pages, and other document building blocks. When you create pictures, charts, or diagrams, they also coordinate with your current document look.
                    You can easily change the formatting of selected text in the document text by choosing a look for the selected text from the Quick Styles gallery on the Home tab. You can also format text directly by using the other controls on the Home tab. Most controls offer a choice of using the look from the current theme or using a format that you specify directly.
                    To change the overall look of your document, choose new Theme elements on the Page Layout tab. To change the looks available in the Quick Style gallery, use the Change Current Quick Style Set command. Both the Themes gallery and the Quick Styles gallery provide reset commands so that you can always restore the look of your document to the original contained in your current template.

                </article>
                <aside class="col-4 card-panel">On the Insert tab, the galleries include items that are designed to coordinate with the overall look of your document. You can use these galleries to insert tables, headers, footers, lists, cover pages, and other document building blocks. When you create pictures, charts, or diagrams, they also coordinate with your current document look.
                    You can easily change the formatting of selected text in the document text by choosing a look for the selected text from the Quick Styles gallery on the Home tab. You can also format text directly by using the other controls on the Home tab. Most controls offer a choice of using the look from the current theme or using a format that you specify directly.
                </aside>
            </div>
            <div class="col-12" id="panel">To change the overall look of your document, choose new Theme elements on the Page Layout tab. To change the looks available in the Quick Style gallery, use the Change Current Quick Style Set command. </div>
        </div>

        <footer class="col-12" id="footer">
            <div class="col-3" id="links"></div>
            <div class="col-3" id="social"></div>
            <div class="col-3" id="contact"></div>
            <div class="col-11" id="copy"></div>
        </footer>
        <script>
            function open_page (argument) {
            window.open( argument);
            }
        </script>
    </body>
</html>
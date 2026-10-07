// Gather structural application hooks
const runButton = document.getElementById('run-btn');
const htmlInput = document.getElementById('html-code');
const cssInput = document.getElementById('css-code');
const jsInput = document.getElementById('js-code');
const previewFrame = document.getElementById('preview-frame');

function compileAndExecute() {
      
    const html = htmlInput.value;
    const css = cssInput.value;
    const js = jsInput.value;

   
    const frameDoc = previewFrame.contentWindow.document;

    
    frameDoc.open();
    frameDoc.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <style>
                /* Inside-sandbox default structural rendering reset overrides */
                body { font-family: sans-serif; padding: 20px; color: #333; }
                ${css}
            </style>
        </head>
        <body>
            ${html}
            <script>
                try {
                    ${js}
                } catch (err) {
                    document.body.innerHTML += '<div style="color: #ef4444; margin-top: 20px; padding: 10px; background: #fee2e2; border-radius: 4px; font-family: monospace;">Runtime Exception: ' + err.message + '</div>';
                }
            <\/script>
        </body>
        </html>
    `);
    frameDoc.close();
}

// Hook compiler directly into button mouse trigger streams
runButton.addEventListener('click', compileAndExecute);

// Initialize application state render loops immediately on generation
window.addEventListener('DOMContentLoaded', compileAndExecute);

export function advertisements()
{
    $(".advertisements").on('click', function() {
    	let url = $(this).data("url")
    	if (!url.match(/^https?:\/\//i)) {
    		url = 'http://' + url;
    	}
    	window.open(url)
    });
}
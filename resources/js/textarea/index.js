export function textarea(parent = null) {
    if (parent) {
        parent = parent.find("textarea")
    } else {
        parent = $("textarea")
    }
    setTimeout(function() {
        parent.each(function() {
            if (this.value) {
                let el = this
                el.style.height = el.scrollHeight + "px"
            }
        })

        parent.on('focus keyup keypress keydown input', function() {
            let el = $(this)
            console.log(el.prop('scrollHeight'))
            setTimeout(function() {
                el.css({
                    "height": 0
                })
                el.css({
                    "height": el.prop('scrollHeight')
                })
            }, 0)
        })
    }, 500)
}
